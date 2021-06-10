<?php
$arrOpCorr = array();
function validaciones($numPet){
	if($numPet == 0){
		
		$arrOpCorr[0] = true;
	}else if($numPet == 1){
		
		$arrOpCorr[1] = true;
	}else if($numPet == 2){
		$arrOpCorr[2] = true;
	}else if($numPet == 3){
		$arrOpCorr[3] = true;
	}else if($numPet == 4){
		$arrOpCorr[4] = true;
	}else if($numPet == 5){
		$arrOpCorr[5] = true;
	}else if($numPet == 6){
		$arrOpCorr[6] = true;
	}else if($numPet == 7){
		$arrOpCorr[7] = true;
	}else if($numPet == 8){
		foreach($arrOpCorr as $key => $value){
			$arrOpCorr[8] = ($value===true && $arrOpCorr[8]===true)?true:false;
		}
	}
	return $res;
}

$_SESSION['usuario'] = '9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07';
/*$_POST['fecha'] = "2021-05-05";
$_POST['hora'] = "19:05";
$_POST['duracion'] = "true";
$_POST['tema'] = "Funciones cuadráticas";
$_POST['materia'] = "1500";
$_POST['cupo'] = "2";
$_POST['medio'] = "true";
$_POST['lugar'] = "Escuela Nacional Preparatoria Plantel 6 Antonio Caso";*/

$peticion = $_POST['pet'];

$valor = validaciones($peticion);

if (isset($_SESSION['usuario']) && $arrOpCorr[8]===true) {
	include('config.php');
	$conexion = conectar_base();
	$usuario = $_SESSION['usuario'];


	$fecha = $_POST['fecha'];
	//explode("-", $_POST['fecha']);
	$hora = $_POST['hora'];
	//explode(":", $_POST['hora']);
	$fechaHora = $fecha.' '.$hora; 
	//$fechaHora = mktime(intval($hora[0]), intval($hora[1]), 0, intval($fecha[1]), intval($fecha[2]), intval($fecha[0]));
	$duracion = (($_POST['duracion']) == "true") ? true : false;
	$tema = $_POST['tema'];
	$materia = $_POST['materia'];
	$cupo = intval($_POST['cupo']);
	$medio = (($_POST['medio']) == "true") ? true : false;
	$lugar = $_POST['lugar'];

	$datos_as = "INSERT INTO asesoria (id_usuario,id_materia,tema,fecha_hora,duracion_simple,cupo,medio_vir,lugar) VALUES ('$usuario', '$materia','$tema','$fechaHora','$duracion','$cupo','$medio','$lugar')";

	$ins = mysqli_query($conexion, $datos_as);
	if ($ins) {  
		echo 'Registro de asesoría exitoso';
	} else {
		echo 'Registro fallido';
	}
}

// EOF
