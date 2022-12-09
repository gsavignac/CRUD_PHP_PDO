<?php
ini_set("display_errors",0);
include_once("../lib/funciones_php/funciones_principales.php");

class usuarios
{

	private $id_usuario;
	private $username;
	private $passkey;
	private $estatus;

	function __construct($data)
	{
		if($data!=null)
		{
			if(!empty($data['id_usuario'])){
			$this->id_usuario = $data['id_usuario'];
			}else{
				$this->id_usuario = generar_codigo();
			}
			$this->username = $data['username'];
			$this->passkey = $data['passkey'];
			$this->estatus = $data['estatus'];
		}
	}

	public function listar($conexion){

		$sql = "SELECT * FROM usuarios ORDER BY username ASC";
		$resp = $conexion->Ejecutar($sql);

		for ($i=0; $i < count($resp); $i++) { 
			$id_usuario = $resp[$i]['id_usuario'];
			$estatus = $resp[$i]['estatus'];

			if($estatus == 'ACTIVO'){
				$resp[$i]['estatus'] = '<span class="text-success"><b>'.$estatus.'</b></span>';
			}else{
				$resp[$i]['estatus'] = '<span class="text-danger"><b>'.$estatus.'</b></span>';
			}

			$btns = '<button type="button" title="CAMBIAR ESTATUS" class="btn btn-xs btn-info" onclick="cambiar_estatus(\''.$id_usuario.'\',\''.$estatus.'\');"><i class="fa fa-pencil"></i></button>';
			$btns .= '<button type="button" title="ELIMINAR" class="btn btn-xs btn-danger" onclick="eliminar(\''.$id_usuario.'\');"><i class="fa fa-trash"></i></button>';

			$resp[$i]['acciones'] = $btns;
		}

		if(count($resp)==0){ return true; }

		return $resp;
	}

	public function crear($conexion){

		$busqueda = $this->buscar($conexion);
		if(count($busqueda)>0)
		{
			return false;
		}else{

			$this->passkey = password_hash($this->passkey, PASSWORD_BCRYPT);

			$sql = "INSERT INTO usuarios (id_usuario, username, passkey, estatus) 
					VALUES('$this->id_usuario', '$this->username', '$this->passkey', 'ACTIVO')";
			$resp = $conexion->Ejecutar($sql);
			if(count($resp) == 0){
				return true;
			}else{
				return $resp;
			}
		}

	}

	public function actualizar($conexion){

		$sql = "UPDATE usuarios SET estatus = '$this->estatus' WHERE id_usuario = '$this->id_usuario'";
		$resp = $conexion->Ejecutar($sql);
		if(count($resp) == 0){
			return true;
		}else{
			return $resp;
		}

	}

	public function eliminar($conexion){

		$sql = "DELETE FROM usuarios WHERE id_usuario = '$this->id_usuario'";
		$resp = $conexion->Ejecutar($sql);
		if(count($resp) == 0){
			return true;
		}else{
			return $resp;
		}

	}

	public function buscar($conexion){

		$sql = "SELECT * FROM usuarios WHERE username = '$this->username'";
		$resp = $conexion->Ejecutar($sql);
		return $resp;

	}

}

?>