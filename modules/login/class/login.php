<?php
ini_set("display_errors",0);
include_once("../lib/funciones_php/funciones_principales.php");

class login
{

	private $id_usuario;
	private $username;
	private $passkey;
	private $estatus;

	function __construct($data)
	{
		if($data!=null)
		{
			if(!empty($data['id_persona'])){
			$this->id_persona = $data['id_persona'];
			}else{
				$this->id_persona = generar_codigo();
			}
			$this->username = $data['username'];
			$this->passkey = $data['passkey'];
			$this->estatus = $data['estatus'];
		}
	}

	public function iniciar_sesion($conexion){

		// verificamos si el usuario existe en base de datos
		$usuario = $this->buscar($conexion);

		if(count($usuario) > 0){
			if($usuario[0]['estatus'] == 'ACTIVO'){

				$verificar = password_verify($this->passkey, $usuario[0]['passkey']);
				if($verificar){

					session_start();
					$_SESSION = array();
					$_SESSION['username'] = $usuario[0]['username'];
					return true;

				}else{
					//credenciales incorrectas
					$conexion->msg_error = "Usuario/Contraseña incorrectas.";
					return false;
				}

			}else{
				//usuario inactivo
				$conexion->msg_error = "El usuario se encuentra actualmente en estatus INACTIVO.";
				return false;
			}
		}else{
			// no existe
			$conexion->msg_error = "El usuario no se encuentra registrado.";
			return false;
		}

	}

	public function cerrar_sesion($conexion){

		$_SESSION = array();

		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		session_destroy();
		return true;
	}

	public function buscar($conexion){

		$sql = "SELECT * FROM usuarios WHERE username = '$this->username';";
		$resp = $conexion->Ejecutar($sql);
		return $resp;

	}

}

?>