
	<h2>Modificar Curso</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="cod_grado" id="cod_grado" value="<?php echo $cod_grado; ?>">
		<div class="form-group">
			
			<div class="input-group">
				<label class="control-label" for="grado">Grado</label>
				<input type="text" class="form-control" name="grado" id="grado" value="<?php echo $grado; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="seccion">Sección</label>
				<input type="text" class="form-control" name="seccion" id="seccion" value="<?php echo $seccion; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="cod_ciclo">Ciclo</label>
				<select name="cod_ciclo" id="cod_ciclo" class="form-control">
					<option value="0">Seleccione un Ciclo</option>
					<?php 
					foreach ($ciclo as $row) {
						if($cod_ciclo == $row['cod_ciclo'])
							echo "<option value='".$row['cod_ciclo']."' selected='selected'>".$row['nombre']."</option>";
						else
							echo "<option value='".$row['cod_ciclo']."'>".$row['nombre']."</option>";
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
