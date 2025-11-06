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
				<h1 class="h2">Ventas Totales:</h1>
			</div>
			<?php
			$busqueda = '';
			if(isset($_GET['busqueda'])){
				$busqueda = $_GET['busqueda'];
			}
			?>
			<form method="get" action="mostrar_ventas.php" target="contenido">
				<input type="search" name="busqueda" id="busqueda" placeholder="Haz una búsqueda"
					value="<?php echo $busqueda?>">
				<input type="submit" class="btn btn-outline-success my-2 my-sm-0"></button>
			</form>
			</br>
			</br>
			<?php
				$sql = "SELECT c.idventa, c.fecha  , c.formacompra, c.formaenvio , c.detalle , c.senia  , p.nombre, p.dni, b.nombre AS idmodelo  , c.subtotal  , a.nombre AS idcategoria, c.total, c.estado 
						FROM venta c
						LEFT JOIN clientes p
						  ON c.idcliente = p.id
						LEFT JOIN categoria a
						  ON c.idcategoria = a.id
						LEFT JOIN modelo b
							ON c.idmodelo = b.id
						WHERE p.nombre LIKE '%$busqueda%'
							OR p.dni LIKE '%$busqueda%'
							OR c.fecha LIKE '%$busqueda%'
						ORDER BY c.fecha DESC
						LIMIT 1";

				$resultado = mysqli_query($conexion,$sql);
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
						<th class="table-info">Opciones</th>
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
							<td align="center"><a class="btn btn-primary" role="button" href="vista/modificar_venta.php?idventa=<?php echo $venta->idventa?>">
								Modificar</a></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
				<a href="mostrar_ultimas_10_ventas.php">Volver a últimas 10</a>
			</br>
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
