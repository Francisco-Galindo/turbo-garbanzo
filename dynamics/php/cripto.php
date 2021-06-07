<?php

define("HASH", "sha256");
define("METODO", "aes-128-cbc");
define("IV_LENGTH", $iv_len = openssl_cipher_iv_length(METODO));
define("IV", $iv = openssl_random_pseudo_bytes($iv_len));

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
	$cifrado = openssl_encrypt(
		$cadena,
		METODO,
		$llave,
		OPENSSL_RAW_DATA,
		IV
	);

	return $cifrado;
}

function descifrar_cadena($cadena, $llave)
{
	$descifrado = openssl_decrypt(
		$cadena,
		METODO,
		$llave,
		OPENSSL_RAW_DATA,
		IV
	);

	return $descifrado;
}

// EOF
