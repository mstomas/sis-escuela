<h1 class="page-header">Indicador de puntualidad del alumno</h1>
<div class="row">
	<div class="col-md-4">
		<label>Mes:</label>
		<select class="form-control" id="mes_filtro" name="mes_filtro">
			<?php echo $options_meses; ?>
		</select>
	</div>
	<div class="col-md-4">
		<label>Alumno:</label>
		<select class="form-control" id="alumno_filtro" name="alumno_filtro">
			<?php echo $options_alumnos; ?>
		</select>
	</div>
	<div class="col-md-4">
		<br>
		<button class="btn btn-primary" id="boton-generar">Generar gráfica</button>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		&nbsp;
	</div>
	<div class="col-md-6">
		<canvas id="canvas-puntual-alumno"></canvas>
	</div>
	<div class="cold-md-3">
		&nbsp;
	</div>
</div>