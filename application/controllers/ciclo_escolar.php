<?php 
/**
* Controlador para ciclos
*/
class Ciclo_escolar extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelo_cicloescolar');
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_cicloescolar';
		$data['titulo'] = 'Sistema Escuela | Ciclo Escolar';
		$data['tabla'] = $this->consulta_registros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_cicloescolar->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Código</th>
							<th>Descripción</th>
							<th>Año</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['cod_ciclo_escolar']);
			$linkElimina = $this->gen_link_e($row['cod_ciclo_escolar']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['cod_ciclo_escolar']."</td>
						<td>".$row['descripcion']."</td>
						<td>".$row['anio']."</td>
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

		$descripcion = $this->input->post('descripcion');
		$anio = $this->input->post('anio');

		$this->modelo_cicloescolar->insertarRegistro($descripcion,$anio);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$cod_ciclo_escolar = $this->input->post('id');
		$registro = $this->modelo_cicloescolar->obtenerRegistro($cod_ciclo_escolar);
		$data['cod_ciclo_escolar'] = $registro->cod_ciclo_escolar;
		$data['descripcion'] = $registro->descripcion;
		$data['anio'] = $registro->anio;
		$this->load->view('v_cicloescolar_actualiza',$data);
	}

	public function actualizar()
	{
		
		$cod_ciclo_escolar = $this->input->post('cod_ciclo_escolar');
		$descripcion = $this->input->post('descripcion');
		$anio = $this->input->post('anio');

		$this->modelo_cicloescolar->actualizarRegistro($cod_ciclo_escolar, $descripcion, $anio);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$cod_ciclo_escolar = $this->input->post('id');
			
		$this->modelo_cicloescolar->eliminarRegistro($cod_ciclo_escolar);

		echo $this->consulta_registros();
		
	}

}

 ?>