<?php 
/**
* Controlador para las notas
*/
class Notas extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_notas', 'modelo_ciclo_escolar'));
	}

	public function index(){

		$cod_docente = $this->segsis->cod_docente();
		if($cod_docente != 0)
		{
			$res = $this->modelo_notas->consultarDocente($cod_docente);
			$nombre_catedratico = $res->nombre;

			$cursos = $this->modelo_notas->consultarCursosDocente($cod_docente);

			$tabla = "";
			$tabla .= "<table class='table'>
						<thead>
							<tr>
								<th>Curso</th>
								<th>Grado</th>
								<th>Sección</th>
								<th></th>
							</tr>
						</thead>
						<tbody>";

			foreach ($cursos as $row) 
			{
				$tabla .= "<tr>
							<td>".$row['curso']."</td>
							<td>".$row['grado']."</td>
							<td>".$row['seccion']."</td>
							<td><a href='".site_url('notas/ingresar/'.$row['cod_grado'].'/'.$row['cod_curso'])."' class='btn btn-success'>Ingresar Notas</a></td>
							</tr>";
			}	

			$tabla .= "</tbody>
					   </table>";

		}else{
			$nombre_catedratico = "";
			$cursos = $this->modelo_notas->consultarCursosDocente("a.cod_docente");
			$tabla = "";
			$tabla .= "<table class='table'>
						<thead>
							<tr>
								<th>Docente</th>
								<th>Curso</th>
								<th>Grado</th>
								<th>Sección</th>
								<th></th>
							</tr>
						</thead>
						<tbody>";

			foreach ($cursos as $row) 
			{
				$tabla .= "<tr>
							<td>".$row['docente']."</td>
							<td>".$row['curso']."</td>
							<td>".$row['grado']."</td>
							<td>".$row['seccion']."</td>
							<td><a href='".site_url('notas/ingresar/'.$row['cod_grado'].'/'.$row['cod_curso'])."' class='btn btn-success'>Ingresar Notas</a></td>
							</tr>";
			}	

			$tabla .= "</tbody>
					   </table>";
		}

		$data['menu'] = $this->menu();
		$data['titulo'] = "Sistema Escuela | Ingreso de Notas";
		$data['contenido'] = "v_notas";
		$data['nombre_catedratico'] = $nombre_catedratico;
		$data['tabla'] = $tabla;
		$this->load->view('v_plantilla', $data);

		
	}

	public function ingresar($cod_grado, $cod_curso){

		$anio = $this->segsis->cicloEscolar();
		$ciclo_escolar = $this->modelo_ciclo_escolar->obtenerRegistro($anio);
		foreach ($ciclo_escolar as $row) {
			$cod_ciclo_escolar = $row['cod_ciclo_escolar'];
		}

		$alumnos = $this->modelo_notas->consultarAlumnosGrado($cod_grado, $cod_curso, $cod_ciclo_escolar);

		if($alumnos->num_rows() == 0){
			$this->modelo_notas->insertarAlumnosGrado($cod_grado, $cod_curso, $cod_ciclo_escolar);
		}
		
		$alumnos = $this->modelo_notas->consultarAlumnosGrado($cod_grado, $cod_curso, $cod_ciclo_escolar);
		$alumnos = $alumnos->result_array();
		$tabla = "";
		$tabla .= "<table class='table'>
					<thead>
						<tr>
							<th>Clave</th>
							<th>Nombre</th>
							<th>Bimestre 1</th>
							<th>Bimestre 2</th>
							<th>Bimestre 3</th>
							<th>Bimestre 4</th>
							<th>Promedio</th>
						</tr>
					</thead>
					<tbody>";

		foreach ($alumnos as $row) 
		{
			$tabla .= "<tr>
						<td>".$row['clave']."</td>
						<td>".$row['nombre']."</td>
						<td><input type='text' name='b1_".$row['cod_alumno']."_".$cod_curso."_".$cod_ciclo_escolar."' id='b1_".$row['clave']."' class='form-control' value='".$row['bimestre_1']."' onkeyup='calcular(this); return false' ></td>
						<td><input type='text' name='b2_".$row['cod_alumno']."_".$cod_curso."_".$cod_ciclo_escolar."' id='b2_".$row['clave']."' class='form-control' value='".$row['bimestre_2']."' onkeyup='calcular(this); return false'></td>
						<td><input type='text' name='b3_".$row['cod_alumno']."_".$cod_curso."_".$cod_ciclo_escolar."' id='b3_".$row['clave']."' class='form-control' value='".$row['bimestre_2']."' onkeyup='calcular(this); return false'></td>
						<td><input type='text' name='b4_".$row['cod_alumno']."_".$cod_curso."_".$cod_ciclo_escolar."' id='b4_".$row['clave']."' class='form-control' value='".$row['bimestre_2']."' onkeyup='calcular(this); return false'></td>
						<td><div id='prom_".$row['clave']."'>".$row['promedio']."</div></td>
						</tr>";
		}	

		$tabla .= "</tbody>
				   </table>";

		$data['tabla'] = $tabla;
		$data['titulo'] = "Sistema Escuela | Ingresar Notas";
		$data['contenido'] = "v_ingresar_notas";
		$data['menu'] = $this->menu();
		$this->load->view('v_plantilla', $data);
	}

	public function guardar(){
		$cod_alumno = $this->input->post("cod_alumno");
		$cod_curso = $this->input->post("cod_curso");
		$cod_ciclo_escolar = $this->input->post("cod_ciclo_escolar");
		$bimestre_1 = $this->input->post("bimestre_1");
		$bimestre_2 = $this->input->post("bimestre_2");
		$bimestre_3 = $this->input->post("bimestre_3");
		$bimestre_4 = $this->input->post("bimestre_4");

		$this->modelo_notas->actualizarNotasAlumno($cod_alumno, $cod_curso, $cod_ciclo_escolar, $bimestre_1, $bimestre_2, $bimestre_3, $bimestre_4);
	}



} // Fin Clase


 ?>