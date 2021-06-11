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
            for (let asesoria in resultado) {
                console.log(resultado[asesoria])
            }

        })
        peticion.fail(function (resp) {
            console.log(resp);
            console.log("no")
        })

    });
});