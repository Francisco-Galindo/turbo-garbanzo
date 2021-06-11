$(document).ready(function() {

    let arch;
    $("#arch").change(function(event) {
        arch = this.files[0];
    })

    $("#crear").on("click", function(evento){

        evento.preventDefault();
        let verifica = [];
        let nombre = $("#name").val();
        let primApe = $("#primApe").val();
        let segApe = $("#primApe").val();
        let email = $("#email").val();
        let tel = $("#tel").val();
        let nacimiento = $("#nacimiento").val();
        let grado = $("#grado").val();
        let arch = $("#arch").val();
        let noCuenta = $("#nocuenta").val();
        let password = $("#password").val();

        console.log(arch);
        console.log(grado);
        console.log(nacimiento);


        //algunas validaciones para crear cuenta
        let regexCorreo= /^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/;




        console.log(nombre);
        let formulario = new FormData();
        formulario.append('nombre', nombre);
        formulario.append('prim_ape', primApe);
        formulario.append('seg_ape', segApe);
        formulario.append('num_cuenta', noCuenta);
        formulario.append('correo', email);
        formulario.append('telefono', tel);
        formulario.append('fecha_nacimiento', nacimiento);
        formulario.append('grado', grado);
        formulario.append('contrasena', password);
        formulario.append('imagen', arch);



        let peticion= $.ajax({
            method:"POST",
            url: "../dynamics/php/registro.php",
            data: {num_cuenta:noCuenta, 
                   contrasena:password,
                   correo: email,
                   grado: grado,
                   telefono: tel,
                   nombre: nombre,
                   prim_ape: primApe,
                   seg_ape: segApe,
                   fecha_nacimiento: nacimiento,
                   imagen: arch
                },
            method:"POST",
            data: formulario,
            cache: false,
            contentType: false,
            processData: false,
        });
        peticion.done(function (resp){
            console.log(resp);
            if (resp == 'Exito') {
                window.location.replace("./materias.html");
            } else {
                $("#boton").after(``);
                $("#boton").after(`<h5 class="text-danger" class="text">${resp}</h5>`);
            }

        });
        peticion.fail(function(resp){
            console.log("No se realizó la petición :(");
            console.log(resp);
            console.log("no")
        });

    });
});
