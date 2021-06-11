$(document).ready(function() {

    let arch;
    $("#arch").change(function(event) {
        arch = this.files[0];
    })

    $("#crear").on("click", function(evento){

        evento.preventDefault();
        let verifica = [];
        let nombre = $("#name").val();
        let primApe = $("#primApe").val();
        let segApe = $("#primApe").val();
        let email = $("#email").val();
        let tel = $("#tel").val();
        let nacimiento = $("#nacimiento").val();
        let grado = $("#grado").val();
        let arch = $("#arch").val();
        let noCuenta = $("#nocuenta").val();
        let password = $("#password").val();

        console.log(arch);
        console.log(grado);
        console.log(nacimiento);


        //algunas validaciones para crear cuenta
        let regexCorreo= /^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)/;




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
            method:"POST",
            data: formulario,
            cache: false,
            contentType: false,
            processData: false,
        });
        peticion.done(function (resp){
            console.log(resp);
            if (resp == 'Exito') {
                window.location.replace("./materias.html");
            } else {
                $("#boton").after(``);
                $("#boton").after(`<h5 class="text-danger" class="text">${resp}</h5>`);
            }

        });
        peticion.fail(function(resp){
            console.log("No se realizó la petición :(");
            console.log(resp);
            console.log("no")
        });

    });
});
/*
$("#crear").on("click", function (evento) {
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
        let img = $("#arch").val();
        let password = $("#password").val();

        console.log(img, "archivo");
        let y=0;
        //algunas validaciones para crear cuenta
        let regexCorreo = /^[\w\.\-\ñ]{4,20}(\.([\w\.\-]))*@([\w\.\-]+)(\.[\w\.\-]+)$/;
        let regexCuenta = /^[1-3]\d{8}$/;
        let regexNames = /^[A-Za-zñÑá-úÁ-Ú]{2,32}$/;
        let regexTel = /^[1-9][\d]{9}$/;
        let regexContrasena = /^(?=.*[A-ZÑ]+)(?=.*[\W_]+)(?=.*[\d]+)(?=.*[a-zñ]+).{8,}$/;

        let today = new Date();
        let fecha = (today.getFullYear() + "-" + today.getMonth() + "-" + today.getDay());
        console.log("mes", today.getMonth());
        let nacimientomal=true;
        console.log(nacimiento);
        var arrayfecha = fecha.split("-");
        if (nacimiento !== "") {
            var arrayfecha = fecha.split("-");
            var arraynacimiento = nacimiento.split("-")

            if (arrayfecha[0] > arraynacimiento[0]) {
                verifica.push(true);
               
            }
            else if(arrayfecha[1] > arraynacimiento[1]-1 && arrayfecha[0] >= arraynacimiento[0]){
                verifica.push(true);
            }
            /*else if(arrayfecha[2] > arraynacimiento[2] &&arrayfecha[1] == arraynacimiento[1]-1 && arrayfecha[0] >= arraynacimiento[0]){
                verifica.push(true);
                console.log(arrayfecha[2], arraynacimiento[2], "dia");
            }
            else {
                verifica.push(false);
                nacimientomal=false;
            }
        }
        else {
            verifica.push(false);
            nacimientomal=false;
        }
        //console.log(nacimientomal);
        verifica.push(regexCorreo.test(email));
        verifica.push(regexCuenta.test(noCuenta));
        verifica.push(regexNames.test(nombre));
        verifica.push(regexNames.test(primApe));
        verifica.push(regexNames.test(segApe));
        verifica.push(regexTel.test(tel));
        verifica.push(regexContrasena.test(password));

        if (img !== "") {
            let ext = arch.name;
            ext = ext.split(".").pop();
            
            if(ext=="png" || ext=="jpg" ||ext=="jpe")
            {
                console.log(ext);
                console.log("archivo válido");
                verifica.push(true);

            }
            else{
                y=1;
            }
        }

        for (let value of verifica) {

            if (value !== true) {
                contador++;
            }
        }
        console.log("contador", contador);
        if (contador === 0) {
            $(".text-danger").remove();
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
            if(arch!==null)
            {
                formulario.append('imagen', arch);
            }
            
    
    
    
            let peticion = $.ajax({
                method: "POST",
                url: "../dynamics/php/registro.php",
                data: formulario,
                cache: false,
                contentType: false,
                processData: false,
            });
            peticion.done(function (resp) {
                console.log(resp);
                if (resp == 'Exito') {
                    window.location.replace("./materias.html");
                }
    
            })
            peticion.fail(function (resp) {
                console.log(resp);
                console.log("no")
            })

        }
        else {
            //verifica[nacimiento, email, noCuenta, nombe, primApe, segApe, tel, password, arch]
            $(".text-danger").remove();
            $("#boton").after('<p class="text-danger" class="text">Algunos datos introducidos son inválidos, intente de nuevo</p>');
            if(nacimientomal==false|| nacimiento=="")
            {
                $("#boton").after('<h5 class="text-danger" class="text">Fecha de nacimiento inválida</h5>');
            }
            if(regexCorreo.test(email)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Correo Inválido</h5>');
            }
            if(regexCuenta.test(noCuenta)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Cuenta inválida</h5>');
            }
            if(regexNames.test(nombre)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Nombre inválido</h5>');
            }
            if(regexNames.test(primApe)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Primer apellido inválido</h5>');
            }
            if(regexNames.test(segApe)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Segundo apellido inválido</h5>');
            }
            if(regexTel.test(tel)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Teléfono inválido</h5>');
            }
            if(regexContrasena.test(password)==false)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Contraseña inválida</h5>');
            }
            if(y==1)
            {
                $("#boton").after('<h5 class="text-danger" class="text">Fotorafía inválida</h5>');
            }
            
            


          

        }


    });*/
