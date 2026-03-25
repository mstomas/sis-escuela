<?php 

class Modelo_docentecursos extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros()
	{
		$sql = "SELECT a.codigo, a.cod_docente, a.cod_grado, a.cod_curso,
				b.nombre docente, c.grado, c.seccion, d.nombre curso
				FROM docente_cursos a, docente b, grado_seccion c, curso d
				WHERE a.cod_docente = b.cod_docente
				AND a.cod_grado = c.cod_grado
				AND a.cod_curso = d.cod_curso";

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerRegistro($codigo)
	{
		$sql = "SELECT a.codigo, a.cod_docente, a.cod_grado, a.cod_curso,
				b.nombre docente, c.grado, c.seccion, d.nombre curso
				FROM docente_cursos a, docente b, grado_seccion c, curso d
				WHERE a.cod_docente = b.cod_docente
				AND a.cod_grado = c.cod_grado
				AND a.cod_curso = d.cod_curso
				AND a.codigo = ".$this->db->escape($codigo);

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarRegistro($cod_docente, $cod_grado, $cod_curso)
	{
		$sql = "INSERT INTO docente_cursos(cod_docente, cod_grado, cod_curso) VALUE ( ".$this->db->escape($cod_docente).",".$this->db->escape($cod_grado)." ,".$this->db->escape($cod_curso).");";

		$query = $this->db->query($sql);
	}

	public function actualizarRegistro($codigo, $cod_docente, $cod_grado, $cod_curso)
	{
		$sql = "UPDATE docente_cursos 
				SET cod_docente = ".$this->db->escape($cod_docente).",
				cod_grado = ".$this->db->escape($cod_grado).",
				cod_curso = ".$this->db->escape($cod_curso)."
				WHERE codigo = ".$this->db->escape($codigo);

		$query = $this->db->query($sql);
	}

	public function eliminarRegistro($codigo)
	{
		$sql = "DELETE FROM docente_cursos WHERE codigo = ".$this->db->escape($codigo);

		$this->db->query($sql);
	}

}

 ?>