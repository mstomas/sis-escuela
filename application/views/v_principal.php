<h1 class="page-header">Dashboard</h1>
<div class="row">
	<?php if($id_role == 1){ ?>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<a href="<?php echo site_url('alumno'); ?>" class="wid">
			<div class="enc-wid">
						
			</div>
			<div class="body-wid">
				<span class="glyphicon glyphicon-briefcase"></span>
			</div>
			<div class="foot-wid">
				Alumnos
			</div>
		</a>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<a href="<?php echo site_url('notas'); ?>" class="wid">
			<div class="enc-wid">
									
			</div>
			<div class="body-wid">
				<span class="glyphicon glyphicon-pencil"></span>
			</div>
			<div class="foot-wid">
				Notas
			</div>
		</a>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<a href="<?php echo site_url('marcarentrada'); ?>" class="wid">
			<div class="enc-wid">
									
			</div>
			<div class="body-wid">
				<span class="glyphicon glyphicon-import"></span>
			</div>
			<div class="foot-wid">
				Marcar entrada
			</div>
		</a>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<a href="<?php echo site_url('marcarsalida'); ?>" class="wid">
			<div class="enc-wid">
									
			</div>
			<div class="body-wid">
				<span class="glyphicon glyphicon-export"></span>
			</div>
			<div class="foot-wid">
				Marcar salida
			</div>
		</a>
	</div>
	<?php }else{ ?>
	<div class="col-md-3 col-sm-3 col-xs-6">
	<a href="<?php echo site_url('notas'); ?>" class="wid">
		<div class="enc-wid">
								
		</div>
		<div class="body-wid">
			<span class="glyphicon glyphicon-pencil"></span>
		</div>
		<div class="foot-wid">
			Notas
		</div>
		</a>
	</div>
	<?php } ?>
</div>