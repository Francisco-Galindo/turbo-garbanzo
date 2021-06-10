$(document).ready(function () {

	let peticion= $.ajax({
		method:"POST",
		url: "../dynamics/php/materias.php",
		data: {accion:"mostrar_opciones", usuario:"self"}
	});
	peticion.done(function (resp){
                console.log(resp);
		$('#materias').append(resp);
		$('#materias').append('<button id="elegir" type="submit" name="accion" value="elegir_horario_usuario">Elegir materias</button>')

		$("#elegir").click(function(evento) {
			evento.preventDefault();
			let materiasObjeto = $('input[name="materias[]"').serialize();
			let materias = JSON.stringify(materiasObjeto);
			let peticionGuardado = $.ajax({
				method:"POST",
				url: "../dynamics/php/materias.php",
				data: {
					accion:"elegir_materia",
					materias:materias
				}
			});
			peticionGuardado.done(function(resp) {
				if (resp == 'Exito') {
					window.location.replace("./horarios.html")
				} else {
					console.log(resp);
				}
			});
		});

	})
});