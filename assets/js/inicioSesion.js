$(document).ready(() => {
    var base_url = $("#ruta").val();

    $(".btn_login").click(() => {
        var correo = $("#inputEmail").val();
        var clave = $("#inputclave").val();

        if (correo.length != 0 || clave.length != 0) {
            $.ajax({
                url: base_url + "iniciarSesion",
                type: "post",
                dataType: "json",
                data: { correo, clave },
                success: (response) => {
                    if (response.success) {
                        crearSesion(response.usuario);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "inicio de Sesion",
                            text: response.msg,
                        });
                        $("#inputclave").val("");
                    }
                },
                error: () => {

                    /* ----------TEST PRODUCCION--------- */

                    console.log("test error");
                    const userTest = {
                        email_usuario: "ADMIN@GRUPOFIRMA.CL",
                        estado_usuario: true,
                        id_rol: 1,
                        id_sucursal: 1,
                        id_usuario: 1,
                        nombre_usuario: "DIEGO ANTONIO RIOS ROJAS",
                        userToken: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c3VhcmlvSWQiOjEsImNyZWF0ZUF0IjoxNjAzODMwNzg5LCJleHBpcmVkQXQiOjE2MDM4NzM5ODl9.jlSiQT6VC3jxMCtbtBRR3sEwWTnMv8sqpc_nj3gj11g"
                    }
                    crearSesion(userTest);
                    /* ----------TEST PRODUCCION--------- */




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
                    SalertError();
                }
            },
            error: () => {
                alertError();
            },
        });
    }

    function alertError() {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "A ocurrido un Error Contacte a informatica",
        });
    }
});