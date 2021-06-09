<?php

/**
 * Iterar por las asesorias que da el usuario
 * 	Si la asesoria ya terminó / emepezo y no existe notificacion al respecto,
 * 	crear la notificacion
 * 
 * Iterar por las asesorias en las que esta inscrito
 * 	Mismo proceso que arriba, pero las notificaciones faltan 
 */

require 'config.php';
require 'seguridad_y_cripto.php';

function notificar_inicio_asesoria(
	$conexion, 
	$id_asesoria, 
	$id_usuario,
	$es_asesor
)
{
	$tipos_notificacion = array();
	if ($es_asesor) {
		$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
			WHERE titulo='aviso_inicio'
			OR titulo='pasar_asistencia';";
	} else {
		$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
			WHERE titulo='aviso_inicio';";
	}
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($tipos_notificacion, $row['id_tipo_notificacion']);
	}

	notificar_sobre_sesion($conexion, $id_asesoria, $id_usuario, 			$tipos_notificacion);

}

function notificar_final_asesoria(
	$conexion,
	$id_asesoria, 
	$id_usuario,
	$es_asesor
)
{
	$tipos_notificacion = array();
	if ($es_asesor) {
		$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
			WHERE titulo='aviso_final'
			OR titulo='reportar';";
	} else {
		$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
			WHERE titulo='aviso_final'
			OR titulo='reportar'
			OR titulo='valorar';";
	}
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($tipos_notificacion, $row['id_tipo_notificacion']);
	}

	notificar_sobre_sesion($conexion, $id_asesoria, $id_usuario, 			$tipos_notificacion);

}

function notificar_sobre_sesion(
	$conexion,
	$id_asesoria,
	$id_usuario,
	$tipos_notificacion
)
{
	$cadena_ids = '(';
	foreach ($tipos_notificacion as $id_tipo) {
		$cadena_ids .= 'id_tipo_notificacion=' . $id_tipo . ' OR ';
	}
	$cadena_ids .= '0=1)';
	$consulta = "SELECT id_tipo_notificacion FROM notificacion
		WHERE id_usuario='$id_usuario'
		AND $cadena_ids";
	$resultado = mysqli_query($conexion, $consulta);
	echo $consulta;
	// $row = mysqli_fetch_assoc($resultado);
	if (mysqli_num_rows($resultado) === 0) {
		foreach ($tipos_notificacion as $id_tipo) {
			$consulta = "INSERT INTO notificacion 
				(id_usuario, id_asesoria, 
				id_tipo_notificacion)
				VALUES ('$id_usuario', $id_asesoria, 
				$id_tipo);";
			$resultado = mysqli_query($conexion, $consulta);
		}

	}
}

$conexion = conectar_base();
session_start();
if (isset($_SESSION)) {
	$_SESSION = purgar_arreglo($_SESSION, $conexion);
}

$id_usuario = $_SESSION['id_usuario'];



$consulta = "SELECT id_asesoria, fecha_hora FROM asesoria 
	WHERE id_usuario='$id_usuario'";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
	$id_asesoria = $row['id_asesoria'];
	if (strtotime($row['fecha_hora']) - time() <= 0 ) {
		notificar_inicio_asesoria($conexion, 
			$id_asesoria, 
			$id_usuario,
			true);
	}
}

$consulta = "SELECT id_asesoria FROM asesoria_has_usuario
	WHERE id_usuario='$id_usuario';";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
	$id_asesoria = $row['id_asesoria'];
	$consulta = "SELECT id_asesoria, fecha_hora FROM asesoria 
		WHERE id_asesoria='$id_asesoria'";
	$resultado = mysqli_query($conexion, $consulta);

	while ($row = mysqli_fetch_assoc($resultado)) {
		if (strtotime($row['fecha_hora']) - time() <= 0 ) {
			notificar_inicio_asesoria($conexion, 
				$id_asesoria, 
				$id_usuario,
				false);
		}
	}
}
 //EOF
