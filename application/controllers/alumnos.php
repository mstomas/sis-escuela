<?php 

/**
* Controlador para alumnos
*/
class Alumnos extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$data['contenido'] = 'alumnos';
		$data['titulo'] = 'Sistema Escuela | Nota de Alumnos';
		$data['menu'] = $this->menu();
		$this->load->view('v_plantilla', $data);
	}
}

 ?>