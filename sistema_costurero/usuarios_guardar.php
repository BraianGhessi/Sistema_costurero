<?php
	require_once 'base/config.php';
	
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	$confirmar_pw = $_POST['confirmar_pw'];

	if($password == $confirmar_pw){
		
		$password = password_hash($password, PASSWORD_DEFAULT);
		
		$conexion = connectDB();
		$sql = "INSERT INTO usuarios (usuario, password)
				VALUES ('$usuario', '$password')";
		$resultado = mysqli_query($conexion, $sql);
		$mensaje = "El usuario <b>$usuario</b> se registró correctamente.";
		include_once 'index.php';
	}
	else{
		$mensaje = 'Las contraseñas no coiciden.';
		include_once 'usuarios_registro.php';
	}
	
?>