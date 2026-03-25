<?php 

/**
* Controlador para reporte de asistencias
*/
class AsistenciaReporte extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('table','html2pdf', 'PHPExcel/IOFactory'));
		$this->load->model(array('modelo_alumno', 'modelo_asistencia', 'modelo_asistenciadetalle'));
	}

	public function index(){
		$fecha_hoy = date("Y-m-d");
		$alumnos = $this->modelo_alumno->obtenerRegistros();

		$tabla = "";
		$tabla .= "<table class='table'>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Grado</th>
								<th>Sección</th>
								<th>Generar Reporte</th>
							</tr>
						</thead>
						<tbody>";

		foreach ($alumnos as $row) {
			$tabla .= "<tr>
							<td>".$row['nombre']."</td>
							<td>".$row['grado']."</td>
							<td>".$row['seccion']."</td>
							<td>
								<a href='javascript:generarReporte(".$row['cod_alumno'].");' class='btn btn-danger'>PDF</a>
							</td>
							</tr>";
		}

		$tabla .= "</tbody>
					   </table>";

		$data['titulo'] = "Sistema Escuela | Reporte de Asistencia";
		$data['contenido'] = "v_reporteasistencia";
		$data['menu'] = $this->menu();
		$data['tabla'] = $tabla;
		$data['options_meses'] = $this->optionsMes();
		$this->load->view('v_plantilla', $data);
	}

	private function optionsMes(){
		$options = "";
		$anio_actual = date("Y");
		$mes_atual = date("m");
		$mes = intval($mes_atual) - 1;
		$array_meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

		for($i = 0; $i < 12; $i++){
			if($mes == $i)
				$options .= "<option selected='selected' value='".($i + 1)."'>".$array_meses[$i]."/".$anio_actual."</option>";
			else
				$options .= "<option value='".($i + 1)."'>".$array_meses[$i]."/".$anio_actual."</option>";
		}

		return $options;
	}

	public function generarPDF($cod_alumno, $mes_inicial, $mes_final){

		$asistencia = $this->modelo_asistencia->obtenerAsistenciasRangoMes($mes_inicial, $mes_final);
		$this->table->set_heading('Fecha', 'Nombre alumno', 'Hora entrada', 'Hora salida');
		foreach ($asistencia as $row) {
			$detalle = $this->modelo_asistenciadetalle->obtenerAsistencia($row['codigo'], $cod_alumno);
			if(count($detalle) == 0){
				$this->table->add_row($row['fecha'], 'Inasistencia');
			}else{
				$this->table->add_row($row['fecha'], $detalle->nombre, $detalle->hora_entrada, $detalle->hora_salida);
			}
		}

		$data['tabla_asistencia'] = $this->table->generate();

		$this->crearFolder();
		$this->html2pdf->folder('./files/pdfs/');
		$this->html2pdf->filename('asistencia.pdf');
		$this->html2pdf->paper('a4','portrait');

		$this->html2pdf->html(utf8_decode($this->load->view('r_asistencia_pdf',$data, true)));

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
			$filename = "asistencia.pdf";
			$route = base_url("files/pdfs/asistencia.pdf");
			if(file_exists("./files/pdfs/".$filename))
			{
				header('Content-type: application/pdf');
				readfile($route);
			}
		}
	}

}

 ?>