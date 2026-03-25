<h2>Reporte de asistencias e inasistencias</h2>
<div class="row">
	<div class="col-md-6">
		<label>De:</label>
		<select class="form-control" id="mes_inicial" name="mes_inicial">
			<?php echo $options_meses; ?>
		</select>
	</div>
	<div class="col-md-6">
		<label>A:</label>
		<select class="form-control" id="mes_final" name="mes_final">
			<?php echo $options_meses; ?>
		</select>
	</div>
	<div class="col-md-12">
		<?php echo $tabla; ?>
	</div>
</div>