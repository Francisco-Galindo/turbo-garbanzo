$(document).ready(function () {

	let peticion= $.ajax({
		method:"POST",
		url: "../dynamics/php/horarios.php",
		data: {accion:"ver_todos_los_horarios"}
	});
	peticion.done(function (resp){
		$('#horarios').html(resp);
		$('#horarios').append('<button type="submit" name="accion" value="elegir_horario_usuario">Elegir materias</button>')

		// $("#elegir").click(function(evento) {
		// 	evento.preventDefault();
		// 	console.log($('input[name="horarios[]"]').serialize())
		// });
	})
});