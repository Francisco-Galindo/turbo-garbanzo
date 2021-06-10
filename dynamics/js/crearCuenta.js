$(document).ready(function() {

    $("#crear").on("click", function(){
        console.log("click");
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


        //algunas validaciones para crear cuenta
        let regexCorreo= /^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/;
        let reguexCuenta = /^[1-3]\d{8}/;
        let reguexNames = /[A-Za-zñÑá-úÁ-Ú]{2,32}/;
        let reguexTel = /^[1-9]\d{9}$/;
        let reguexImg = /^[A-Za-zá-úÁ-Ú0-9_\-()\/&%$#!¡¿?]{1,50}\.(jpg|png|jpeg)$/;
        let reguexContrasena = /[\wñÑ_\-\/\.&%$#!?¿¡]{6,20}/; 


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