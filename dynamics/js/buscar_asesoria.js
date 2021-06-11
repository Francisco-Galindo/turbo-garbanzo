$(document).ready(function () {
    let peticion = $.ajax({
        method: "POST",
        url: "../dynamics/php/busqueda.php",
        data: {modo:"recibir_filtros"},
    });
    peticion.done(function (resp) {
        let info = JSON.parse(resp);
        for (let tipo in info) {
            for (let key in info[tipo]) {
                if (info[tipo][key]['id_materia'] !== undefined) {
                    $("#materia").append(`<option value="${info[tipo][key]['id_materia']}">${info[tipo][key]['abreviacion']}</option>`);
                } else {
                    $("#horario").append(`<option value="${info[tipo][key]['hora']}">${info[tipo][key]['hora']}</option>`);
                }
            }

        }
        let fecha = new Date();
        $("#fecha").attr("min", fecha.getDate());

    })
    peticion.fail(function (resp) {
        console.log(resp);
        console.log("no")
    })

    $("#buscar").on("click", function (evento) {
        evento.preventDefault();

        let fecha = $("#fecha").val();
        let horario = $("#horario").val();
        let materia = $("#materia").val();
        let modalidad = $("#modalidad").val();
        let modoBusqueda = $("#modoBusqueda").val();
        let formulario = new FormData();
        formulario.append('fecha', fecha);
        formulario.append('horario', horario);
        formulario.append('materia', materia);
        formulario.append('modalidad', modalidad);
        formulario.append('modo', modoBusqueda);


        let peticion = $.ajax({
            method: "POST",
            url: "../dynamics/php/busqueda.php",
            data: formulario,
            cache: false,
            contentType: false,
            processData: false,
        });
        peticion.done(function (resp) {
            let resultado = JSON.parse(resp);
            $("#results").html("");
            for (let asesoria in resultado) 
            {
                asesoria_info = resultado[asesoria];
                let duracion = asesoria_info.duracion_simple == 1 ? '50 minutos' : '100 minutos';
                $("#results").append(`<div id="tarjRes"><div id="tarjCont"><div class="nomAses"><h4>Asesor: ${asesoria_info.nombre} ${asesoria_info.prim_ape}</h4></div><div class="fech_hora"><h6>Fecha y hora: ${asesoria_info.fecha_hora}</h6></div><div class="dura"><h4>Duración: ${duracion}</h4></div><div class="mate_tema"><h4>Tema: ${asesoria_info.tema}</h4></div><div class="cupo"><h4>Cupo: ${asesoria_info.cupo}</h4></div></div><a class="mas" href="./datosAsesoria.html?${asesoria_info.tema}">Ver más</a></div>`)
            }
            // console.log(resultado[asesoria]
        });
        peticion.fail(function (resp) {
            console.log(resp);
            console.log("no")
        })

    });
});