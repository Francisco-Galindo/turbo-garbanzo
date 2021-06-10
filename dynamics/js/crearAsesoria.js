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

        
        let regexTema=/[A-Za-zñÑá-úÁ-Ú\:\s]{2,70}/;
        let regexLugar=/[A-Za-zñÑá-úÁ-Ú0-9\\_\:\.\-]{2,70}/;

        

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
/*
$("#date").on("change", ()=>{
        numPeticion = 0;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, fecha:$("#date").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#hora").on("change", ()=>{
        numPeticion = 1;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, hora:$("#hora").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#duracion").on("change", ()=>{
        numPeticion = 2;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, duracion:$("#duracion").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#tema").on("change", ()=>{
        numPeticion = 3;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, tema:$("#tema").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#materia").on("change", ()=>{
        numPeticion = 4;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, materia:$("#materia").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#cupo").on("change", ()=>{
        numPeticion = 5;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, cupo:$("#cupo").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#medio").on("change", ()=>{
        numPeticion = 6;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, medio:$("#medio").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#lugar").on("change", ()=>{
        numPeticion = 7;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion, lugar:$("#lugar").val()},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });
    $("#boton").on("click", ()=>{
        numPeticion = 8;
        peticion =$.ajax({
            url: "../dynamics/php/crear_asesoria.php",
            data: {pet:numPeticion},
            method: "POST"
        });
        peticion.done((resp)=>{
            console.log(resp);
        });
        peticion.fail(()=>{
            console.log("Falló la petición al servidor");
        })
    });*/