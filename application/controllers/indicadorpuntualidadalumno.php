<?php 

/**
* Controlador para indicador de puntualidad
*/
class IndicadorPuntualidadAlumno extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_alumno', 'modelo_asistenciadetalle'));
	}

	public function index(){
		$data['titulo'] = "Sistema Escuela | Indicador puntualidad alumno";
		$data['contenido'] = "v_indicador_puntualidad";
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
		
		$datos = $this->modelo_asistenciadetalle->obtenerPorcentajePuntualidad($codigo_alumno, $mes);

		$labels = array('Puntual', 'Impuntual');
		$dataset1->label = 'Puntualidad';
		$dataset1->backgroundColor = array('rgb(54, 162, 235)', 'rgb(255, 99, 132)');
		$dataset1->borderWidth = 1;
		$dataset1->data = array($datos->puntual, $datos->impuntual);

		$retorno->labels = $labels;
		$retorno->datasets = array($dataset1);
		echo json_encode($retorno);
	}
}

 ?>