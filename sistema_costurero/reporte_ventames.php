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
				<h1 class="h2">Ventas Totales en determinado mes:</h1>
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
			<form method="get" action="reporte_ventames.php" target="contenido">
				<!-- <input type="search" name="busqueda" id="busqueda" placeholder="Haz una búsqueda" 
					value="<?php echo $busqueda?>"> -->
				<select class="form-control no-print" name="busqueda1" id="busqueda1" value="<?php echo $busqueda1?>">
					<option value="0"> Seleccionar Mes </option>
					<option value="01"> Enero </option>
					<option value="02"> Febrero </option>
					<option value="03"> Marzo </option>
					<option value="04"> Abril </option>
					<option value="05"> Mayo </option>
					<option value="06"> Junio </option>
					<option value="07"> Julio </option>
					<option value="08"> Agosto </option>
					<option value="09"> Septiembre </option>
					<option value="10"> Octubre </option>
					<option value="11"> Noviembre </option>
					<option value="12"> Diciembre </option>
				</select>
				<select class="form-control no-print" name="busqueda2" id="busqueda2" value="<?php echo $busqueda2?>">
					<option value="0"> Seleccionar Año </option>
					<option value="2018"> 2018 </option>
					<option value="2019"> 2019 </option>
					<option value="2020"> 2020 </option>
					<option value="2021"> 2021 </option>
					<option value="2022"> 2022 </option>
					<option value="2023"> 2023 </option>
					<option value="2024"> 2024 </option>
					<option value="2025"> 2025 </option>
					<option value="2026"> 2026 </option>
					<option value="2027"> 2027 </option>
					<option value="2028"> 2028 </option>
					<option value="2029"> 2029 </option>
					<option value="2030"> 2030 </option>
					<option value="2031"> 2031 </option>
					<option value="2032"> 2032 </option>
					<option value="2033"> 2033 </option>
					<option value="2034"> 2034 </option>
					<option value="2035"> 2035 </option>
				</select>
				<input type="submit" class="btn btn-outline-success my-2 my-sm-0 no-print"></button>
			</form>
			</br>
			<?php
				if ($busqueda1 !== '' && $busqueda2 !== ''){
				$sql = "SELECT c.idventa, c.fecha  , c.formacompra, c.formaenvio , c.detalle , c.senia  , p.nombre, p.dni, b.nombre AS idmodelo  , c.subtotal  , x.nombre AS idcategoria, c.total, c.estado 
						FROM venta c
						LEFT JOIN clientes p
						  ON c.idcliente = p.id
						 LEFT JOIN categoria x
						  ON c.idcategoria = x.id
						LEFT JOIN modelo b
						  ON c.idmodelo = b.id
						WHERE substring(c.fecha, 6,2) LIKE '%$busqueda1%' 
						  AND substring(c.fecha, 1,4) LIKE '%$busqueda2%' 
						  ORDER BY c.fecha";

				$resultado = mysqli_query($conexion,$sql);
				if ($resultado){	
			?>
			
				<table class="table table-hover">
				<thead>
					<tr>
						<th class="table-info">Fecha</th>
						<th class="table-info">DNI/C.U.I.T</th>
						<th class="table-info">Nombre</th>
						<th class="table-info">Categoria</th>
						<th class="table-info">Modelo</th>
						<th class="table-info">Forma Compra</th>
						<th class="table-info">Forma Envío</th>
						<th class="table-info">Detalle</th>
						<th class="table-info">Seña</th>
						<th class="table-info">Subtotal</th>
						<th class="table-info">Total</th>
						<th class="table-info">Estado</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($venta= mysqli_fetch_object($resultado)) { ?>
						<tr>
							<td align="center"><?php echo $venta->fecha?></td>
							<td align="center"><?php echo $venta->dni ?></td>
							<td align="center"><?php echo $venta->nombre ?></td>
							<td align="center"><?php echo $venta->idcategoria ?></td>
							<td align="center"><?php echo $venta->idmodelo ?></td>
							<td align="center"><?php echo $venta->formacompra ?></td>
							<td align="center"><?php echo $venta->formaenvio ?></td>
							<td align="center"><?php echo $venta->detalle ?></td>
							<td align="center"><?php echo $venta->senia ?></td>
							<td align="center"><?php echo $venta->subtotal ?></td>
							<td align="center"><?php echo $venta->total ?></td>
							<td align="center"><?php echo $venta->estado ?></td>
					<?php } ?>
				</tbody>
				</table>
				<?php } ?>
				<?php } ?>
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
