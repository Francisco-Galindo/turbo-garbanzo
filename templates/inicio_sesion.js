$(document).ready(function() {

    $("#enviar").on("click", function(){
        console.log("click");
        let cuenta = $("#nocuenta").val();
        let password = $("#password").val();
        let peticion= $.ajax({
            url: "../php/inicio_sesion.php",
            data: {num_cuenta:cuenta, contrasena:password},
            method:"POST"
        });
        peticion.done(function (resp){
            console.log(resp);
            
        })
        peticion.fail(function(resp){
            console.log("No se realizó la petición");
        })
        
    });
   
});