<?php 
/**
* Controlador para ciclos
*/
class Maestro extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelo_maestro');
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_maestro';
		$data['titulo'] = 'Sistema Escuela | Maestro';
		$data['tabla'] = $this->consulta_registros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_maestro->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Télefono</th>
							<th>E-mail</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['cod_docente']);
			$linkElimina = $this->gen_link_e($row['cod_docente']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['cod_docente']."</td>
						<td>".$row['nombre']."</td>
						<td>".$row['telefono']."</td>
						<td>".$row['email']."</td>
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
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('email');

		$this->modelo_maestro->insertarRegistro($nombre, $telefono, $email);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$cod_docente = $this->input->post('id');
		$registro = $this->modelo_maestro->obtenerRegistro($cod_docente);
		$data['cod_docente'] = $registro->cod_docente;
		$data['nombre'] = $registro->nombre;
		$data['telefono'] = $registro->telefono;
		$data['email'] = $registro->email;
		$this->load->view('v_maestro_actualiza',$data);
	}

	public function actualizar()
	{
		
		$cod_docente = $this->input->post('cod_docente');
		$nombre = $this->input->post('nombre');
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('email');

		$this->modelo_maestro->actualizarRegistro($cod_docente, $nombre, $telefono, $email);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$cod_docente = $this->input->post('id');
			
		$this->modelo_maestro->eliminarRegistro($cod_docente);

		echo $this->consulta_registros();
		
	}

}

 ?>