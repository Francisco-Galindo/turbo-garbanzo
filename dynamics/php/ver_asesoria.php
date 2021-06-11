<?php
if(isset($_SESSION['id_usuario']))
{
    require_once 'config.php';
    $conexion = conectar_base();
    date_default_timezone_set("America/Mexico_City");
    $id_asesoria = $_POST['asesoria'];
    $consulta = "SELECT nombre, prim_ape, seg_ape, materia, tema, fecha_hora, duracion_simple, cupo, medio_vir, id_usuario FROM usuario INNER JOIN asesoria ON usuario.id_usuario=asesoria.id_usuario INNER JOIN materia ON asesoria.id_materia=materia.id_materia WHERE id_asesoria=$id_asesoria";
    $res = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_array($res)) {
        echo '<table border="1"><thead><tr><th colspan="2">' . $row[0] . ' ' . $row[1] . ' ' . $row[2] . '</th></tr></thead>';
        echo '<tbody><tr><td>Materia</td><td>' . $row[3] . '</td></tr>';
        echo '<tr><td>Tema</td><td>' . $row[4] . '</td></tr>';
        $fecha = explode(' ', $row[5]);
        $fechTim = explode('-', $fecha[0]);
        $horTim = explode(':', $fecha[1]);
        echo '<tr><td>Fecha</td><td>' . $fecha[0] . '</td></tr>';
        $segFech = mktime(intval($horTim[0]), intval($horTim[1]), 0, intval($fechTim[1]), intval($fechTim[2]), intval($fechTim[0]));
        if ($row[6] == true) {
            $segFech += (60 * 50);
        } else {
            $segFech += (60 * 100);
        }
        echo '<tr><td>Horario</td><td>' . $horTim[0] . ':' . $horTim[1] . ' - ' . date("H:i", $segFech) . '</td></tr>';
        $mod = ($row[7] == 1) ? 'Individual' : 'Grupal';
        echo '<tr><td>Modalidad</td><td>' . $mod . '</td></tr>';
        $medio = ($row[8] == "true") ? 'Virtual' : 'Presencial';
        echo '<tr><td>Medio</td><td>' . $medio . '</td></tr>';
        echo '<tr><td>Cupo</td><td>' . $row[8] . '</td></tr></tbody></table><br><br>';
        if($row[9] == $_SESSION['id_usuario']){
            echo '<div id="botones"><a><button>Eliminar asesoria</button></a></div>';
        }else{
            echo '<div id="botones"><a><button>Regresar</button></a><a><button>Inscribirme</button></a></div>'
        }
    }
}

//EOF
