$(document).ready(() => {
    var tablaUsuario = $("#tablaUsuarios").DataTable(lenguaje);

    //cargar sucursales
    (() => {
        const url = base_route + "cargar_Sucursales";
        const select = document.getElementById("inputSucursalUsuario");
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    const option = document.createElement("option");
                    option.innerHTML = o.nombre_sucursal;
                    option.value = o.id_sucursal;
                    select.appendChild(option);
                });
            } else {
                console.log("ah ocurrido un error al cargar");
            }
        });
    })();

    //cargar roles
    (() => {
        const url = base_route + "cargar_roles";
        const select = document.getElementById("inputRolUsuario");
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    const option = document.createElement("option");
                    option.innerHTML = o.nombre_rol;
                    option.value = o.id_rol;
                    select.appendChild(option);
                });
            } else {
                console.log("ah ocurrido un error al cargar");
            }
        });
    })();

    //cargar usuarios
    (() => {
        const url = base_route + "cargar_usuarios";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    tablaUsuario.row
                        .add([
                            o.nombre_usuario,
                            o.email_usuario,
                            o.role.nombre_rol,
                            o.sucursale.nombre_sucursal,
                            formatearFecha(o.createdAt),
                            "<button data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-edit'></i></button>",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar conductor");
            }
        });
    })();

    $("#btn_registrar_usuario").click(() => {
        var nombre = $("#inputNombreUsuario").val();
        var correo = $("#inputCorreoUsuario").val();
        var clave = $("#inputClaveUsuario").val();
        var rol = $("#inputRolUsuario").val();
        var sucursal = $("#inputSucursalUsuario").val();

        if (nombre.length != 0 && correo.length != 0 && clave.length != 0) {
            $("#btn_registrar_usuario").attr("disabled", true);
            $("#spinner_btn_registrar").show();
            $.ajax({
                url: base_route + "registrar_usuario",
                type: "post",
                dataType: "json",
                data: { nombre, correo, clave, rol, sucursal },
                success: (e) => {
                    if (e.success) {
                        Swal.fire("Exito", "Usuario creado exitosamente", "success");
                        cargarUsuarioEnTabla(e.data[0]);
                        $("#inputNombreUsuario").val("");
                        $("#inputCorreoUsuario").val("");
                        $("#inputClaveUsuario").val("");
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: e.msg,
                        });
                    }
                    $("#btn_registrar_usuario").attr("disabled", false);
                    $("#spinner_btn_registrar").hide();
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "no se guardo el usuario",
                        text: "A ocurrido un Error Contacte a informatica",
                    });
                    $("#btn_registrar_usuario").attr("disabled", false);
                    $("#spinner_btn_registrar").hide();
                },
            });
        }
    });

    function cargarUsuarioEnTabla(usuario) {
        tablaUsuario.row
            .add([
                usuario.nombre_usuario,
                usuario.email_usuario,
                usuario.role.nombre_rol,
                usuario.sucursale.nombre_sucursal,
                formatearFecha(usuario.createdAt),
                "<button data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-edit'></i></button>",
            ])
            .draw(false);
    }
});