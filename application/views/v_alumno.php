<div class="row" style="padding: 5px; margin-bottom: 10px;">
	<div class="col-md-12">
		<div id="form">
			<h2>Ingresar Nuevo Alumno</h2>
			<form class="form-horizontal" role="form" onsubmit="insertarRegistro(); return false" id="frm">
				<div class="form-group">
					<div class="input-group">
						<label class="control-label" for="clave">Clave</label>
						<input type="text" class="form-control" name="clave" id="clave">
					</div>
					<div class="input-group">
						<label class="control-label" for="nombre">Nombre</label>
						<input type="text" class="form-control" name="nombre" id="nombre">
					</div>
					<div class="input-group">
						<label class="control-label" for="direccion">Dirección</label>
						<input type="text" class="form-control" name="direccion" id="direccion">
					</div>
					<div class="input-group">
						<label class="control-label" for="cod_grado">Grado y Sección</label>
						<select id="cod_grado" name="cod_grado" class="form-control">
							<option value="0">Seleccione Grado y Sección</option>
							<?php 
							foreach ($grado as $row) {
								echo "<option value='".$row['cod_grado']."'>".$row['grado']." - ".$row['seccion']."</option>";
							}

							 ?>
						</select>
					</div>
					<div class="input-group">
						<label class="control-label" for="cod_ciclo_escolar">Ciclo escolar</label>
						<select name="cod_ciclo_escolar" id="cod_ciclo_escolar" class="form-control">
							<option value="0">Seleccione el Ciclo Escolar</option>
							<?php 
							foreach ($ciclo_escolar as $row) {
								echo "<option value='".$row['cod_ciclo_escolar']."'>".$row['descripcion']."</option>";
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