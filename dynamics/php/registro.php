<?php

require 'config.php';
require 'seguridad_y_cripto.php';

$_POST['num_cuenta'] = '320054336';
$_POST['contrasena'] = 'popo';
$_POST['correo'] = 'paqui10718@gmail.com';
$_POST['grado'] = '6';
$_POST['telefono'] = '5522442070';
$_POST['nombre'] = 'Francisco';
$_POST['prim_ape'] = 'Galindo';
$_POST['seg_ape'] = 'Mena';
$_POST['fecha_nacimiento'] = '2004-09-01';
$error = [false];

$conexion = conectar_base();

$_POST = purgar_arreglo($_POST, $conexion);

// Recibiendo datos
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


// Validando los datos recibidos
if ($contrasena === null) {
	$error[0] = true;
	array_push($error, 'Contraseña no válida');
}
if ($num_cuenta === null || strlen($num_cuenta) !== 9) {
	$error[0] = true;
	array_push($error, 'Número de cuenta no válido');
}

// Regex para validar correo
$regex = '/^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/';
if (!preg_match($regex, $correo)) {
	$error[0] = true;
	array_push($error, 'Correo no válido');
}
if (!in_array($_POST['grado'], array('4', '5', '6'))) {
	$error[0] = true;
	array_push($error, 'Grado no válido');
}
if ($telefono === null|| strlen($telefono) !== 10 ) {
	$error[0] = true;
	array_push($error, 'Teléfono no válido');
}
if ($nombre === null|| strlen($nombre) > 32 ) {
	$error[0] = true;
	array_push($error, 'Nombre demasiado largo');
}
if ($prim_ape === null|| strlen($prim_ape) > 32 ) {
	$error[0] = true;
	array_push($error, 'Primer apellido demasiado largo');
}
if ($seg_ape === null|| strlen($seg_ape) > 32 ) {
	$error[0] = true;
	array_push($error, 'Segundo apellido largo');
}
if (time() - strtotime($_POST['fecha_nacimiento']) < 0) {
	$error[0] = true;
	array_push($error, 'Fecha no válida');
}
if (isset($_FILES['imagen'])) {
	$arch = $_FILES['imagen']['tmp_name'];
	$nombre = $_FILES['imagen']['name'];
	$ext = pathinfo($nombre, PATHINFO_EXTENSION);
	if ($ext === 'png' || $ext === 'jpg' || $ext === 'jpeg') {
		$nombreArchivo = $prim_ape . $seg_ape . $fecha_nacimiento;
		$rutaImagen = '../../statics/perfiles/' . $nombreArchivo;
		rename($arch, $rutaImagen);
	} else {
		$error[0] = true;
		array_push($error, 'Archivo no válido');
	}
	unset($arch, $nombre, $ext);
}

$id = hash("sha256", $num_cuenta);
$consulta = "SELECT * FROM usuario WHERE id_usuario='$id' OR correo='$correo';";
$resultado = mysqli_query($conexion, $consulta);
if (mysqli_num_rows($resultado) !== 0) {
	$error[0] = true;
	array_push($error, 'Usuario existente');
}

if ($error[0] === false) {

	$pimienta = obtener_pimienta();
	$sal = obtener_sal();
	$hash = hash('sha256', $contrasena . $pimienta . $sal);
	$num_cuenta_cifrado = cifrar_cadena($num_cuenta, $contrasena);
	$telefono_cifrado = cifrar_cadena($telefono, $contrasena);

	if (isset($rutaImagen)) {
		$consulta = "INSERT INTO usuario
			(id_usuario, contrasena, sal, num_cuenta, correo, grado,
			telefono, nombre, prim_ape, seg_ape, fecha_nacimiento, foto)
			VALUES ('$id', '$hash', '$sal', '$num_cuenta_cifrado',
			'$correo', '$grado', '$telefono_cifrado', '$nombre',
			'$prim_ape', '$seg_ape', '$fecha_nacimiento', '$rutaImagen');";
	} else {
		$consulta = "INSERT INTO usuario
			(id_usuario, contrasena, sal, num_cuenta, correo, grado,
			telefono, nombre, prim_ape, seg_ape, fecha_nacimiento)
			VALUES ('$id', '$hash', '$sal', '$num_cuenta_cifrado',
			'$correo', '$grado', '$telefono_cifrado', '$nombre',
			'$prim_ape', '$seg_ape', '$fecha_nacimiento');";
	}


	$resultado = mysqli_query($conexion, $consulta);
	if ($resultado === false) {
		$error[0] = true;
		array_push($error, 'Registro fallido');
	}
}

mysqli_close($conexion);

if ($error[0] === false) {
	echo 'Exito';
} else {
	for ($i = 1; $i < count($error); $i++) {
		echo $error[$i];
		echo '|';
	}
}


// EOF
