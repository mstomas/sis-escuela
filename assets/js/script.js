function limpiaForm(miForm){
	$(':input', miForm).each(function(){
		var type = this.type;
		var tag = this.tagName.toLowerCase();
		if(type=='text' || type=='password' || tag=='textarea')
			this.value = "";
		else if(type=='checkbox' || type=='radio')
			this.checked = false;
		else if(tag=='select')
			this.selectIndex = -1;
	});
}

function sesion(form){
	var url = location.href + "/iniciar/";
	var datos = $(form).serialize();
	$.ajax({
		type: 'POST',
		url: url,
		data: datos,
		datatype: 'json',
		async: true,
		success: function(json){
			if(json.estado == 0){
				$("#mensaje").html(json.mensaje);
			}else{
				//$("#mensaje").html(json.mensaje);
				location.href = json.mensaje;
			}
		}
	})
}

function insertarRegistro(){
	var dir = location.href+"/insertar/";
	var form = $('#frm');
	var datos = form.serialize();
	$.ajax({
		type: "POST",
		url: dir,
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			limpiaForm(form);
			$('#data-grid').html("");
			$('#data-grid').html(respuesta);
		}
	});
}

function eliminarRegistro(idEl, idEl2, idEl3, idEl4){
	var dir = location.href+"/eliminar/";
	var datos = "";

	if(idEl2 != null && idEl3 == null && idEl4 == null)
		datos = "id="+idEl+"&id2="+idEl2;
	else if(idEl2 != null && idEl3 != null && idEl4 == null)
		datos = "id="+idEl+"&id2="+idEl2+"&id3="+idEl3;
	else if(idEl2 != null && idEl3 != null && idEl4 != null)
		datos = "id="+idEl+"&id2="+idEl2+"&id3="+idEl3+"&id4="+idEl4;
	else
		datos = "id="+idEl;
	
	$.ajax({
		type: "POST",
		url: dir,
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			$('#data-grid').html("");
			$('#data-grid').html(respuesta);
		}
	});
}

function formActualiza(idAct, idAct2, idAct3, idAct4){
	var dir = location.href+"/consulta_por_id/";
	var datos = "";

	if(idAct2 != null && idAct3 == null && idAct4 == null)
	 	datos = "id="+idAct+"&id2="+idAct2;
	else if(idAct2 != null && idAct3 != null && idAct4 == null)
		datos = "id="+idAct+"&id2="+idAct2+"&id3="+idAct3;
	else if(idAct2 != null && idAct3 != null && idAct4 != null)
		datos = "id="+idAct+"&id2="+idAct2+"&id3="+idAct3+"&id4="+idAct4;
	else
		datos = "id="+idAct;

	$.ajax({
		type: "POST",
		url: dir,
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			$('#form').html(respuesta);
		}
	});
}

function modificaRegistro(formulario){
	var dir = location.href+"/actualizar/";
	var form = $(formulario);
	var datos = form.serialize();
	$.ajax({
		type: "POST",
		url: dir,
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			limpiaForm(form);
			$('#data-grid').html(respuesta);
			location.href = location.href;
		}
	});
}

function calcular(input){
	var ident = $(input).attr("id");
	var clave = ident.substr(3,2);

	var b1 = (($("#b1_"+clave).val()) * -1 ) * -1;
	var b2 = (($("#b2_"+clave).val()) * -1 ) * -1;
	var b3 = (($("#b3_"+clave).val()) * -1 ) * -1;
	var b4 = (($("#b4_"+clave).val()) * -1 ) * -1;

	var promedio = (b1 + b2 + b3 + b4) / 4;
	$("#prom_"+clave).html(promedio.toPrecision(2));

	var nombre = $(input).attr("name");
	var valores = nombre.split("_");
	var cod_alumno = valores[1];
	var cod_curso = valores[2];
	var cod_ciclo_escolar = valores[3];
	var datos = "cod_alumno="+cod_alumno+"&cod_curso="+cod_curso+"&cod_ciclo_escolar="+cod_ciclo_escolar;
	datos += "&bimestre_1="+b1+"&bimestre_2="+b2+"&bimestre_3="+b3+"&bimestre_4="+b4;

	$.ajax({
		type: "POST",
		url: "http://localhost/sis-escuela/notas/guardar",
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			console.log("exito");
		}
	})

}

function marcarEntrada(codigo_alumno){
	var codigo_asistencia = $("#codigo_asistencia").val();
	var datos = "codigo_alumno="+codigo_alumno+"&codigo_asistencia="+codigo_asistencia;
	$.ajax({
		type: "POST",
		url: location.href + "/marcarEntrada/",
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			$(".respuesta_asistencia").html("<h4 class='bg-primary'>"+respuesta+"</h4>");
			setTimeout(function() {
				$(".respuesta_asistencia").html("");
				$("#codigo_alumno").val("");
				$("#codigo_alumno").focus();
			}, 3000);
		}
	})
}


function marcarSalida(codigo_alumno){
	var codigo_asistencia = $("#codigo_asistencia_salida").val();
	var datos = "codigo_alumno="+codigo_alumno+"&codigo_asistencia="+codigo_asistencia;
	$.ajax({
		type: "POST",
		url: location.href + "/marcarSalida/",
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			$(".respuesta_asistencia").html("<h4 class='bg-primary'>"+respuesta+"</h4>");
			setTimeout(function() {
				$(".respuesta_asistencia").html("");
				$("#codigo_alumno_salida").val("");
				$("#codigo_alumno_salida").focus();
			}, 3000);
		}
	})
}

function generarReporte(codigo_alumno){
	var mes_inicial = $("#mes_inicial").val();
	var mes_final = $("#mes_final").val();
	var url = location.href + "/generarPDF/"+codigo_alumno+"/"+mes_inicial+"/"+mes_final;
	var win = window.open(url, '_blank');
  	win.focus();
}

function asistenciaDia(campo){
	var datos = "codigo="+$(campo).val();
	$.ajax({
		type: "POST",
		url: location.href + "/obtenerTabla/",
		datatype: "html",
		async: true,
		contentType: "application/x-www-form-urlencoded",
		data: datos,
		success: function(respuesta){
			$("#datos-asistencia").html("");
			$("#datos-asistencia").html(respuesta);
		}
	});
}

function generarReporteAsistenciaDia(){
	var codigo = $("#filtro-dia").val();
	var url = location.href + "/generarPDF/"+codigo;
	var win = window.open(url, '_blank');
  	win.focus();
}

var barChartData = {};

$(document).ready(function(){
	$("#codigo_alumno").focus();
	$("#codigo_alumno").blur(function(){
		$("#codigo_alumno").focus();
	});
	$("#codigo_alumno").on("input", function(){
		marcarEntrada($(this).val());
	});

	$("#codigo_alumno_salida").focus();
	$("#codigo_alumno_salida").blur(function(){
		$("#codigo_alumno_salida").focus();
	});
	$("#codigo_alumno_salida").on("input", function(){
		marcarSalida($(this).val());
	});

	function callbackIndicadorPuntualidad(data){
		window.puntualChart.data = data;
		window.puntualChart.update();
	}

	function indicadorPuntualidad(){
		var mes = $("#mes_filtro").val();
		$.getJSON(location.href+"/getData/" + mes)
		.done(function(data){
			callbackIndicadorPuntualidad(data);
		});
	}
	
	if(location.href === "http://localhost/sis-escuela/indicadores"){
		indicadorPuntualidad();

		var canvas_puntual = document.getElementById('canvas-puntual').getContext('2d');
		window.puntualChart = new Chart(canvas_puntual, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Puntualidad'
				}
			}
		});

		$("#boton-actualizar").on("click", indicadorPuntualidad);
	}

	function callbackIndicadorPuntualidadAlumno(data){
		window.puntualAlumnoChart.data = data;
		window.puntualAlumnoChart.update();
	}
	function getIndicadorPuntualidadAlumno(){
		var mes = $("#mes_filtro").val();
		var alumno = $("#alumno_filtro").val();
		$.getJSON(location.href+"/getData/" + mes + "/" + alumno)
		.done(function(data){
			console.log(data);
			callbackIndicadorPuntualidadAlumno(data);
		});
	}
	
	if(location.href === "http://localhost/sis-escuela/indicadorpuntualidadalumno"){
		
		var pieChartData = {};
		var canvas_puntual_alumno = document.getElementById('canvas-puntual-alumno').getContext('2d');
		window.puntualAlumnoChart = new Chart(canvas_puntual_alumno, {
			type: 'pie',
			data: pieChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Indicador puntualidad del alumno'
				}
			}
		});

		$("#boton-generar").on("click", getIndicadorPuntualidadAlumno);
	}

	function callbackIndicadorAsistenciaAlumno(data){
		window.asistenciaAlumnoChart.data = data;
		window.asistenciaAlumnoChart.update();
	}
	function getIndicadorAsistenciaAlumno(){
		var mes = $("#mes_filtro").val();
		var alumno = $("#alumno_filtro").val();
		$.getJSON(location.href+"/getData/" + mes + "/" + alumno)
		.done(function(data){
			callbackIndicadorAsistenciaAlumno(data);
		});
	}

	if(location.href === "http://localhost/sis-escuela/indicadorasistenciaalumno"){
		
		var pieChartData = {};
		var canvas_asistencia_alumno = document.getElementById('canvas-asistencia-alumno').getContext('2d');
		window.asistenciaAlumnoChart = new Chart(canvas_asistencia_alumno, {
			type: 'pie',
			data: pieChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Indicador de asistencia del alumno'
				}
			}
		});

		$("#boton-generar").on("click", getIndicadorAsistenciaAlumno);
	}
	

});