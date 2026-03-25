<?php 

/**
* Modelo detalle asistencia
*/
class Modelo_asistenciadetalle extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerHoraEntrada($codigo_alumno, $codigo_asistencia){
		$sql = "SELECT * FROM asistencia_detalle WHERE codigo_alumno = $codigo_alumno AND codigo_asistencia = $codigo_asistencia";
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarDetalleAsistencia($codigo_alumno, $codigo_asistencia, $hora_entrada){
		$sql = "INSERT INTO asistencia_detalle(codigo_asistencia, codigo_alumno, hora_entrada, hora_salida, descripcion_inasistencia) VALUES($codigo_asistencia, $codigo_alumno, '$hora_entrada', NULL, '')";
		$query = $this->db->query($sql);

		return $this->db->insert_id();
	}

	public function updateHoraSalida($codigo_alumno, $codigo_asistencia, $hora_salida){
		$sql = "UPDATE asistencia_detalle SET hora_salida = '$hora_salida' WHERE codigo_alumno = $codigo_alumno AND codigo_asistencia = $codigo_asistencia";
		$query = $this->db->query($sql);
	}

	public function obtenerAsistencia($codigo_asistencia, $codigo_alumno){
		$sql = "SELECT a.codigo, b.cod_alumno, b.nombre, DATE_FORMAT(a.hora_entrada,'%H:%i:%s') hora_entrada, DATE_FORMAT(a.hora_salida,'%H:%i:%s') hora_salida FROM asistencia_detalle a INNER JOIN alumno b ON a.codigo_alumno = b.cod_alumno WHERE a.codigo_asistencia = $codigo_asistencia AND a.codigo_alumno = $codigo_alumno";
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function obtenerAsistenciaPorCodigo($codigo_asistencia){
		$sql = "SELECT codigo_alumno, DATE_FORMAT(hora_entrada, '%H:%i:%s') hora_entrada, DATE_FORMAT(hora_salida,'%H:%i:%s') hora_salida FROM asistencia_detalle WHERE codigo_asistencia = $codigo_asistencia";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerPuntuales($mes){
		$sql = "SELECT COUNT(*) cantidad, DATE_FORMAT(hora_entrada, '%Y/%m/%d') fecha 
				FROM asistencia_detalle 
				WHERE DATE_FORMAT(hora_entrada, '%H:%i:%s') <= '08:00'
				AND EXTRACT(MONTH FROM hora_entrada)  = $mes
				GROUP by fecha";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerInpuntuales($mes){
		$sql = "SELECT COUNT(*) cantidad, DATE_FORMAT(hora_entrada, '%Y/%m/%d') fecha 
				FROM asistencia_detalle 
				WHERE DATE_FORMAT(hora_entrada, '%H:%i:%s') > '08:00'
				AND EXTRACT(MONTH FROM hora_entrada)  = $mes
				GROUP by fecha";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerPorcentajePuntualidad($codigo_alumno, $mes){

		$sql = "SELECT COUNT(*) total
						FROM asistencia_detalle
						WHERE codigo_alumno = $codigo_alumno
						AND EXTRACT(MONTH FROM hora_entrada) = $mes";
		$asistencia = $this->db->query($sql)->row();

		$sql_puntual = "SELECT COUNT(*) cantidad
						FROM asistencia_detalle
						WHERE codigo_alumno = $codigo_alumno
						AND EXTRACT(MONTH FROM hora_entrada) = $mes
						AND DATE_FORMAT(hora_entrada,'%H:%i') < '08:00'";
		$puntual = $this->db->query($sql_puntual)->row();

		$sql_impuntual = "SELECT COUNT(*) cantidad
						FROM asistencia_detalle
						WHERE codigo_alumno = $codigo_alumno
						AND EXTRACT(MONTH FROM hora_entrada) = $mes
						AND DATE_FORMAT(hora_entrada,'%H:%i') >= '08:00'";
		$impuntual = $this->db->query($sql_impuntual)->row();

		$porcentaje_puntual = ((intval($puntual->cantidad) / intval($asistencia->total)) * 100);
		$porcentaje_impuntual = ((intval($impuntual->cantidad) / intval($asistencia->total)) * 100);

		$retorno->total_asistencias = $asistencia->total;
		$retorno->puntual = number_format((float)$porcentaje_puntual, 2);
		$retorno->impuntual = number_format((float)$porcentaje_impuntual, 2);

		return $retorno;

	}

	public function obtenerCantidadAsistencias($codigo_alumno, $mes){
		$sql = "SELECT COUNT(*) total FROM asistencia_detalle WHERE codigo_alumno = $codigo_alumno AND EXTRACT(MONTH FROM hora_entrada) = $mes";
		$query = $this->db->query($sql);

		return $query->row();
	}
}

 ?>