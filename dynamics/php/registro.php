<?php

require_once 'config.php';
require_once 'cripto.php';

$_POST['contrasena'] = 'popo';
$contrasena = isset($_POST['contrasena']) && $_POST['contrasena'] != '' ?
	$_POST['contrasena'] : null;
	
$_POST['num_cuenta'] = '320054336';
$num_cuenta = floatval($_POST['num_cuenta']) === (float)0 ?
	null : floatval($_POST['num_cuenta']);



echo $num_cuenta;
echo '<br>';
echo $contrasena;
echo '<br>';
$pimienta = pimienta();
$sal = sal();
$hash = hash('sha256', $contrasena . $pimienta . $sal);


// $intento = 'popo';
// echo $intento;
// echo '<br>';

// if (verificar_contrasena_sha256($intento, $sal, $hash)) {
// 	echo 'Correcto';
// } else {
// 	echo "Incorrecto";
// }
// echo '<br>';

$conexion = conectar_base();
$consulta = 'SELECT * FROM materia;';
$resultado = mysqli_query($conexion, $consulta);
while ($row = mysqli_fetch_array($resultado)) {
	echo $row['materia'];
	echo '<br>';
}
mysqli_close($conexion);

// EOF
