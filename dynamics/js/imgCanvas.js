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