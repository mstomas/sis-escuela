<?php 
/**
* Controlador para ciclos
*/
class Curso extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_curso', 'modelo_ciclo'));
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_curso';
		$data['titulo'] = 'Sistema Escuela | Curso';
		$data['tabla'] = $this->consulta_registros();
		$data['ciclo'] = $this->modelo_ciclo->obtenerRegistros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_curso->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Ciclo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['cod_curso']);
			$linkElimina = $this->gen_link_e($row['cod_curso']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['cod_curso']."</td>
						<td>".$row['nombre']."</td>
						<td>".$row['ciclo']."</td>
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
		$cod_ciclo = $this->input->post('cod_ciclo');

		$this->modelo_curso->insertarRegistro($nombre, $cod_ciclo);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$cod_curso = $this->input->post('id');
		$registro = $this->modelo_curso->obtenerRegistro($cod_curso);
		$data['cod_curso'] = $registro->cod_curso;
		$data['nombre'] = $registro->nombre;
		$data['cod_ciclo'] = $registro->cod_ciclo;
		$data['ciclo'] = $this->modelo_ciclo->obtenerRegistros();
		$this->load->view('v_curso_actualiza',$data);
	}

	public function actualizar()
	{
		
		$cod_curso = $this->input->post('cod_curso');
		$cod_ciclo = $this->input->post('cod_ciclo');
		$nombre = $this->input->post('nombre');

		$this->modelo_curso->actualizarRegistro($cod_curso, $nombre, $cod_ciclo);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$cod_curso = $this->input->post('id');
			
		$this->modelo_curso->eliminarRegistro($cod_curso);

		echo $this->consulta_registros();
		
	}

}

 ?>