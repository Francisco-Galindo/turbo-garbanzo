<?php

require 'config.php';
require 'seguridad_y_cripto.php';

$error = [false];

$conexion = conectar_base();

$_POST = purgar_arreglo($_POST, $conexion);

// Recibiendo datos
$contrasena = isset($_POST['contrasena']) && $_POST['contrasena'] != '' ?
	$_POST['contrasena'] : null;
$num_cuenta = !isset($_POST['num_cuenta']) || floatval($_POST['num_cuenta']) === (float)0 ?
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
// Regex para validar una contraseña segura
$regex = '/^(?=.*[A-ZÑ]+)(?=.*[\W_]+)(?=.*[\d]+)(?=.*[a-zñ]+).{8,}$/';
if (!preg_match($regex, $contrasena)) {
	$error[0] = true;
	array_push($error, 'Contraseña insegura, necesita ser de mínimo 8 carácteres, ter letras minúsculas, mínimo una mayúscula, un número y un caracter especial.');
}

if ($num_cuenta === null || strlen($num_cuenta) !== 9) {
	$error[0] = true;
	array_push($error, 'Número de cuenta no válido');
}
// Regex para validar correo
$regex = '/^[\w\.\-\ñÑ]{4,20}@([\w\.\-]+)(\.[\w\.\-]+)$/';
if (!preg_match($regex, $correo)) {
	$error[0] = true;
	array_push($error, 'Correo no válido');
}
if (!in_array($grado, array('4', '5', '6'))) {
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
if (time() - strtotime($fecha_nacimiento) < 0) {
	$error[0] = true;
	array_push($error, 'Fecha no válida');
}

if (isset($_FILES['imagen'])) {
	$arch = $_FILES['imagen']['tmp_name'];
	$nombre_archivo = $_FILES['imagen']['name'];
	$ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
	if ($ext === 'png' || $ext === 'jpg' || $ext === 'jpeg') {
		$nombreArchivo = $num_cuenta . '.' . $ext;
		$rutaImagen = '../../statics/img/perfiles/' . $nombreArchivo;
		rename($arch, $rutaImagen);
	} else {
		$error[0] = true;
		array_push($error, 'Archivo no válido');
	}
	unset($arch, $nombre_archivo, $ext);
}

// Checando si usuario ya existe
$consulta = "SELECT * FROM usuario WHERE id_usuario='$num_cuenta' OR correo='$correo';";
$resultado = mysqli_query($conexion, $consulta);
if (mysqli_num_rows($resultado) !== 0) {
	$error[0] = true;
	array_push($error, 'Y existe un usuario registrado con estos datos');
}

//  Creando el usuario
if ($error[0] === false) {

	$pimienta = obtener_pimienta();
	$sal = obtener_sal();
	$hash = hash('sha256', $contrasena . $pimienta . $sal);
	$telefono_cifrado = cifrar_cadena($telefono, $contrasena);

	if (isset($rutaImagen)) {
		$consulta = "INSERT INTO usuario
			(id_usuario, contrasena, sal, correo, grado,
			telefono, nombre, prim_ape, seg_ape, fecha_nacimiento, foto)
			VALUES ('$num_cuenta', '$hash', '$sal', '$correo', '$grado', 
			'$telefono_cifrado', '$nombre','$prim_ape', '$seg_ape',
			'$fecha_nacimiento', '$rutaImagen');";
	} else {
		$consulta = "INSERT INTO usuario
			(id_usuario, contrasena, sal, correo, grado,
			telefono, nombre, prim_ape, seg_ape, fecha_nacimiento)
			VALUES ('$num_cuenta', '$hash', '$sal', '$correo', '$grado', 
			'$telefono_cifrado', '$nombre','$prim_ape', '$seg_ape',
			'$fecha_nacimiento');";
	}

	$resultado = mysqli_query($conexion, $consulta);
	if ($resultado === false) {
		$error[0] = true;
		array_push($error, 'Registro fallido');
	}
}

mysqli_close($conexion);

// // Enviando resultados
if ($error[0] === false) {
	session_start();
	$_SESSION['id_usuario'] = $num_cuenta;
	echo 'Exito';
} else {
	for ($i = 1; $i < count($error); $i++) {
		echo $error[$i];
		echo '|';
	}
}


// EOF
