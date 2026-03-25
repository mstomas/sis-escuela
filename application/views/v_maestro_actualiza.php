
	<h2>Modificar Maestro</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="cod_docente" id="cod_docente" value="<?php echo $cod_docente; ?>">
		<div class="form-group">
			<div class="input-group">
				<label class="control-label" for="nombre">Nombre</label>
				<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="telefono">Teléfono</label>
				<input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="email">E-mail</label>
				<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">	
				<input type="submit" value="Guardar" class="btn btn-success">
			</div>
		</div>
	</form>
