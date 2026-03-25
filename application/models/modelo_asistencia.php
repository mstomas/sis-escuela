<?php 

/**
* Modelo para asistencia
*/
class Modelo_asistencia extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function obtenerRegistros(){
		$sql = "SELECT * FROM asistencia";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerAsistenciaHoy($fecha){
		$sql = "SELECT * FROM asistencia WHERE fecha = ".$this->db->escape($fecha);
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function obtenerAsistenciaCodigo($codigo){
		$sql = "SELECT * FROM asistencia WHERE codigo = ".$this->db->escape($codigo);
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function insertarAsistencia($fecha){
		$descripcion = "Asistencia del día " . $this->fechaDescripcion($fecha);
		$sql = "INSERT INTO asistencia(fecha, descripcion) VALUES (".$this->db->escape($fecha).", ".$this->db->escape($descripcion).")";
		$query = $this->db->query($sql);
		$asistencia->id = $this->db->insert_id();
		$asistencia->descripcion = $descripcion;
		return $asistencia;
	}

	public function obtenerAsistenciasRangoMes($mes_inicial, $mes_final){
		$sql = "SELECT * FROM asistencia WHERE EXTRACT(MONTH FROM fecha) BETWEEN $mes_inicial AND $mes_final";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function obtenerCantidadAsistenciaMes($mes){
		$sql = "SELECT COUNT(*) total FROM asistencia WHERE EXTRACT(MONTH FROM fecha) = $mes";
		$query = $this->db->query($sql);

		return $query->row();
	}

	private function fechaDescripcion($fecha){
		$anio = substr($fecha, 0, 4);
		$mes = substr($fecha, 5, 2);
		$dia = substr($fecha, 8, 2);
		$nombre_mes = "";
		$descripcion_fecha = "";
		switch ($mes) {
			case '01':
				$nombre_mes = "Enero";
				break;
			case '02':
				$nombre_mes = "Febrero";
				break;
			case '03':
				$nombre_mes = "Marzo";
				break;
			case '04':
				$nombre_mes = "Abril";
				break;
			case '05':
				$nombre_mes = "Mayo";
				break;
			case '06':
				$nombre_mes = "Junio";
				break;
			case '07':
				$nombre_mes = "Julio";
				break;
			case '08':
				$nombre_mes = "Agosto";
				break;
			case '09':
				$nombre_mes = "Septiembre";
				break;
			case '10':
				$nombre_mes = "Octubre";
				break;
			case '11':
				$nombre_mes = "Noviembre";
				break;
			case '12':
				$nombre_mes = "Diciembre";
				break;
			default:
				$nombre_mes = "No existe";
				break;
		}

		$descripcion_fecha = $dia . " de " . $nombre_mes . " " . $anio;
		return $descripcion_fecha;
	}


}

 ?>