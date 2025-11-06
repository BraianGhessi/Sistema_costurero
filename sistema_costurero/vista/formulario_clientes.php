<?php
	require_once '../base/config.php';
	include_once '../usuarios_autorizar.php';
	$conexion = connectDB();

	$cliente = new stdclass();
	$cliente->id = '';
	$cliente->nombre = '';
	$cliente->dni = '';
	$cliente->calle = '';
	$cliente->altura = '';
	$cliente->provincia = '';
	$cliente->codpostal = '';
	$cliente->localidad = '';
	$cliente->telefono = '';
	$cliente->email = '';
	$cliente->tcliente ='';
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT id, nombre, dni, calle, altura, localidad, telefono, email, provincia, codpostal, tcliente
				FROM clientes 
				WHERE id = '$id';";
		$rescliente = mysqli_query($conexion, $sql);
		$cliente = mysqli_fetch_object($rescliente);
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
				<h1 class="h2">Clientes</h1>
				<div class="btn-toolbar mb-2 mb-md-0">
				</div>
			</div>
			</br>
			<form action="../guardar_cliente.php" method="post">
				<div class="form-group row">
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $cliente->id?>">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="tcliente" class="col-sm-2 col-form-label">Tipo de Cliente:</label>
					<div class="col-sm-8">
						<select class="form-control" name="tcliente" id="tcliente" value="<?php echo $cliente->tcliente?>">
							<option value="0"> Seleccionar Tipo de Cliente </option>
							<option value="Particular" <?php if($cliente->tcliente == 'Particular') echo 'selected'?>> Particular </option>
							<option value="Empresarial" <?php if($cliente->tcliente == 'Empresarial') echo 'selected'?>> Empresarial </option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="nombre" class="col-sm-2 col-form-label">Nombre y Apellido/R.Social:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $cliente->nombre?>" placeholder="Ingrese Nombre y Apellido/C.U.I.T" required>
					</div>
				</div>


				<div class="form-group row">
					<label for="dni" class="col-sm-2 col-form-label">DNI/C.U.I.T:</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="dni" id="dni" value="<?php echo $cliente->dni?>" placeholder="Ingrese DNI/C.U.I.T" required>
					</div>
				</div>

				<div class="form-group row">
					<label for="provincia" class="col-sm-2 col-form-label">Provincia:</label>
					<div class="col-sm-8">
						<select class="form-control" name="provincia" id="provincia" onchange="onchange_provincia()">
							<option value="0"> Seleccionar Provincia </option>
							<?php
								$sql = "SELECT id, nombre FROM provincia;";
								$resprov = mysqli_query($conexion, $sql);
							?>
							<?php while($provincia = mysqli_fetch_object($resprov)) { ?>
							<option value="<?php echo $provincia->id?>" <?php if($cliente->provincia == $provincia->id) echo 'selected'?>>
								<?php echo utf8_encode($provincia->nombre)?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="localidad" class="col-sm-2 col-form-label">Localidad:</label>
					<div class="col-sm-8">
						<select class="form-control" name="localidad" id="localidad" onchange="onchange_localidad()">
							<option value="<?php echo $cliente->localidad?>" data-cp="0">
							Seleccione una Localidad
							</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="codpostal" class="col-sm-2 col-form-label">Código Postal:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="codpostal" id="codpostal"
						onkeyup="onkeyup_codigopostal()" value="<?php echo $cliente->codpostal?>" placeholder="Ingrese Código Postal" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="direccion" class="col-sm-2 col-form-label">Calle:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="calle" id="calle"
						value="<?php echo $cliente->calle?>" placeholder="Ingrese Calle" required>
					</div>
				</div>

				<div class="form-group row">
					<label for="altura" class="col-sm-2 col-form-label">Altura:</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="altura" id="altura" 
						value="<?php echo $cliente->altura?>" placeholder="Ingrese Altura" required>
					</div>
				</div>

				<div class="form-group row">
					<label for="telefono" class="col-sm-2 col-form-label">Teléfono:</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="telefono" id="telefono" value="<?php echo $cliente->telefono?>" placeholder="Ingrese Teléfono">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email:</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="email" id="email" value="<?php echo $cliente->email?>" placeholder="Ingrese Email" required>
					</div>
				</div>
				
				<button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
				<button type="submit" name="eliminar" class="btn btn-danger" value="eliminar">Eliminar</button>
          </form>
		</main>
		    <!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="../lib/assets/js/vendor/jquery-3.3.1.min.js"></script>
			<script src="../lib/assets/js/vendor/popper.min.js"></script>
			<script src="../lib/dist/js/bootstrap.min.js"></script>

			<!-- Icons -->
			<script src="../lib/assets/js/vendor/feather.min.js"></script>
			<script>
			feather.replace()

		function onchange_provincia(){
			$('#codpostal').val('');
			buscarLocalidades();
		}

		function onchange_localidad(){
			var cp = $('#localidad').find(':selected').data('cp');
			$('#codpostal').val(cp);
		}

		function onkeyup_codigopostal(){
			if($('#provincia').val() != 1){
				buscarLocalidades();
			}
		}

		function buscarLocalidades(){
			$.ajax({
				type: 'GET',
				url: 'localidades.php',
				data: {
					'provincia': $('#provincia').val(),
					'codpostal': $('#codpostal').val(),
					'localidad': $('#localidad').val()
				},
				dataType: 'text',
				complete: function(data){
					 $('#localidad').html(data.responseText);
				}
			});
		}

		 buscarLocalidades();
			</script>
	</body>
</html>
