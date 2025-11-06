<?php
	include_once '../base/config.php';

	$provincia = $_GET['provincia'];
	$codigopostal = $_GET['codpostal'];
	$idlocalidad = $_GET['localidad'];

	$conexion = connectDB();

	$sql = "SELECT id, idprovincia, nombre, codpostal
					FROM localidades
					WHERE idprovincia = '$provincia'
					 AND codpostal LIKE '%$codigopostal%'
					 ORDER BY nombre;";
	$resultado = mysqli_query($conexion, $sql);
	
?>
<option value="0">Seleccione una Localidad</option>
<?php while($localidad=mysqli_fetch_object($resultado)){ ?>
	<option value="<?php echo $localidad->id?>" data-cp="<?php echo $localidad->codpostal ?>" 
	<?php if($localidad->id == $idlocalidad) echo 'selected' ?>>
		<?php echo utf8_encode($localidad->nombre), " (CP: $localidad->codpostal)"?>
	</option>
<?php } ?>

