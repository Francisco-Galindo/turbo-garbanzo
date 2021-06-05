<?php

define('ROOTUSER', 'root');
define('DBUSER', 'turbogarbanzo');
define('DBHOST', 'localhost');
define('PASSWORD', '');
define('DB', 'asesorias_p6');

//Funcion para conectar con base de datos
function conectar_base() {
	//Conección con base de datos
	$conexion = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
	if (!$conexion) {
		$usuario = DBUSER;
		$conexion = mysqli_connect(DBHOST, ROOTUSER, PASSWORD, DB);
		$consulta = 'CREATE USER \'$usuario\'@\'localhost\' IDENTIFIED BY \'\'';
		$resultado = mysqli_query($conexion, $consulta);

		$tablas = ['autor', 'editorial', 'genero'];
		foreach ($tablas as $tabla) {
			$consulta = 'GRANT SELECT, INSERT ON biblioteca.' .
			$tabla . ' TO  \'$usuario\'@\'localhost\'';
			$resultado = mysqli_query($conexion, $consulta);
		}

		$tablas = ['formulario', 'historial_descargas', 'reporte', 'libro_has_genero'];
		foreach ($tablas as $tabla) {
			$consulta = 'GRANT SELECT, INSERT, DELETE ON biblioteca.' . 
			$tabla . ' TO  \'$usuario\'@\'localhost\'';
			$resultado = mysqli_query($conexion, $consulta);
		}

		$tablas = ['libro'];
		foreach ($tablas as $tabla) {
			$consulta = 'GRANT SELECT, INSERT, UPDATE, DELETE ON biblioteca.' . $tabla . ' TO  \'$usuario\'@\'localhost\'';
			$resultado = mysqli_query($conexion, $consulta);
		}

		$tablas = ['usuario', 'tipo_usuario', 'categoria', 'historial_descargas'];
		foreach ($tablas as $tabla) {
			$consulta = 'GRANT SELECT ON biblioteca.' . $tabla . ' TO  \'$usuario\'@\'localhost\'';
			$resultado = mysqli_query($conexion, $consulta);
		}

		$consulta = 'GRANT SELECT, INSERT, DELETE ON biblioteca.usuario TO  \'$usuario\'@\'localhost\'';
		$resultado = mysqli_query($conexion, $consulta);
		$consulta = 'GRANT SELECT, INSERT, DELETE ON biblioteca.favorito TO  \'$usuario\'@\'localhost\'';
		$resultado = mysqli_query($conexion, $consulta);
		mysqli_close($conexion);


		$conexion = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
	}
}

return $conexion;

// EOF
