$(document).ready (function(){
    $("#crear").on("click", function(){
        console.log("click");
        let date = $("#date").val();
        let hora = $("#hora").val();
        let duracion = $("#duracion").val();
        let temaa = $("#tema").val();
        let asignatura = $("#materia").val();
        let place = $("#lugar").val();
        let medioo = $("#medio").val();
        let cupoo = $("#cupo").val();


        
        let regexTema=/[A-Za-zñÑá-úÁ-Ú\:\s]{2,70}/;
        let regexLugar=/[A-Za-zñÑá-úÁ-Ú0-9\\_\:\.\-]{2,70}/;

        /*verifica.push(regexTema.test(email));
        verifica.push(regexLugar.test(noCuenta));
        verifica.push(regexCorreo.test(email));
        verifica.push(regexCuenta.test(noCuenta));*/
     
       
        let peticionHorario= $.ajax({
            method:"POST",
            url: "../dynamics/php/crear_asesoria.php",
            data: {
                fecha: date,
                horario: hora,
                duracion: duracion,
                tema: temaa,
                materia: asignatura,
                medio: medioo,
                cupo: cupoo,
                lugar: place           
            }
        });
        peticionHorario.done(function(resp) {
            console.log("Respuesta");
            console.log(resp);
        });

        

        /*if((verifica && verifica2 )===true)
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
                  
            
        }*/
        
    });


    
});
