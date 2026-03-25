<?php 
/**
* Controlador para ciclos
*/
class Usuario extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_usuario', 'modelo_maestro', 'modelo_curso', 'modelo_grado'));
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_usuario';
		$data['titulo'] = 'Sistema Escuela | Usuarios';
		$data['tabla'] = $this->consulta_registros();
		$data['docente'] = $this->modelo_maestro->obtenerRegistros();
		$data['curso'] = $this->modelo_curso->obtenerRegistros();
		$data['grado'] = $this->modelo_grado->obtenerRegistros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_usuario->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Usuario</th>
							<th>Estado</th>
							<th>Role</th>
							<th>Docente</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['idUsuario']);
			$linkElimina = $this->gen_link_e($row['idUsuario']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['Nombre']."</td>
						<td>".$row['estado']."</td>
						<td>".$row['role']."</td>
						<td>".$row['docente']."</td>
						<td>".$link."</td>
						</tr>";
		}	

		$tabla .= "</tbody>
				   </table>";

		return $tabla;
	}

	private function gen_link_a($id)
	{

		$link = '<a onclick="formActualiza('.$id.')" class="btn btn-warning">Modificar</a>';

		return $link;
	}

	private function gen_link_e($id)
	{

		$link = '<a onclick="eliminarRegistro('.$id.')" class="btn btn-danger">Eliminar</a>';

		return $link;
	}


	public function insertar()
	{	

		$nombre = $this->input->post('nombre');
		$password = $this->input->post('password');
		$idEstatusUsuario = $this->input->post('idEstatusUsuario');
		$idRole = $this->input->post('idRole');
		$cod_docente = $this->input->post('cod_docente');

		$this->modelo_usuario->insertarRegistro($nombre, $password, $idEstatusUsuario, $idRole, $cod_docente);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$idUsuario = $this->input->post('id');
		$registro = $this->modelo_usuario->obtenerRegistro($idUsuario);
		$data['idUsuario'] = $registro->idUsuario;
		$data['nombre'] = $registro->Nombre;
		$data['idEstatusUsuario'] = $registro->idEstatusUsuario;
		$data['idRole'] = $registro->idRole;
		$data['password'] = $registro->Password;
		$data['cod_docente'] = $registro->cod_docente;
		$data['docente'] = $this->modelo_maestro->obtenerRegistros();
		$this->load->view('v_usuario_actualiza',$data);
	}

	public function actualizar()
	{
		
		$idUsuario = $this->input->post('idUsuario');
		$nombre = $this->input->post('nombre');
		$idEstatusUsuario = $this->input->post('idEstatusUsuario');
		$idRole = $this->input->post('idRole');
		$password = $this->input->post('password');
		$cod_docente = $this->input->post('cod_docente');

		$this->modelo_usuario->actualizarRegistro($idUsuario, $nombre, $password, $idEstatusUsuario,$idRole,$cod_docente);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$idUsuario = $this->input->post('id');
			
		$this->modelo_usuario->eliminarRegistro($idUsuario);

		echo $this->consulta_registros();
		
	}

}

 ?>