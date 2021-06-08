<?php

$horarios = [['1', '07:50:00'], ['1', '12:00:00'], ['3', '09:30:00']];
date_default_timezone_set('America/Mexico_City');
// $date = date_create_from_format('j,', '');
$un_dia = 60 * 60 * 24;
$cuatro_semanas = 60 * 60 * 24 * 28;
$tiempo = time() + $un_dia;
$tiempo_a_comparar = $tiempo;
$contador = 0;
echo date('Y-n-j H:i', $tiempo) . "<br><br><br>";
while ($tiempo_a_comparar - $tiempo < $cuatro_semanas) {
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
			$horario_timestamp >= $tiempo;

		if ($mismo_dia_semana && $un_dia_entre_fechas) {
			echo date('H:i A', $horario_timestamp) . "<br>";
			echo date('j-n H:i A', $horario_timestamp) . "<br>";
			echo $horario_timestamp . "<br>";
			echo '<br>';
		}
	}
	$tiempo_a_comparar += $un_dia;
}
$date = localtime(time(), true);
$date['tm_yday']++;
