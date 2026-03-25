<div class="row">
	<div class="col-md-6">
		<label>Elegir fecha:</label>
		<select class="form-control" id="filtro-dia" name="filtro-dia" onchange="asistenciaDia(this)">
			<?php echo $options_dia; ?>
		</select>
	</div>
	<div class="col-md-12" id="datos-asistencia">
		<?php echo $datos_asistencia ?>
	</div>
	<div class="col-md-3">
		<button class="btn btn-danger" onclick="generarReporteAsistenciaDia()">Generar pdf</button>
	</div>
</div>