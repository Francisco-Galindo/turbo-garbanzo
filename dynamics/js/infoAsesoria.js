$(document).ready (function(){

        let id_asesoria = window.location.href.split("?").pop();
        console.log(id_asesoria);

        let peticion = $.ajax({
                method: "POST",
                url: "../dynamics/php/ver_asesoria.php",
                data: {asesoria:id_asesoria}
            });
            peticion.done(function (resp) {
                let resultado = resp;
                $("#cuerpo").html(resultado);
            });
            peticion.fail(function (resp) {
                console.log(resp);
                console.log("no")
            })
    
}); 