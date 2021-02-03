<div class="modal fade" id="modal_registrar_empresa" tabindex="-1" aria-labelledby="modal_registrar_empresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_registrar_empresaLabel">Registrar cliente empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate id="form_registrar_empresa">
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label for="inputRutEmpresa">Rut (ejemplo: 12.345.678-9) </label>
                            <input maxLength="12" type="text" type="text" class="form-control" name="inputRutEmpresa" id="rut_empresa_registrar" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputNombreEmpresa">Nombre </label>
                            <input onblur="mayus(this);" maxLength="60" type="text" class="form-control" name="inputNombreEmpresa" id="nombre_empresa_registrar" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputCorreoEmpresa">Correo electronico</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input onblur="mayus(this);" maxLength="60" type="email" class="form-control" name="inputCorreoEmpresa">
                            </div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputDireccionEmpresa">Direccion comercial</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" name="inputDireccionEmpresa">
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputComunaEmpresa">Comuna / region </label>
                            <select class="form-control" name="inputComunaEmpresa" id="inputComunaEmpresaRegistrar">
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputCiudadEmpresa">Ciudad / pueblo </label>
                            <select class="form-control" name="inputCiudadEmpresa" id="inputCiudadEmpresaRegistrar">
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputTelefonoEmpresa">Telefono </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+569</span>
                                </div>
                                <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" name="inputTelefonoEmpresa">
                            </div>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputVigencia">Vigencia</label>
                            <select name="inputVigencia" id="inputVigenciaEmpresaRegistrar" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputRol">Rol o rubro</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" name="inputRol">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                        <button type="submit" class="btn btn-success" id="btn_registrar_empresa">Registrar empresa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>