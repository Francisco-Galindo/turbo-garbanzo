<?php

define('ROOTUSER', 'root');
define('DBUSER', 'turbogarbanzo');
define('DBHOST', 'localhost');
define('PASSWORD', 'el_garbanzo');
define('DB', 'asesorias_p6');

/**
 * Realiza la conexión con la base de datos del proyecto.
 * Trata de conectarse con el usuario creado específicamente para el proyecto.
 * En caso de no existir, lo creará automáticamente.
 * Devuelve la conexión.
 */
function conectar_base()
{
	//Conección con base de datos
	$conexion = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);

	// Si la conexión no pudo ser realizada, creando el usuario necesario
	if (!$conexion) {
		// Se intentó que el usuario para la base de datos de creara automáticamente, pero no salió

		// $conexion = mysqli_connect(DBHOST, ROOTUSER, PASSWORD, DB);
		// $consulta = 'CREATE USER \'' . DBUSER .
		// 	'\'@\'localhost\' IDENTIFIED BY \''.PASSWORD.'\'';
		// $resultado = mysqli_query($conexion, $consulta);

		// $consulta = 'GRANT ALL PRIVILEGES ON ' . DB .
		// 	'.* TO \'' . DBUSER . '\'@\'' . DBHOST . '\'';
		// $resultado = mysqli_query($conexion, $consulta);

		// $conexion = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
	}

return $conexion;
}

// EOF
