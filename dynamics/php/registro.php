<?php

require 'config.php';
require 'cripto.php';

$_POST['num_cuenta'] = '320054336';
$_POST['contrasena'] = 'popo';
$_POST['correo'] = 'paqui10718@gmail.com';
$_POST['grado'] = 'sexto';
$_POST['telefono'] = '5522442070';
$_POST['nombre'] = 'Francisco';
$_POST['prim_ape'] = 'Galindo';
$_POST['seg_ape'] = 'Mena';
$_POST['fecha_nacimiento'] = '2004-09-01';
$error = [false];

foreach($_POST as $elemento) {
	$elemento = htmlspecialchars($elemento);
}

$conexion = conectar_base();

foreach($_POST as $elemento) {
	$elemento = mysqli_real_escape_string($conexion, $elemento);
}

$contrasena = isset($_POST['contrasena']) && $_POST['contrasena'] != '' ?
	$_POST['contrasena'] : null;
$num_cuenta = floatval($_POST['num_cuenta']) === (float)0 ?
	null : floatval($_POST['num_cuenta']);
$correo = isset($_POST['correo']) && $_POST['correo'] !== '' ?
	$_POST['correo'] : null;
$grado = isset($_POST['grado']) && $_POST['grado'] !== '' ?
	$_POST['grado'] : null;
$telefono = isset($_POST['telefono']) && $_POST['telefono'] !== '' ?
	$_POST['telefono'] : null;
$nombre = isset($_POST['nombre']) && $_POST['nombre'] !== '' ?
	$_POST['nombre'] : null;
$prim_ape = isset($_POST['prim_ape']) && $_POST['prim_ape'] !== '' ?
	$_POST['prim_ape'] : null;
$seg_ape = isset($_POST['seg_ape']) && $_POST['seg_ape'] !== '' ?
	$_POST['seg_ape'] : null;
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) && $_POST['fecha_nacimiento'] !== '' ?
	$_POST['fecha_nacimiento'] : null;



if ($contrasena === null) {
	$error[0] = true;
	array_push($error, 'Contraseña no válida');
}
if ($num_cuenta === null || strlen($num_cuenta) !== 9) {
	$error[0] = true;
	array_push($error, 'Número de cuenta no válido');
}

$regex = '/^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/';
if (!preg_match($regex, $correo)) {
	$error[0] = true;
	array_push($error, 'Correo no válido');
}

if (!in_array($_POST['grado'], array('cuarto', 'quinto', 'sexto'))) {
	$error[0] = true;
	array_push($error, 'Grado no válido');
}

if ($_POST['telefono'] === null|| strlen($_POST['telefono']) !== 10 ) {
	$error[0] = true;
	array_push($error, 'Teléfono no válido');
}

if (time() - strtotime($_POST['fecha_nacimiento']) < 0) {
	$error[0] = true;
	array_push($error, 'Fecha no válida');
}

if ($error[0] === false) {

	$consulta = "SELECT * FROM usuario WHERE correo='$correo';";
	$resultado = mysqli_query($conexion, $consulta);

	if (!$resultado) {
		$pimienta = obtener_pimienta();
		$sal = obtener_sal();
		$hash = hash('sha256', $contrasena . $pimienta . $sal);
		
		
		$num_cuenta_cifrado = cifrar_cadena($num_cuenta, $contrasena);
		$telefono_cifrado = cifrar_cadena($telefono, $contrasena);
		
		
		$consulta = "INSERT INTO usuario 
			(contrasena, sal, num_cuenta, correo, grado, telefono, nombre, prim_ape, seg_ape, fecha_nacimiento) VALUES ('$hash', '$sal', '$num_cuenta_cifrado', '$correo', 
			'$grado', '$telefono_cifrado', '$nombre', '$prim_ape', '$seg_ape', '$fecha_nacimiento');";
		
		$resultado = mysqli_query($conexion, $consulta);
		if ($resultado === false) {
			echo 'Muerte';
			echo '<br>';
		}
	}
}

mysqli_close($conexion);

foreach ($error as $indx => $cadena) {
	echo $cadena;
	echo '<br>';
}

// EOF
