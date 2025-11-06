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
				<h1 class="h2">Productos vendidos:</h1>
			</div>
			<?php
			$busqueda1 = '';
			$busqueda2 = '';
			if(isset($_GET['busqueda1'])){
				$busqueda1 = $_GET['busqueda1'];
			}
			
			if(isset( $_GET['busqueda2'])){
				$busqueda2 =  $_GET['busqueda2'];
			}
			?>
			<form method="get" action="reporte_productos.php" target="contenido">
				<select class="form-control no-print" name="busqueda1" id="busqueda1" value="<?php echo $busqueda1?>">
					<option value="0"> Seleccionar Categoria</option>	
						<?php
							$sql = "SELECT id, nombre FROM categoria;";
							$rescat = mysqli_query($conexion, $sql);
						?>
						<?php while($categoria = mysqli_fetch_object($rescat)) { ?>
						<option value="<?php echo $categoria->id?>">
							<?php echo utf8_encode($categoria->nombre)?>
						</option>
						<?php } ?>
					</select>
				<select class="form-control no-print" name="busqueda2" id="busqueda2" value="<?php echo $busqueda2 ?>">
					<option value="0"> Seleccionar Modelo</option>	
						<?php
							$sql = "SELECT id, nombre FROM modelo;";
							$resmod = mysqli_query($conexion, $sql);
						?>
						<?php while($modelo = mysqli_fetch_object($resmod)) { ?>
						<option value="<?php echo $modelo->id?>">
							<?php echo utf8_encode($modelo->nombre)?>
						</option>
						<?php } ?>
				</select>
				<input type="submit" class="btn btn-outline-success my-2 my-sm-0 no-print"></button>
			</form>
			</br>
			<?php
				if ($busqueda1 !== '' && $busqueda2 !== ''){
				$sql = "SELECT c.idventa, c.fecha, c.formacompra, c.formaenvio , c.detalle , m.nombre AS idmodelo , p.nombre AS idcategoria
						FROM venta c
						LEFT JOIN categoria p
						  ON c.idcategoria = p.id
						 LEFT JOIN modelo m
						  ON c.idmodelo = m.id 
						WHERE c.idcategoria LIKE '%$busqueda1%' AND idmodelo LIKE '%$busqueda2%'";

				$resultado = mysqli_query($conexion,$sql);
			?>
			<table class="table table-hover">
				<thead>
				<tr>
						<th class="table-info">Fecha</th>
						<th class="table-info">Categoria</th>
						<th class="table-info">Modelo</th>
						<th class="table-info">Forma Compra</th>
						<th class="table-info">Forma Envío</th>
						<th class="table-info">Detalle</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($venta= mysqli_fetch_object($resultado)) { ?>
						<tr>
							<td align="center"><?php echo $venta->fecha ?></td>
							<td align="center"><?php echo $venta->idcategoria ?></td>
							<td align="center"><?php echo $venta->idmodelo ?></td>
							<td align="center"><?php echo $venta->formacompra ?></td>
							<td align="center"><?php echo $venta->formaenvio ?></td>
							<td align="center"><?php echo $venta->detalle ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php }?>
				</br>
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-top">
			<input type="button" value="imprimir" onclick="window.print()">
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
				
				
				
				
				
				
				