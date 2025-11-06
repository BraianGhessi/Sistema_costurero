<?php

	require_once 'base/config.php';
	include_once 'usuarios_autorizar.php';
	$conexion = connectDB();

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
				<h1 class="h2">Categorías</h1>
			</div>
			<?php
			$busqueda = '';
			if(isset($_GET['busqueda'])){
				$busqueda = $_GET['busqueda'];
			}
			?>
			<form method="get" action="mostrar_categorias.php" target="contenido">
				<input type="search" name="busqueda" id="busqueda" placeholder="Haz una búsqueda"
					value="<?php echo $busqueda?>">
				<input type="submit" class="btn btn-outline-success my-2 my-sm-0"></button>
			</form>
			</br>
			<?php
			$sql= "SELECT * FROM categoria
				   WHERE nombre LIKE '%$busqueda%'
				   ORDER BY id DESC
				   LIMIT 1";
			$resultado = mysqli_query($conexion,$sql);
			?>
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-top">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th class="table-info">Categoría</th>
						<th class="table-info">Opciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
					while($categoria= mysqli_fetch_object($resultado)) { ?>
					<tr>
						<td align="center"><?php echo $categoria->nombre ?></td>
						<td align="center"><a class="btn btn-primary" role="button" href="vista/formulario_categoria.php?id=<?php echo $categoria->id?>">
						Modificar</a></td>
					</tr>
				<?php } ?>
				</tbody>
				</table>
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
