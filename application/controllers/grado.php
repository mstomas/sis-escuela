<?php 
/**
* Controlador para ciclos
*/
class Grado extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_grado', 'modelo_ciclo'));
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_grado';
		$data['titulo'] = 'Sistema Escuela | Grado y Sección';
		$data['tabla'] = $this->consulta_registros();
		$data['ciclo'] = $this->modelo_ciclo->obtenerRegistros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_grado->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Código</th>
							<th>Grado</th>
							<th>Sección</th>
							<th>Ciclo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['cod_grado']);
			$linkElimina = $this->gen_link_e($row['cod_grado']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['cod_grado']."</td>
						<td>".$row['grado']."</td>
						<td>".$row['seccion']."</td>
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

		$grado = $this->input->post('grado');
		$seccion = $this->input->post('seccion');
		$cod_ciclo = $this->input->post('cod_ciclo');

		$this->modelo_grado->insertarRegistro($grado, $seccion, $cod_ciclo);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$cod_grado = $this->input->post('id');
		$registro = $this->modelo_grado->obtenerRegistro($cod_grado);
		$data['cod_grado'] = $registro->cod_grado;
		$data['grado'] = $registro->grado;
		$data['seccion'] = $registro->seccion;
		$data['cod_ciclo'] = $registro->cod_ciclo;
		$data['ciclo'] = $this->modelo_ciclo->obtenerRegistros();
		$this->load->view('v_grado_actualiza',$data);
	}

	public function actualizar()
	{
		
		$cod_grado = $this->input->post('cod_grado');
		$grado = $this->input->post('grado');
		$seccion = $this->input->post('seccion');
		$cod_ciclo = $this->input->post('cod_ciclo');

		$this->modelo_grado->actualizarRegistro($cod_grado, $grado, $seccion, $cod_ciclo);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$cod_grado = $this->input->post('id');
			
		$this->modelo_grado->eliminarRegistro($cod_grado);

		echo $this->consulta_registros();
		
	}

}

 ?>