<?php 

/**
* Clase para seleccionar el ciclo escolar
*/
class Cicloescolar extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelo_ciclo_escolar');
	}

	public function index(){
		$reg_ciclos = $this->modelo_ciclo_escolar->obtenerRegistros();
		$options = "";

		foreach ($reg_ciclos as $row) {
			$options .= "<option value='".$row['anio']."'>".$row['descripcion']."</option>";
		}

		$data['options'] = $options;
		$this->load->view('v_ciclo_escolar', $data);
	}

	public function seleccionar(){
		$ciclo = $this->input->post('ciclo');
		echo $ciclo;
		$this->segsis->setCicloEscolar($ciclo);
		redirect('principal');
	}
}


 ?>