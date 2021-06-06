<?php

/**
 * Este es un comentario de bloque
 * De ser posible, guardar los archivos con tipo de indentación en tabuladores
 * Esto se puede realizar dando click en la parte inferior del
 * archivo.
 */

$nombre_variable = 42069;

function get_movies() 
{
	$movies = array();
	// ...

	return $movies;
}
/******************************************************************************/
// El de arriba es un comentario separador

if ($expr1) {
	// if body
} elseif ($expr2) {
	// elseif body
} else {
	// else body
}

if ($expr1) {
	$result1 = true;
} else {
	$result1 = false;
}

if ($expr2) {
	$result2 = true;
}


switch ($expr) {
	case 0:
		echo 'First case, with a break';
		break;

	case 1:
		echo 'Second case, which falls through';
		// no break
	case 2:
	case 3:
	case 4:
		echo 'Third case, return instead of break';
		return;

	default:
		echo 'Default case';
		break;
}

// EOF // Este comentario va al final del archivo, después un enter, no se cierra la etiqueda PHP
