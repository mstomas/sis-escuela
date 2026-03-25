<?php 

/**
* Seguridad del sistema
*
* Clase para la seguridad del sistema, control de autenticación
* de usuario, permisos que tendrá en la apliación, etc.
*
* @author Marcos Tomás <mst_samuel90@hotmail.com>
* @version 1
* @since 02-10-2014
*/
class Segsis
{

	var $CI;

	var $_id_usuario = 0;
	var $_nom_usuario = "";
	var $_rol_usuario = "";
	var $_autenticado = false;
	var $_ciclo_escolar = 0;
	var $_cod_docente = 0;

	public function __construct($auto = true)
	{
		$this->CI =& get_instance();

		if($auto){
			if($this->iniciarSesion($this->CI->session->userdata('nom_usuario'), $this->CI->session->userdata('clave_usuario'))){
				$this->_id_usuario = $this->CI->session->userdata('id_usuario');
				$this->_nom_usuario = $this->CI->session->userdata('nom_usuario');
				$this->_rol_usuario = $this->CI->session->userdata('rol_usuario');
				$this->_autenticado = $this->CI->session->userdata('autenticado');
				$this->_ciclo_escolar = $this->CI->session->userdata('ciclo_escolar');
				$this->_cod_docente = $this->CI->session->userdata('cod_docente');
			}
		}
	}

	public function iniciarSesion($usuario = "", $clave = ""){

		if(empty($usuario) && empty($clave))
			return false;

		$sql = "SELECT * FROM usuario WHERE nombre = ".$this->CI->db->escape($usuario)." and password = ".$this->CI->db->escape($clave);
		
		$query = $this->CI->db->query($sql);

		if($query->num_rows() == 1){
			$row = $query->row();

			$this->_id_usuario = $row->idUsuario;
			$this->_nom_usuario = $row->Nombre;
			$this->_rol_usuario = $row->idRole;
			$this->_cod_docente = $row->cod_docente;
			$this->_autenticado = true;

			$credenciales = array(
				'id_usuario' => $this->_id_usuario,
				'nom_usuario' => $this->_nom_usuario,
				'rol_usuario' => $this->_rol_usuario,
				'autenticado' => $this->_autenticado,
				'cod_docente' => $this->_cod_docente
				);

			$this->CI->session->set_userdata($credenciales);

			return true;

		}else{
			$this->_autenticado = false;
			$this->cerrarSesion();

			return false;
		}

	}

	public function cerrarSesion(){
		$this->CI->session->destroy();
		$this->_autenticado = false;
	}

	public function sesionIniciada(){

		if($this->CI->session){
			if($this->CI->session->userdata('autenticado')){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}

	public function idUsuario(){
		return $this->_id_usuario;
	}

	public function idRole(){
		return $this->_rol_usuario;
	}

	public function cod_docente(){
		return $this->_cod_docente;
	}

	public function setCicloEscolar($anio){
		$this->CI->session->set_userdata('ciclo_escolar', $anio);
		$this->_ciclo_escolar = $anio;
	}

	public function cicloEscolar(){
		return $this->_ciclo_escolar;
	}
}

 ?>