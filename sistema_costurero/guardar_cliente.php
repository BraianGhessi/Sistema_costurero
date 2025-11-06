<?php
	require_once 'modelo/cliente_particular.class.php';
	require_once 'base/config.php';
	
	$mensaje= '';
	
	$id=$_POST['id'];
	$nombre = $_POST['nombre'];
	$dni = $_POST['dni'];
	$calle = $_POST['calle'];
	$altura = $_POST['altura'];
	$provincia = $_POST['provincia'];
	$localidad = $_POST['localidad'];
	$codpostal = $_POST['codpostal'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	$tcliente = $_POST['tcliente'];
	$valido = true;
	$modificar = (isset($id) && $id != '');
	$eliminar = (isset($_POST['eliminar']) && $_POST['eliminar'] != '');
	
	
	if( !isset($nombre) || trim($nombre) == '' ) {
		$valido = false;
		$mensaje = $mensaje . 'El Nombre no puede ser vacío. ';
	}
	
	
	if( !isset($calle) || trim($calle) == '' ) {
		$valido = false;
		$mensaje = $mensaje . 'La Calle no puede ser vacía. ';
	}
	
	if( !isset($altura) || trim($altura) == '' ) {
		$valido = false;
		$mensaje = $mensaje . 'La Altura no puede ser vacía. ';
	}
	
	
	
	if( !isset($provincia) || trim($provincia) == '' ) {
		$valido = false;
		$mensaje = $mensaje . 'La Provincia no puede ser vacío. ';
	}
	
	if( !isset($codpostal) || trim($codpostal) == '' ) {
		$valido = false;
		$mensaje = $mensaje . 'El Código Postal no puede ser vacío. ';
	}
	
	if($valido){
		$conexion = connectDB();
		if($eliminar){
			$sql = "DELETE FROM clientes
					WHERE id = '$id'";
		}
		else if($modificar){
			$sql = "UPDATE clientes 
					SET dni='$dni',
						nombre='$nombre',
						calle = '$calle',
						telefono = '$telefono',
						provincia = '$provincia',
						localidad = '$localidad',
						codpostal = '$codpostal',
						altura = '$altura',
						email = '$email',
						tcliente = '$tcliente'
						
					WHERE id = '$id';";
		}
		else{
			$sql ="INSERT INTO clientes (nombre, dni, calle, altura, localidad, telefono, email, provincia, codpostal, tcliente)
			VALUES ('$nombre', '$dni', '$calle', '$altura', '$localidad', '$telefono', '$email', '$provincia', '$codpostal', '$tcliente')";			
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
	include_once 'mostrar_registro.php';
?>