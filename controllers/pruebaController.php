<?php

/** Archivo que actua como puente entre la vista y las clases del sistema **/

ini_set("display_errors",1);/* opcion para mostrar u ocultar errores de php */
$respuesta = array();/* se inicializa un arreglo recibir los resultados de la consultas */
$resp = array();/* arreglo que sera retornado con las respuestas de las operaciones */

/** parametros que recibe **/
$method=$_POST["accion"];/* accion o metodo a ejecutar */
$parametros=$_POST["datos"];/* datos enviados como parametros a la clase */

if($method!="")
{
	@include_once "../class/conexion_pdo.php";/* incluimos la clase conexion */
	@include_once "../modules/prueba/class/prueba.php";/* incluimos la clase recibida */
	
	$BD = new ConexionPostgreSQL(); /* creamos la conexion a la base de datos */
	$conexion = $BD->Conectar();
	$objeto = new prueba($parametros);/* creamos un objeto de la clase */
	$respuesta = $objeto->$method($conexion);/* ejecutamos el metodo seleccionado y rrecibimos una respuesta */
	if($respuesta)/* respondemos si la accion se ejecuto con exito */
	{
		$resp["success"] = true;
		$resp["message"] = "Operacion exitosa";
		$resp["data"] = $respuesta;
	}else{/* respondemos si la accion no se ejecuto */
		$resp["success"] = false;
		$resp["message"] = "Error al realizar la operacion";
		$resp["data"] = $respuesta;
		$resp["error"] = $conexion->msg_error; // se trae el erro desde postgres
	}

	$BD->Desconectar($conexion);/* cerramos la conexion con la base de datos */

}else{
	/* si se reciven valores vacios en los parametros obligatorios */
	/* se retorna un mensaje de error */
	$resp["success"] = false;
	$resp["message"] = "Error, Se han enviado parametros vacios.";
}
	header('Content-type: application/json; charset=utf-8');
	/* retornamos la respuesta en formato JSON */
	echo json_encode($resp);
?>
