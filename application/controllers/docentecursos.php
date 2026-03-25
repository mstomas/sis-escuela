<?php 
/**
* Controlador para ciclos
*/
class Docentecursos extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_docentecursos', 'modelo_maestro', 'modelo_curso', 'modelo_grado'));
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_docentecursos';
		$data['titulo'] = 'Sistema Escuela | Docente y cursos';
		$data['tabla'] = $this->consulta_registros();
		$data['docente'] = $this->modelo_maestro->obtenerRegistros();
		$data['curso'] = $this->modelo_curso->obtenerRegistros();
		$data['grado'] = $this->modelo_grado->obtenerRegistros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_docentecursos->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Código</th>
							<th>Docente</th>
							<th>Grado</th>
							<th>Sección</th>
							<th>Curso</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['codigo']);
			$linkElimina = $this->gen_link_e($row['codigo']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['codigo']."</td>
						<td>".$row['docente']."</td>
						<td>".$row['grado']."</td>
						<td>".$row['seccion']."</td>
						<td>".$row['curso']."</td>
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

		$cod_docente = $this->input->post('cod_docente');
		$cod_grado = $this->input->post('cod_grado');
		$cod_curso = $this->input->post('cod_curso');

		$this->modelo_docentecursos->insertarRegistro($cod_docente, $cod_grado, $cod_curso);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$codigo = $this->input->post('id');
		$registro = $this->modelo_docentecursos->obtenerRegistro($codigo);
		$data['codigo'] = $registro->codigo;
		$data['cod_docente'] = $registro->cod_docente;
		$data['cod_grado'] = $registro->cod_grado;
		$data['cod_curso'] = $registro->cod_curso;
		$data['docente'] = $this->modelo_maestro->obtenerRegistros();
		$data['grado'] = $this->modelo_grado->obtenerRegistros();
		$data['curso'] = $this->modelo_curso->obtenerRegistros();
		$this->load->view('v_docentecursos_actualiza',$data);
	}

	public function actualizar()
	{
		
		$codigo = $this->input->post('codigo');
		$cod_docente = $this->input->post('cod_docente');
		$cod_grado = $this->input->post('cod_grado');
		$cod_curso = $this->input->post('cod_curso');

		$this->modelo_docentecursos->actualizarRegistro($codigo, $cod_docente, $cod_grado, $cod_curso);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$codigo = $this->input->post('id');
			
		$this->modelo_docentecursos->eliminarRegistro($codigo);

		echo $this->consulta_registros();
		
	}

}

 ?>