<?php

require 'config.php';
require 'seguridad_y_cripto.php';


function resolver_noti($conexion, $id_noti)
{
        $consulta = "UPDATE notificacion visto=true WHERE id_notificacion=$id_noti;";
        $resultado = mysqli_query($conexion, $consulta);
}

function accion_formulario($conexion, $id_noti, $arreglo, $id_comentador)
{
        $comentario = $arreglo['comentario'];
        $valoracion = $arreglo['valoracion'];
        if (strlen($comentario) === 0 || ($valoracion < 1 || $valoracion > 5)) {
                return false;
        }
        $usuarios_reportados = $arreglo['usuarios'];
        $razones = $arreglo['razones'];

        foreach ($usuarios_reportados as $id_usuario) {
                $consulta = "SELECT id_usuario FROM usuario
                        WHERE id_usuario='$id_usuario';";
                $resultado = mysqli_query($conexion, $consulta);
                if (mysqli_num_rows($resultado) === 0) {
                        return false;
                }

        }

        foreach ($razones as $id_razon) {
                $consulta = "SELECT id_usuario FROM razon
                        WHERE id_razon='$id_razon';";
                $resultado = mysqli_query($conexion, $consulta);
                if (mysqli_num_rows($resultado) === 0) {
                        return false;
                }

        }

        $consulta = "SELECT t2.id_usuario, t2.id_asesoria FROM notificacion t1
                INNER JOIN asesoria t2 ON t1.id_asesoria=t2.id_asesoria
                WHERE id_notificacion=$id_noti;";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_assoc($resultado);
        $id_asesor = $row['id_usuario'];
        $id_asesoria = $row['id_asesoria'];
        $consulta = "INSERT INTO valoracion
                (id_usuario, id_comentador, id_asesoria, comentario
                calificacion)
                VALUES ('$id_asesor', '$id_comentador', $id_asesoria,
                '$comentario', $valoracion);";

        foreach ($usuarios_reportados as $id_usuario) {
                $consulta = "INSERT INTO reporte (id_usuario, id_asesoria)
                        VALUES ('$id_usuario', $id_asesoria);";
                $resultado = mysqli_query($conexion, $consulta);
                $consulta = "SELECT id_reporte FROM reporte
                        WHERE id_usuario='$id_usuario'
                        AND id_asesoria=$id_asesoria;";
                $resultado = mysqli_query($conexion, $consulta);
                $id_reporte = $row['id_reporte'];

                foreach ($razones as $id_razon) {
                        $consulta = "INSERT INTO reporte_has_razon
                        (id_reporte, id_razon)
                        VALUES ($id_reporte, $id_razon);";
                        $resultado = mysqli_query($conexion, $consulta);
                }

        }

        resolver_noti($conexion, $id_noti);

        return true;
}

function accion_confirmar_asesoria(
        $conexion, 
        $id_noti,
        $arreglo,
        $id_usuario, 
        $id_tipo_noti
)
{
        $id_noti = $arreglo['id_notificacion'];
        $opcion = $arreglo['opcion'];

        $consulta = "SELECT t2.id_asesoria FROM notificacion t1
                INNER JOIN asesoria t2 ON t1.id_asesoria=t2.id_asesoria
                WHERE id_notificacion=$id_noti;";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_assoc($resultado);
        $id_asesoria = $row['id_asesoria'];

        $consulta = "UPDATE asesoria SET confirmada=$opcion
                WHERE id_asesoria=$id_asesoria;";
        $resultado = mysqli_query($conexion, $consulta);

        $consulta = "INSERT INTO notificacion (id_usuario, id_asesoria,
                id_tipo_notificacion)
                VALUES ('$id_usuario', $id_asesoria, $id_tipo_noti);";

        resolver_noti($conexion, $id_noti);

}

function accion_pasar_asistencia($conexion, $id_noti, $arreglo)
{
        $usuarios_asistentes = $arreglo['usuarios'];

        foreach ($usuarios_asistentes as $id_usuario) {
                $consulta = "SELECT id_usuario FROM usuario
                        WHERE id_usuario='$id_usuario';";
                $resultado = mysqli_query($conexion, $consulta);
                if (mysqli_num_rows($resultado) === 0) {
                        return false;
                }
        }

        $consulta = "SELECT t2.id_asesoria FROM notificacion t1
                INNER JOIN asesoria t2 ON t1.id_asesoria=t2.id_asesoria
                WHERE id_notificacion=$id_noti;";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_assoc($resultado);
        $id_asesoria = $row['id_asesoria'];

        $consulta = "SELECT id_usuario FROM asesoria_has_usuario
        WHERE id_asesoria='$id_asesoria';";
        $resultado = mysqli_query($conexion, $consulta);
        while ($row = mysqli_fetch_array($resultado)) {
                $usuario_checado = $row['id_usuario'];
                if (!in_array( $usuario_checado, $usuarios_asistentes)) {
                        $consulta = "UPDATE usuario SET num_faltas=num_faltas+1
                        WHERE id_usuario='$id_usuario';";
                }
        }

        resolver_noti($conexion, $id_noti);
}


$conexion = conectar_base();
$_POST = purgar_arreglo($_POST, $conexion);
$_SESSION = purgar_arreglo($_SESSION, $conexion);

$id_noti = isset($_POST['id_noti']) ? $_POST['id_noti'] : null;
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

$tipos_notificacion = array();
$consulta = "SELECT id_tipo_notificacion, titulo FROM tipo_notificacion";
$resultado = mysqli_query($conexion, $consulta);
while ($row = mysqli_fetch_assoc($resultado)) {
	$tipos_notificacion += [$row['id_tipo_notificacion'] => $row['titulo']];
}


$consulta = "SELECT id_tipo_notificacion FROM notificacion
        WHERE id_notificacion=$id_notificacion
        AND id_usuario='$id_usuario';";

$resultado = mysqli_query($conexion, $consulta);
if (mysqli_num_rows($resultado) === 0) {
        mysqli_close($conexion);
        exit();
}

$row = mysqli_fetch_assoc($resultado);
$tipo_noti = $tipos_notificacion[$id_noti];

if ($tipo_noti === 'valorar') {
        accion_formulario($conexion, $id_noti, $arreglo, $id_comentador);
} elseif ($tipo_noti === 'confirmar_asesoria') {
        accion_confirmar_asesoria($conexion, $id_noti, $arreglo, $id_usuario,
                $id_tipo_noti);
} elseif ($tipo_noti === 'pasar_asistencia') {
        accion_pasar_asistencia($conexion, $id_noti, $arreglo);
} else {
        resolver_noti($conexion, $id_noti);
}

// EOF
