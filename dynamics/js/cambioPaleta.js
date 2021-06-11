$(document).ready(()=>{
     //Funciones retomadas del Proyecto SAMI, Creador Orginal Alan Mauricio
     /*-----------------------------------*/
    function valCookie(nombreCookie,x) 
    {
        let cookies = document.cookie;
        let arrCookies=cookies.split("; ");

        for(const valor of arrCookies)
        {
            const cookie = valor.split('=');
            if (cookie[0] === nombreCookie)
            {
                if(x==1)
                    return cookie[0];
                else if(x == 2)
                    return cookie[1];
            }
        }
        return null;
    }
    function cambiarColor(){
        let colorAct = valCookie("actual", 2);
        if(valCookie(colorAct, 2).charAt(0) == 'b')
        {
            paletaguardada = 'b';
            $("body").css("backgroundColor", "white"); 
        }
        else if(valCookie(colorAct, 2).charAt(0) == 'n')
        {
            paletaguardada='n';
           $("body").css("backgroundColor", "#242222");
        }
    }
    /*-----------------------------------*/
    var fecha = new Date();
    fecha.setTime(fecha.getTime()+1000*60*60*24*30);

    let user = $("#usuario");
    let submitBtn = $("#submitPalUser");
    let paletaSelec = $("#paleta");
    let estadoPal = 0;
    let paletaguardada='b';
    let stringCookie;

    if(valCookie("actual", 1) == "actual" &&  valCookie("actual", 1) != "")
    {
        user.val(valCookie("actual", 2));
        cambiarColor();
    }
    paletaSelec.on("click",()=>{
        let activa = valCookie("actual", 2);
        if(estadoPal%2 == 0)
        {
            $("body").css("backgroundColor", "white");
            estadoPal++;
            paletaguardada="b";
            if(valCookie(activa, 1)!= null || valCookie(activa, 1)!= "")
            {
                stringCookie = valCookie(activa, 2);
                stringCookie=stringCookie.replace(stringCookie.charAt(0), paletaguardada);
                document.cookie=activa+"="+stringCookie+";expires="+fecha.toGMTString();
            }    
        }
        else
        {
            $("body").css("backgroundColor", "#242222");
            estadoPal++;
            paletaguardada="n";
            if(valCookie(activa, 1)!= null || valCookie(activa, 1)!= "")
            {
                stringCookie = valCookie(activa, 2);
                stringCookie=stringCookie.replace(stringCookie.charAt(0), paletaguardada);
                document.cookie=activa+"="+stringCookie+";expires="+fecha.toGMTString();
            }
        }
        
    });

    submitBtn.click(()=>{
        document.cookie = "actual=" +user.val();
        let nueva= valCookie("actual", 2);
        if(valCookie(nueva,1)== null || valCookie(nueva,1)== ""){
            document.cookie=valCookie("actual", 2)+"="+paletaguardada+";expires="+fecha.toGMTString();
        }
        else{
            cambiarColor();
            stringCookie = valCookie(nueva, 2);
            stringCookie = stringCookie.replace(stringCookie.charAt(0), paletaguardada);
            document.cookie=nueva+"="+stringCookie+";expires="+fecha.toGMTString();
        }
        submitBtn.attr("data-bs-dismiss","modal");
    });
});