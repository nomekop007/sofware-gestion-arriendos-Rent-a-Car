$(document).ready(() => {
    var tablaUsuario = $("#tablaUsuarios").DataTable(lenguaje);

    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursalUsuario");
    cargarSelect("cargar_Sucursales", "inputEditSucursalUsuario");
    //cargar roles (ruta,select)
    cargarSelect("cargar_roles", "inputRolUsuario");
    cargarSelect("cargar_roles", "inputEditRolUsuario");



    //cargar usuarios
    cargarUsuarios();

    function cargarUsuarios() {
        const url = base_route + "cargar_usuarios";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, usuario) => {
                    cargarUsuarioEnTabla(usuario);
                });
            } else {
                console.log("ah ocurrido un error al cargar los usuarios");
            }
        });
    }

    $("#btn_registrar_usuario").click(() => {
        var nombre = $("#inputNombreUsuario").val();
        var correo = $("#inputCorreoUsuario").val();
        var clave = $("#inputClaveUsuario").val();
        var rol = $("#inputRolUsuario").val();
        var sucursal = $("#inputSucursalUsuario").val();

        if (nombre.length != 0 && correo.length != 0 && clave.length > 8) {
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
                        cargarUsuarioEnTabla(e.data);
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


    $("#btn_editar_usuario").click(() => {

        var id_usuario = $("#inputUsuario").val();
        var nombre = $("#inputEditNombreUsuario").val();
        var correo = $("#inputEditCorreoUsuario").val();
        var clave = $("#inputEditClaveUsuario").val();
        var rol = $("#inputEditRolUsuario").val();
        var sucursal = $("#inputEditSucursalUsuario").val();
        if (nombre.length != 0 && correo.length != 0) {
            const usuario = {
                id_usuario,
                nombre,
                correo,
                rol,
                sucursal,
                clave
            };

            if (clave.length != 0) {
                if (clave.length < 8) {
                    Swal.fire({
                        icon: "warning",
                        title: "la clave debe tener minimo 8 caracteres",
                    });
                    return;
                }
            }

            $.ajax({
                url: base_route + "editar_usuario",
                type: "post",
                dataType: "json",
                data: usuario,
                success: (response) => {

                    Swal.fire("Exito", response.msg, "success");
                    $('#modal_editar_usuario').modal('toggle');
                    editarUsuarioEnTabla(response.data);
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "no se actualizo el usuario",
                        text: "A ocurrido un Error Contacte a informatica",
                    });
                }
            });

        }
    });


    function cargarUsuarioEnTabla(usuario) {

        var btnEstado = "";
        if (usuario.estado_usuario == "ACTIVO") {
            btnEstado =
                " <button  onclick='desactivarUsuario(" +
                usuario.id_usuario + "  )' " +
                "  id='cambiar_estado_usuario' class='btn btn-outline-danger'><i class='fas fa-lock'></i></button> "

        } else {
            btnEstado =
                " <button  onclick='activarUsuario(" +
                usuario.id_usuario + "  )' " +
                "  id='cambiar_estado_usuario' class='btn btn-outline-success'><i class='fas fa-unlock-alt'></i></button> "
        }



        tablaUsuario.row
            .add([
                usuario.nombre_usuario,
                usuario.email_usuario,
                usuario.role.nombre_rol,
                usuario.sucursale.nombre_sucursal,
                formatearFecha(usuario.createdAt),
                usuario.estado_usuario,
                " <button  onclick='cargarUsuario(" +
                usuario.id_usuario + "  )' " +
                " data-toggle='modal' data-target='#modal_editar_usuario' class='btn btn-outline-info'><i class='far fa-edit'></i></button> " +
                btnEstado
            ])
            .draw(false);
    }


    //BUSCAR MEJOR SOLUCION PARA EDITAR USUARIO
    function editarUsuarioEnTabla() {
        //limpia la tabla
        tablaUsuario.row()
            .clear()
            .draw(false);

        //carga nuevamente
        cargarUsuarios();
    }

});