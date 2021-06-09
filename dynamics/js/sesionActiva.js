window.addEventListener('load', ()=>{
    let fleDer = document.getElementById("der");
    let fleIz = document.getElementById("iz");
    const fecha = new Date();
    let mes = fecha.getMonth();
    let anio = fecha.getFullYear();
    let pet = $.ajax({
        url: "../dynamics/php/calendario.php",
        data: {mes:mes, anio:anio},
        method: "POST"
    });
    pet.done(function(resp){
        $("#fecha").html(resp);
    });
    pet.fail(function(){
        console.log("Falló la petición");
    });

    fleIz.addEventListener('click',()=>{        
        mes--;
        if(mes==-1){
            mes = 11;
            anio--;
        }
        pet = $.ajax({
            url: "../dynamics/php/calendario.php",
            data: {mes:mes, anio:anio},
            method: "POST"
        });
        pet.done(function(resp){
            $("#fecha").html(resp);
        });
        pet.fail(function(){
            console.log("Falló la petición");
        });
    });
    fleDer.addEventListener('click',()=>{
        mes++;
        if(mes==12){
            mes = 0;
            anio++;
        }
        pet = $.ajax({
            url: "../dynamics/php/calendario.php",
            data: {mes:mes, anio:anio},
            method: "POST"
        });
        pet.done(function(resp){
            $("#fecha").html(resp);
            console.log(resp);
        });
        pet.fail(function(){
            console.log("Falló la petición");
        });
    });
});