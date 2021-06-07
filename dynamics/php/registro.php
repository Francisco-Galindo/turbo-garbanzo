<?php

require 'config.php';
require 'cripto.php';

$_POST['num_cuenta'] = '320054336';
$_POST['contrasena'] = 'popo';
$contrasena = isset($_POST['contrasena']) && $_POST['contrasena'] != '' ?
	$_POST['contrasena'] : null;
	

$num_cuenta = floatval($_POST['num_cuenta']) === (float)0 ?
	null : floatval($_POST['num_cuenta']);




echo $contrasena;
echo '<br>';
$pimienta = obtener_pimienta();
$sal = obtener_sal();
$hash = hash('sha256', $contrasena . $pimienta . $sal);
echo $hash;
echo '<br>';

echo $num_cuenta;
echo '<br>';
$num_cuenta_cifrado = cifrar_cadena($num_cuenta, $contrasena);
echo $num_cuenta_cifrado;
echo '<br>';
echo strlen($num_cuenta_cifrado);
echo '<br>';


$conexion = conectar_base();
// $consulta = 'SELECT * FROM materia;';
// $resultado = mysqli_query($conexion, $consulta);
// while ($row = mysqli_fetch_array($resultado)) {
// 	echo $row['materia'];
// 	echo '<br>';
// }
mysqli_close($conexion);

// EOF
