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
        let segApe = $("#segApe").val();
        let noCuenta = $("#nocuenta").val();
        let email = $("#email").val();
        let tel = $("#tel").val();
        let nacimiento = $("#nacimiento").val();
        let grado = $("#grado").val();
        
        let password = $("#password").val();



        //algunas validaciones para crear cuenta
        let regexCorreo= /^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/;
        let regexCuenta = /^[1-3]\d{8}/;
        let regexNames = /[A-Za-zñÑá-úÁ-Ú]{2,32}/;
        let regexTel = /^[1-9]\d{9}$/;
        let regexImg = /^[A-Za-zá-úÁ-Ú0-9_\-()\/&%$#!¡¿?]{1,50}\.(jpg|png|jpeg)$/;
        let regexContrasena = /[\wñÑ_\-\/\.&%$#!?¿¡]{6,20}/; 

        verifica.push(regexCorreo.test(email));
        verifica.push(regexCuenta.test(noCuenta));
        verifica.push(regexNames.test(nombre));
        verifica.push(regexNames.test(primApe));
        verifica.push(regexNames.test(segApe));
        verifica.push(regexTel.test(tel));
        verifica.push(regexImg.test(arch));
        verifica.push(regexContrasena.test(password));



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
            data: formulario,
            cache: false,
            contentType: false,
            processData: false,
        });
        peticion.done(function (resp){
            console.log(resp);
            window.location.replace("./materias.html");
           
        })
        peticion.fail(function(resp){
            console.log(resp);
            console.log("no")
        })
        
    });
   
});