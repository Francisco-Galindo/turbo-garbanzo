$(window).on("load", function(){
    let numPeticion;
    let peticion;
     /*= $.ajax({
        url: "../dynamics/php/crear_asesoria.php",
        data: {fecha:$("#date").val(), hora:$("#hora").val(), duracion:$("#duracion").val(), tema:$("#tema").val(), materia:$("#materia").val(),
        cupo:$("#cupo").val(), }
    });*/
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
    });
});