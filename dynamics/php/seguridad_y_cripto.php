<?php

define("HASH", "sha256");
define("METODO", "aes-128-cbc");
define("IV_LENGTH", openssl_cipher_iv_length(METODO));

/**
 * Devuelve una cadena aleatoria de 23 caracteres.
 */
function obtener_sal()
{
	return uniqid('', true);
}

/**
 * Devuelve una cadena de dos caracteres aleatorios.
 */
function obtener_pimienta()
{
	$todo = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');

	$caracteres = array_rand($todo, 2);

	return $todo[$caracteres[0]] . $todo[$caracteres[1]];
}

/**
 * Verica que una cadena se corresponda con un hash dado.
 * Itera por todas las combinaciones posibles de pimientas para realizar su
 * cometido.
 * Regresa true si la contraseña es correcta. Si no, false.
 */
function verificar_contrasena_sha256(
	string $contrasena,
	string $sal,
	string $hash)
{
	$todo = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');

	for ($i = 0; $i < count($todo); $i++) {
		for ($j = 0; $j < count($todo); $j++) {
			if (hash('sha256', $contrasena . $todo[$i] . $todo[$j] . $sal) === $hash) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Dada una cadena y llave, devuelve un cifrado en base 64.
 */
function cifrar_cadena(string $cadena, string $llave)
{
	$iv = openssl_random_pseudo_bytes(IV_LENGTH);
	$cifrado = openssl_encrypt(
		$cadena,
		METODO,
		$llave,
		0,
		$iv
	);

	return base64_encode($cifrado . '::' . $iv);
}

/**
 * Dada un cifrado hecho por cifrar_cadena() y la llave, devuelve 
 * texto plano.
 */
function descifrar_cadena(string $cadena, string $llave)
{
	$componentes = explode('::', base64_decode($cadena));
	$cifrado = $componentes[0];
	$iv = $componentes[1];

	$descifrado = openssl_decrypt(
		$cifrado,
		METODO,
		$llave,
		0,
		$iv
	);

	return $descifrado;
}

/**
 * Purga un arreglo de posibles ataques XSS o inyecciones SQL.
 * Itera de manera recursiva sobre todo el arreglo dado, 
 * se encarga de escapar los caracteres que podrían ser utilizados para 
 * realizar un ataque XSS o inyecciones SQL.
 * Regresa el arreglo purgado.
 */
function purgar_arreglo(array $arreglo, $conexion)
{
	foreach ($arreglo  as $indice => $elemento) {

		if (is_array($arreglo[$indice])) {
			$elemento_purgado = purgar_arreglo(
				$arreglo[$indice], $conexion);
		} else {
			$elemento_purgado = htmlspecialchars($elemento);
			$elemento_purgado = mysqli_real_escape_string(
				$conexion,
				$elemento_purgado);
		}


		$arreglo[$indice] = $elemento_purgado;
	}

	return $arreglo;
}

// EOF
