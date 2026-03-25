
	<h2>Modificar Curso</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="cod_alumno" id="cod_alumno" value="<?php echo $cod_alumno; ?>">
		<div class="form-group">
			
			<div class="input-group">
				<label class="control-label" for="clave">Clave</label>
				<input type="text" class="form-control" name="clave" id="clave" value="<?php echo $clave; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="nombre">Nombre</label>
				<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="direccion">Dirección</label>
				<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>">
			</div>
			<div class="input-group">
				<label class="control-label" for="cod_grado">Grado y Sección</label>
				<select id="cod_grado" name="cod_grado" class="form-control">
					<option value="0">Seleccione Grado y Sección</option>
					<?php 
					foreach ($grado as $row) {
						if($cod_grado == $row['cod_grado'])
							echo "<option value='".$row['cod_grado']."' selected='selected'>".$row['grado']." - ".$row['seccion']."</option>";
						else
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
						if($cod_ciclo_escolar == $row['cod_ciclo_escolar'])
							echo "<option value='".$row['cod_ciclo_escolar']."' selected='selected'>".$row['descripcion']."</option>";
						else
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
