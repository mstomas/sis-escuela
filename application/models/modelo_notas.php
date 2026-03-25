<?php 
/**
* Modelo para el controlador Notas
*/
class modelo_notas extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function consultarDocente($cod_docente){
		$sql = "SELECT nombre FROM docente WHERE cod_docente = ".$this->db->escape($cod_docente);
		$res = $this->db->query($sql);
		return $res->row();
	}

	public function consultarCursosDocente($cod_docente){
		$sql = "SELECT b.nombre as docente, c.nombre as curso, d.grado, d.seccion, a.cod_grado, a.cod_curso
				FROM docente_cursos as a, docente as b, curso as c, grado_seccion as d
				WHERE a.cod_docente = b.cod_docente
				AND a.cod_curso = c.cod_curso
				AND a.cod_grado = d.cod_grado
				AND a.cod_docente = ".$cod_docente;
		$res = $this->db->query($sql);
		return $res->result_array();
	}

	public function consultarAlumnosGrado($cod_grado, $cod_curso, $cod_ciclo_escolar){
		$sql = "SELECT a.cod_alumno, a.nombre, a.clave, b.bimestre_1, b.bimestre_2, b.bimestre_3, b.bimestre_4,
				ROUND((b.bimestre_1 + b.bimestre_2 + b.bimestre_3 + b.bimestre_4) / 4) as promedio
				FROM alumno as a , notas_alumno b
				WHERE a.cod_alumno= b.cod_alumno
				AND  a.cod_grado = ".$this->db->escape($cod_grado)."
				AND b.cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar)."
				AND b.cod_curso = ".$this->db->escape($cod_curso)."
				ORDER BY a.clave";
		$res = $this->db->query($sql);
		return $res;
	}

	public function insertarAlumnosGrado($cod_grado, $cod_curso, $cod_ciclo_escolar){
		$sql = "INSERT INTO notas_alumno
				SELECT null, cod_alumno, ".$this->db->escape($cod_curso).", ".$this->db->escape($cod_ciclo_escolar).", 0, 0, 0, 0
				FROM alumno
				WHERE cod_grado = ".$this->db->escape($cod_grado);
		$this->db->query($sql);
	}

	public function actualizarNotasAlumno($cod_alumno, $cod_curso, $cod_ciclo_escolar, $bimestre_1, $bimestre_2, $bimestre_3, $bimestre_4){
		$sql = "UPDATE notas_alumno
				SET bimestre_1 = ".$this->db->escape($bimestre_1).",
				bimestre_2 = ".$this->db->escape($bimestre_2).",
				bimestre_3 = ".$this->db->escape($bimestre_3).",
				bimestre_4 = ".$this->db->escape($bimestre_4)."
				WHERE cod_alumno = ".$this->db->escape($cod_alumno)."
				AND cod_curso = ".$this->db->escape($cod_curso)."
				AND cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar);
		$this->db->query($sql);
	}

}


 ?>