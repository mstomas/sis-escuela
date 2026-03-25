<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Escuela | Login</title>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/estilo.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="row">
				<div class="col-md-12 centrar" id="titulo-login">
					<h2>INICIAR SESIÓN</h2>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 centrar form-login">
					<form class="form-horizontal" role="form" action="" onsubmit="sesion(this); return false">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
								<input type="text" class="form-control control-gr" id="usuario" name="usuario" placeholder="Usuario">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock"></span>
								</div>
								<input type="password" class="form-control control-gr" id="clave" name="clave" placeholder="Clave">
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg">Entrar</button>
						</div>
					</form>
					<div id="mensaje">
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="assets/js/jquery-1.11.1.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/script.js"></script>

</body>
</html>