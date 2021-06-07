<?php
    if(isset($_SESSION['usuario'])){
        include('config.php');
        $conexion = conectar_base();
        $usuario = $_SESSION['usuario'];

        $fecha = explode("-",$_POST['fecha']);
        $hora = explode(":", $_POST['hora']);
        $fechaHora = mktime(intval($hora[0]), intval($hora[1]), 0, intval($fecha[1]), intval($fecha[2]), intval($fecha[0]));
        $duracion = (($_POST['duracion'])=="true")?true:false;
        $tema = $_POST['tema'];
        $materia = $_POST['materia'];
        $cupo = intval($_POST['cupo']);
        $medio = (($_POST['medio'])=="true")?true:false;
        $lugar = $_POST['lugar'];

        $datos_as = 'INSERT INTO asesoria (id_usuario,id_materia,tema,fecha_hora,duracion_simple,cupo,medio_vir,lugar) VALUES ('.$usuario.','.$materia.',"'.$tema.'",'.$fechaHora.','.$duracion.','.$cupo.','.$medio.',"'.$lugar.'")';
        $ins = mysqli_query($conexion, $datos_as);
        ($ins)?echo 'Registro de asesoría exitoso':echo 'Registro fallido';
    } 

// EOF