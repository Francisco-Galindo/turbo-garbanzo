<?php
$_SESSION['usuario'] = '1';
$_POST['fecha'] = "2021-05-05";
$_POST['hora'] = "19:05";
$_POST['duracion'] = "true";
$_POST['tema'] = "Funciones cuadráticas";
$_POST['materia'] = "1500";
$_POST['cupo'] = "2";
$_POST['medio'] = "true";
$_POST['lugar'] = "Escuela Nacional Preparatoria Plantel 6 Antonio Caso";

if (isset($_SESSION['usuario'])) {
	include('config.php');
	$conexion = conectar_base();
	$usuario = $_SESSION['usuario'];


	$fecha = $_POST['fecha'];
	//explode("-", $_POST['fecha']);
	$hora = $_POST['hora'];
	//explode(":", $_POST['hora']);
	$fechaHora = $fecha.' '.$hora; 
	//$fechaHora = mktime(intval($hora[0]), intval($hora[1]), 0, intval($fecha[1]), intval($fecha[2]), intval($fecha[0]));
	$duracion = (($_POST['duracion']) == "true") ? true : false;
	$tema = $_POST['tema'];
	$materia = $_POST['materia'];
	$cupo = intval($_POST['cupo']);
	$medio = (($_POST['medio']) == "true") ? true : false;
	$lugar = $_POST['lugar'];

	$datos_as = "INSERT INTO asesoria (id_usuario,id_materia,tema,fecha_hora,duracion_simple,cupo,medio_vir,lugar) VALUES ($usuario, '$materia','$tema','$fechaHora','$duracion','$cupo','$medio','$lugar')";

	$ins = mysqli_query($conexion, $datos_as);
	if ($ins) {  
		echo 'Registro de asesoría exitoso';
	} else {
		echo 'Registro fallido';
	}
}

// EOF
