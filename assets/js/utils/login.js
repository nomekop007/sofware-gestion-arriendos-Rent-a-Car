$("#spinner_btn_login").hide();

"use strict";
window.addEventListener(
    "load",
    function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        let forms = document.getElementsByClassName("needs-validation");
        // Loop over them and prevent submission
        let validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener(
                "submit",
                function (event) {
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