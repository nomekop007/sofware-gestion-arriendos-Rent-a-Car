<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_route(); ?>cargarPanel?panel=1">Gestion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
        </nav>
        <h1 class="h3">Modulo usuarios del sistema</h1>
    </div>
    <div>
        <br>
        <h5>Registrar nuevo usuario</h5>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNombreUsuario">Nombre Completo</label>
                            <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                                id="inputNombreUsuario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCorreoUsuario">correo</label>
                            <input oninput="mayus(this);" maxLength="30" type="email" class="form-control"
                                id="inputCorreoUsuario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputRolUsuario">Rol</label>
                            <select id="inputRolUsuario" class="form-control">

                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputSucursalUsuario">Sucursal</label>
                            <select id="inputSucursalUsuario" class="form-control">
                            </select>
                        </div>
                        <div class=" form-group col-md-4">
                            <label for="inputClaveUsuario">Constraseña</label>
                            <div class="input-group">
                                <input maxLength="30" minlength="8" type="password" class="form-control"
                                    id="inputClaveUsuario" required>
                                <div class="input-group-append">
                                    <button class="btn btn-dark show_password" type="button"
                                        onclick="mostrarPassword('inputClaveUsuario')"> <span
                                            class="fa fa-eye-slash icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-dark" id="btn_registrar_usuario">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_registrar"></span>
                        Registrar Usuario</button>
                </form>
            </div>
        </div>
        <br>
        <br>
        <h5>Usuarios del Sistema</h5>
        <div class="card">
            <div class="card-body">
                <br>
                <!-- contenido -->
                <table id="tablaUsuarios" class="table table-striped table-bordered" style="width:100%">
                    <thead class="btn-dark">
                        <tr>
                            <th>Nombre completo</th>
                            <th>correo Electronico</th>
                            <th>rol</th>
                            <th>sucursal</th>
                            <th>fecha creacion</th>
                            <th>estado</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot class="btn-dark">
                        <tr>
                            <th>Nombre completo</th>
                            <th>correo Electronico</th>
                            <th>rol</th>
                            <th>sucursal</th>
                            <th>fecha creacion</th>
                            <th>estado</th>
                            <th> </th>
                        </tr>
                    </tfoot>
                </table>
                <div class="text-center" id="spinner_tablaUsuarios">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</main>
</div>
</div>




<!-- Modal editar usuario -->
<div class="modal fade" id="modal_editar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="formEditarUsuario" novalidate>
                <input type="text" id="inputUsuario" hidden />
                <div class="modal-body" id="fomUsuario">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEditNombreUsuario">Nombre Completo</label>
                                    <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                                        id="inputEditNombreUsuario" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditCorreoUsuario">correo</label>
                                    <input oninput="mayus(this);" maxLength="30" type="email" class="form-control"
                                        id="inputEditCorreoUsuario" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditRolUsuario">Rol</label>
                                    <select id="inputEditRolUsuario" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditSucursalUsuario">Sucursal</label>
                                    <select id="inputEditSucursalUsuario" class="form-control">
                                    </select>
                                </div>

                                <div class=" form-group col-md-12">
                                    <label for="inputEditClaveUsuario">Cambiar constraseña</label>
                                    <div class="input-group">
                                        <input maxLength="30" minlength="8" type="password" class="form-control"
                                            id="inputEditClaveUsuario">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark show_password" type="button"
                                                onclick="mostrarPassword('inputEditClaveUsuario')"> <span
                                                    class="fa fa-eye-slash icon"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_cambiarEstado_usuario" class="">cambiar estado</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_editar_usuario" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_editarUsuario"></span>
                        Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script>
$("#m_usuario").addClass("active");
$("#l_usuario").addClass("card");
$("#spinner_btn_registrar").hide();

function cargarUsuario(id_usuario) {
    limpiarCampos();
    $.getJSON({
        url: base_route + "buscar_usuario",
        type: "post",
        dataType: "json",
        data: {
            id_usuario
        },
        success: (response) => {
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
                $("#formSpinner").hide();
                $("#formEditarUsuario").show();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Usuario no encontrado",
                });
                $("#formSpinner").show();
                $("#formEditarUsuario").hide();
            }
        },
        error: () => {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "A ocurrido un Error Contacte a informatica",
            });
            $("#formSpinner").show();
            $("#formEditarUsuario").hide();
        },
    });
}

//funcion para ocultar y mostrar constraseñas
function mostrarPassword(idInput) {
    var cambio = document.getElementById(idInput);
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }

    //CheckBox mostrar contraseña
    $('.ShowPassword').click(function() {
        $('.Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
}

function limpiarCampos() {
    $("#formSpinner").show();
    $("#spinner_btn_editarUsuario").hide();
    $("#formEditarUsuario").hide();
    $("#inputUsuario").val("");
    $("#inputEditNombreUsuario").val("");
    $("#inputEditCorreoUsuario").val("");
    $("#inputEditRolUsuario").val("");
    $("#inputEditSucursalUsuario").val("");
    $("#inputEditClaveUsuario").val("");
    $("#btn_cambiarEstado_usuario").removeClass();
}
</script>

<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_usuarios.js"></script>