<?php 
/**
* Controlador para ciclos
*/
class Ciclo extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelo_ciclo');
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_ciclo';
		$data['titulo'] = 'Sistema Escuela | Ciclo';
		$data['tabla'] = $this->consulta_registros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_ciclo->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Código</th>
							<th>Descripción</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['cod_ciclo']);
			$linkElimina = $this->gen_link_e($row['cod_ciclo']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['cod_ciclo']."</td>
						<td>".$row['nombre']."</td>
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

		$this->modelo_ciclo->insertarRegistro($nombre);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$cod_ciclo = $this->input->post('id');
		$registro = $this->modelo_ciclo->obtenerRegistro($cod_ciclo);
		$data['cod_ciclo'] = $registro->cod_ciclo;
		$data['descripcion'] = $registro->nombre;
		$this->load->view('v_ciclo_actualiza',$data);
	}

	public function actualizar()
	{
		
		$cod_ciclo = $this->input->post('cod_ciclo');
		$nombre = $this->input->post('nombre');

		$this->modelo_ciclo->actualizarRegistro($cod_ciclo, $nombre);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$cod_ciclo = $this->input->post('id');
			
		$this->modelo_ciclo->eliminarRegistro($cod_ciclo);

		echo $this->consulta_registros();
		
	}

}

 ?>