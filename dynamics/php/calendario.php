<?php
    date_default_timezone_set("America/Mexico_City");
    if(!(isset($_POST['mes'])) && !(isset($_POST['anio']))){
        $mes = intval(date("m"));
        $anio = intval(date("Y"));
    }else{
        $mes = $_POST['mes']+1;
        $anio = $_POST['anio'];
    };
    $días = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
    

 //EOF