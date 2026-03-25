
	<h2>Modificar Ciclo Escolar</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="cod_ciclo_escolar" id="cod_ciclo_escolar" value="<?php echo $cod_ciclo_escolar; ?>">
		<div class="form-group">
			<label class="control-label" for="descripcion">Descripción</label>
			<div class="input-group">
				<input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label" for="anio">Año</label>
			<div class="input-group">
				<select id="anio" name="anio" class="form-control">
					<option value="0">Seleccione un valor</option>
					<?php 
					$anio_escolar = 2014;
					for ($i=0; $i < 10; $i++) {
						if($anio == $anio_escolar) 
							echo "<option value='".$anio_escolar."' selected='selected'>Año ".$anio_escolar."</option>";
						else
							echo "<option value='".$anio_escolar."'>Año ".$anio_escolar."</option>";

						$anio_escolar++;
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
