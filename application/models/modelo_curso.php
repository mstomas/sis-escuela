<?php 

class Modelo_curso extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT a.cod_curso, a.nombre, a.cod_ciclo, b.nombre ciclo
				FROM curso a, ciclo b
				WHERE a.cod_ciclo = b.cod_ciclo";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($cod_curso)
	{
		$sql = "SELECT a.cod_curso, a.nombre, a.cod_ciclo, b.nombre ciclo
				FROM curso a, ciclo b
				WHERE a.cod_ciclo = b.cod_ciclo
				AND a.cod_curso = ".$this->db->escape($cod_curso);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($nombre, $cod_ciclo)
	{
		$sql = "INSERT INTO curso(nombre, cod_ciclo) VALUE ( ".$this->db->escape($nombre).", ".$this->db->escape($cod_ciclo).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($cod_curso, $nombre, $cod_ciclo)
	{
		$sql = "UPDATE curso SET Nombre = ".$this->db->escape($nombre).",
				cod_ciclo = ".$this->db->escape($cod_ciclo)."
				WHERE cod_curso = ".$this->db->escape($cod_curso);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($cod_curso)
	{
		$sql = "DELETE FROM curso WHERE cod_curso = ".$this->db->escape($cod_curso);

		$this->db->query($sql);
	}

}

 ?>