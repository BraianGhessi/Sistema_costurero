<?php
	require_once '../base/config.php';
	include_once '../usuarios_autorizar.php';
	$conexion = connectDB();

	$mod = new stdclass();
	$mod->id = '';
	$mod->nombre = '';
	$mod->idcategoria = '';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT id, nombre, idcategoria
				FROM modelo
				WHERE id = '$id'";
		$resultado = mysqli_query($conexion, $sql);
		$mod = mysqli_fetch_object($resultado);
	}
?>

<!DOCTYPE html>
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

		<main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Nuevo Modelo</h1>
				<div class="btn-toolbar mb-2 mb-md-0">
				</div>
			</div>
			</br>
			<form action="../guardar_modelos.php" method="post">
				<div class="form-group row">
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $mod->id?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
					<div class="col-sm-8">
						<select class="form-control" name="categoria" id="categoria">
							<option value="0"> Seleccionar Categoría </option>
							<?php
								$sql = "SELECT id, nombre FROM categoria;";
								$resultado = mysqli_query($conexion, $sql);
							?>
							<?php while($categoria = mysqli_fetch_object($resultado)) { ?>
							<option value="<?php echo $categoria->id?>"><?php echo utf8_encode($categoria->nombre)?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $mod->nombre?>" placeholder="Ingrese Nombre">
					</div>
				</div>
				<button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
				<button type="submit" name="eliminar" class="btn btn-danger" value="eliminar">Eliminar</button>
          </form>
		</main>
		    <!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="../lib/assets/js/vendor/jquery-slim.min.js"></script>
			<script src="../lib/assets/js/vendor/popper.min.js"></script>
			<script src="../lib/dist/js/bootstrap.min.js"></script>

			<!-- Icons -->
			<script src="../lib/assets/js/vendor/feather.min.js"></script>
			<script>
			feather.replace()
			</script>
	</body>
</html>
