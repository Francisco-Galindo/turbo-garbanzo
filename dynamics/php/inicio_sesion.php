<?php

require 'config.php';
require 'seguridad_y_cripto.php';

$_POST['num_cuenta'] = '320054336';
$_POST['contrasena'] = 'popo';

$conexion = conectar_base();
// Purgando el arreglo $_POST de posibles ataques
$_POST = purgar_arreglo($_POST, $conexion);
$error = array(false);

// Asignando los valores recibidos a variables
$num_cuenta = floatval($_POST['num_cuenta']) === (float)0 ?
	null : floatval($_POST['num_cuenta']);

$contrasena = isset($_POST['contrasena']) && $_POST['contrasena'] != '' ?
	$_POST['contrasena'] : null;

// Validando los datos recibidos
if ($contrasena === null) {
	$error[0] = true;
	array_push($error, 'Contraseña no inexistente');
}
if ($num_cuenta === null || strlen($num_cuenta) !== 9) {
	$error[0] = true;
	array_push($error, 'Número de cuenta no válido');
}


// Comparando la contraseña con la de la base de datos
if ($error[0] === false) {
	$num_cuenta_hash = hash('sha256', $num_cuenta);
	$contrasena_hash = hash('sha256', $contrasena);

	$consulta = "SELECT contrasena, sal FROM usuario
		WHERE id_usuario='$num_cuenta_hash';";
	$resultado = mysqli_query($conexion, $consulta);

	if(mysqli_num_rows($resultado) === 0) {
		$error[0] = true;
		array_push($error, 'No existe tal usuario');
	} else {
		$row = mysqli_fetch_array($resultado);
		$hash_bd = $row['contrasena'];
		$sal = $row['sal'];

		$correcto = verificar_contrasena_sha256(
			$contrasena,
			$sal,
			$hash_bd
		);
		if (!$correcto) {
			$error[0] = true;
			array_push($error, 'Contraseña incorrecta');
		}
	}
}

// Enviando la respuesta
if ($error[0] === false) {
	echo 'Exito';
} else {
	array_shift($error);
	foreach ($error as $valor) {
		echo $valor;
		echo '|';
	}
}

// EOF
