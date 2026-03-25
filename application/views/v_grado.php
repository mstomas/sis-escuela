<div class="row" style="padding: 5px; margin-bottom: 10px;">
	<div class="col-md-12">
		<div id="form">
			<h2>Ingresar Nuevo Grado</h2>
			<form class="form-horizontal" role="form" onsubmit="insertarRegistro(); return false" id="frm">
				<div class="form-group">
					<div class="input-group">
						<label class="control-label" for="grado">Grado</label>
						<input type="text" class="form-control" name="grado" id="grado">
					</div>
					<div class="input-group">
						<label class="control-label" for="seccion">Sección</label>
						<input type="text" class="form-control" name="seccion" id="seccion">
					</div>
					<div class="input-group">
						<label class="control-label" for="nombre">Ciclo</label>
						<select name="cod_ciclo" id="cod_ciclo" class="form-control">
							<option value="0">Seleccione un Ciclo</option>
							<?php 
							foreach ($ciclo as $row) {
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
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12" id="data-grid">
		<?php echo $tabla; ?>
	</div>
</div>