<?php 

/**
* Controlador para el reporte de Alumnos filtrados por cursos
*/
class Alumnocursos extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('modelo_notas', 'modelo_ciclo_escolar', 'modelo_alumnocursos'));
		$this->load->library(array('table','html2pdf', 'phpexcel', 'PHPExcel/IOFactory'));
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
								<th>Generar Reporte</th>
							</tr>
						</thead>
						<tbody>";

			foreach ($cursos as $row) 
			{
				$tabla .= "<tr>
							<td>".$row['curso']."</td>
							<td>".$row['grado']."</td>
							<td>".$row['seccion']."</td>
							<td>
								<a href='".site_url('alumnocursos/generarPDF/'.$row['cod_grado'].'/'.$row['cod_curso'])."' target='_blank' class='btn btn-danger'>PDF</a>
								<a href='".site_url('alumnocursos/generarExcel/'.$row['cod_grado'].'/'.$row['cod_curso'])."' class='btn btn-success'>Excel</a>
							</td>
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
								<th>Generar Reporte</th>
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
							<td>
								<a href='".site_url('alumnocursos/generarPDF/'.$row['cod_grado'].'/'.$row['cod_curso'])."' target='_blank' class='btn btn-danger'>PDF</a>
								<a href='".site_url('alumnocursos/generarExcel/'.$row['cod_grado'].'/'.$row['cod_curso'])."' class='btn btn-success'>Excel</a>
							</td>
							</tr>";
			}	

			$tabla .= "</tbody>
					   </table>";
		}

		$data['titulo'] = "Sistema Escuela | Reporte de Alumnos por Cursos";
		$data['contenido'] = "v_alumnocursos";
		$data['menu'] = $this->menu();
		$data['tabla'] = $tabla;
		$this->load->view('v_plantilla', $data);
	}

	public function generarExcel($cod_grado, $cod_curso){

		$docente_curso = $this->modelo_alumnocursos->docenteCurso($cod_grado, $cod_curso);

		$anio = $this->segsis->cicloEscolar();
		$ciclo_escolar = $this->modelo_ciclo_escolar->obtenerRegistro($anio);
		foreach ($ciclo_escolar as $row) {
			$cod_ciclo_escolar = $row['cod_ciclo_escolar'];
		}

		$alumnos = $this->modelo_alumnocursos->alumnoPorCursos($cod_grado, $cod_curso, $cod_ciclo_escolar);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Sistema")
									 ->setLastModifiedBy("Sistema")
									 ->setTitle("Alumnos por Cursos")
									 ->setSubject("Alumnos por Cursos")
									 ->setDescription("Alumnos filtrados por cursos, con promedios")
									 ->setKeyWords("alumnos cursos docentes promedio")
									 ->setCategory("alumnos");

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1','Curso');
		$objPHPExcel->getActiveSheet()->setCellValue('A2','Docente');
		$objPHPExcel->getActiveSheet()->setCellValue('A3','Grado');
		$objPHPExcel->getActiveSheet()->setCellValue('A4','Sección');

		$objPHPExcel->getActiveSheet()->setCellValue('B1', $docente_curso->curso);
		$objPHPExcel->getActiveSheet()->setCellValue('B2', $docente_curso->docente);
		$objPHPExcel->getActiveSheet()->setCellValue('B3', $docente_curso->grado);
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $docente_curso->seccion);

		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Clave');
		$objPHPExcel->getActiveSheet()->setCellValue('B6', 'Alumno');
		$objPHPExcel->getActiveSheet()->setCellValue('C6', 'Bimestre 1');
		$objPHPExcel->getActiveSheet()->setCellValue('D6', 'Bimestre 2');
		$objPHPExcel->getActiveSheet()->setCellValue('E6', 'Bimestre 3');
		$objPHPExcel->getActiveSheet()->setCellValue('F6', 'Bimestre 4');
		$objPHPExcel->getActiveSheet()->setCellValue('G6', 'Promedio');

		$cont = 7;
		foreach ($alumnos as $row) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$cont, $row['clave']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$cont, $row['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$cont, $row['bimestre_1']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$cont, $row['bimestre_2']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$cont, $row['bimestre_3']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$cont, $row['bimestre_4']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$cont, $row['promedio']);
			$cont++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		$objPHPExcel->setActiveSheetIndex(0);

		$nombre_archivo = $docente_curso->curso." ".$docente_curso->grado."_".$docente_curso->seccion;
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$nombre_archivo.'.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
		header ('Cache-Control: cache, must-revalidate'); 
		header ('Pragma: public');
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

	public function generarPDF($cod_grado, $cod_curso){

		$anio = $this->segsis->cicloEscolar();
		$ciclo_escolar = $this->modelo_ciclo_escolar->obtenerRegistro($anio);
		foreach ($ciclo_escolar as $row) {
			$cod_ciclo_escolar = $row['cod_ciclo_escolar'];
		}

		$alumnos = $this->modelo_alumnocursos->alumnoPorCursos($cod_grado, $cod_curso, $cod_ciclo_escolar);

		$this->table->set_heading('Clave','Alumno', 'Bimestre 1', 'Bimestre 2', 'Bimestre 3', 'Bimestre 4', 'Promedio');

		foreach ($alumnos as $row) {
			$this->table->add_row($row['clave'], $row['nombre'], $row['bimestre_1'], $row['bimestre_2'], $row['bimestre_3'], $row['bimestre_4'], $row['promedio']);
		}

		$data['tabla_alumnos'] = $this->table->generate();
		
		$docente_curso = $this->modelo_alumnocursos->docenteCurso($cod_grado, $cod_curso);
		$this->table->clear();
		$this->table->add_row('Curso: ', $docente_curso->curso);
		$this->table->add_row('Docente: ', $docente_curso->docente);
		$this->table->add_row('Grado: ', $docente_curso->grado);
		$this->table->add_row('Sección: ', $docente_curso->seccion);
		$data['tabla_docente'] = $this->table->generate();


		$this->crearFolder();
		$this->html2pdf->folder('./files/pdfs/');
		$this->html2pdf->filename('alumnocursos.pdf');
		$this->html2pdf->paper('a4','portrait');

		$this->html2pdf->html(utf8_decode($this->load->view('r_alumnocursos_pdf',$data, true)));

		if($this->html2pdf->create('save'))
			$this->show();

	}

	private function crearFolder()
	{
		if(!is_dir("./files"))
		{
			mkdir("./files", 0777);
			mkdir("./files/pdfs", 0777);
		}
	}

	private function show()
	{
		if(is_dir("./files/pdfs"))
		{
			$filename = "alumnocursos.pdf";
			$route = base_url("files/pdfs/alumnocursos.pdf");
			if(file_exists("./files/pdfs/".$filename))
			{
				header('Content-type: application/pdf');
				readfile($route);
			}
		}
	}

}


 ?>