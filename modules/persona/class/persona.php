<?php
ini_set("display_errors",0);
include_once("../lib/funciones_php/funciones_principales.php");

class persona
{

	private $id_persona;
	private $cedula;
	private $nombre;
	private $telefono;
	private $direccion;
	private $email;

	function __construct($data)
	{
		if($data!=null)
		{
			if(!empty($data['id_persona'])){
			$this->id_persona = $data['id_persona'];
			}else{
				$this->id_persona = generar_codigo();
			}
			$this->cedula = $data['cedula'];
			$this->nombre = $data['nombre'];
			$this->telefono = $data['telefono'];
			$this->direccion = $data['direccion'];
			$this->email = $data['email'];
		}
	}

	public function listar($conexion){

		$sql = "SELECT * FROM persona ORDER BY cedula ASC";
		$resp = $conexion->Ejecutar($sql);
		if(count($resp)==0){ return true; }
		return $resp;
	}

	public function crear($conexion){

		$busqueda = $this->buscar($conexion);
		if(count($busqueda)>0)
		{
			return false;
		}else{
			$sql = "INSERT INTO persona (id_persona, cedula, nombre, telefono, direccion, email) VALUES('$this->id_persona', '$this->cedula', '$this->nombre', '$this->telefono', '$this->direccion', '$this->email')";
			$resp = $conexion->Ejecutar($sql);
			if(count($resp) == 0){
				return true;
			}else{
				return $resp;
			}
		}

	}

	public function actualizar($conexion){

		$sql = "UPDATE persona SET cedula = '$this->cedula', nombre = '$this->nombre', telefono = '$this->telefono', direccion = '$this->direccion', email = '$this->email' WHERE id_persona = '$this->id_persona'";
		$resp = $conexion->Ejecutar($sql);
		if(count($resp) == 0){
			return true;
		}else{
			return $resp;
		}

	}

	public function eliminar($conexion){

		$sql = "DELETE FROM persona WHERE id_persona = '$this->id_persona'";
		$resp = $conexion->Ejecutar($sql);
		if(count($resp) == 0){
			return true;
		}else{
			return $resp;
		}

	}

	public function buscar($conexion){

		$sql = "SELECT * FROM persona WHERE cedula = '$this->cedula'";
		$resp = $conexion->Ejecutar($sql);
		return $resp;

	}

}

?>