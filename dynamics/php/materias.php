<?php

require 'config.php';
require 'seguridad_y_cripto.php';

define('ACCIONES', array('mostrar_opciones', 'elegir_materia', 'ver_elegidas'));

/**
 * Devuelve un JSON de las materias que puede impartir alguien dependiendo de su grado
 */
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

/**
 * Recibe un arreglo de ids de materias y sube a la base de datos que el usuario
 *  puede asesorar sobre el tema.
 */
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

/**
 * Imprime todas las materias que el usuario puede asesorar
 */
function ver_materias_del_usuario($conexion, $id_usuario)
{
        $consulta = "SELECT t1.id_materia, t1.materia FROM materia t1
                INNER JOIN usuario_has_materia t2 ON t1.id_materia=t2.id_materia
                WHERE t2.id_usuario='$id_usuario'";
        $resultado = mysqli_query($conexion, $consulta);

        $materias = array();
        while ($resultado && $row = mysqli_fetch_assoc($resultado)) {
                $materias += [$row['id_materia'] => $row['materia']];
                // echo $row['materia'];
                // echo '<br>';
        }

        echo json_encode($materias, JSON_UNESCAPED_UNICODE);
        return true;
}
/******************************************************************************/


$_POST['accion'] = 'ver_elegidas';
// $_POST['materias'] = ['1400', '1412'];


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
