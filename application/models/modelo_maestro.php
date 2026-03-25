<?php 

class Modelo_maestro extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT * FROM docente";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($cod_docente)
	{
		$sql = "SELECT * FROM docente WHERE cod_docente = ".$this->db->escape($cod_docente);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($nombre, $telefono, $email)
	{
		$sql = "INSERT INTO docente(nombre, telefono, email) VALUE ( ".$this->db->escape($nombre).", ".$this->db->escape($telefono).", ".$this->db->escape($email).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($cod_docente, $nombre, $telefono, $email)
	{
		$sql = "UPDATE docente SET Nombre = ".$this->db->escape($nombre).",
				telefono = ".$this->db->escape($telefono).",
				email = ".$this->db->escape($email)."
				WHERE cod_docente = ".$this->db->escape($cod_docente);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($cod_docente)
	{
		$sql = "DELETE FROM docente WHERE cod_docente = ".$this->db->escape($cod_docente);

		$this->db->query($sql);
	}

}

 ?>