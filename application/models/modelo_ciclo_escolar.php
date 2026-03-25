<?php 
/**
* Modelo para la tabla ciclo escolar
*/
class Modelo_ciclo_escolar extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros(){
		$sql = "SELECT * FROM ciclo_escolar";
		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function obtenerRegistro($anio){
		$sql = "SELECT * FROM ciclo_escolar
				WHERE anio = ".$this->db->escape($anio);
		$res = $this->db->query($sql);

		return $res->result_array();
	}
}

 ?>