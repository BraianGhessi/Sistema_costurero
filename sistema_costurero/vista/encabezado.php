<!DOCTYPE html>
<html len='en'>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.svg">

		<title>Sistema Costurero</title>


		<!-- Bootstrap core CSS -->
		<link href="lib/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="vista/css/estilo.css" rel="stylesheet">

	</head>


<body>

	<!-- Todos los plugins JavaScript de Bootstrap -->
    <script src="js/bootstrap.min.js"></script>

	<body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark p-0">
      <a class="navbar-brand col-sm-3 col-md-1 mr-0" href="index.php"> Inicio</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto px-3">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle"  id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="vista/formulario_clientes.php" target="contenido">Registrar Nuevo Cliente</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="mostrar_clienteparticular.php" target="contenido">Clientes Particulares Registrados</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="mostrar_clienteempresa.php" target="contenido">Clientes Empresariales Registrados</a>
					</div>
				</li>


				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ventas</a>
					<div class="dropdown-menu" aria-labelledby="dropdown03">
					<a class="dropdown-item" href="mostrar_ultimas_10_ventas.php" target="contenido">Ventas  Registradas</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
					<div class="dropdown-menu" aria-labelledby="dropdown04">
						<a class="dropdown-item" href="vista/formulario_categoria.php" target="contenido">Registrar Nueva Categoría</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="mostrar_categorias.php" target="contenido">Listado de Categorías</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="vista/formulario_modelos.php" target="contenido">Registrar Nuevo Modelo</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="mostrar_modelos.php" target="contenido">Listado de Modelos</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
					<div class="dropdown-menu" aria-labelledby="dropdown06">
						<a class="dropdown-item" href="reporte_ventames.php" target="contenido">Reporte Ventas por Mes</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="reporte_productos.php" target="contenido">Reporte Productos mas vendidos</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="reporte_historial.php" target="contenido">Reporte Historial de Ventas</a>
					</div>
				</li>
			</ul>
		<a href="logout.php">Desconectar</a>
		</div>
    </nav>
