<?php

	session_start();
	$arrOpCorr = [false];
	//require ('materias.php');
	require_once ('config.php');
	require_once ('seguridad_y_cripto.php');
	if(!(isset($_SESSION['id_usuario']))){
		header("location: ../../../");
	}
	$conexion = conectar_base();
	$_POST = purgar_arreglo($_POST, $conexion);

	function validaciones($conexion){
		$fecha = (isset($_POST['fecha']) && $_POST['fecha'] !== '')?$_POST['fecha']:null;
		$horario = (isset($_POST['horario']) && $_POST['horario'] !== '')?$_POST['horario']:null;
		$duracion = (isset($_POST['duracion']) && $_POST['duracion'] !== '')?$_POST['duracion']:null;
		$tema = (isset($_POST['tema']) && $_POST['tema'] !== '')?$_POST['tema']:null;
		$materia = (isset($_POST['materia']) && $_POST['materia'] !== '')?$_POST['materia']:null;
		$medio = (isset($_POST['medio']) && $_POST['medio'] !== '')?$_POST['medio']:null;
		$cupo = (isset($_POST['cupo']) && $_POST['cupo'] !== '')?$_POST['cupo']:null;
		$lugar = (isset($_POST['lugar']) && $_POST['lugar'] !== '')?$_POST['lugar']:null;
		$id_usuario = $_SESSION['id_usuario'];

			$arrOpCorr[0] = true;
			$arrOp_Corr[1] = true;
		if($duracion !== null){
			$arrOpCorr[2] = ($duracion==true || $duracion==false)?true:false;
		}
		if($tema !== null){
			$arrOpCorr[3] = (strlen($tema)>=2 && strlen($tema)<=70)?true:false;
		}
		if($materia !== null){
			$consulta = "SELECT t1.id_materia, t1.materia FROM materia t1
			INNER JOIN usuario_has_materia t2 ON t1.id_materia=t2.id_materia
			WHERE t2.id_usuario='$id_usuario'";
			$resultado = mysqli_query($conexion, $consulta);

			$materias = array();
			while ($resultado && $row = mysqli_fetch_assoc($resultado)) {
				$materias += [$row['id_materia'] => $row['materia']];
			// echo $row['materia'];
			// echo '<br>';
			}

			$materiasDisp = $materias;
			foreach($materiasDisp as $key => $value){
				if($materia == $value){
					$arrOpCorr[4] = true;
				}
			}
		}
		var_dump($materiasDisp);
		$arrOpCorr[4] = true;
		if($medio !== null){
			$arrOpCorr[5] = ($medio == true || $medio == false)?true:false;
		}
		if($lugar !== null){
			$arrOpCorr[6] = (strlen($lugar)>=2 && strlen($lugar)<=70)?true:false;
		}
		$arrOpCorr[7] = true;
		foreach($arrOpCorr as $key => $value){
			$arrOpCorr[8] = ($value===true && $arrOpCorr[8]===true)?true:false;
		}
		
	}

	validaciones($conexion);

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



// EOF
