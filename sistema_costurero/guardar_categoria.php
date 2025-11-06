<?php
	require_once 'modelo/categoria.class.php';
	require_once 'base/config.php';

	$mensaje= '';

	$id=$_POST['id'];
	$nombre = $_POST['nombre'];
	$valido = true;
	$modificar = (isset($id) && $id != '');
	$eliminar = (isset($_POST['eliminar']) && $_POST['eliminar'] != '');

	if( !isset($nombre) || trim($nombre) == '' ) {
		$valido = false;
		$mensaje = $mensaje . 'El Nombre de la Categoría no puede ser vacío. ';
	}

	if($valido){
		$conexion = connectDB();
		if($eliminar){
			$sql = "DELETE FROM categoria
							WHERE id = '$id'";
		}
		else if($modificar){
			$sql = "UPDATE categoria
							SET	nombre ='$nombre'
							WHERE id = '$id'";
		}
		else{
			$sql ="INSERT INTO categoria(nombre)
						VALUES ( '$nombre')";
		}
		$resultado = mysqli_query($conexion, $sql);

		if($resultado){
				if($eliminar){
				$mensaje = 'Se eliminó correctamente';
				}
				else{
				$mensaje = 'Se guardó correctamente';
				}
		}
		else{
			$error = mysqli_error($conexion);
			$nro = mysqli_errno($conexion);
			$mensaje = "Hubo un error al guardar: $error. Error nro: $nro";
		}
	}
	include_once 'mostrar_registrocategoria.php';
?>
