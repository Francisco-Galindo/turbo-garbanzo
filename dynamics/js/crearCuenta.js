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