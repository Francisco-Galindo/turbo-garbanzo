<?php
    $consNotiAs = "SELECT id_asesoria FROM asesoria_has_usuario INNER JOIN ";
    $consulta = "SELECT nombre, prim_ape, seg_ape FROM usuario INNER JOIN asesoria_has_usuario ON usuario.id_usuario=asesoria_has_usuario.id_usuario WHERE "    
 //EOF