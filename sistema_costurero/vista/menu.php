<?php
	include_once 'vista/encabezado.php';
?>
<?php require_once 'usuarios_autorizar.php'; ?>


	<div style="text-align:center;"> 
		<iframe src="vista/inicio.php" name="contenido" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px;border:none" scrolling="auto"></iframe>
	</div>
		
	<div> 
		<iframe src="vista/background.php" name="background" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:300px;width:300px;position:relative;border:none" align="right" scrolling="no" allowtransparency="true"></iframe>
	</div>
	
<?php
	include_once 'vista/pie.php';
?>