$(document).ready(function() {

    $("#crear").on("click", function(){
        console.log("click");
        let verifica = [];
        let nombre = $("#name").val();
        let primApe = $("#primApe").val();
        let segApe = $("#segApe").val();
        let noCuenta = $("#nocuenta").val();
        let email = $("#email").val();
        let tel = $("#tel").val();
        let nacimiento = $("#nacimiento").val();
        let grado = $("#grado").val();
        let arch = $("#arch").val();
        let password = $("#password").val();

        console.log(arch);
        console.log(grado);
        console.log(nacimiento);

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



        let peticion= $.ajax({
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
            method:"POST"
        });
        peticion.done(function (resp){
            console.log(resp);
           
        })
        peticion.fail(function(resp){
            console.log("No se realizó la petición :(");
        })
        
    });
   
});