<h1 class="page-header">Indicadores</h1>
<div class="row">
	<div class="col-md-6">
		<label>Mes:</label>
		<select class="form-control" id="mes_filtro" name="mes_filtro">
			<?php echo $options_meses; ?>
		</select>
	</div>
	<div class="col-md-6">
		<br>
		<button class="btn btn-primary" id="boton-actualizar">Actualizar gráfica</button>
	</div>
	<div class="col-md-12">
		<canvas id="canvas-puntual"></canvas>
	</div>
</div>