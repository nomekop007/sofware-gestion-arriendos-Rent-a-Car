<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="sofware de arriendo">
    <meta name="author" content="nomekop007">


    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link rel="shortcut icon" href="<?php echo base_route() ?>assets/images/logo3.png">
    <title>Gestino de Arriendos</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>assets/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>assets/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>assets/css/signin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>assets/bootstrap/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <!-- se envia la url del base_url al js -->
    <input id="url" value="<?php echo base_url(); ?>" hidden />
    <form class="form-signin needs-validation" novalidate>
        <img class="mb-4" src="<?php echo base_route(); ?>assets/images/logo.png" alt="" width="100%" height="100%">
        <h1 class="h3 mb-3 font-weight-normal">Plataforma Rentacar</h1>
        <label for="inputEmail" class="sr-only">Correo Electronico</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="correo Electronico" required autofocus>
        <label for="inputclave" class="sr-only">Constraseña</label>
        <input type="password" id="inputclave" class="form-control" placeholder="Constraseña" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recordar
            </label>
        </div>
        <button class="btn btn-dark btn-block btn_login" type="submit" id="btn_login">Iniciar Sesion
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_login"></span>
        </button>
        <p class="mt-5 mb-3 text-muted text-center">Copyright © SAC Grupo Firma</p>
    </form>

</body>

<!-- importaciones -->
<script src="<?php echo base_route(); ?>assets/js/utils/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_route(); ?>assets/js/utils/sweetalert2.all.min.js"></script>


<script>
    $("#spinner_btn_login").hide();

    "use strict";
    window.addEventListener(
        "load",
        function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            let validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            event.preventDefault();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        },
        false
    );


    $(document).ready(() => {
        var base_url = $("#url").val();

        $(".btn_login").click(() => {
            var correo = $("#inputEmail").val();
            var clave = $("#inputclave").val();

            if (correo.length != 0 || clave.length != 0) {
                $("#btn_login").attr("disabled", true);
                $("#spinner_btn_login").show();
                $.ajax({
                    url: base_url + "iniciar_sesion",
                    type: "post",
                    dataType: "json",
                    data: {
                        correo,
                        clave
                    },
                    success: (response) => {
                        if (response.success) {
                            crearSesion(response.usuario);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "inicio de Sesion",
                                text: response.msg,
                            });
                            $("#btn_login").attr("disabled", false);
                            $("#spinner_btn_login").hide();
                            $("#inputclave").val("");
                        }
                    },
                    error: () => {
                        alertError();
                    },
                });
            }
        });

        function crearSesion(usuario) {
            $.ajax({
                url: base_url + "crear_sesion",
                type: "post",
                dataType: "json",
                data: {
                    nombre_usuario: usuario.nombre_usuario,
                    email_usuario: usuario.email_usuario,
                    estado_usuario: usuario.estado_usuario,
                    id_rol: usuario.id_rol,
                    id_usuario: usuario.id_usuario,
                    id_sucursal: usuario.id_sucursal,
                    userToken: usuario.userToken,
                },
                success: (response) => {
                    if (response.msg == "OK") {
                        window.location.href = base_url + "cargar_panel?panel=1";
                    } else {
                        alertError();
                    }
                    $("#btn_login").attr("disabled", false);
                    $("#spinner_btn_login").hide();
                },
                error: (err) => {
                    alertError();
                },
            });
        }

        function alertError() {
            $("#btn_login").attr("disabled", false);
            $("#spinner_btn_login").hide();
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "A ocurrido un Error Contacte a informatica",
            });
        }
    });
</script>

</html>