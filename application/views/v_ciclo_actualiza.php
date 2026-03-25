
	<h2>Modificar Ciclo</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="cod_ciclo" id="cod_ciclo" value="<?php echo $cod_ciclo; ?>">
		<div class="form-group">
			<label class="control-label" for="nombre">Descripción</label>
			<div class="input-group">
				<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $descripcion; ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">	
				<input type="submit" value="Guardar" class="btn btn-success">
			</div>
		</div>
	</form>
