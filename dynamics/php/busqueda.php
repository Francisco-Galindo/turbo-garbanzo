<?php

require 'config.php';
require 'seguridad_y_cripto.php';

define('ACCIONES', array('buscar_usuario', 'buscar_asesoria', 'recibir_filtros'));

date_default_timezone_set("America/Mexico_City");

function buscar_asesoria($conexion, $fecha, $horario, $materia, $modalidad)
{
	$ahora = date('Y-m-d H:i:s');
	$condiciones_a_consulta = "fecha_hora>='$ahora' AND confirmada=true";
	
	if ($fecha !== null && $horario === null) {
		echo  'FSGERG';
		$fecha_date = date('Y-m-d H:i:s', strtotime($fecha));
		$fecha_final_dia = date('Y-m-d H:i:s', strtotime($fecha) + (24 * 60 * 60));
		$condiciones_a_consulta .= " AND 
			(fecha_hora BETWEEN '$fecha_date' AND '$fecha_final_dia') ";
	} elseif ($fecha != null && $horario !== null) {
		$timestamp = strtotime($horario) + strtotime($fecha);
		$fecha_date = date('Y-m-d H:i:s', $timestamp);
		$condiciones_a_consulta .= " AND 
			(fecha_hora='$fecha_date') ";
	} elseif ($fecha == null && $horario !== null) {
		$condiciones_a_consulta .= " AND 
			(HOUR(fecha_hora)=HOUR('$horario') 
			AND MINUTE(fecha_hora)=MINUTE('$horario')) ";
	}
	if ($materia !== null) {
		$condiciones_a_consulta .= " AND 
		(t2.id_materia=$materia) ";
	}
	if ($modalidad == 'true') {
		$condiciones_a_consulta .= " AND 
		(cupo>1) ";
	} else if ($modalidad == 'false') {
		$condiciones_a_consulta .= " AND 
		(cupo=1) ";
	}


 	$consulta = "SELECT t2.id_asesoria, t1.nombre, t1.prim_ape, t3.materia, t2.tema, t2.fecha_hora, 
	 	t2.duracion_simple, t2.cupo, t2.medio_vir FROM usuario t1 
		INNER JOIN asesoria t2 ON t1.id_usuario=t2.id_usuario 
		INNER JOIN materia t3 ON t2.id_materia=t3.id_materia
		WHERE $condiciones_a_consulta";

	$resultado = mysqli_query($conexion, $consulta);
	$asesorias = array();
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($asesorias, $row);
	}

	return json_encode($asesorias, JSON_UNESCAPED_UNICODE);
}

function enviar_filtros($conexion)
{
	$materias = array();
	$consulta = "SELECT id_materia, abreviacion FROM materia";
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($materias, $row);
	}

	$horas = array();
	$consulta = "SELECT id_hora, hora FROM hora";
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($horas, $row);
	}

	return json_encode([$materias, $horas], JSON_FORCE_OBJECT);
}

session_start();
$conexion = conectar_base();
// Purgando el arreglo $_POST de posibles ataques
$_POST = purgar_arreglo($_POST, $conexion);
$_SESSION = purgar_arreglo($_SESSION, $conexion);

$fecha = (isset($_POST['fecha'])) && $_POST['fecha'] !== "undefined" && $_POST['fecha'] !== ""? $_POST['fecha']:null;
$horario = (isset($_POST['horario'])) && $_POST['horario'] !== "undefined" && $_POST['horario'] !== ""?$_POST['horario']:null;
$materia = (isset($_POST['materia'])) && $_POST['materia'] !== "undefined" && $_POST['materia'] !== ""?$_POST['materia']:null;
$modalidad = (isset($_POST['modalidad'])) && $_POST['modalidad'] !== "undefined" && $_POST['modalidad'] !== ""?$_POST['modalidad']:null;
$modo = (isset($_POST['modo']) && $_POST['modo'] !== "") && $_POST['modo'] !== ""? $_POST['modo'] : null;


if ($modo === 'buscar_asesoria') {
	echo buscar_asesoria($conexion, $fecha, $horario, $materia, $modalidad);
} else if ($modo === 'recibir_filtros') {
	echo enviar_filtros($conexion);
}


// EOF
