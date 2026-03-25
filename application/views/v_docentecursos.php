<div class="row" style="padding: 5px; margin-bottom: 10px;">
	<div class="col-md-12">
		<div id="form">
			<h2>Ingresar Nuevo Grado</h2>
			<form class="form-horizontal" role="form" onsubmit="insertarRegistro(); return false" id="frm">
				<div class="form-group">
					<div class="input-group">
						<label class="control-label" for="cod_docente">Docente</label>
						<select id="cod_docente" name="cod_docente" class="form-control">
							<option value="0">Seleccione un Docente</option>
							<?php 
							foreach ($docente as $row) {
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
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12" id="data-grid">
		<?php echo $tabla; ?>
	</div>
</div>