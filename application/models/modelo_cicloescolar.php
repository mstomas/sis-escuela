<?php 

class Modelo_cicloescolar extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT * FROM ciclo_escolar";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($cod_ciclo_escolar)
	{
		$sql = "SELECT * FROM ciclo_escolar WHERE cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($descripcion, $anio)
	{
		$sql = "INSERT INTO ciclo_escolar(descripcion, anio) VALUE ( ".$this->db->escape($descripcion).", ".$this->db->escape($anio).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($cod_ciclo_escolar, $descripcion, $anio)
	{
		$sql = "UPDATE ciclo_escolar SET descripcion = ".$this->db->escape($descripcion).",
				anio = ".$this->db->escape($anio)."
				WHERE cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($cod_ciclo_escolar)
	{
		$sql = "DELETE FROM ciclo_escolar WHERE cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar);

		$this->db->query($sql);
	}

}

 ?>