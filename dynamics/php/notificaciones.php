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
	echo $row['id_asesoria'] . '<br>';
	echo $row['fecha_hora'] . '<br>';
	echo strtotime($row['fecha_hora']) - time() . '<br>';
}
 //EOF
