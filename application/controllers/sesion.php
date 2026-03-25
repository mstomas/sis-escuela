<?php 

/**
* Inicio de Sesion
*
* Controlador para el inicio de sesión
*
* @author Marcos Tomás <mst_samuel90@hotmail.com>
* @version 1
* @since 02-10-2014
*/
class Sesion extends CI_Controller
{

	private $seg = "";
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->seg = new Segsis(FALSE);
	}

	public function index(){

		$this->load->view('v_sesion');
		
	}

	public function iniciar(){

		$respuesta = array('estado' => 0, 'mensaje' => 'No se ha podido iniciar sesión');

		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');

		if(strcmp($usuario, "") == 0 || strcmp($clave, "") == 0){
			$respuesta = array('estado' => 0, 'mensaje' => 'Debe de ingresar el nombre del usuario y contraseña');
		}else{
			if($this->seg->iniciarSesion($usuario, $clave)){
				$respuesta = array('estado' => 1, 'mensaje' => base_url("cicloescolar"));
			}else{
				$respuesta = array('estado' => 0, 'mensaje' => 'Usuario o contraseña son incorrectos. Porfavor intentelo de nuevo.');
			}
		}

		$this->resjson($respuesta);

	}

	public function cerrar(){
		$this->seg->cerrarSesion();
		redirect("sesion");
	}

	public function prueba(){
		$respuesta = array('estado' => 0, 'mensaje' => 'No se ha podido iniciar sesion');
		$this->resjson($respuesta);
	}

	private function resjson($data){
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
}

 ?>