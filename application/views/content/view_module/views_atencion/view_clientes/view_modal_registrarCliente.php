<div class="modal fade" id="modal_registrar_cliente" tabindex="-1" aria-labelledby="modal_registrar_clienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_registrar_clienteLabel">Registrar cliente particular</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate id="form_registrar_cliente">
                    <div class="form-row">
                        <div class="form-group col-xl-6">
                            <label for="inputRutCliente">Rut o Pasaporte (ejemplo: 12.345.678-9)</label>
                            <input maxLength="12" type="text" class="form-control" name="inputRutCliente" id="rut_cliente_registrar" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputNacionalidadCliente">Nacionalidad</label>
                            <select name="inputNacionalidadCliente" class="form-control">
                                <option value="CHILENO/A" selected>Chileno/a</option>
                                <option value="EXTRANJERO/A">Extranjero/a</option>
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputNombreCliente">Nombre completo</label>
                            <input onblur="mayus(this);" maxLength="60" type="text" class="form-control" id="nombre_cliente_registrar" name="inputNombreCliente" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputDireccionCliente">Direccion </label>
                            <input onblur="mayus(this);" maxLength="60" type="text" class="form-control" name="inputDireccionCliente">
                        </div>


                        <div class="form-group col-xl-6">
                            <label for="inputFechaNacimiento">Fecha Nacimiento</label>
                            <input type="text" class="form-control input_data" readonly name="inputFechaNacimiento" id="fechaN_cliente_registrar" />
                        </div>

                        <div class="form-group col-xl-6">
                            <label for="inputEstadoCivil">Estado Civil</label>
                            <select name="inputEstadoCivil" id="inputEstadoCivil" class="form-control">
                                <option value="SOLTERO/A" selected>Soltero/a</option>
                                <option value="CASADO/A">Casado/a</option>
                                <option value="VIUDO/A">Viudo/a</option>
                                <option value="DIVORCIADO/A">Divorciado/a</option>
                                <option value="SEPARADO/A">Separado/a</option>
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputComunaCliente">Comuna / region </label>
                            <select class="form-control" name="inputComunaCliente" id="inputComunaClienteRegistrar">
                            </select>
                        </div>

                        <div class="form-group col-xl-6">
                            <label for="inputCiudadCliente">Ciudad / pueblo </label>
                            <select class="form-control" name="inputCiudadCliente" id="inputCiudadClienteRegistrar">
                            </select>
                        </div>


                        <div class="form-group col-xl-6">
                            <label for="inputTelefonoCliente">Telefono </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+569</span>
                                </div>
                                <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" name="inputTelefonoCliente">
                            </div>

                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputCorreoCliente">Correo electronico </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input onblur="mayus(this);" maxLength="50" type="email" class="form-control" name="inputCorreoCliente">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>

                        <button type="submit" class="btn btn-success" id="btn_registrar_cliente">Registrar cliente</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>