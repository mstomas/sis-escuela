<?php 

/**
* Controlador para indicadores
*/
class Indicadores extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_asistencia', 'modelo_asistenciadetalle', 'modelo_alumno'));
	}

	public function index(){
		$data['titulo'] = "Sistema Escuela | Reporte de Alumnos por Cursos";
		$data['contenido'] = "v_indicadores";
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

	public function getData($mes){
		
		$labels = array();
		$dataset1->label = 'Puntuales';
		$dataset1->backgroundColor = 'rgb(54, 162, 235)';
		$dataset1->borderColor = 'rgb(54, 162, 235)';
		$dataset1->borderWidth = 1;
		$dataset1->data = array();

		$dataset2->label = 'Impuntuales';
		$dataset2->backgroundColor = 'rgb(255, 99, 132)';
		$dataset2->borderColor = 'rgb(255, 99, 132)';
		$dataset2->borderWidth = 1;
		$dataset2->data = array();

		$puntuales = $this->modelo_asistenciadetalle->obtenerPuntuales($mes);
		foreach ($puntuales as $row) {
			array_push($labels, $row['fecha']);
			array_push($dataset1->data, $row['cantidad']);
		}

		$inpuntuales = $this->modelo_asistenciadetalle->obtenerInpuntuales($mes);
		foreach ($inpuntuales as $row) {
			if(count($labels) == 0)
				array_push($labels, $row['fecha']);
			array_push($dataset2->data, $row['cantidad']);
		}

		
		$retorno->labels = $labels;
		$retorno->datasets = array($dataset1, $dataset2);

		echo json_encode($retorno);
	}
}

 ?>