$(document).ready(function() {

    let arch;
    $("#arch").change(function(event) {
        arch = this.files[0];
    })

    $("#crear").on("click", function(evento){
        let contador = 0;
        console.log("click");
        evento.preventDefault();
        let verifica = [];
        let nombre = $("#name").val();
        let primApe = $("#primApe").val();
        let segApe = $("#segApe").val();
        let noCuenta = $("#nocuenta").val();
        let email = $("#email").val();
        let tel = $("#tel").val();
        let nacimiento = $("#nacimiento").val();
        let grado = $("#grado").val();
        let img = $("#arch").val();;
        let password = $("#password").val();

        console.log(img, "archivo");

        //algunas validaciones para crear cuenta
        let regexCorreo= /^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/;
        let regexCuenta = /^[1-3]\d{8}/;
        let regexNames = /[A-Za-zñÑá-úÁ-Ú]{2,32}/;
        let regexTel = /^[1-9]\d{9}$/;
        let regexImg = /^[A-Za-zá-úÁ-Ú0-9_\-\(\)\/&%$#!¡¿?\:\\]{1,50}\.(jpg|png|jpeg)$/;
        let regexContrasena = /[\wñÑ_\-\/\.&%$#!?¿¡]{6,20}/; 
        
        let today = new Date();
        let fecha = (today.getFullYear()+"-"+today.getMonth()+"-"+today.getDay());   
        
        
        var arrayfecha= fecha.split("-");
        if(nacimiento!=="")
        {
            var arrayfecha= fecha.split("-");
            var arraynacimiento= nacimiento.split("-")
          
            if(arrayfecha[0]>arraynacimiento[0])
            {
                verifica.push(true);
            }
            else{
                verifica.push(false);
            }
        }
        else{
            verifica.push(false);
        }
        
        verifica.push(regexCorreo.test(email));
        verifica.push(regexCuenta.test(noCuenta));
        verifica.push(regexNames.test(nombre));
        verifica.push(regexNames.test(primApe));
        verifica.push(regexNames.test(segApe));
        verifica.push(regexTel.test(tel));
        verifica.push(regexContrasena.test(password));

        if(img!==""){
            verifica.push(regexImg.test(img));
            console.log(verifica[8], "img");
        }

        for(let value of verifica){
            
            if(value !==true)
            {
                contador++;
            }
        }
        console.log("contador", contador);
        if(contador===0)
        {
            $(".text-danger").remove();
            let peticion= $.ajax({
                url: "../dynamics/php/registro.php",
                data: {num_cuenta:noCuenta, 
                       contrasena:password,
                       correo: email,
                       grado: grado,
                       telefono: tel,
                       nombre: nombre,
                       prim_ape: primApe,
                       seg_ape: segApe,
                       fecha_nacimiento: nacimiento,
                       imagen: arch
                    },
                method:"POST"
            });
            peticion.done(function (resp){
                console.log("Se hizo correctamente la petición");
                //redireccionar
               
            })
            peticion.fail(function(resp){
                console.log("No se realizó la petición :(");
            })
            
        }
        else{
            //verifica[nacimiento, email, noCuenta, nombe, primApe, segApe, tel, password, arch]
            $(".text-danger").remove();
            $("#boton").before('<p class="text-danger" class="text">Algunos datos introducidos son inválidos, intente de nuevo</p>');

        }


        console.log(nombre);
        let formulario = new FormData();
        formulario.append('nombre', nombre);
        formulario.append('prim_ape', primApe);
        formulario.append('seg_ape', segApe);
        formulario.append('num_cuenta', noCuenta);
        formulario.append('correo', email);
        formulario.append('telefono', tel);
        formulario.append('fecha_nacimiento', nacimiento);
        formulario.append('grado', grado);
        formulario.append('contrasena', password);
        formulario.append('imagen', arch);



        let peticion= $.ajax({
            method:"POST",
            url: "../dynamics/php/registro.php",
            data: formulario,
            cache: false,
            contentType: false,
            processData: false,
        });
        peticion.done(function (resp){
            console.log(resp);
            window.location.replace("./materias.html");
           
        })
        peticion.fail(function(resp){
            console.log(resp);
            console.log("no")
        })
        

       
       
    });
});