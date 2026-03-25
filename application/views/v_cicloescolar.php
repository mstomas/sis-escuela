<div class="row" style="padding: 5px; margin-bottom: 10px;">
	<div class="col-md-12">
		<div id="form">
			<h2>Ingresar Nuevo Ciclo Escolar</h2>
			<form class="form-horizontal" role="form" onsubmit="insertarRegistro(); return false" id="frm">
				<div class="form-group">
					<label class="control-label" for="descripcion">Descripción</label>
					<div class="input-group">
						<input type="text" class="form-control" name="descripcion" id="descripcion">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="anio">Año</label>
					<div class="input-group">
						<select id="anio" name="anio" class="form-control">
							<option value="0">Seleccione un valor</option>
							<?php 
							$anio = 2014;
							for ($i=0; $i < 10; $i++) { 
								echo "<option value='".$anio."'>Año ".$anio."</option>";
								$anio++;
							}
							 ?>
						</select>
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