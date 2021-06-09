<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../statics/img/favicon/favicon.svg" type="image/png">
    <link rel="stylesheet" href="../../libs/bootstrap-5.0.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../libs/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="../../statics/styles/basics.css">
    <link rel="stylesheet" href="../../statics/styles/notifiaciones.css">
    <title>Notificaciones</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="d-flex">
                <a class="navbar-brand" href="#" id="blockNav">
                    <img id="navLogo" src="../statics/img/favicon/favicon.svg" alt="" class="d-inline-block align-text-top">
                </a>
                <a class="navbar-brand" id="titulo" href="#">
                    <h2 id="tituNav" >Asesorías P6</h2>
                </a> 
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=""><i class="fas fa-bell"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="nomUser"><h2 id="nomNav">Nombre del Usuario</h2></a>
                        </li>
        
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=""><i class="far fa-user-circle"></i></a>
                        </li>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </nav>
    <div id="principal">
        <div id="cont">
            <h1 class="tituloSc">Notificaciones</h1>
        </div>
        <div id="notificaciones">

<?php

require 'config.php';
require 'seguridad_y_cripto.php';

function mostrar_noti_aviso_inicio($row)
{
	echo '<div id="aseIni" class="notif">
			<h1 class="tipo">Tu asesoría</h1>
			<h1 class="preg">La fecha de tu asesoría  de'.
			$row['tema'] . ' con ' . $row['nombre'] . $row['prim_ape'].
			'ya llegó.</h1>
			<button type="button" class="submitcarr" 
			name="button">Aceptar</button>
		</div>';
}

function mostrar_noti_aviso_final($row)
{
	echo '<div id="aseFin" class="notif">
			<h1 class="tipo">Tu asesoría</h1>
			<h1 class="preg">Tu asesoría de' .
			$row['tema'] . ' con ' . $row['nombre'] . $row['prim_ape'].
			'ya terminó.</h1>
			<button type="button" class="submitcarr" name="button">Aceptar</button>
		</div>';
}

///////////////////////////////////////////////
function mostrar_noti_final_formulario($row)
{
	echo '<div id="alumTermino" class="notif">
		<h1 class="tipo">Terminó la sesión</h1>
		<h1 class="preg">La asesoría de ' .
		$row['tema'] . ' con ' . $row['nombre'] . $row['prim_ape'].
		'ya ha terminado
			¿Gustas dejar un comentario?</h1>
		    	<textarea name="texto" rows="10" cols="100"></textarea>
		<h1 class="preg">¿Gustas calificar la asesoría?</h1>
		<label>
			<input type="number" id="" min="1" max="5">
		</label>

		<h1 class="preg">¿Algún usuario tuvó un comportamiento inapropiado?</h1>
		<label for= "ResTaco">
		    	<label><input type="checkbox" name="taco5" value="A" 	required>Verde</label>
			<label><input type="checkbox" name="taco5" value="B">Roja</label>
		    	<label><input type="checkbox" name="taco5" value="C">Naranja (de habanero)</label>
		</label>
		<h1 class="preg">¿Cuál fue su falta?</h1>.
		<label for= "ResTaco">
			<label><input type="radio" name ="taco5" value="A" required>Verde</label>
			<label><input type="radio" name ="taco5" value="B">Roja</label>
			<label><input type="radio" name ="taco5" value="C">Naranja (de habanero)</label>
			<label><input type="radio" name ="taco5" value="B">Roja</label>
			<label><input type="radio" name ="taco5" value="C">Naranja (de habanero)</label>
		</label>
		<button type="button" class="submitcarr" name="button">Aceptar</button>
	    </div>';
}

function mostrar_noti_confirmar_asesoria()
{
	echo '<div id="aseSoli" class="notif">
			<h1 class="tipo">Solicitud de asesoría</h1>
			<h1 class="preg">USUARIO esta solicitando una asesoría</h1>
			<div>
			Información de la asesoría:
			</div>
			<label for= "ResTaco">
			<label><input type="radio" name ="taco5" value="A" required>Verde</label>
			<label><input type="radio" name ="taco5" value="B">Roja</label>
			</label>
			<button type="button" class="submitcarr" name="button">Aceptar</button>
		</div>';
}

function mostrar_noti_pasar_asistencia()
{
	echo '<div id="aseTermino" class="notif">
			<h1 class="tipo">Terminó tu sesión</h1>
			<h1 class="preg">¿Quiénes asistieron a la asesoría?</h1>
			<label for= "ResTaco">
			<label><input type="radio" name ="taco5" value="A" required>Verde</label>
			<label><input type="radio" name ="taco5" value="B">Roja</label>
			<label><input type="radio" name ="taco5" value="C">Naranja (de habanero)</label>
			</label>
			<button type="button" class="submitcarr" name="button">Aceptar</button>
		</div>';
}

function mostrar_noti_aviso_strike()
{
	echo '<div id="aseTermino" class="notif">
			<h1 class="tipo">¡Strike!</h1>
			<h1 class="preg">Has recibido un strike</h1>
			<button type="button" class="submitcarr" name="button">Aceptar</button>
		</div>';
}

function mostrar_noti_recibir_confirmacion()
{
	echo '<div id="aseTermino" class="notif">
			<h1 class="tipo">¡Strike!</h1>
			<h1 class="preg">Has recibido un strike</h1>
			<button type="button" class="submitcarr" name="button">Aceptar</button>
		</div>';
}

session_start();
$conexion = conectar_base();
$_SESSION = purgar_arreglo($_SESSION, $conexion);
$id_usuario = $_SESSION['id_usuario'];

$tipos_notificacion = array();
$consulta = "SELECT id_tipo_notificacion, titulo FROM tipo_notificacion";
$resultado = mysqli_query($conexion, $consulta);
while ($row = mysqli_fetch_assoc($resultado)) {
	$tipos_notificacion += [$row['id_tipo_notificacion'] => $row['titulo']];
}

$consulta = "SELECT * FROM notificacion
	WHERE id_usuario='$id_usuario'
	AND visto=false;";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
	$tipo_notificacion = $tipos_notificacion[$row['id_tipo_notificacion']];

	$id_asesoria = $row['id_asesoria'];
	
	$consulta = "SELECT nombre, prim_ape, seg_ape, materia, tema,
	 fecha_hora, duracion_simple, cupo, medio_vir FROM usuario 
	 INNER JOIN asesoria ON usuario.id_usuario=asesoria.id_usuario 
	 INNER JOIN materia ON asesoria.id_materia=materia.id_materia 
	 WHERE id_asesoria=$id_asesoria";
	$resultado_asesoria = mysqli_query($conexion, $consulta);
	$row_asesoria = mysqli_fetch_assoc($resultado_asesoria);


	if ($tipo_notificacion === 'aviso_final')  {
		mostrar_noti_aviso_final($row_asesoria);
	} elseif ($tipo_notificacion === 'aviso_inicio') {
		mostrar_noti_aviso_inicio($row_asesoria);
	} elseif ($tipo_notificacion === 'valorar') {
	} elseif ($tipo_notificacion === 'confirmar_asesoria') {
		mostrar_noti_confirmar_asesoria();
	} elseif ($tipo_notificacion === 'pasar_asistencia') {
		mostrar_noti_pasar_asistencia();
	} elseif ($tipo_notificacion === 'aviso_trike') {
		mostrar_noti_aviso_strike();
	} elseif ($tipo_notificacion === 'recibir_confirmacion') {
		mostrar_noti_recibir_confirmacion();
	}
}

// mostrar_noti_recibir_confirmacion();
// mostrar_noti_aviso_strike();
// mostrar_noti_pasar_asistencia();
// mostrar_noti_confirmar_asesoria();
// EOF

?>

</div>
    <footer>
        <h3>Asesorías P6</h3>
    </footer>

    <script src="../../libs/bootstrap-5.0.1-dist/js/bootstrap.min.js"></script>
</body>
</html>