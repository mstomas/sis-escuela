<?php 

/**
* Controlador para asistencia
*/
class Asistencia extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_asistencia', 'modelo_alumno', 'modelo_asistenciadetalle'));
	}

	public function index(){

		$fecha_hoy = date("Y-m-d");

		$asistencia_hoy = $this->modelo_asistencia->obtenerAsistenciaHoy($fecha_hoy);
		$codigo_asistencia = 0;
		$descripcion_asistencia = "";
		if(count($asistencia_hoy) == 0){
			$asistencia_insert = $this->modelo_asistencia->insertarAsistencia($fecha_hoy);
			$codigo_asistencia = $asistencia_insert->id;
			$descripcion_asistencia = $asistencia_insert->descripcion;
		}else{
			$codigo_asistencia = $asistencia_hoy->codigo;
			$descripcion_asistencia = $asistencia_hoy->descripcion;
		}

		$data['contenido'] = 'v_asistencia';
		$data['titulo'] = 'Sistema Escuela | Asistencia';
		$data['menu'] = $this->menu();
		$data['descripcion_asistencia'] = $descripcion_asistencia;
		$data['codigo_asistencia'] = $codigo_asistencia;
		$this->load->view('v_plantilla', $data);

	}

	public function marcarEntrada(){
		
		$codigo_alumno = $this->input->post("codigo_alumno");
		$codigo_asistencia = $this->input->post("codigo_asistencia");
		$fecha_hora = date("Y-m-d H:m:s");
		$alumno = $this->modelo_alumno->obtenerRegistro($codigo_alumno);

		$respuesta = "";

		if(count($alumno) > 0){
			$asistenca_detalle = $this->modelo_asistenciadetalle->obtenerHoraEntrada($codigo_alumno, $codigo_asistencia);
			if(count($asistenca_detalle) == 0){
				$this->modelo_asistenciadetalle->insertarDetalleAsistencia($codigo_alumno, $codigo_asistencia, $fecha_hora);
				$respuesta = "Asistencia marcada para el alumno " . $alumno->nombre . ", hora de entrada: " . $fecha_hora;
			}else{
				$respuesta = "El alumno " . $alumno->nombre . " ya marco su hora de entrada";
			}
		}else{
			$respuesta = "Alumno no encontrado, intentelo de nuevo";
		}

		echo $respuesta;
	}

	
}

 ?>