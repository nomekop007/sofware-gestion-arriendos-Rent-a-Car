<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1">Gestion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion usuarios del sistema</h1>
    </div>
    <div>
        <br>
        <h5>Registrar nuevo usuario</h5>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" id="form_registrar_usuario" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNombreUsuario">Nombre Completo</label>
                            <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                                id="inputNombreUsuario" name="inputNombreUsuario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCorreoUsuario">correo</label>
                            <input onblur="mayus(this);" maxLength="30" type="email" class="form-control"
                                id="inputCorreoUsuario" name="inputCorreoUsuario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputRolUsuario">Rol</label>
                            <select id="inputRolUsuario" name="inputRolUsuario" class="form-control">

                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputSucursalUsuario">Sucursal</label>
                            <select id="inputSucursalUsuario" name="inputSucursalUsuario" class="form-control">
                            </select>
                        </div>
                        <div class=" form-group col-md-4">
                            <label for="inputClaveUsuario">Constraseña</label>
                            <div class="input-group">
                                <input maxLength="30" minlength="9" type="password" class="form-control"
                                    id="inputClaveUsuario" name="inputClaveUsuario" required>
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
                <div class="scroll">
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
                </div>
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
            <form class="needs-validation" id="form_editar_usuario" novalidate>
                <input type="text" id="inputUsuario" name="inputUsuario" hidden />
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEditNombreUsuario">Nombre Completo</label>
                                    <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                                        id="inputEditNombreUsuario" name="inputEditNombreUsuario" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditCorreoUsuario">correo</label>
                                    <input onblur="mayus(this);" maxLength="30" type="email" class="form-control"
                                        id="inputEditCorreoUsuario" name="inputEditCorreoUsuario" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditRolUsuario">Rol</label>
                                    <select id="inputEditRolUsuario" name="inputEditRolUsuario" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditSucursalUsuario">Sucursal</label>
                                    <select id="inputEditSucursalUsuario" name="inputEditSucursalUsuario"
                                        class="form-control">
                                    </select>
                                </div>

                                <div class=" form-group col-md-12">
                                    <label for="inputEditClaveUsuario">Cambiar constraseña</label>
                                    <div class="input-group">
                                        <input maxLength="30" minlength="8" type="password" class="form-control"
                                            id="inputEditClaveUsuario" name="inputEditClaveUsuario">
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


<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_usuarios.js?v=<?php echo version(); ?>"></script>