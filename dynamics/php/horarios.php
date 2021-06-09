<?php

require 'config.php';
require 'seguridad_y_cripto.php';
date_default_timezone_set('America/Mexico_City');

$horarios = ['1::2', '3::1', '3::3'];
$id_usuario = '9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07';

define('UN_DIA', 60 * 60 * 24);
define('CUATRO_SEMANAS', UN_DIA * 28);
define('ACCIONES', array('ver_horario_usuario', 'ver_disponibilidad_cercana',
	'ver_todos_los_horarios', 'elegir_horario_usuario'));

function ver_horarios_usuario($conexion, $id_usuario)
{
	$horarios = array();
	$consulta = "SELECT t1.id_uhh, t3.hora, t4.dia FROM usuario_has_horario t1
		INNER JOIN usuario t2 ON t1.id_usuario=t2.id_usuario
		INNER JOIN hora t3 ON t1.id_hora=t3.id_hora
		INNER JOIN dia t4 ON t1.id_dia=t4.id_dia
		WHERE t1.id_usuario='$id_usuario';";
	
	$resultado = mysqli_query($conexion, $consulta);
	if (mysqli_num_rows($resultado) > 0) {
		while ($row = mysqli_fetch_assoc($resultado)) {

			$horarios += 
				[$row['id_uhh'] => 
				$row['dia'] . '::' . $row['hora']];
		}
	}
	echo '<br>' . json_encode($horarios, JSON_UNESCAPED_UNICODE);
}


function ver_horarios_cercanos($tiempo_actual, $tiempo_a_comparar, $horarios)
{
	foreach ($horarios as $horario) {
		$mismo_dia_semana = 
			date('w', $tiempo_a_comparar) == $horario[0];

		$hora_arreglo = explode(':', $horario[1]);
		$horario_timestamp = 
			mktime($hora_arreglo[0], $hora_arreglo[1], 0,
				date('n', $tiempo_a_comparar),
				date('j', $tiempo_a_comparar),
				date('Y', $tiempo_a_comparar));

		$un_dia_entre_fechas = 
			$horario_timestamp >= $tiempo_actual;

		if ($mismo_dia_semana && $un_dia_entre_fechas) {
			echo date('H:i A', $horario_timestamp) . "<br>";
			echo date('j-n H:i A', $horario_timestamp) . "<br>";
			echo $horario_timestamp . "<br>";
			echo '<br>';
		}
	}
}


function ver_todos_horarios($conexion)
{
	$horas = array();
	$consulta = 'SELECT id_hora, hora FROM hora;';
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		array_push($horas, [$row['id_hora'], $row['hora']]);
	}

	$consulta = 'SELECT id_dia, dia FROM dia;';
	$resultado = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_assoc($resultado)) {
		echo '<br>';
		echo $row['dia'];
		echo '<br>';
		foreach ($horas as $hora) {
			echo '<label>';
			echo $hora[1];
			echo '<input tabindex="0" id="' . $row['id_dia'] . '::' . $hora[0] . '" type="checkbox"> ';
			echo '</label>';
		}
	}
}


function elegir_horarios($conexion, $id_usuario, $horarios)
{
	$alerta = '';

	$consulta = "DELETE FROM usuario_has_horario
                WHERE id_usuario='$id_usuario';";
	$resultado = mysqli_query($conexion, $consulta);
	foreach ($horarios as $horario) {
		$horario = explode('::', $horario);
		$consulta = "INSERT INTO usuario_has_horario
			(id_usuario, id_hora, id_dia) 
			VALUES ('$id_usuario', $horario[1], $horario[0]);";

		$resultado = mysqli_query($conexion, $consulta);
		if (!$resultado) {
			$alerta .= 'No existe uno de los horarios marcados. Se seguirá tratando de registrar el resto de horarios.';
		}
	}
	if ($alerta === '') {
		return true;
	} else {
		return $alerta;
	}
}

$conexion = conectar_base();

$tiempo_actual = time() + UN_DIA;
$tiempo_a_comparar = $tiempo_actual;

// while ($tiempo_a_comparar - $tiempo_actual < CUATRO_SEMANAS) {
// 	ver_horarios_cercanos($tiempo_actual, $tiempo_a_comparar, $horarios);
// 	$tiempo_a_comparar += UN_DIA;
// }

// ver_todos_horarios($conexion);
// elegir_horarios($conexion, $id_usuario, $horarios);
ver_horarios_usuario($conexion, $id_usuario);

$date = localtime(time(), true);
$date['tm_yday']++;

// EOF
