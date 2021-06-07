<?php

require_once 'config.php';
$conexion = conectar_base();
$perfil = (isset($_POST['usuario']) && $_POST['usuario'] !== "") ? $_POST['usuario'] : "No hay usuario";
if ($perfil !== "No hay usuario") {
    $consulta = 'SELECT (nombre,prim_ape,seg_ape,fecha nacimiento,es_admin,foto) FROM usuario WHERE nombre=' . $perfil;
    $res = mysqli_query($conexion, $consulta);
    while ($row = mysqli_fetch_array($res)) {
        echo 'Nombre: ' . $row[1] . ' ' . $row[2] . ' ' . $row[3] . '<br>';
        echo 'Fecha de nacimiento: ' . $row[4] . '<br>';
        $us = ($row[5] === true) ? 'Administrador' : 'Alumno';
        echo 'Tipo de usuario: ' . $us . '<br>';
        echo $row[6];
    }
}

// EOF
