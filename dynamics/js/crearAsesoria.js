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
            console.log("funcionó");
            console.log(resp)
        });

        
    });


    
});
