<?php

require 'config.php';
require 'seguridad_y_cripto.php';

function resolver_noti($conexion, $arreglo)
{
        $id_noti = $arreglo['id_notificacion'];
        $consulta = "UPDATE notificacion visto=true WHERE id_notificacion=$id_noti;";
        $resultado = mysqli_query($conexion, $consulta);
}

function accion_formulario($conexion, $arreglo, $id_comentador)
{
        $id_noti = $arreglo['id_notificacion'];
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
        return true;
}

function accion_confirmar_asesoria($conexion, $arreglo)
{
        
}

// EOF
