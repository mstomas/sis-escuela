<?php 

class Modelo_ciclo extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT * FROM ciclo";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($cod_ciclo)
	{
		$sql = "SELECT * FROM ciclo WHERE cod_ciclo = ".$this->db->escape($cod_ciclo);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($nomCiclo)
	{
		$sql = "INSERT INTO ciclo(nombre) VALUE ( ".$this->db->escape($nomCiclo).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($cod_ciclo, $nomCiclo)
	{
		$sql = "UPDATE ciclo SET Nombre = ".$this->db->escape($nomCiclo)." WHERE cod_ciclo = ".$this->db->escape($cod_ciclo);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($cod_ciclo)
	{
		$sql = "DELETE FROM ciclo WHERE cod_ciclo = ".$this->db->escape($cod_ciclo);

		$this->db->query($sql);
	}

}

 ?>