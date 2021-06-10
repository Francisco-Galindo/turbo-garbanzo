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
require 'crear_notificaciones.php';


$conexion = conectar_base();
session_start();
if (isset($_SESSION)) {
	$_SESSION = purgar_arreglo($_SESSION, $conexion);
}

$id_usuario = $_SESSION['id_usuario'];



$consulta = "SELECT id_asesoria, fecha_hora FROM asesoria
	WHERE id_usuario='$id_usuario'
	AND confirmada=true;";
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

while (mysqli_num_rows($resultado) > 0 && $row = mysqli_fetch_assoc($resultado)) {
	$id_asesoria = $row['id_asesoria'];
	$consulta = "SELECT id_asesoria, fecha_hora FROM asesoria
		WHERE id_asesoria='$id_asesoria'
		AND confirmada=true;";
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
