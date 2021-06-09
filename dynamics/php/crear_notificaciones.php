<?php

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
			WHERE titulo='aviso_inicio';";
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
			OR titulo='reportar'
			OR titulo='pasar_asistencia';";
	} else {
		$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
			WHERE titulo='aviso_final'
			OR titulo='reportar'
			OR titulo='valorar'
			OR titulo='pasar_asistencia';";
	}
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($tipos_notificacion, $row['id_tipo_notificacion']);
	}

	notificar_sobre_sesion($conexion, $id_asesoria, $id_usuario, 			$tipos_notificacion);

}

function notificar_strike(
	$conexion,
	$id_usuario,
	$id_asesoria
	)
{
	$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
		WHERE titulo='aviso_strike';";
	$resultado = mysqli_query($conexion, $consulta);
	$row = mysqli_fetch_assoc($resultado);
	$id_aviso = $row['id_tipo_notificacion'];

	notificar_sobre_sesion($conexion, $id_asesoria, $id_usuario, 
		[$id_aviso]);
}

function notificar_solicitud_asesoria_asesor(
	$conexion,
	$id_usuario,
	$id_asesoria
)
{
	$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
		WHERE titulo='confirmar_asesoria';";
	$resultado = mysqli_query($conexion, $consulta);
	$row = mysqli_fetch_assoc($resultado);
	$id_aviso = $row['id_tipo_notificacion'];

	notificar_sobre_sesion($conexion, $id_asesoria, $id_usuario, 
	[$id_aviso]);
}

function notificar_solicitud_asesoria_alumno(
	$conexion,
	$id_usuario,
	$id_asesoria
)
{
	$consulta = "SELECT id_tipo_notificacion FROM tipo_notificacion
		WHERE titulo='recibir_confirmacion';";
	$resultado = mysqli_query($conexion, $consulta);
	$row = mysqli_fetch_assoc($resultado);
	$id_aviso = $row['id_tipo_notificacion'];

	notificar_sobre_sesion($conexion, $id_asesoria, $id_usuario, 
	[$id_aviso]);
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

// EOF
