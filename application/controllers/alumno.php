<?php 
/**
* Controlador para ciclos
*/
class Alumno extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_alumno', 'modelo_cicloescolar', 'modelo_grado'));
		$this->load->library('zend');
	}

	public function index(){

		$data['menu'] = $this->menu();
		$data['contenido'] = 'v_alumno';
		$data['titulo'] = 'Sistema Escuela | Alumnos';
		$data['tabla'] = $this->consulta_registros();
		$data['ciclo_escolar'] = $this->modelo_cicloescolar->obtenerRegistros();
		$data['grado'] = $this->modelo_grado->obtenerRegistros();
		$this->load->view('v_plantilla', $data);
	}

	public function consulta_registros()
	{
		$dat = $this->modelo_alumno->obtenerRegistros();
		$tabla = "";

		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Clave</th>
							<th>Nombre</th>
							<th>Dirección</th>
							<th>Grado</th>
							<th>Sección</th>
							<th>Ciclo Escolar</th>
							<th>Codigo barras</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($dat as $row) 
		{
			$linkActualiza = $this->gen_link_a($row['cod_alumno']);
			$linkElimina = $this->gen_link_e($row['cod_alumno']);
			$link = $linkActualiza.' '.$linkElimina;
			$tabla .= "<tr>
						<td>".$row['clave']."</td>
						<td>".$row['nombre']."</td>
						<td>".$row['direccion']."</td>
						<td>".$row['grado']."</td>
						<td>".$row['seccion']."</td>
						<td>".$row['descripcion']."</td>
						<td><img src='".site_url("alumno/gen_codbar/".$row['codigo_tarjeta'])."'></td>
						<td>".$link."</td>
						</tr>";
		}	

		$tabla .= "</tbody>
				   </table>";

		return $tabla;
	}

	public function gen_codbar($val){
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('code128', 'image', array('text' => $val), array());
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
		$clave = $this->input->post('clave');
		$direccion = $this->input->post('direccion');
		$cod_grado = $this->input->post('cod_grado');
		$cod_ciclo_escolar = $this->input->post('cod_ciclo_escolar');

		list($primer_nombre, $segundo_nombre) = explode(" ", $nombre);
		$codigo_tarjeta = strtolower(substr($primer_nombre, 0, 1)) . strtolower(substr($segundo_nombre, 0, 1)) . rand(100, 900);

		$this->modelo_alumno->insertarRegistro($clave, $nombre, $direccion, $cod_grado, $cod_ciclo_escolar, $codigo_tarjeta);

		echo $this->consulta_registros();
		
	}

	public function consulta_por_id()
	{

		$cod_alumno = $this->input->post('id');
		$registro = $this->modelo_alumno->obtenerRegistro($cod_alumno);
		$data['cod_alumno'] = $registro->cod_alumno;
		$data['clave'] = $registro->clave;
		$data['nombre'] = $registro->nombre;
		$data['direccion'] = $registro->direccion;
		$data['cod_grado'] = $registro->cod_grado;
		$data['cod_ciclo_escolar'] = $registro->cod_ciclo_escolar;
		$data['ciclo_escolar'] = $this->modelo_cicloescolar->obtenerRegistros();
		$data['grado'] = $this->modelo_grado->obtenerRegistros();
		$this->load->view('v_alumno_actualiza',$data);
	}

	public function actualizar()
	{
		
		$cod_alumno = $this->input->post('cod_alumno');
		$clave = $this->input->post('clave');
		$nombre = $this->input->post('nombre');
		$direccion = $this->input->post('direccion');
		$cod_grado = $this->input->post('cod_grado');
		$cod_ciclo_escolar = $this->input->post('cod_ciclo_escolar');

		$this->modelo_alumno->actualizarRegistro($cod_alumno, $clave, $nombre, $direccion, $cod_grado, $cod_ciclo_escolar);

		echo $this->consulta_registros();
		
	}

	public function eliminar()
	{
		$cod_alumno = $this->input->post('id');
			
		$this->modelo_alumno->eliminarRegistro($cod_alumno);

		echo $this->consulta_registros();
		
	}

}

 ?>