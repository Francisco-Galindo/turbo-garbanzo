<?php
    if(isset($_SESSION['usuario'])){
        include('config.php');
        $conexion = conectar_base();
        $usuario = $_SESSION['usuario'];

        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $duracion = $_POST['duracion'];
        $tema = $_POST['tema'];
        $materia = $_POST['materia'];
        $cupo = $_POST[''];
        $datos_as = 'INSERT INTO asesoria (id_usuario,id_materia,tema,fecha_hora,duracion_simple,cupo,medio_vir,lugar) VALUES (';
    } 
?>