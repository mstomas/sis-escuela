
	<h2>Modificar Curso</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
		<div class="form-group">
			
			<div class="input-group">
				<label class="control-label" for="cod_docente">Docente</label>
				<select id="cod_docente" name="cod_docente" class="form-control">
					<option value="0">Seleccione un Docente</option>
					<?php 
					foreach ($docente as $row) {
						if($cod_docente == $row['cod_docente'])
							echo "<option value='".$row['cod_docente']."' selected='selected'>".$row['nombre']."</option>";
						else
							echo "<option value='".$row['cod_docente']."'>".$row['nombre']."</option>";

					}
					 ?>
				</select>
			</div>
			<div class="input-group">
				<label class="control-label" for="cod_grado">Grado - Sección</label>
				<select id="cod_grado" name="cod_grado" class="form-control">
					<option value="0">Seleccione Grado y Sección</option>
					<?php 
					foreach ($grado as $row) {
						if($cod_grado == $row['cod_grado'])
							echo "<option value='".$row['cod_grado']."' selected='selected'>".$row['grado'].' - '.$row['seccion']."</option>";
						else
							echo "<option value='".$row['cod_grado']."'>".$row['grado'].' - '.$row['seccion']."</option>";

					}
					 ?>
				</select>
			</div>
			<div class="input-group">
				<label class="control-label" for="cod_curso">Curso</label>
				<select name="cod_curso" id="cod_curso" class="form-control">
					<option value="0">Seleccione un Curso</option>
					<?php 
					foreach ($curso as $row) {
						if($cod_curso == $row['cod_curso'])
							echo "<option value='".$row['cod_curso']."' selected='selected'>".$row['nombre']." (".$row['ciclo'].")</option>";
						else
							echo "<option value='".$row['cod_curso']."'>".$row['nombre']." (".$row['ciclo'].")</option>";

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
