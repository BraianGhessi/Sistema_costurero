<?php
	include_once '../base/config.php';
	$conexion = connectDB();
	
	$idcategoria = $_GET['idcategoria'];
	$idmodelo = $_GET['idmodelo'];
	

	$sql = "SELECT id, nombre, idcategoria
			FROM modelo
			WHERE idcategoria = '$idcategoria'";
			 
	$resultado = mysqli_query($conexion, $sql);

	var_dump($resultado);
	
?>
<option value="0">Seleccione un Modelo</option>
<?php while($modelo=mysqli_fetch_object($resultado)){ ?>
	<option value="<?php echo $modelo->id?>" <?php if($modelo->id == $idmodelo) echo 'selected' ?>>
		<?php echo utf8_encode($modelo->nombre)?>
	</option>
<?php } ?>

