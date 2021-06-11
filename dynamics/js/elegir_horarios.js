$(document).ready(function () {

	let peticion= $.ajax({
		method:"POST",
		url: "../dynamics/php/horarios.php",
		data: {accion:"ver_todos_los_horarios"}
	});
	peticion.done(function (resp){
		$('#horarios').html('<br><br><button id="elegir" type="submit" name="accion" value="elegir_horario_usuario">Elegir materias</button>');
		$('#horarios').append(resp);

		$("#elegir").click(function(evento) {
			evento.preventDefault();
			let horariosObjeto = $('input[name="horarios[]"]').serialize();
			let horarios = JSON.stringify(horariosObjeto);
			let peticionGuardado = $.ajax({
				method:"POST",
				url: "../dynamics/php/horarios.php",
				data: {
					accion:"elegir_horario_usuario",
					horarios:horarios
				}
			});
			peticionGuardado.done(function(resp) {
				if (resp == 'Exito') {
					window.location.replace("./sesionActiva.html")
				} else {
					console.log(resp);
				}
			});
		});

	})
});