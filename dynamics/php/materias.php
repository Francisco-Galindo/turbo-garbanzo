<?php

require 'config.php';
require 'seguridad_y_cripto.php';

define('ACCIONES', array('mostrar_todas', 'mostrar_opciones', 'elegir_materia', 'ver_elegidas'));

/**
 * Imprime checkboxes correspondientes a cada materia que puede dar el usuario
 */
function mostrar_opciones($conexion, $row)
{
        $grado = $row['grado'];
        $consulta = "SELECT id_materia, materia FROM materia
                WHERE grado<='$grado';";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_assoc($resultado)) {
                echo '<label>' . $row['materia'] .
                        '<input name=\'' . 'materias[]' .
                        '\' value=\'' . $row['id_materia'] . '\' type="checkbox">
                </label>';

                echo '<br>';
        }

        return true;
}

function obtener_todas($conexion)
{
        $consulta = "SELECT id_materia, materia FROM materia
                WHERE grado<=6;";
        $resultado = mysqli_query($conexion, $consulta);

        $materias = array();
        while ($row = mysqli_fetch_assoc($resultado)) {
                $materias += [$row['id_materia'] => $row['materia']];
        }

        return json_encode($materias, JSON_UNESCAPED_UNICODE);;
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
                $seriado = $seriado[0];
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

        return json_encode($materias, JSON_UNESCAPED_UNICODE);
        //echo json_encode($materias, JSON_UNESCAPED_UNICODE);
        //return true;
}
/******************************************************************************/


// $_POST['accion'] = 'ver_elegidas';
// $_POST['materias'] = ['1400', '1412'];
session_start();
$conexion = conectar_base();
// Purgando el arreglo $_POST de posibles ataques
$_POST = purgar_arreglo($_POST, $conexion);
$_SESSION = purgar_arreglo($_SESSION, $conexion);
$error = array(false);

$id_usuario = isset($_POST['id_usuario']) ?
        $_POST['id_usuario'] : null;

$accion = isset($_POST['accion']) && in_array($_POST['accion'], ACCIONES) ?
        $_POST['accion'] : null;

if (isset($_POST['materias'])) {
        parse_str($_POST['materias'], $materias);
        $materias = array_values($materias);
        array_pop($materias);
} else {
        $materias = null;
}


if ($accion === null) {
        echo 'Accion inválida';
        mysqli_close($conexion);
        exit(500);
}
if ($accion === 'mostrar_opciones' || $accion === 'elegir_materia') {
        $id_usuario = $_SESSION['id_usuario'];
}

$exito = null;

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
                if (count($materias) >= 2) {
                        $exito = elegir_materia($conexion, $materias, $id_usuario);
                } else {
                        $exito = 'Se necesitan mínimo 2 materias';
                }
        } elseif ($accion == 'ver_elegidas') {
                $exito = ver_materias_del_usuario($conexion, $id_usuario);
        }
        elseif ($accion == 'ver_elegidas') {
                $exito = obtener_todas($conexion);
        }
}


mysqli_close($conexion);
if ($error[0] === false) {
        if ($exito !== true) {
                echo $exito;
        } else if  ($exito && $accion === 'elegir_materia') {
                echo 'Exito';
        }
} else {
        $error[0] = 'Error:';
        foreach ($error as $valor) {
                echo $valor;
                echo '|';
        }
}

// EOF
