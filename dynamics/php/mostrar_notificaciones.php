<?php

require 'config.php';
require 'seguridad_y_cripto.php';

function mostrar_noti_aviso_inicio($id_notificacion, $row)
{
	echo '<div id="aseIni" class="notif">
			<h1 class="tipo">Tu asesoría</h1>
			<h1 class="preg">La fecha de tu asesoría  de'.
			$row['tema'] . ' con ' . $row['nombre'] . $row['prim_ape'].
			'ya llegó.</h1>';
	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}

function mostrar_noti_aviso_final($id_notificacion, $row)
{
	echo '<div id="aseFin" class="notif">
			<h1 class="tipo">Tu asesoría</h1>
			<h1 class="preg">Tu asesoría de' .
			$row['tema'] . ' con ' . $row['nombre'] . $row['prim_ape'].
			'ya terminó.</h1>';
	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}


function mostrar_noti_final_formulario($id_notificacion, $conexion, $row, $row_asesoria, $id_asesoria)
{
	$consulta = "SELECT id_usuario FROM asesoria_has_usuario
		WHERE id_asesoria=$id_asesoria";
	$resultado = mysqli_query($conexion, $consulta);

	$usuarios = array();
	if (mysqli_num_rows($resultado) > 0) {
		while ($row_asesoria = mysqli_fetch_assoc($resultado)) {
			$id_usuario = $row_asesoria['id_usuario'];
			$consulta_usuario = "SELECT nombe, prim_ape FROM usuario
				WHERE id_usuario='$usuarios'";
			$resultado = mysqli_query($conexion, $consulta_usuario);
			$row_usuario = mysqli_fetch_assoc($resultado);
			$nombre = $row_usuario['nombre'] .
				' ' . $row_usuario['prim_ape'];
			$usuarios += [$usuarios => $nombre];

		}

	} else {
		return;
	}

	$razones = array();
	$consulta = "SELECT * FROM razon";
	$resultado = mysqli_query($conexion, $consulta);
	while ($row_razon = mysqli_fetch_assoc($resultado)) {
		$razones += [$row_razon['id_razon'] => $row_razon['razon']];
	}

	echo '<div id="alumTermino" class="notif">
		<h1 class="tipo">Terminó la sesión</h1>
		<h1 class="preg">La asesoría de ' .
		$row['tema'] . ' con ' . $row['nombre'] . $row['prim_ape'].
		'ya ha terminado
		¿Gustas dejar un comentario?</h1>';

	echo '<textarea id="'.$row_asesoria['id_notificacion'].'::' . 'com'. '"
		name="texto" rows="10" cols="100"></textarea>';

	echo '<h1 class="preg">¿Gustas calificar la asesoría?</h1>
		<label>';
	echo '<input
		id="'.$row_asesoria['id_notificacion'].'::' . 'val'. '"
		type="number" min="1" max="5">';
	echo '</label>

		<h1 class="preg">¿Algún usuario tuvó un comportamiento inapropiado?</h1>';

	foreach ($usuarios as $id_usuario => $usuario) {
		echo '<label>';
		echo $usuario;
		echo '<input id="'. $id_usuario .'" type="checkbox">';
		echo '</label>';
	}

	echo '<h1 class="preg">¿Cuál fue su falta?</h1>.';

	foreach ($razones as $id_razon => $razon) {
		echo '<label>';
		echo $razon;
		echo '<input id="'. $id_razon .'" type="checkbox">';
		echo '</label>';
	}

	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}

function mostrar_noti_confirmar_asesoria($id_notificacion, $conexion, $row_asesoria, $id_asesoria)
{
	$consulta = "SELECT id_usuario FROM asesoria_has_usuario
		WHERE id_asesoria=$id_asesoria
		AND es_solicitante=true;";
	$resultado = mysqli_query($conexion, $consulta);
	$row = mysqli_fetch_assoc($resultado);
	$id_usuario = $row['id_usuario'];

	$consulta = "SELECT nombre, prim_ape, grado, correo FROM usuario
		WHERE id_usuario='$id_usuario';";
	$resultado = mysqli_query($conexion, $consulta);
	$row = mysqli_fetch_assoc($resultado);
	$nombre = $row['nombre'];
	$prim_ape = $row['prim_ape'];
	$nombre .= ' ' . $prim_ape;
	$grado = $row['grado'];
	$correo = $row['correo'];


	echo '<div id="aseSoli" class="notif">
			<h1 class="tipo">Solicitud de asesoría</h1>
			<h1 class="preg">'. $nombre .' esta solicitando una asesoría</h1>
			<div>';
	echo 'Año escolar: ' . $grado;
	echo '<br>';
	echo 'Correo: ' . $correo;

	echo 'Información de la asesoría:
			</div>

			<label><input type="radio" value="true">Aceptar</label>
			<label><input type="radio" value="false">Rechazar</label>';

	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}

function mostrar_noti_pasar_asistencia($id_notificacion, $conexion, $row, $id_asesoria)
{
	$consulta = "SELECT id_usuario FROM asesoria_has_usuario
		WHERE id_asesoria=$id_asesoria";
	$resultado = mysqli_query($conexion, $consulta);

	$usuarios = array();
	if (mysqli_num_rows($resultado) > 0) {
		while ($row_asesoria = mysqli_fetch_assoc($resultado)) {
			$id_usuario = $row_asesoria['id_usuario'];
			$consulta_usuario = "SELECT nombe, prim_ape FROM usuario
				WHERE id_usuario='$usuarios'";
			$resultado = mysqli_query($conexion, $consulta_usuario);
			$row_usuario = mysqli_fetch_assoc($resultado);
			$nombre = $row_usuario['nombre'] .
				' ' . $row_usuario['prim_ape'];
			$usuarios += [$usuarios => $nombre];

		}

	} else {
		return;
	}
	echo '<div id="aseTermino" class="notif">
		<h1 class="tipo">Terminó tu sesión</h1>
		<h1 class="preg">¿Quiénes asistieron a la asesoría?</h1>';

	foreach ($usuarios as $id_usuario => $usuario) {
		echo '<label>';
		echo $usuario;
		echo '<input id="'. $id_usuario .'" type="checkbox">';
		echo '</label>';
	}

	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}

function mostrar_noti_aviso_strike($id_notificacion, $conexion, $id_usuario)
{
	$consulta = "SELECT num_faltas FROM usuario
		WHERE $id_usuario='$id_usuario'";
	$resultado = mysqli_query($conexion, $consulta);
	if (mysqli_num_rows($resultado) === 1) {
		$row = mysqli_fetch_assoc($resultado);
		$strikes = $row['num_faltas'];
	} else {
		return;
	}

	echo '<div id="aseTermino" class="notif">
			<h1 class="tipo">¡Strike!</h1>
			<h1 class="preg">Has recibido un strike</h1>
			<p>Tienes ' . $strikes . ', recuerda que si acumulas 3,
			ameritarás una suspensión de dos semanas.</p>';
	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}

function mostrar_noti_recibir_confirmacion($id_notificacion, $row)
{
	if ($row['confirmada'] == true) {
		$mensaje = 'Solicitud confirmada';
	} else {
		$mensaje = 'Solicitud rechazada';
	}
	echo '<div id="aseTermino" class="notif">
			<h1 class="tipo">' . $mensaje . '</h1>
			<h1 class="preg">'.$row['tema'].'</h1>
			<p>En la asesoría de' . $row['nombre'] . ' para el '. $row['fecha_hora'] .'.</p>';
	echo '<button id="'. $id_notificacion .'" type="button" class="submitcarr" name="button">Aceptar</button> </div>';
}



session_start();
$conexion = conectar_base();
$_SESSION = purgar_arreglo($_SESSION, $conexion);
$id_usuario = $_SESSION['id_usuario'];

$tipos_notificacion = array();
$consulta = "SELECT id_tipo_notificacion, titulo FROM tipo_notificacion";
$resultado = mysqli_query($conexion, $consulta);
while ($row = mysqli_fetch_assoc($resultado)) {
	$tipos_notificacion += [$row['id_tipo_notificacion'] => $row['titulo']];
}

$consulta = "SELECT * FROM notificacion
	WHERE id_usuario='$id_usuario'
	AND visto=false;";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
	$id_notificacion = $row['id_notificacion'];
	$tipo_notificacion = $tipos_notificacion[$row['id_tipo_notificacion']];

	$id_asesoria = $row['id_asesoria'];

	$consulta = "SELECT nombre, prim_ape, seg_ape, materia, tema,
		fecha_hora, duracion_simple, cupo, medio_vir FROM usuario
		INNER JOIN asesoria ON usuario.id_usuario=asesoria.id_usuario
		INNER JOIN materia ON asesoria.id_materia=materia.id_materia
		WHERE id_asesoria=$id_asesoria";
	$resultado_asesoria = mysqli_query($conexion, $consulta);
	$row_asesoria = mysqli_fetch_assoc($resultado_asesoria);


	if ($tipo_notificacion === 'aviso_final')  {
		mostrar_noti_aviso_final($id_notificacion, $row_asesoria);
	} elseif ($tipo_notificacion === 'aviso_inicio') {
		mostrar_noti_aviso_inicio($id_notificacion, $row_asesoria);
	} elseif ($tipo_notificacion === 'valorar') {
		mostrar_noti_final_formulario($id_notificacion, $conexion,
			$row, $row_asesoria, $id_asesoria);
	} elseif ($tipo_notificacion === 'confirmar_asesoria') {
		mostrar_noti_confirmar_asesoria($id_notificacion, 
			$conexion, $row_asesoria, $id_asesoria);
	} elseif ($tipo_notificacion === 'pasar_asistencia') {
		mostrar_noti_pasar_asistencia($id_notificacion, $conexion,
			$row_asesoria, $id_asesoria);
	} elseif ($tipo_notificacion === 'aviso_trike') {
		mostrar_noti_aviso_strike($id_notificacion, $conexion,
			$id_usuario);
	} elseif ($tipo_notificacion === 'recibir_confirmacion') {
		mostrar_noti_recibir_confirmacion($id_notificacion,
			$row_asesoria);
	}
}

// EOF
