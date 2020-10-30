$("#m_usuario").addClass("active");
$("#l_usuario").addClass("card");
$("#spinner_btn_registrar").hide();

const buscarUsuario = async(id_usuario) => {
    limpiarCampos();
    const data = new FormData();
    data.append("id_usuario", id_usuario);
    const response = await ajax_function(data, "buscar_usuario");
    if (response.success) {
        const usuario = response.data;
        $("#inputUsuario").val(usuario.id_usuario);
        $("#inputEditNombreUsuario").val(usuario.nombre_usuario);
        $("#inputEditCorreoUsuario").val(usuario.email_usuario);
        $("#inputEditRolUsuario").val(usuario.id_rol);
        $("#inputEditSucursalUsuario").val(usuario.id_sucursal);

        if (usuario.estado_usuario) {
            $("#btn_cambiarEstado_usuario").text("inhabilitar");
            $("#btn_cambiarEstado_usuario").addClass("btn btn-danger");
        } else {
            $("#btn_cambiarEstado_usuario").text("habilitar");
            $("#btn_cambiarEstado_usuario").addClass("btn btn-success");
        }
        //ocultar y mostrar
        $("#form_editar_usuario").show();
    }
    $("#formSpinner").hide();
};

//funcion para ocultar y mostrar constraseñas
const mostrarPassword = (idInput) => {
    var cambio = document.getElementById(idInput);
    if (cambio.type == "password") {
        cambio.type = "text";
        $(".icon").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
    } else {
        cambio.type = "password";
        $(".icon").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
    }
    //CheckBox mostrar contraseña
    $(".ShowPassword").click(function() {
        $(".Password").attr("type", $(this).is(":checked") ? "text" : "password");
    });
};

const limpiarCampos = () => {
    $("#formSpinner").show();
    $("#spinner_btn_editarUsuario").hide();
    $("#form_editar_usuario").hide();
    $("#form_editar_usuario")[0].reset();
    $("#btn_cambiarEstado_usuario").removeClass();
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
    const tablaUsuario = $("#tablaUsuarios").DataTable(lenguaje);

    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursalUsuario");
    cargarSelect("cargar_Sucursales", "inputEditSucursalUsuario");
    //cargar roles (ruta,select)
    cargarSelect("cargar_roles", "inputRolUsuario");
    cargarSelect("cargar_roles", "inputEditRolUsuario");

    (cargarUsuarios = async() => {
        $("#spinner_tablaUsuarios").show();
        const response = await ajax_function(null, "cargar_usuarios");
        if (response.success) {
            $.each(response.data, (i, usuario) => {
                cargarUsuarioEnTabla(usuario);
            });
        }
        $("#spinner_tablaUsuarios").hide();
    })();

    $("#btn_registrar_usuario").click(async() => {
        const nombre = $("#inputNombreUsuario").val();
        const correo = $("#inputCorreoUsuario").val();
        const clave = $("#inputClaveUsuario").val();

        const form = $("#form_registrar_usuario")[0];
        const data = new FormData(form);

        if (nombre.length != 0 && correo.length != 0 && clave.length > 8) {
            $("#btn_registrar_usuario").attr("disabled", true);
            $("#spinner_btn_registrar").show();

            const response = await ajax_function(data, "registrar_usuario");
            if (response) {
                if (response.data) {
                    Swal.fire("Exito", "Usuario creado exitosamente", "success");
                    cargarUsuarioEnTabla(response.data);
                    $("#form_registrar_usuario")[0].reset();
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: response.msg,
                    });
                }
            }
            $("#btn_registrar_usuario").attr("disabled", false);
            $("#spinner_btn_registrar").hide();
        }
    });

    $("#btn_editar_usuario").click(async() => {
        const nombre = $("#inputEditNombreUsuario").val();
        const correo = $("#inputEditCorreoUsuario").val();
        const clave = $("#inputEditClaveUsuario").val();

        const form = $("#form_editar_usuario")[0];
        const data = new FormData(form);
        if (nombre.length != 0 && correo.length != 0) {
            if (clave.length != 0) {
                if (clave.length < 8) {
                    Swal.fire({
                        icon: "warning",
                        title: "la clave debe tener minimo 8 caracteres",
                    });
                    return;
                }
            }
            const response = await ajax_function(data, "editar_usuario");
            if (response.success) {
                Swal.fire("Exito", response.msg, "success");
                $("#modal_editar_usuario").modal("toggle");
                refrescarTabla();
            }
        }
    });

    $("#btn_cambiarEstado_usuario").click(() => {
        const accion = $("#btn_cambiarEstado_usuario").text();
        const id_usuario = $("#inputUsuario").val();

        let config = "";
        if (accion == "inhabilitar") {
            config = {
                title: "esta seguro?",
                text: "esta a punto de desactivar el usuario!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF2E02",
                confirmButtonText: "si, desactivar!",
            };
        } else {
            config = {
                title: "esta seguro?",
                text: "esta a punto de activar el usuario!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#6BDC39",
                confirmButtonText: "si, activar!",
            };
        }
        Swal.fire(config).then(async(result) => {
            if (result.isConfirmed) {
                const data = new FormData();
                data.append("id_usuario", id_usuario);
                data.append("accion", accion);
                const response = await ajax_function(data, "cambiarEstado_usuario");
                if (response.success) {
                    Swal.fire("Exito", response.msg, "success");
                    $("#modal_editar_usuario").modal("toggle");
                    refrescarTabla();
                }
            }
        });
    });

    const refrescarTabla = () => {
        //limpia la tabla
        tablaUsuario.row().clear().draw(false);
        //carga nuevamente
        cargarUsuarios();
    };

    const cargarUsuarioEnTabla = (usuario) => {
        try {
            tablaUsuario.row
                .add([
                    usuario.nombre_usuario,
                    usuario.email_usuario,
                    usuario.role.nombre_rol,
                    usuario.sucursale.nombre_sucursal,
                    formatearFechaHora(usuario.createdAt),
                    usuario.estado_usuario ?
                    "<span class='badge badge-pill badge-success'>ACTIVO </span>" :
                    "<span class='badge badge-pill badge-danger'>INACTIVO</span>",
                    " <button value='" +
                    usuario.id_usuario +
                    "' " +
                    " onclick='buscarUsuario(this.value)'" +
                    " data-toggle='modal' data-target='#modal_editar_usuario' class='btn btn-outline-info'><i class='far fa-edit'></i></button> ",
                ])
                .draw(false);
        } catch (error) {}
    };
});