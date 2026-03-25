
	<h2>Modificar Usuario</h2>
	<form class="form-horizontal" role="form" onsubmit="modificaRegistro(this); return false" id="frm">
		<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario; ?>">
		<div class="form-group">
			
			<div class="input-group">
						<label class="control-label" for="nombre">Usuario</label>
						<input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
					</div>
					<div class="input-group">
						<label class="control-label" for="password">Contraseña</label>
						<input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>">
					</div>
					<div class="input-group">
						<label class="control-label" for="idEstatusUsuario">Estado</label>
						<select name="idEstatusUsuario" id="idEstatusUsuario" class="form-control">
							<option value="0">Seleccione Estado</option>
							<?php 
							if($idEstatusUsuario == 1)
							{
								$select1 = "selected='selected'";
								$select2 = "";
							}
							else{
								$select2 = "selected='selected'";
								$select1 = "";	
							}
							 ?>
							<option value="1" <?php echo $select1; ?>>Activo</option>
							<option value="2" <?php echo $select2; ?>>Inactivo</option>
						</select>
					</div>
					<div class="input-group">
						<label class="control-label" for="idRole">Role</label>
						<select name="idRole" id="idRole" class="form-control">
							<option value="0">Seleccione Role</option>
							<?php
							if($idRole == 1){
								$select3 = "selected='selected'";
								$select4 = "";
							}
							else{
								$select4 = "selected='selected'";
								$select3 = "";
							}
							 ?>
							<option value="1" <?php echo $select3; ?>>Administrador</option>
							<option value="2" <?php echo $select4; ?>>Maestro</option>
						</select>
					</div>
					<div class="input-group">
						<label class="control-label" for="cod_docente">Docente</label>
						<select name="cod_docente" id="cod_docente" class="form-control">
							<option value="0">Seleccione Docente</option>
							<?php 
							foreach ($docente as $row) {
								if($cod_docente == $row['cod_docente'])
									echo "<option value='".$row['cod_docente']."' selected='selected'>".$row['nombre']."</option>";
								else
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
