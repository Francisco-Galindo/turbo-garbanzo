<?php
    require_once 'config.php';
    $conexion = conectar_base();
    date_default_timezone_set("America/Mexico_City");
    $id_asesoria = $_POST['asesoria'];
    $consulta = "SELECT (nombre, prim_ape, seg_ape, materia, tema, fecha_hora, duracion_simple, cupo, medio_vir) FROM usuario NATURAL JOIN asesoria NATURAL JOIN materia WHERE id_asesoria=$id_asesoria";
    $res = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_array($res)){
        echo '<table border="1"><thead><tr colspan="2"><th>'$row[1].' '.row[2].' '.row[3].'</th></tr></thead>';
        echo '<tbody><tr><td>Tema</td><td>'.$row[5].'</td></tr>';
        $fecha = explode(' ',$row[6]);
        $fechTim = explode('-', $fecha[0]);
        $horTim = explode(':', $fecha[1]);
        echo '<tr><td>Fecha</td><td>'.$fecha[0].'</td></tr>';
        $segFech = mktime(intval($horTim[0]),intval($horTim[1]),0,intval($fechTim[1]),intval($fechTim[2]),intval($fechTim[0]));
        if(row[7]=="true"){
            $segFech += 60*50;
        }else{
            $segFech += 60*100;
        }
        echo '<tr><td>Horario</td><td>'.$fecha[1].'-'.date("h:i:s", $segFech).'</td></tr>';
        $mod = ($row[8] == 1)?'Individual':'Grupal';
        echo '<tr><td>Modalidad</td><td>'.$mod.'</td></tr>';
        $medio = ($row[9] == "true"):'Virtual':'Presencial';
        echo '<tr><td>Medio</td><td>'.$medio.'</td></tr>';
        echo '<tr><td>Cupo</td><td>'.$row[8].'</td></tr></tbody></table><br><br>';
    }
//EOF