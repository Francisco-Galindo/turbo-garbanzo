<?php

require 'config.php';
require 'seguridad_y_cripto.php';

define('ACCIONES', array('mostrar_opciones', 'elegir_materia', 'ver_elegidas'));

function mostrar_opciones($conexion, $row, $id_usuario)
{
        $grado = $row['grado'];
        $grado = 6;
        $consulta = "SELECT id_materia, materia FROM materia
                WHERE grado<='$grado';";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_assoc($resultado)) {
                echo '<label>' . $row['materia'] .
                        '<input id=\'' . $row['id_materia'] .
                        '\' value=\'' . $row['id_materia'] . '\' type="checkbox">
                </label>';

                echo '<br>';
        }

        return true;
}


function elegir_materia($conexion, $arreglo, $id_usuario)
{
        $alerta = '';

        $consulta = "DELETE FROM usuario_has_materia
                WHERE id_usuario='$id_usuario'";
        $resultado = mysqli_query($conexion, $consulta);
        foreach ($arreglo as $seriado) {
                $consulta = "INSERT INTO usuario_has_materia
                (id_usuario, id_materia)
                VALUES ('$id_usuario', '$seriado');";
                $resultado = mysqli_query($conexion, $consulta);
                if (!$resultado) {
                        $alerta .= 'No existe una materia con seriado ' . $seriado . '. Se seguirá intentando registrar el resto de materias. | ';
                }
        }
        if ($alerta === '') {
                return true;
        } else {
                return $alerta;
        }
}


function ver_materias_del_usuario($conexion, $id_usuario)
{
        $consulta = "SELECT materia FROM materia t1
                INNER JOIN usuario_has_materia t2 ON t1.id_materia=t2.id_materia
                WHERE t2.id_usuario='$id_usuario'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($resultado && $row = mysqli_fetch_assoc($resultado)) {
                echo $row['materia'];
                echo '<br>';
        }
        return true;
}
/******************************************************************************/


$_POST['id_usuario'] = '9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07';
$_POST['accion'] = 'mostrar_opciones';
$_POST['materias'] = ['1400', '1412'];


$conexion = conectar_base();
// Purgando el arreglo $_POST de posibles ataques
$_POST = purgar_arreglo($_POST, $conexion);
$error = array(false);

$id_usuario = isset($_POST['id_usuario']) && strlen($_POST['id_usuario']) === 64 ?
        $_POST['id_usuario'] : null;

$accion = isset($_POST['accion']) && in_array($_POST['accion'], ACCIONES) ?
        $_POST['accion'] : null;

$materias = isset($_POST['materias']) && is_array($_POST['materias']) ?
        $_POST['materias'] : null;

if ($accion === null || $materias === null) {
        mysqli_close($conexion);
        exit(500);
}

$consulta = "SELECT grado FROM usuario WHERE id_usuario='$id_usuario';";
$resultado = mysqli_query($conexion, $consulta);
if (mysqli_num_rows($resultado) === 0) {
        $error[0] = true;
        array_push($error, 'Usuario inexistente');
} else {
        if ($accion === 'mostrar_opciones') {
                $row = mysqli_fetch_assoc($resultado);
                $exito = mostrar_opciones($conexion, $row, $id_usuario);
        } elseif ($accion === 'elegir_materia' && $materias !== null) {
                $exito = elegir_materia($conexion, $materias, $id_usuario);
        } elseif ($accion == 'ver_elegidas') {
                $exito = ver_materias_del_usuario($conexion, $id_usuario);
        }
        if ($exito === false) {
                $error[0] = true;
                array_push($error, 'Consulta fallida');
        }
        mysqli_close($conexion);
}

if ($error[0] === false) {
        if ($exito !== true) {
                echo 'Advertencia: ';
                echo $exito;
        }
} else {
        $error[0] = 'Error:';
        foreach ($error as $valor) {
                echo $valor;
                echo '|';
        }
}

// EOF
