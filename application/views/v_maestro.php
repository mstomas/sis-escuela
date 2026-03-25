<div class="row" style="padding: 5px; margin-bottom: 10px;">
	<div class="col-md-12">
		<div id="form">
			<h2>Ingresar Nuevo Ciclo</h2>
			<form class="form-horizontal" role="form" onsubmit="insertarRegistro(); return false" id="frm">
				<div class="form-group">
					<div class="input-group">
						<label class="control-label" for="nombre">Nombre</label>
						<input type="text" class="form-control" name="nombre" id="nombre">
					</div>
					<div class="input-group">
						<label class="control-label" for="telefono">Teléfono</label>
						<input type="text" class="form-control" name="telefono" id="telefono">
					</div>
					<div class="input-group">
						<label class="control-label" for="email">E-mail</label>
						<input type="text" class="form-control" name="email" id="email">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">	
						<input type="submit" value="Guardar" class="btn btn-success">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12" id="data-grid">
		<?php echo $tabla; ?>
	</div>
</div>