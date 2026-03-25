
	<h2>Modificar Curso</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="cod_curso" id="cod_curso" value="<?php echo $cod_curso; ?>">
		<div class="form-group">
			<label class="control-label" for="nombre">Nombre</label>
			<div class="input-group">
				<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label" for="cod_ciclo">Ciclo</label>
			<div class="input-group">
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
