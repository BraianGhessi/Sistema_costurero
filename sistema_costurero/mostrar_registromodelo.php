<?php

	require_once 'base/config.php';

	$conexion = connectDB();

	$mensaje1 = $mensaje;


?>

<!doctype html>
  <head>
	<!-- Bootstrap core CSS -->
    <link href="lib/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="vista/css/estilo.css" rel="stylesheet">

  </head>
  <body>
		<main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Modelo:</h1>
				<div class="btn-toolbar mb-2 mb-md-0">
				</div>
			</div>
			<?php
				$sql = "SELECT c.id, c.nombre, p.nombre AS nombrecat, c.idcategoria
							 FROM modelo c
							 LEFT JOIN categoria p
							  ON c.idcategoria = p.id
							 WHERE c.nombre = '$nombre'";

				$resultado = mysqli_query($conexion,$sql);
			?>
				<table class="table table-hover">
				<thead>
					<tr>
						<th class="table-info">Categoria</th>
						<th class="table-info">Modelo</th>
						<th class="table-info">Modificar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($mod= mysqli_fetch_object($resultado)) { ?>
						<tr>
							<td align="center"><?php echo $mod->nombrecat?></td>
							<td align="center"><?php echo$mod->nombre ?></td>
							<td align="center"><a class="btn btn-primary" role="button" href="vista/formulario_modelo.php?id=<?php echo $mod->id?>">
								Modificar</a></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
			</br>
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-top">
				<?php
					echo $mensaje1;
				?>
			</div>
		</main>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="lib/assets/js/vendor/jquery-slim.min.js"></script>
		<script src="lib/assets/js/vendor/popper.min.js"></script>
		<script src="lib/dist/js/bootstrap.min.js"></script>

		<!-- Icons -->
		<script src="lib/assets/js/vendor/feather.min.js"></script>
		<script>
		feather.replace()
		</script>
  </body>
</html>
