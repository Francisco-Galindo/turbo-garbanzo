<?php

function sal()
{
	return uniqid('', true);
}

function pimienta()
{
	$todo = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');

	$caracteres = array_rand($todo, 2);
	return $todo[$caracteres[0]] . $todo[$caracteres[1]];
}

function verificar_contrasena_sha256($contrasena, $sal, $hash) {
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

// EOF
