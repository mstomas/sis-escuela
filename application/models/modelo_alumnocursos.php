<?php 
/**
* Modelo para el controlador de reportes Alumno por cursos
*/
class Modelo_alumnocursos extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function alumnoPorCursos($cod_grado, $cod_curso, $cod_ciclo_escolar){
		$sql = "SELECT b.clave, b.nombre, a.bimestre_1, a.bimestre_2, a.bimestre_3, a.bimestre_4,
				ROUND((a.bimestre_1+a.bimestre_2+a.bimestre_3+a.bimestre_4) / 4) as promedio
				FROM notas_alumno a, alumno b
				WHERE a.cod_alumno = b.cod_alumno
				AND a.cod_curso = ".$this->db->escape($cod_curso)."
				AND a.cod_ciclo_escolar = ".$this->db->escape($cod_ciclo_escolar)."
				AND b.cod_grado = ".$this->db->escape($cod_grado)."
				ORDER BY b.clave";
		$result = $this->db->query($sql);

		return $result->result_array();
	}

	public function docenteCurso($cod_grado, $cod_curso){
		$sql = "SELECT b.nombre curso, c.nombre docente, d.grado, d.seccion
				FROM docente_cursos a, curso b, docente c, grado_seccion d
				WHERE a.cod_curso = b.cod_curso
				AND a.cod_docente = c.cod_docente
				AND a.cod_grado = d.cod_grado
				AND a.cod_grado = ".$this->db->escape($cod_grado)."
				AND a.cod_curso = ".$this->db->escape($cod_curso);
		$result = $this->db->query($sql);

		return $result->row();
	}
}

 ?>