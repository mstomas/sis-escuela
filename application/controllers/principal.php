<?php 

/**
* Pantalla Principal de Dashboard
* 
* Controlador para la pantalla principal del dashboard.
*
* @author Marcos Tomás <mst_samuel90@hotmail.com>
* @version 1
* @since 02-10-2014
*/
class Principal extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$data['menu'] = $this->menu();
		$data['contenido'] = "v_principal";
		$data['titulo'] = "Sistema Escuela | Página Principal";
		$data['id_role'] = $this->segsis->idRole();
		
		$this->load->view('v_plantilla', $data);
	}
}


 ?>