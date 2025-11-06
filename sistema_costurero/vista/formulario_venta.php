6<?php
	require_once '../base/config.php';

	$conexion = connectDB();
	
	$particular = new stdclass();
	$particular->id = '';
	$particular->nombre = '';
	$particular->dni = '';

	$venta = new stdclass();
	$venta->fecha = '';
	$venta->formacompra = '';
	$venta->formaenvio = '';
	$venta->detalle = '';
	$venta->senia = '';
	$venta->idventa = '';
	$venta->subtotal = '';
	$venta->idcategoria='';
	$venta->idmodelo='';
	$venta->estado ='';
	$venta->total='';


	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT id, nombre, dni
				FROM clientes
				WHERE id = '$id';";
		$rescliente = mysqli_query($conexion, $sql);
		$particular = mysqli_fetch_object($rescliente);
	}
	
		if(isset($_GET['idventa'])){
		$id = $_GET['idventa'];
		$sql = "SELECT idventa, fecha, formacompra, formaenvio, detalle, senia, idmodelo, subtotal, idcategoria, idcliente, estado, total
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
						<input type="hidden" class="form-control" name="idventa" id="idventa" value="<?php echo $venta->idventa?>">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $particular->id?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="fecha" class="col-sm-2 col-form-label">Fecha:</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" autocomplete="on" name="fecha" id="fecha" value="<?php if($venta->fecha == '') {echo date('Y-m-d');} else {echo $venta->fecha;}?>" placeholder="Ingrese Fecha">
					</div>
				</div>

				<div class="form-group row">
					<label for="nombre" class="col-sm-2 col-form-label">N y Apellido/ R.Social:</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $particular->nombre?>" placeholder="Ingrese Nombre, Apellido o Razón Social">
					</div>
				</div>

				<div class="form-group row">
					<label for="dni" class="col-sm-2 col-form-label">DNI/C.U.I.T:</label>
					<div class="col-sm-8">
						<input disabled type="number" class="form-control" name="dni" id="dni" value="<?php echo $particular->dni?>" placeholder="Ingrese DNI">
					</div>
				</div>

				<div class="form-group row">
					<label for="categoria" class="col-sm-2 col-form-label">Categoria:</label>
					<div class="col-sm-8">
						<!--<input type="text" class="form-control" name="idcategoria" id="idcategoria" value="<?php echo $venta->idcategoria?>" placeholder="Ingrese Categoría">-->
						<select class="form-control" name="idcategoria" id="idcategoria" onchange="onchange_categoria()">
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
						<select class="form-control" name="idmodelo" id="idmodelo" onchange="onchange_modelo()">
							<option value="<?php echo $venta->idmodelo?>">
								Seleccione un Modelo
							</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="formacompra" class="col-sm-2 col-form-label">Comprado por:</label>
					<div class="col-sm-8">
						<select class="form-control" name="formacompra" id="formacompra" value="<?php echo $venta->formacompra?>">
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
						<select class="form-control" name="formaenvio" id="formaenvio" value="<?php echo $venta->formaenvio?>">
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
						<input type="text" class="form-control" name="detalle" id="detalle" placeholder="Ingrese Detalle">
					</div>
				</div>

				<div class="form-group row">
					<label for="seña" class="col-sm-2 col-form-label">Entrega realizada:</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="senia" id="senia" placeholder="Ingrese Entrega">
					</div>
				</div>

				<div class="form-group row">
					<label for="subtotal" class="col-sm-2 col-form-label">Precio Producto:</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="subtotal" id="subtotal" placeholder="Ingrese Precio">
					</div>
				</div>
					
				<div class="form-group row">
					<label for="total" class="col-sm-2 col-form-label">Pendiente pago:</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="total" id="total" onchange="saldoRestante(this.value)" placeholder="Ingrese Pendiente pago">
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
		<br>
		<button id="calcular" onclick="calcularTotal()" class="btn btn-success ml-3">Calcular Total</button>
		    <!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="../lib/assets/js/vendor/jquery-3.3.1.min.js"></script>
			<script src="../lib/assets/js/vendor/popper.min.js"></script>
			<script src="../lib/dist/js/bootstrap.min.js"></script>

	        <!-- llamamos  a la calculadora javascript-->
			
			<script>
			 function calcularTotal() {
			   var unaSenia = $("#senia").val();
			   var unSubtotal = $("#subtotal").val();
				
			   if(unaSenia>unSubtotal)
			   {
				   alert("La entrega no debe ser mayor al precio");
				   location.reload();
			   }
			   else
			   {
				    var total = (unSubtotal-unaSenia);
					if(total < 0)
					{
						alert("La entrega no debe ser mayor al precio");
					}
					else if(total==0)
					{
						alert("El total no debe ser 0");
						
					}
					else
					{
						document.getElementById("total").value = total; 
					}
					
				}
					
			   }
			 </script>
			 
			<!-- Icons -->
			<script src="../lib/assets/js/vendor/feather.min.js"></script>
			<script>
			feather.replace()
			
			function onchange_categoria(){
				buscarCategoria();
			}

			function onchange_modelo(){
			}
			
			function buscarCategoria(){
			$.ajax({
				type: 'GET',
				url: 'modelos.php',
				data: {
					'idcategoria': $('#idcategoria').val(),
					'idmodelo': $('#idmodelo').val(),
				},
				dataType: 'text',
				complete: function(data){
					 $('#idmodelo').html(data.responseText);
				}
				});
			}
			
			buscarCategoria();
			</script>
			
			
	</body>
</html>
