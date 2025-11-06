<?php

	require_once 'base/config.php';
	include_once 'usuarios_autorizar.php';
	$conexion = connectDB();

	$sql = "SELECT * FROM cliente_empresa";

	$resultado = mysqli_query($conexion,$sql);

?>

<!doctype html>
<html lang="en">
  <head>
	<!-- Bootstrap core CSS -->
    <link href="lib/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="vista/css/estilo.css" rel="stylesheet">
  </head>

  <body>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Clientes Empresas</h1>
			</div>
			<?php
			$busqueda = '';
			if(isset($_GET['busqueda'])){
				$busqueda = $_GET['busqueda'];
			}
			?>
			<form method="get" action="mostrar_clienteempresa.php" target="contenido">
				<input type="search" name="busqueda" id="busqueda" placeholder="Haz una búsqueda"
					value="<?php echo $busqueda?>"></button>
				<input type="submit" name="buscador" class="btn btn-outline-success my-2 my-sm-0">
			</form>
			</br>
			<a href="vista/formulario_clientes.php">Ingresar Nuevo Cliente</a>
			</br>
			
			<?php
			$sql= "SELECT c.id, c.nombre, c.dni, c.calle, c.altura, l.nombre AS localidad, c.telefono, c.email, p.nombre AS provincia, c.codpostal, c.tcliente
						 FROM clientes c
						 LEFT JOIN provincia p ON c.provincia = p.id
						 LEFT JOIN localidades l ON c.localidad = l.id
						 WHERE c.nombre LIKE '%$busqueda%'
					     HAVING c.tcliente = 'Empresarial'";
			$resultado = mysqli_query($conexion,$sql);
			?>
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-top">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th class="table-info">C.U.I.T</th>
						<th class="table-info">N. Apellido/R.Social</th>
						<th class="table-info">Provincia</th>
						<th class="table-info">Localidad</th>
						<th class="table-info">C.Postal</th>
						<th class="table-info">Calle</th>
						<th class="table-info">Altura</th>
						<th class="table-info">Teléfono</th>
						<th class="table-info">Email</th>
						<th class="table-info">Opciones</th>
						<th class="table-info">Venta</th>
					</tr>
				</thead>
					<tbody>
					<?php
						while($cliente= mysqli_fetch_object($resultado)) { ?>
					<tr>
						<td align="center"><?php echo$cliente->dni ?></td>
						<td align="center"><?php echo$cliente->nombre ?></td>
						<td align="center"><?php echo$cliente->provincia ?></td>
						<td align="center"><?php echo$cliente->localidad ?></td>
						<td align="center"><?php echo$cliente->codpostal ?></td>
						<td align="center"><?php echo$cliente->calle ?></td>
						<td align="center"><?php echo$cliente->altura ?></td>
						<td align="center"><?php echo$cliente->telefono ?></td>
						<td align="center"><?php echo$cliente->email ?></td>
						<td align="center"><a class="btn btn-primary" role="button" href="vista/formulario_clientes.php?id=<?php echo $cliente->id?>">
						Modificar</a></td>
						<td align="center"><a class="btn btn-primary" role="button" href="vista/formulario_venta.php?id=<?php echo $cliente->id?>">
						Venta</a></td>
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
