<?php
	require_once '../base/config.php';

	$conexion = connectDB();

	$venta = new stdclass();
	$venta->fecha = '';
	$venta->formacompra = '';
	$venta->formaenvio = '';
	$venta->detalle = '';
	$venta->senia = '';
	$venta->idventa = '';
	$venta->total = '';
	$venta->idcategoria='';
	$venta->idmodelo='';
	$venta->estado ='';
	$venta->idventa ='';
	$venta->idcliente='';
	$venta->subtotal='';
	
	if(isset($_GET['idventa'])){
		$idventa = $_GET['idventa'];
		$sql = "SELECT idventa, fecha, formacompra, formaenvio, detalle, senia, idmodelo, subtotal, idcategoria, total, estado, idcliente
				FROM venta
				WHERE idventa = '$idventa';";
		$resventa = mysqli_query($conexion, $sql);
		$venta = mysqli_fetch_object($resventa);
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
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
				<h1 class="h2">Ventas:</h1>
				<div class="btn-toolbar mb-2 mb-md-0">
				</div>
			</div>
			</br>
			<form action="../guardar_venta.php" method="post">
				<div class="form-group row">
					<div class="col-sm-8">
						<input readonly type="hidden" class="form-control" name="idventa" id="idventa" value="<?php echo $venta->idventa?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="fecha" class="col-sm-2 col-form-label">Fecha:</label>
					<div class="col-sm-8">
						<input readonly type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $venta->fecha?>" placeholder="Ingrese Fecha">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="idcliente" class="col-sm-2 col-form-label">N y Apellido/R.Social:</label>
					<div class="col-sm-8">
						<select readonly class="form-control" name="id" id="id">
							<option value="0"> Seleccionar Cliente </option>
							<?php
								$sql = "SELECT id, nombre FROM clientes;";
								$rescli = mysqli_query($conexion, $sql);
							?>
							<?php while($cliente = mysqli_fetch_object($rescli)) { ?>
							<option value="<?php echo $cliente->id?>" <?php if($venta->idcliente == $cliente->id) echo 'selected'?>>
								<?php echo utf8_encode($cliente->nombre)?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>

				
				<div class="form-group row">
					<label for="categoria" class="col-sm-2 col-form-label">Categoria:</label>
					<div class="col-sm-8">
						<select readonly class="form-control" name="idcategoria" id="idcategoria" onchange="onchange_categoria()">
							<option value="0"> Seleccionar Categoria </option>
							<?php
								$sql = "SELECT id, nombre FROM categoria;";
								$rescat = mysqli_query($conexion, $sql);
							?>
							<?php while($categoria = mysqli_fetch_object($rescat)) { ?>
							<option value="<?php echo $categoria->id?>" <?php if($venta->idcategoria == $categoria->id) echo 'selected'?>>
								<?php echo utf8_encode($categoria->nombre)?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="modelo" class="col-sm-2 col-form-label">Modelo:</label>
					<div class="col-sm-8">
						<select readonly class="form-control" name="idmodelo" id="idmodelo" onchange="onchange_modelo()">
							<?php 
								$sql = "SELECT id, nombre FROM modelo;";
								$resmod = mysqli_query($conexion, $sql);
							?>
							<?php while($modelo = mysqli_fetch_object($resmod)){ ?>
							<option value="<?php echo $venta->idmodelo ?>" <?php if($venta->idmodelo == $modelo->id) echo 'selected'?>>
								<?php echo utf8_encode($modelo->nombre)?> 
							</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="formacompra" class="col-sm-2 col-form-label">Comprado por:</label>
					<div class="col-sm-8">
						<select readonly class="form-control" name="formacompra" id="formacompra" value="<?php echo $venta->formacompra?>">
							<option value="0"> Seleccionar Método de Compra </option>
							<option value="Instagram" <?php if($venta->formacompra == 'Instagram') echo 'selected'?>> Instagram </option>
							<option value="Facebook" <?php if($venta->formacompra == 'Facebook') echo 'selected'?>> Facebook </option>
							<option value="Mercado Libre" <?php if($venta->formacompra == 'Mercado Libre') echo 'selected'?>> Mercado Libre </option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="formaenvio" class="col-sm-2 col-form-label">Tipo de envío:</label>
					<div class="col-sm-8">
						<select readonly class="form-control" name="formaenvio" id="formaenvio" value="<?php echo $venta->formaenvio ?>">
							<option value="0"> Seleccionar Tipo de Envío </option>
							<option value="Moto" <?php if($venta->formaenvio == 'Moto') echo 'selected'?>> Moto </option>
							<option value="Envío por Correo" <?php if($venta->formaenvio == 'Envío por Correo') echo 'selected'?>> Envío por Correo </option>
							<option value="Retiro en Local" <?php if($venta->formaenvio == 'Retiro en Local') echo 'selected'?>> Retiro en Local </option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="detalle" class="col-sm-2 col-form-label">Detalle:</label>
					<div class="col-sm-8">
						<input readonly type="text" class="form-control" name="detalle" id="detalle" value="<?php echo $venta->detalle?>" placeholder="Ingrese Detalle">
					</div>
				</div>

				<div class="form-group row">
					<label for="seña" class="col-sm-2 col-form-label">Seña:</label>
					<div class="col-sm-8">
						<input readonly type="number" class="form-control" name="senia" id="senia" value="<?php echo $venta->senia?>" placeholder="Ingrese Seña">
					</div>
				</div>

				<div class="form-group row">
					<label for="subtotal" class="col-sm-2 col-form-label">Subtotal:</label>
					<div class="col-sm-8">
						<input readonly type="number" class="form-control" name="subtotal" id="subtotal" value="<?php echo $venta->subtotal?>" placeholder="Ingrese Total">
					</div>
				</div>

				<div class="form-group row">
					<label for="total" class="col-sm-2 col-form-label">Total:</label>
					<div class="col-sm-8">
						<input readonly type="number" class="form-control" name="total" id="total" value="<?php echo $venta->total?>" placeholder="Ingrese Total">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="formaenvio" class="col-sm-2 col-form-label">Estado de la Venta :</label>
					<div class="col-sm-8">
						<select class="form-control" name="estado" id="estado" value="<?php echo $venta->estado?>">
							<option value="0"> Seleccionar Estado </option>
							<option value="Pago Aceptado" <?php if($venta->estado == 'Pago Aceptado') echo 'selected'?>> Pago Aceptado </option>
							<option value="Pendiente de Pago" <?php if($venta->estado == 'Pendiente de Pago') echo 'selected'?>> Pendiente de Pago </option>
							<option value="Compra Cancelada" <?php if($venta->estado == 'Compra Cancelada') echo 'selected'?>> Compra Cancelada </option>
						</select>
					</div>
				</div>

				<button type="submit" name="guardar" class="btn btn-primary" value="guardar">Guardar</button>
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
