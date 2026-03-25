<div class="row" style="padding: 5px; margin-bottom: 10px;">
	<div class="col-md-12">
		<div id="form">
			<h2>Ingresar Nuevo Usuario</h2>
			<form class="form-horizontal" role="form" onsubmit="insertarRegistro(); return false" id="frm">
				<div class="form-group">
					<div class="input-group">
						<label class="control-label" for="nombre">Usuario</label>
						<input type="text" id="nombre" name="nombre" class="form-control">
					</div>
					<div class="input-group">
						<label class="control-label" for="password">Contraseña</label>
						<input type="password" id="password" name="password" class="form-control">
					</div>
					<div class="input-group">
						<label class="control-label" for="idEstatusUsuario">Estado</label>
						<select name="idEstatusUsuario" id="idEstatusUsuario" class="form-control">
							<option value="0">Seleccione Estado</option>
							<option value="1">Activo</option>
							<option value="2">Inactivo</option>
						</select>
					</div>
					<div class="input-group">
						<label class="control-label" for="idRole">Role</label>
						<select name="idRole" id="idRole" class="form-control">
							<option value="0">Seleccione Role</option>
							<option value="1">Administrador</option>
							<option value="2">Maestro</option>
						</select>
					</div>
					<div class="input-group">
						<label class="control-label" for="cod_docente">Docente</label>
						<select name="cod_docente" id="cod_docente" class="form-control">
							<option value="0">Seleccione Docente</option>
							<?php 
							foreach ($docente as $row) {
								echo "<option value='".$row['cod_docente']."'>".$row['nombre']."</option>";
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