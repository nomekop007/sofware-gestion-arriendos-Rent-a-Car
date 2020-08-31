$(document).ready(() => {
    var base_url = "http://localhost/proyectos/Rentacar/";

    $("#btn_login").click(() => {
        var correo = $("#inputEmail").val();
        var clave = $("#inputclave").val();

        if (correo.length != 0 || clave.length != 0) {
            $ajax({
                url: base_url + "iniciarSesion",
                type: "post",
                datatype: "json",
                data: {
                    correo,
                    clave,
                },
                succes: (e) => {
                    console.log(e);
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "A ocurrido un Error al registrar vehiculo!",
                    });
                },
            });
        }
    });
});