<?php
	require_once 'base/config.php';

	$mensaje= '';

	$idventa=$_POST['idventa'];
	$fecha = $_POST['fecha'];
	$categoria = $_POST['idcategoria'];
	$modelo = $_POST['idmodelo'];
	$senia = $_POST['senia'];
	$subtotal = $_POST['subtotal'];
	$formaenvio = $_POST['formaenvio'];
	$formacompra = $_POST['formacompra'];
	$idcliente = $_POST['id'];
	$detalle = $_POST['detalle'];
	$estado = $_POST['estado'];
	$total = $_POST['total'];
	$valido = true;
	$modificar = (isset($idventa) && $idventa != '');
	$eliminar = (isset($_POST['eliminar']) && $_POST['eliminar'] != '');

	if($valido){
		$conexion = connectDB();
		if($eliminar){
			$sql = "DELETE FROM venta
					WHERE idventa = '$idventa'";
		}
		else if($modificar){
			$sql = "UPDATE venta
					SET idcliente = '$idcliente',
						fecha = '$fecha',
						formacompra ='$formacompra',
						formaenvio = '$formaenvio',
						detalle = '$detalle',
						total = '$total',
						idmodelo ='$modelo',
						idcategoria ='$categoria',
						senia = '$senia',
						estado = '$estado',
						subtotal = '$subtotal'
					WHERE idventa = '$idventa';";
		}
		else{
			$sql ="INSERT INTO venta (fecha, formacompra, formaenvio, detalle, senia, idcliente, idcategoria, subtotal, idmodelo, total, estado)
			VALUES ('$fecha', '$formacompra', '$formaenvio', '$detalle', '$senia', '$idcliente', '$categoria', '$subtotal', '$modelo', '$total', '$estado')";
		}
		echo $sql;
		$resultado = mysqli_query($conexion, $sql);

		if($resultado){
				if($eliminar){
				$mensaje = 'Se eliminó correctamente';
				}
				else{
				$mensaje = 'Se guardó correctamente';
				$idventa = mysqli_insert_id($conexion);
				}
		}
		else{
			$error = mysqli_error($conexion);
			$nro = mysqli_errno($conexion);
			$mensaje = "Hubo un error al guardar: $error. Error nro: $nro";
		}
	}
include_once 'mostrar_venta_reciente.php';
?>
