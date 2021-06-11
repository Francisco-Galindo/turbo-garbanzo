$(document).ready(function () {
    let z = 0;
    $("#enviar").on("click", function () {
        console.log("click");
        let cuenta = $("#nocuenta").val();
        let password = $("#password").val();

        let regexCuenta = /^[\d]{9}$/;
        let contra = password.replace(/<[^>]+>/g, '');
        var verifica = regexCuenta.test(cuenta);

        if ((verifica == true)) {
            $(".text-danger").remove();
            let peticion = $.ajax({
                url: "../dynamics/php/inicio_sesion.php",
                data: {
                    num_cuenta: cuenta,
                    contrasena: contra
                },
                method: "POST"
            });
            peticion.done(function (resp) {
                if (resp == 'Exito') {
                    window.location.replace("./sesionActiva.html")
                } else {
                    console.log(resp);
                }

            })
            peticion.fail(function (resp) {
                console.log("No se realizó la petición");
            })
        }
        else {
            $(".text-danger").remove();
            if (verifica !== true) {
                if (cuenta === "") {
                    $("#nocuenta").after('<p class="text-danger" class="text">Este campo es obligatorio</p>');
                    $(".espacio").remove();
                }
                else {
                    $("#nocuenta").after('<p class="text-danger" class="text">Número de cuenta inválido</p>');
                }
            }



        }

    });

});