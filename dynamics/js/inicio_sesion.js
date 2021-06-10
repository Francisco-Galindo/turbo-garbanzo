$(document).ready(function() {

    $("#enviar").on("click", function(){
        console.log("click");
        let cuenta = $("#nocuenta").val();
        let password = $("#password").val();

        //Dos validaciones del form de iniciode sesión
        let reguexCuenta = /^[1-3]\d{9}$/;
        let reguexContrasena = /[\wñÑ_\-\/\.&%$#!?¿¡]{6,20}/;

        var verifica = reguexCuenta.test(cuenta);
        console.log(verifica);
        var verifica2 =  reguexContrasena.test(password);
        console.log(verifica2);

        if((verifica && verifica2 )===true)
        {
            let peticion= $.ajax({
                url: "../dynamics/php/inicio_sesion.php",
                data: {num_cuenta:cuenta, 
                       contrasena:password},
                method:"POST"
            });
            peticion.done(function (resp){
                console.log("Se realizó");
            
            })
            peticion.fail(function(resp){
                console.log("No se realizó la petición");
            })
        }
        else{

            $("#cuerpo").a
        }
        
    });
   
});