<?php

define('ROOTUSER', 'root');
define('DBUSER', 'turbogarbanzo');
define('DBHOST', 'localhost');
define('PASSWORD', '');
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
		$conexion = mysqli_connect(DBHOST, ROOTUSER, PASSWORD, DB);
		$consulta = 'CREATE USER \'' . DBUSER .
			'\'@\'localhost\' IDENTIFIED BY \'\'';
		$resultado = mysqli_query($conexion, $consulta);

		$consulta = 'GRANT ALL PRIVILEGES ON ' . DB .
			'.* TO \'' . DBUSER . '\'@\'' . DBHOST . '\';';
		$resultado = mysqli_query($conexion, $consulta);

		$conexion = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
	}

	return $conexion;
}

// EOF
