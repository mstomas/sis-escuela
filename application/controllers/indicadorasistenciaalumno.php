<?php 

/**
* Controlador para indicador de asistencia
*/
class IndicadorAsistenciaAlumno extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_alumno', 'modelo_asistenciadetalle', 'modelo_asistencia'));
	}

	public function index(){
		$data['titulo'] = "Sistema Escuela | Indicador puntualidad alumno";
		$data['contenido'] = "v_indicador_asistencia";
		$data['menu'] = $this->menu();
		$data['options_meses'] = $this->optionsMes();
		$data['options_alumnos'] = $this->optionsAlumnos();
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

	private function optionsAlumnos(){
		
		$alumnos = $this->modelo_alumno->obtenerRegistros();
		$options = "";

		foreach ($alumnos as $row) {
			$options .= "<option value='".$row['cod_alumno']."'>".$row['nombre']."</option>";
		}

		return $options;
	}

	public function getData($mes, $codigo_alumno){
		
		$asistencia = $this->modelo_asistencia->obtenerCantidadAsistenciaMes($mes);
		$detalle_asistencia = $this->modelo_asistenciadetalle->obtenerCantidadAsistencias($codigo_alumno, $mes);
		$inasistencias = intval($asistencia->total) - intval($detalle_asistencia->total);
		$porcentaje_asistencia = number_format((float)((intval($detalle_asistencia->total) / intval($asistencia->total)) * 100), 2);
		if($inasistencias > 0)
			$porcentaje_inasistencia = number_format((float)((intval($inasistencias) / intval($asistencia->total)) * 100), 2);

		$labels = array('Asistencias', 'Inasistencias');
		$dataset1->label = 'Asistencia';
		$dataset1->backgroundColor = array('rgb(54, 162, 235)', 'rgb(255, 99, 132)');
		$dataset1->borderWidth = 1;
		$dataset1->data = array($porcentaje_asistencia, $porcentaje_inasistencia);

		$retorno->labels = $labels;
		$retorno->datasets = array($dataset1);
		echo json_encode($retorno);
	}
}

 ?>