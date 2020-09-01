$(document).ready(() => {
    var base_route = $("#ruta").val();

    $(".btn_login").click((e) => {
        e.preventDefault();

        var correo = $("#inputEmail").val();
        var clave = $("#inputclave").val();

        if (correo.length != 0 || clave.length != 0) {
            $.ajax({
                url: base_route + "iniciarSesion",
                type: "post",
                datatype: "json",
                data: {
                    correo,
                    clave,
                },
                success: (e) => {
                    var response = JSON.parse(e);

                    if (response.success) {
                        irPlataforma(response.usuario);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.msg,
                        });
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "A ocurrido un Error",
                    });
                },
            });
        }
    });

    function irPlataforma(usuario) {
        $.ajax({
            url: base_route + "irPlataforma",
            type: "post",
            datatype: "json",
            data: {
                nombre_usuario: usuario.nombre_usuario,
                email_usuario: usuario.email_usuario,
                id_rol: usuario.id_rol,
                userToken: usuario.userToken,
            },
            success: (e) => {
                var response = JSON.parse(e);
                if (response.msg == "OK") {
                    window.location.href = base_route + "cargarPanelGestion";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "A ocurrido un Error Intente mas Tarde",
                    });
                }
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "A ocurrido un Error Intente mas Tarde",
                });
            },
        });
    }
});