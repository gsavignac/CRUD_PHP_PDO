<?php

   ini_set("display_errors",0);

   /**
    * Esta es una clase que permite realizar una conexion
    * a la base de datos en postgres utiliazndo procesos 
    * nativos de php
    * */
   class Conexion
   {

      private $Servidor;
      private $Puerto;
      private $Nombre;
      private $Usuario;
      private $Clave;
      public $msg_error;

      function __construct($Servidor,$Puerto,$Nombre,$Usuario,$Clave)
      {
         $this->Servidor=$Servidor;
         $this->Puerto=$Puerto;
         $this->Nombre=$Nombre;
         $this->Usuario=$Usuario;
         $this->Clave=$Clave;
         $this->msg_error = '';
      }

      /**
       * Esta funcion permite conectarce a una base de datos postgres
       * */
      public function Conectar()
      {
         $BaseDato=pg_connect("host=$this->Servidor port=$this->Puerto dbname=$this->Nombre user=$this->Usuario password=$this->Clave") or die('No se ha podido conectar: ' . pg_last_error());;
         return $BaseDato;
      }

      /**
       * Esta funcion permite desconectarce de una base de datos postgres
       * */
      public function Desconectar($conexion){
         pg_close($conexion);
      }
      
      /**
       * Esta funcion permite ejecutar un query sql en la base de datos
       * */
      public function Ejecutar($sql)
      {
         $conect=$this->Conectar();
         if(!$conect)
            return 0; //Si no se pudo conectar
         else
         {
            //Valor es resultado de base de dato y Consulta es la Consulta a realizar
            $resp=pg_query($conect,$sql);
            $arreglo = array();
            if(pg_affected_rows($resp)>=0 && pg_last_error($conect)==''){
               while($row = pg_fetch_array($resp)){
                  $arreglo[] = $row;
               }
               return $arreglo; //retorna el listado de registros
            }else{
               $this->msg_error = pg_last_error($conect); // guarda el error generado
               return false;// retorna si ocurrio algun error
            }
         }
      }
   }
?>

