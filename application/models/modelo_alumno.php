<?php 

class Modelo_alumno extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT a.cod_alumno, a.nombre, a.direccion, a.cod_grado, a.cod_ciclo_escolar, a.clave,
				b.grado, b.seccion, c.descripcion, a.codigo_tarjeta
				FROM alumno a, grado_seccion b, ciclo_escolar c
				WHERE a.cod_grado = b.cod_grado
				AND a.cod_ciclo_escolar = c.cod_ciclo_escolar
				ORDER BY b.grado, b.seccion, a.clave";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($cod_alumno)
	{
		$sql = "SELECT a.cod_alumno, a.nombre, a.direccion, a.cod_grado, a.cod_ciclo_escolar, a.clave,
				b.grado, b.seccion, c.descripcion, a.codigo_tarjeta
				FROM alumno a, grado_seccion b, ciclo_escolar c
				WHERE a.cod_grado = b.cod_grado
				AND a.cod_ciclo_escolar = c.cod_ciclo_escolar
				AND a.cod_alumno = ".$this->db->escape($cod_alumno)."
				ORDER BY b.grado, b.seccion, a.clave";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function obtenerRegistroPorTarjeta($codigo_tarjeta){
		$sql = "SELECT a.cod_alumno, a.nombre, a.direccion, a.cod_grado, a.cod_ciclo_escolar, a.clave,
				b.grado, b.seccion, c.descripcion, a.codigo_tarjeta
				FROM alumno a, grado_seccion b, ciclo_escolar c
				WHERE a.cod_grado = b.cod_grado
				AND a.cod_ciclo_escolar = c.cod_ciclo_escolar
				AND a.codigo_tarjeta = ".$this->db->escape($codigo_tarjeta)."
				ORDER BY b.grado, b.seccion, a.clave";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($clave, $nombre, $direccion, $cod_grado, $cod_ciclo_escolar, $codigo_tarjeta)
	{
		$sql = "INSERT INTO alumno(clave, nombre, direccion, cod_grado, cod_ciclo_escolar, codigo_tarjeta) VALUE ( ".$this->db->escape($clave).",".$this->db->escape($nombre)." ,".$this->db->escape($direccion).", ".$this->db->escape($cod_grado).",".$this->db->escape($cod_ciclo_escolar).", ".$this->db->escape($codigo_tarjeta).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($cod_alumno, $clave, $nombre, $direccion, $cod_grado, $cod_ciclo_escolar)
	{
		$sql = "UPDATE alumno 
				SET clave = ".$this->db->escape($clave).",
				nombre = ".$this->db->escape($nombre).",
				direccion = ".$this->db->escape($direccion).",
				cod_grado = ".$this->db->escape($cod_grado).",
				cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar)."
				WHERE cod_alumno = ".$this->db->escape($cod_alumno);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($cod_alumno)
	{
		$sql = "DELETE FROM alumno WHERE cod_alumno = ".$this->db->escape($cod_alumno);

		$this->db->query($sql);
	}

}

 ?>