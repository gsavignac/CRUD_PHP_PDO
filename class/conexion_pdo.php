<?php

   ini_set("display_errors",0);

   /**
    * Esta es una clase que permite realizar una conexion
    * a la base de datos en postgres utiliazndo PDO
    * */

   class ConexionPostgreSQL
   {
      private $Servidor;
      private $Puerto;
      private $BaseDatos;
      private $Usuario;
      private $Clave;
      public $msg_error;
      private $conect;

      function __construct()
      {
         include_once "../config/constantes.php"; // variables de conexion

         $this->Servidor   = SERVIDOR;
         $this->Puerto     = PUERTO;
         $this->BaseDatos  = BD;
         $this->Usuario    = USUARIO;
         $this->Clave      = CLAVE;

         $this->msg_error  = '';//variable para manejar detalles de errores de sql generado en los procesos
      }

      /**
       * Esta funcion permite conectarce a una base de datos postgres
       * */
      public function Conectar()
      {
         try {
             $this->conect = new PDO("pgsql:host=$this->Servidor;port=$this->Puerto;dbname=$this->BaseDatos", $this->Usuario, $this->Clave);
             return $this->conect;
         } catch (PDOException $e) {
             print "No se ha podido conectar: " . $e->getMessage().PHP_EOL;
         }
      }

      /**
       * Esta funcion permite desconectarce de una base de datos postgres
       * */
      public function Desconectar($conexion){
         $conexion = null;
      }

   }
?>

