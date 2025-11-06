<main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
           <h1 class="h2">Registrar usuario y contraseña</h1>
           <div class="btn-toolbar mb-2 mb-md-0">
             <div class="btn-group mr-2">
             </div>
           </div>
         </div>
	</br>
	<?php if(isset($mensaje)){ ?>
		<hr/> <?php echo $mensaje?> <hr/>
	<?php } ?>
<form action="usuarios_guardar.php" method="post">
	<div class="form-group row">
			<label for="usuario" class="col-sm-2 col-form-label"> Usuario</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su Usuario">
			</div>
	</div>
		<br/>
	<div class="form-group row">	
		<label for="password" class="col-sm-2 col-form-label"> Contraseña</label>
		    <div class="col-sm-8">
              <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su Contraseña">
            </div>
	</div>
	<br/>
	<div class="form-group row">
		<label for="confirmar_pw" class="col-sm-2 col-form-label">Confirmar Contraseña:</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="confirmar_pw" name="confirmar_pw" placeholder="Reingrese Contraseña"/>
			</div>
	</div>
	<br/>
	<input type="submit" value="Registrarse"/>
</form>