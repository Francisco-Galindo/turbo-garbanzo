<?php

require 'config.php';
require 'seguridad_y_cripto.php';



session_start();
$conexion = conectar_base();
$_POST = purgar_arreglo($_POST, $conexion);
$_SESSION = purgar_arreglo($_SESSION, $conexion);

$id = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null;

if ($id === null && isset($_SESSION['id_usuario'])) {
	$id = $_SESSION['id_usuario'];
} else {
	header("location: ../../..");
}

$consulta = "SELECT id_usuario, nombre, prim_ape, seg_ape, correo, grado, fecha_nacimiento, foto, es_admin
	FROM usuario WHERE id_usuario='$id'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
	$row = mysqli_fetch_assoc($resultado);
	$consulta = "SELECT AVG(calificacion) FROM valoracion 
	WHERE id_usuario='$id'";
	$resultado = mysqli_query($conexion, $consulta);
	echo json_encode($row, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conexion);

// EOF
