<?php

function connectDB(){

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "sistema_costurero";


    $conexion = mysqli_connect($host, $user, $password,$database) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");

	return $conexion;
} 

?>