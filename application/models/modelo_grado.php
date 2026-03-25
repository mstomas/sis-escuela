<?php 

class Modelo_grado extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT a.cod_grado, a.grado, a.seccion, a.cod_ciclo, b.nombre ciclo
				FROM grado_seccion a, ciclo b
				WHERE a.cod_ciclo = b.cod_ciclo";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($cod_grado)
	{
		$sql = "SELECT a.cod_grado, a.grado, a.seccion, a.cod_ciclo, b.nombre ciclo
				FROM grado_seccion a, ciclo b
				WHERE a.cod_ciclo = b.cod_ciclo
				AND a.cod_grado = ".$this->db->escape($cod_grado);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($grado, $seccion, $cod_ciclo)
	{
		$sql = "INSERT INTO grado_seccion(grado, seccion, cod_ciclo) VALUE ( ".$this->db->escape($grado).",".$this->db->escape($seccion)." ,".$this->db->escape($cod_ciclo).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($cod_grado, $grado, $seccion, $cod_ciclo)
	{
		$sql = "UPDATE grado_seccion SET grado = ".$this->db->escape($grado).",
				seccion = ".$this->db->escape($seccion).",
				cod_ciclo = ".$this->db->escape($cod_ciclo)."
				WHERE cod_grado = ".$this->db->escape($cod_grado);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($cod_grado)
	{
		$sql = "DELETE FROM grado_seccion WHERE cod_grado = ".$this->db->escape($cod_grado);

		$this->db->query($sql);
	}

}

 ?>