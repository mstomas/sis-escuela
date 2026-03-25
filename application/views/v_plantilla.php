<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo; ?> </title>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/estilo.css'; ?> ">
</head>
<body>

	<div class="navbar navbar-fixed-top navbar-sis" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle-navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Academia de ingles Campo Real</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right nav-sis">
					<li><a href="<?php echo site_url('principal'); ?>">Inicio</a></li>
					<!-- <li><a href="#">Ajustes</a></li>
					<li><a href="#">Ayuda</a></li> -->
					<li><a href="<?php echo site_url('sesion/cerrar'); ?>">Salir</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<!-- <ul class='nav nav-sidebar'>
					<li>
						<a href='#'><span class='glyphicon glyphicon-'>&nbsp;</span>Opcion</a>
					</li>
				</ul> -->
				<?php echo $menu; ?>
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<!-- Contenido Principal -->
				<?php $this->load->view($contenido.'.php'); ?>
			</div>
		</div>
	</div>


	<script src="<?php echo base_url().'assets/js/jquery-1.11.1.js'; ?> "></script>
	<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'; ?> "></script>
	<script src="<?php echo base_url().'assets/Chartjs/Chart.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/js/script.js'; ?> "></script>
</body>
</html>