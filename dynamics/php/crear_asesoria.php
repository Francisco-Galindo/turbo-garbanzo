<?php
if(isset($_SESSION['id_usuario'])){


	$arrOpCorr = [false];
	session_start();
	require_once ('config.php');
	require_once ('seguridad_y_cripto.php');
	require_once ('materias.php');
	$conexion = conectar_base();
	$_POST = purgar_arreglo($_POST, $conexion);

	function validaciones(){
		$fecha = (isset($_POST['fecha']) && $_POST['fecha'] !== '')?$_POST['fecha']:null;
		$horario = (isset($_POST['horario']) && $_POST['horario'] !== '')?$_POST['horario']:null;
		$duracion = (isset($_POST['duracion']) && $_POST['duracion'] !== '')?$_POST['duracion']:null;
		$tema = (isset($_POST['tema']) && $_POST['tema'] !== '')?$_POST['tema']:null;
		$materia = (isset($_POST['materia']) && $_POST['materia'] !== '')?$_POST['materia']:null;
		$medio = (isset($_POST['medio']) && $_POST['medio'] !== '')?$_POST['medio']:null;
		$cupo = (isset($_POST['cupo']) && $_POST['cupo'] !== '')?$_POST['cupo']:null;
		$lugar = (isset($_POST['lugar']) && $_POST['lugar'] !== '')?$_POST['lugar']:null;
		$usuario = $_SESSION['id_usuario'];

			$arrOpCorr[0] = true;
			$arrOp_Corr[1] = true;
		if(duracion !== null){
			$arrOpCorr[2] = ($duracion=="50 minutos" || $duracion=="100 minutos")?true:false;
		}
		if($tema !== null){
			$arrOpCorr[3] = (strlen($tema)>=2 && strlen($tema)<=70)?true:false;
		}
		if($materia !== null){
			$materiasDisp = ver_materias_del_usuario($conexion, $usuario);
			foreach($materiasDisp as $key => $value){
				if($materia == $value){
					$arrOpCorr[4] = true;
				}
			}
		}
		if($medio !== null){
			$arrOpCorr[5] = ($medio == "Virtual" || $medio == "Presencial")?true:false;
		}
		if($lugar !== null){
			$arrOpCorr[6] = (strlen($lugar)>=2 && strlen($lugar)<=70)?true:false;
		}
		$arrOpCorr[7] = true;
		foreach($arrOpCorr as $key => $value){
			$arrOpCorr[8] = ($value===true && $arrOpCorr[8]===true)?true:false;
		}
		
	}

	validaciones();

	if ($arrOpCorr[8]===true) {
		$usuario = $_SESSION['usuario'];


		$fecha = $_POST['fecha'];
		$hora = $_POST['hora'];
		$fechaHora = $fecha.' '.$hora; 
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
}else{
	header("location: ../../../");
}

// EOF
