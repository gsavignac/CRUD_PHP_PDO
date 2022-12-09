<?php  

session_start();
if($_SESSION['username'] !='' || $_SESSION['username'] !=  null){
	header('Location: admin.php');
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


<div class="cargando">
    <img src="img/loading3.gif" alt="">
</div>

<section class="container">

	<div class="panel panel-info login-container">
	  <div class="panel-heading text-center">
	  	<img src="img/logo_circle.png" alt="" style="height: 50px; max-width: 100%;">
	  	<h3 class="panel-title">
	  		Iniciar sesión
	  	</h3>
	  </div>
	  <div class="panel-body">
	    <p>
	    	¡Bienvenido!
	    	<br>
	    	por favor ingrese los siguientes datos para iniciar sesión.
	    </p>

	    <hr>

	    <form id="form_login">
	    	
	    	<div class="form-group">
				<label for="username">Usuario: </label>
				<input type="text" class="form-control" id="username" title="nombre de usuario">
			</div>

			<div class="form-group">
				<label for="passkey">Contraseña: </label>
				<input type="password" class="form-control" id="passkey" title="contraseña">
			</div>

			<button type="button" class="btn btn-info btn-block" style="margin-top: 30px;" onclick="iniciar_sesion();">
				<i class="fa fa-sign-out"></i> Ingresar
			</button>

	    </form>
	  </div>
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