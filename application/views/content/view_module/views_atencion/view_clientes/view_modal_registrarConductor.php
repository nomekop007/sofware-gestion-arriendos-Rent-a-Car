<div class="modal fade" id="modal_registrar_conductor" tabindex="-1" aria-labelledby="modal_registrar_conductorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_registrar_conductorLabel">Registrar conductor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate id="form_registrar_conductor">
                    <div class="form-row">
                        <div class="form-group  col-xl-6">
                            <label for="inputRutConductor">Rut (ejemplo: 12.345.678-9)</label>
                            <input type="text" class="form-control" maxLength="12" type="text" id="rut_conductor_registrar" name="inputRutConductor" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputNacionalidadConductor">Nacionalidad</label>
                            <select name="inputNacionalidadConductor" class="form-control">
                                <option value="CHILENO/A" selected>Chileno/a</option>
                                <option value="EXTRANJERO/A">Extranjero/a</option>
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputNombreConductor">Nombre completo </label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="nombre_conductor_registrar" name="inputNombreConductor" required>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputVCTOConductor">VCTO</label>
                            <input type="text" class="form-control input_data" readonly name="inputVCTOConductor" id="vcto_conductor_registrar" />
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputDireccionConductor">Direccion</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" name="inputDireccionConductor">
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputTelefonoConductor">Telefono </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+569</span>
                                </div>
                                <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" name="inputTelefonoConductor">
                            </div>
                        </div>

                        <div class="form-group col-xl-6">
                            <label for="inputClaseConductor">Clase</label>
                            <select name="inputClaseConductor" class="form-control">
                                <option value="Clase B" selected>Clase B</option>
                                <option value="Clase C">Clase C</option>
                                <option value="Clase D">Clase D</option>
                                <option value="Clase E">Clase E</option>
                                <option value="Clase F">Clase F</option>
                                <option value="Clase A1">Clase A1</option>
                                <option value="Clase A2">Clase A2</option>
                                <option value="Clase A3">Clase A3</option>
                                <option value="Clase A4">Clase A4</option>
                                <option value="Clase A5">Clase A5</option>
                                <option value="EXTRANJERA">Licencia extranjera</option>
                            </select>
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputNumeroConductor">Numero serie</label>
                            <input oninput="this.value = soloNumeros(this)" maxLength="11" type="number" class="form-control" name="inputNumeroConductor">
                        </div>
                        <div class="form-group col-xl-6">
                            <label for="inputMunicipalidadConductor">Municipalidad</label>
                            <input onblur="mayus(this);" maxLength="30" type="text" class="form-control" name="inputMunicipalidadConductor">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                        <button type="submit" class="btn btn-success" id="btn_registrar_conductor">Registrar conductor</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>