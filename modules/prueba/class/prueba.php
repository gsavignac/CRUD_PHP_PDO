<?php
ini_set("display_errors",1);
include_once("../lib/funciones_php/funciones_principales.php");
@include_once "../../class/conexion_postgres.php";

class prueba
{

	private $id_prueba;
	private $dato1;
	private $dato2;

	function __construct($data)
	{
		if($data!=null)
		{

			if(!empty($data['id_prueba'])){
				// si se recibe como parametro un id se le asigna a la variable
				$this->id_prueba = $data['id_prueba'];
			}else{
				// si no recibe id se genera uno nuevo
				$this->id_prueba = generar_codigo();
			}
			$this->dato1 = $data['dato1'];
			$this->dato2 = $data['dato2'];
		}
	}

	public function listar($conexion){

		$sent = $conexion->query("SELECT * FROM prueba ORDER BY dato1 ASC");
		$result = $sent->fetchAll();
		if(count($result)==0){
			return true; //se envia true para que no de error en el controlados
		}
		return $result;
	}

	public function crear($conexion){

		$busqueda = $this->buscar($conexion);
		if(count($busqueda) == 0)
		{
			$sql = "INSERT INTO prueba (id_prueba, dato1, dato2) VALUES(?,?,?)";
			$resp = $conexion->prepare($sql);
			$resp->execute([$this->id_prueba, $this->dato1, $this->dato2]);	
			$error = $resp->errorInfo();	
			if($error[0] != 0){ 
				$conexion->msg_error = $error[2]; 
				return false; 
			}else{
				return true;
			}
		}else{
			$conexion->msg_error = "Ya se encuentran los datos en la base de datos."; 
			return false;
		}

	}

	public function actualizar($conexion){

		$sql = "UPDATE prueba SET dato1 = ?, dato2 = ? WHERE id_prueba = ?";
		$resp = $conexion->prepare($sql);
		$resp->execute([$this->dato1, $this->dato2, $this->id_prueba]);	
		$error = $resp->errorInfo();	
		if($error[0] != 0){ 
			$conexion->msg_error = $error[2]; 
			return false;
		}else{
			return true;
		}

	}

	public function eliminar($conexion){

		$sql = "DELETE FROM prueba WHERE id_prueba = ?";
		$resp = $conexion->prepare($sql);
		$resp->execute([$this->id_prueba]);
		$error = $resp->errorInfo();	
		if($error[0] != 0){ 
			$conexion->msg_error = $error[2]; 
			return false;
		}else{
			return true;
		}

	}

	public function buscar($conexion){

		$sent = $conexion->query("SELECT * FROM prueba where dato1='$this->dato1' and dato2='$this->dato2';");
		$result = $sent->fetchAll();
		return $result;

	}

}

?>