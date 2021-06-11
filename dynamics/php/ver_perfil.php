<?php

require 'config.php';
require 'seguridad_y_cripto.php';




$conexion = conectar_base();
$_POST = purgar_arreglo($_POST, $conexion);

$id = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';


$consulta = "SELECT (nombre,prim_ape,seg_ape,fecha nacimiento,es_admin,foto)
	FROM usuario WHERE id_usuario='$id'";
$resultado = mysqli_query($conexion, $consulta);
mysqli_close($conexion);

if ($resultado) {
	$row = mysqli_fetch_assoc($resultado);
	echo json_encode($row);
}

// EOF
