<?php  

session_start();
if($_SESSION['username'] =='' || $_SESSION['username'] ==  null){
	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CRUD Practica</title>
	<link rel="stylesheet" href="lib/bootstrap.min.css">
	<link rel="stylesheet" href="lib/bootstrap-material-design/css/material.min.css">
	<link rel="stylesheet" href="lib/bootstrap-material-design/css/material-fullpalette.css">
	<link rel="stylesheet" href="lib/bootstrap-material-design/css/roboto.css">
	<link rel="stylesheet" href="lib/font-awesome-4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="lib/bootstrap-table/css/bootstrap-table.css">
	<link rel="stylesheet" href="lib/sweetalert/dist/sweetalert.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-info">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php">
			<img src="img/logo_circle.png" alt="" style="height: 50px; max-width: 100%; margin-top: -10px;">
		</a>
		<ul class="nav navbar-nav">
			<?php 
				include_once('lib/funciones_php/funciones_principales.php');
				mostrar_modulos();
			?>
		</ul>
		<ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		           <img src="img/avatar.png" alt="avatar" style="height: 30px; max-width: 100%; margin-top: -10px; border-radius: 50%; margin-right: 5px;">
		           <?php echo strtoupper($_SESSION['username']); ?> 
		           <span class="caret"></span>
	       	  </a>
	          <ul class="dropdown-menu">
	            <li>
	            	<a href="javascript:void(0)" onclick="cerrar_sesion()">
			            <i class="fa fa-sign-out"></i> Cerrar sesión
			        </a>
			    </li>
	          </ul>
	        </li>
	    </ul>
	</div>
</nav>

<div class="cargando">
    <img src="img/loading.gif" alt="">
</div>

<section class="container-fluid" id="cuerpo">
	<div class="container">
		<div class="text-center">
			<img src="img/logo_circle.png" alt="" style="width: 200px; max-height: 100%;">
		</div>
		<h1 class="text-center">Modulo de prueba</h1>
		<h4 class="text-center">
			En este módulo se muestran las funciones básicas de un CRUD (Agregar, Editar, Eliminar y Listar).
			<br>
			Desarrollado con HTML, CSS3, JQuery, PHP y una Conexión a Base de datos en PostgreSQL.
			<br>
			También cuenta con un módulo que se gestiona utilizando PDO en donde se realizan las mismas operaciones del CRUD.
		</h4>
		<p class="text-center">
			propuesta desarrollada por: T.S.U. Gustavo Savignac.
		</p>
	</div>
</section>

</body>
	<script src="lib/jquery-2.2.0.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
	<script src="lib/bootstrap-material-design/js/material.js"></script>
	<script src="lib/bootstrap-table/js/bootstrap-table.js"></script>
	<script src="lib/bootstrap-table/locale/bootstrap-table-es-MX.js"></script>
	<script src="lib/sweetalert/dist/sweetalert.min.js"></script>
	<script src="js/funciones_principales.js"></script>
	<script src="modules/login/js/login.js"></script>
</html>