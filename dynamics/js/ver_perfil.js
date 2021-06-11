$(document).ready (function(){

        let id_asesoria = window.location.href.split("?").pop();
        console.log(id_asesoria);

        let peticion = $.ajax({
                method: "POST",
                url: "../dynamics/php/ver_perfil.php",
                data: {asesoria:id_asesoria}
            });
            peticion.done(function (resp) {
                let resultado = JSON.parse(resp);
                $('#nombre').html(`<h2>${resultado.nombre} ${resultado.prim_ape} ${resultado.seg_ape}</h2>`);
                $('#cuenta').html(`<h3>${resultado.id_usuario}</h3>`);
                $('#correo').html(`<h3>${resultado.correo}</h3>`);
            });
            peticion.fail(function (resp) {
                console.log(resp);
            })
    
}); 