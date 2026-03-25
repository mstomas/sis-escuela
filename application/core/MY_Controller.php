<?php 
/**
* Clase que servirá de base para los controladores. Acá
* se colocará toda la lógica común para todos los 
* controladores, por ejemplo: la seguridad
*
* @author Marcos Tomás <mst_samuel90@hotmail.com>
* @version 1
* @since 29-09-2014
*/
class MY_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		if( ! $this->segsis->sesionIniciada() ){
			redirect('sesion');
		}else{
			$this->load->model('modelo_menu');
		}

	}

	public function resjson($data){
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function menu(){
		$idRole = $this->segsis->idRole();
		$idUsuario  = $this->segsis->idUsuario();
		$menu = "";

		$reg_ap = $this->modelo_menu->aplicacion($idRole, $idUsuario);
		$reg_me = $this->modelo_menu->menu($idRole, $idUsuario);

		$uri = uri_string();

		foreach ( $reg_ap as $row_ap ) {
			$menu .= "<ul class='nav nav-sidebar'>";
			foreach ( $reg_me as $row_me ) {
				if( strcmp($row_me['idAplicacion'], $row_ap['idAplicacion']) == 0 ){
					if(strcmp($uri, $row_me['Pagina']) == 0)
						$menu .= "<li class='active'><a href='".site_url($row_me['Pagina'])."'><span class='glyphicon glyphicon-".$row_me['Icono']."'>&nbsp;</span>".$row_me['Menu']."</a></li>";
					else
						$menu .= "<li><a href='".site_url($row_me['Pagina'])."'><span class='glyphicon glyphicon-".$row_me['Icono']."'>&nbsp;</span>".$row_me['Menu']."</a></li>";
				}
			}
			$menu .= "</ul>";
		}

		return $menu;

	}
}


 ?>