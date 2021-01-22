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
                                    <input onblur="mayus(this);" maxLength="80" type="text" class="form-control"
                                        id="inputEditNombreUsuario" name="inputEditNombreUsuario" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditCorreoUsuario">correo</label>
                                    <input onblur="mayus(this);" maxLength="80" type="email" class="form-control"
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
                                        <input maxLength="50" minlength="8" type="password" class="form-control"
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