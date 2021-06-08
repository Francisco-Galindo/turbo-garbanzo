<?php
require_once 'config.php';

$conexion = conectar_base();
date_default_timezone_set("America/Mexico_City");
$filFech = (isset($_POST['fecha']))?$_POST['fecha']:null;
$filMat = (isset($_POST['materia']))?$_POST['fecha']:null;
$filMod = (isset($_POST['modalidad']))?$_POST['modalidad']:null;
$busqueda = (isset($_POST['busqueda']) && $_POST['busqueda'] !== "") ? $_POST['busqueda'] : "No hay búsqueda";



if(isset($filFech) && !(isset($filMat)) && !(isset($filMod))){
	$cons = "SELECT (nombre, materia, tema, fecha_hora, duracion_simple, medio_vir, lugar) FROM usuario WHERE fecha_hora LIKE '$filFech'%";		
}else if(!(isset($filFech)) && (isset($filMat)) && !(isset($filMod))){
	$cons = "SELECT (nombre, materia, tema, fecha_hora, duracion_simple, medio_vir, lugar) FROM usuario WHERE materia LIKE '$filMat'";
}else if(!(isset($filFech)) && !(isset($filMat)) && (isset($filMod))){
	
}
$resFil = mysqli_query($conexion, $cons);

if ($busqueda !== "No hay búsqueda") {
	$consulta = 'SELECT (nombre, materia, tema, fecha_hora, duracion_simple, medio_vir, lugar) FROM usuario NATURAL JOIN asesoria_has_usuario NATURAL JOIN asesoria NATURAL JOIN materia WHERE nombre=' . $busqueda . ' OR materia=' . $busqueda;
	$res = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_array($res)) {
		echo 'Nombre: ' . $row[1] . ' Materia: ' . $row[2] . '<br>';
		echo 'Tema: ' . $row[3] . '<br>';
		$fecha = date("d-m-Y h:i A", $row[4]);
		echo 'Fecha: ' . $fecha . '<br>';
		$duracion = ($row[6] === true) ? "50 min" : "100 min";
		echo 'Duración: ' . $duracion . '        ';
		$medio = ($row[7] === true) ? "Virtual" : "Presencial";
		echo 'Medio: ' . $medio . '<br>';
		echo 'Lugar: ' . $row[8];
	}
}

// EOF
