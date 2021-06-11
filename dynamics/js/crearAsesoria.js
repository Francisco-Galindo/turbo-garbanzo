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
            let canvas = document.getElementById("canvas");
            let ctx = canvas.getContext("2d");
            let asesoria = ["Asesor", "Fecha", "Horario", "Duración", "Tema", "Materia", "Cupo", "Medio", "Lugar"];
            function nombreDatos (){
                for(var i=0; i<720; i+=80)
                {
                    ctx.beginPath();
                        ctx.font = "20px Louis George Café";
                        ctx.fillText(asesoria[i/80], canvas.width/3, i+80)
                        ctx.fill();
                    ctx.closePath();

                    ctx.stroke();
                }
                
            }
            function contenedor(){
                ctx.beginPath();
                        ctx.moveTo(canvas.width/3, i+80);
                        ctx.rect(canvas.width/3, i+80, canvas.width/3+40, i+90);
                    
                ctx.closePath();
                ctx.stroke();
            }

            nombreDatos();
            contenedor();
        });

        
    });


    
});
