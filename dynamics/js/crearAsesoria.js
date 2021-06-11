$(document).ready (function(){
    $("#enviar").on("click", function(){
        console.log("click");
        let fecha = $("#date").val();
        let hora = $("#hora").val();
        let duracion = $("#duracion").val();
        let tema = $("#tema").val();
        let materia = $("#materia").val();
        let lugar = $("#lugar").val();
        let medio = $("#medio").val();


        console.log(cuenta);
        
        let regexTema=/[A-Za-zñÑá-úÁ-Ú]{2,70}/;
        let regexLugar=/[A-Za-zñÑá-úÁ-Ú]{2,70}/;

        

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
