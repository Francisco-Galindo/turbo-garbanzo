<?php

require_once 'config.php';
require_once 'cripto.php';

$_POST['id_usuario'] = '320054336';
$_POST['id_usuario'] = floatval($_POST['id_usuario']) === (float)0 ?
	null : floatval($_POST['id_usuario']);



echo $_POST['id_usuario'];
echo '<br>';
$sal = sal();
echo $sal;
echo '<br>';

$conexion = conectar_base();
$consulta = 'SELECT * FROM materia;';
$resultado = mysqli_query($conexion, $consulta);
while ($row = mysqli_fetch_array($resultado)) {
    echo $row['materia'];
    echo '<br>';
}

// EOF
