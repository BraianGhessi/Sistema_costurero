<html lang="en">
	<head>
		<meta charset="utf8">
		<!-- Bootstrap core CSS -->
		<link href="../lib/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->

		<link href="css/estilo.css" rel="stylesheet">
	</head>
	<body>
		<!-- Todos los plugins JavaScript de Bootstrap -->
		<script src="../js/bootstrap.min.js"></script>
<body>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
           <h1 class="h2">Ingrese usuario y contraseña</h1>
           <div class="btn-toolbar mb-2 mb-md-0">
             <div class="btn-group mr-2">
             </div>
           </div>
         </div>
	</br>
	<?php if(isset($mensaje)){ ?>
		<hr/> <?php echo $mensaje?> <hr/>
	<?php } ?>
	<form action="index.php" method="post">
	<div class="form-group row">
		<label for="nombre" class="col-sm-2 col-form-label"> Usuario</label>
		    <div class="col-sm-8">
              <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su usuario">
            </div>
	</div>
	<br/>
	<br/>
	<div class="form-group row">
		<label for="nombre" class="col-sm-2 col-form-label"> Contraseña</label>
		    <div class="col-sm-8">
              <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su contraseña">
            </div>
	</div>
		<br/>
		</br>
		<input type="submit" value="Ingresar"/>
	</form>
	</br>
	</br>
	<a href="usuarios_registro.php" target="contenido">Registrarse</a> 
</body>
</html>