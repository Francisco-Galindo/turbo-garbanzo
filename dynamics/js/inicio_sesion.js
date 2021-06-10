$(document).ready(function() {
    let z = 0;
    $("#enviar").on("click", function(){
        console.log("click");
        let cuenta = $("#nocuenta").val();
        let password = $("#password").val();

        console.log(cuenta);
        
        let reguexCuenta = /^[1-3]\d{8}$/;
        let reguexContrasena = /[\wñÑ_\-\/\.&%$#!?¿¡]{6,20}/;

        var verifica = reguexCuenta.test(cuenta);
        console.log(verifica);
        var verifica2 =  reguexContrasena.test(password);
        console.log(verifica2);

        if((verifica && verifica2 )===true)
        {
            $(".text-danger").remove();
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
            $(".text-danger").remove();
            $(".espacio").remove();
            if(verifica!==true)
            {
                if(cuenta==="")
                {
                    $("#nocuenta").after('<p class="text-danger" class="text">Este campo es obligatorio</p>');
                    $(".espacio").remove();
                }
                else{
                    $("#nocuenta").after('<p class="text-danger" class="text">Número de cuenta inválido</p>');
                }
            }
            if(verifica2!==true)
            {
                if(password==="")
                {
                    $("#password").after('<p class="text-danger" class="text">Este campo es obligatorio</p>');
                }
                else{ 
                    $("#password").after('<p class="text-danger" class="text">Contraseña inválida</p>');
                }
            
            }
        z++;     
                  
            
        }
        
    });
   
});