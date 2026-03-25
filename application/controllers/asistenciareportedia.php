<?php 

/**
* Controlador para reporte de asistencias por día
*/
class AsistenciaReporteDia extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('table','html2pdf', 'phpexcel', 'PHPExcel/IOFactory'));
		$this->load->model(array('modelo_alumno', 'modelo_asistencia', 'modelo_asistenciadetalle'));
	}

	
	public function index(){

		$fecha_hoy = date("Y-m-d");
		$asistencia_hoy = $this->modelo_asistencia->obtenerAsistenciaHoy($fecha_hoy);

		$data['titulo'] = "Sistema Escuela | Reporte de Asistencia";
		$data['contenido'] = "v_reporteasistenciadia";
		$data['menu'] = $this->menu();
		$data['datos_asistencia'] = $this->genTablaAsistencia($asistencia_hoy->codigo);
		$data['descripcion_asistencia'] = $asistencia_hoy->descripcion;
		$data['options_dia'] = $this->optionsDia($asistencia_hoy->codigo);
		$this->load->view('v_plantilla', $data);
	}

	private function genTablaAsistencia($codigo){
		
		$asistencia = $this->modelo_asistencia->obtenerAsistenciaCodigo($codigo);

		$detalle_asistencia = $this->modelo_asistenciadetalle->obtenerAsistenciaPorCodigo($asistencia->codigo);

		$tabla = "<h1>".$asistencia->descripcion."</h1>";
		$tabla .= "<table class='table'>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Grado</th>
								<th>Sección</th>
								<th>Hora entrada</th>
								<th>Hora salida</th>
							</tr>
						</thead>
						<tbody>";

		foreach ($detalle_asistencia as $row) {
			$alumno = $this->modelo_alumno->obtenerRegistro($row['codigo_alumno']);
			$tabla .= "<tr>
							<td>".$alumno->nombre."</td>
							<td>".$alumno->grado."</td>
							<td>".$alumno->seccion."</td>
							<td>".$row['hora_entrada']."</td>
							<td>".$row['hora_salida']."</td>
							</tr>";
		}

		$tabla .= "</tbody>
					   </table>";

		return $tabla;
	}

	private function optionsDia($codigo_actual){
		$fechas = $this->modelo_asistencia->obtenerRegistros();
		$options = "";
		foreach ($fechas as $row) {
			if($row['codigo'] == $codigo_actual)
				$options .= '<option value="'.$row['codigo'].'" selected="selected">'.$row['descripcion'].'</option>';
			else
				$options .= '<option value="'.$row['codigo'].'">'.$row['descripcion'].'</option>';
		}

		return $options;
	}

	public function obtenerTabla(){
		$codigo = $this->input->post("codigo");
		echo $this->genTablaAsistencia($codigo);
	}

	public function generarPDF($codigo){

		$data['tabla'] = $this->genTablaAsistencia($codigo);

		$this->crearFolder();
		$this->html2pdf->folder('./files/pdfs/');
		$this->html2pdf->filename('asistencia_dia.pdf');
		$this->html2pdf->paper('a4','portrait');

		$this->html2pdf->html(utf8_decode($this->load->view('r_asistencia_dia_pdf',$data, true)));

		if($this->html2pdf->create('save'))
			$this->show();
	}

	private function crearFolder()
	{
		if(!is_dir("./files"))
		{
			mkdir("./files", 0777);
			mkdir("./files/pdfs", 0777);
		}
	}

	private function show()
	{
		if(is_dir("./files/pdfs"))
		{
			$filename = "asistencia_dia.pdf";
			$route = base_url("files/pdfs/asistencia_dia.pdf");
			if(file_exists("./files/pdfs/".$filename))
			{
				header('Content-type: application/pdf');
				readfile($route);
			}
		}
	}
}

 ?>