<?php

define("HASH", "sha256");
define("METODO", "aes-128-cbc");
define("IV_LENGTH", openssl_cipher_iv_length(METODO));

function obtener_sal()
{
	return uniqid('', true);
}

function obtener_pimienta()
{
	$todo = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');

	$caracteres = array_rand($todo, 2);

	return $todo[$caracteres[0]] . $todo[$caracteres[1]];
}

function verificar_contrasena_sha256($contrasena, $sal, $hash)
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

function cifrar_cadena($cadena, $llave)
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

function descifrar_cadena($cadena, $llave)
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

function purgar_arreglo($arreglo, $conexion)
{
	foreach ($arreglo  as $indice => $elemento) {

		$elemento_purgado = htmlspecialchars($elemento);
		$elemento_purgado = mysqli_real_escape_string(
			$conexion,
			$elemento_purgado);
			
		$arreglo[$indice] = $elemento_purgado;
	}

	return $arreglo;
}

// EOF
