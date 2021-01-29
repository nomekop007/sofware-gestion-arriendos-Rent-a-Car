<?php
$rol = $this->session->userdata("rol");
?>

<div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_header">item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="spinner_cliente">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="body_cliente">
                <form class="needs-validation" novalidate id="form_editar_cliente">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="inputNombreCliente">Nombre Completo</label>
                                    <input onblur="mayus(this);" type="text" name="inputNombreCliente" class="form-control" id="inputNombreCliente">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputRutCliente">Rut </label>
                                    <input disabled type="text" class="form-control" id="inputRutCliente">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputEstadoCivilCliente">Estado Civil </label>
                                    <select name="inputEstadoCivilCliente" id="inputEstadoCivilCliente" class="form-control">
                                        <option value="SOLTERO/A" selected>Soltero/a</option>
                                        <option value="CASADO/A">Casado/a</option>
                                        <option value="VIUDO/A">Viudo/a</option>
                                        <option value="DIVORCIADO/A">Divorciado/a</option>
                                        <option value="SEPARADO/A">Separado/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputNacionalidadCliente">Nacionalidad</label>
                                    <select name="inputNacionalidadCliente" id="inputNacionalidadCliente" class="form-control">
                                        <option value="CHILENO/A" selected>Chileno/a</option>
                                        <option value="EXTRANJERO/A">Extranjero/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputNacimientoCliente">Fecha de Nacimiento </label>
                                    <input type="text" class="form-control input_data" readonly name="inputNacimientoCliente" id="inputNacimientoCliente" required />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="inputCorreoCliente">Correo electronico </label>
                                    <input onblur="mayus(this);" type="email" class="form-control" name="inputCorreoCliente" id="inputCorreoCliente">
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="inputTelefonoCliente">Numero contacto </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" id="inputTelefonoCliente" name="inputTelefonoCliente" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-7">
                                    <label for="inputDireccionCliente">Direccion </label>
                                    <input onblur="mayus(this);" type="text" class="form-control" name="inputDireccionCliente" id="inputDireccionCliente">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputComunaCliente">Comuna / region </label>
                                    <select class="form-control" id="inputComunaCliente" name="inputComunaCliente">
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputCiudadCliente">Ciudad / pueblo</label>
                                    <select class="form-control" id="inputCiudadCliente" name="inputCiudadCliente">
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputCreateAtCliente">Registrado el </label>
                                    <input disabled type="text" class="form-control" id="inputCreateAtCliente">
                                </div>
                            </div>
                            <br>
                            <div id="card_documentos_cliente">
                            </div>
                            <br>
                            <?php if ($rol == 1 || $rol == 2) { ?>
                                <div class="card bg-light">
                                    <h6>Editar foto Carnet</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputCarnetFrontalCliente">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetFrontalCliente" name="inputCarnetFrontalCliente" required>
                                        </div>
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputCarnetTraseraCliente">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetTraseraCliente" name="inputCarnetTraseraCliente" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-dark" id="btn_editar_cliente">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_editar_cliente"></span>
                                    Editar cliente</button>
                            <?php } ?>
                        </div>
                    </div>
            </div>
            </form>
            <div class="modal-body" id="body_empresa">
                <form class="needs-validation" novalidate id="form_editar_empresa">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="inputNombreEmpresa">Nombre Empresa</label>
                                    <input type="text" onblur="mayus(this);" class="form-control" name="inputNombreEmpresa" id="inputNombreEmpresa">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputRutEmpresa">Rut</label>
                                    <input disabled type="text" class="form-control" id="inputRutEmpresa">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputRolEmpresa">Rol</label>
                                    <input type="text" onblur="mayus(this);" class="form-control" name="inputRolEmpresa" id="inputRolEmpresa">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="inputVigenciaEmpresa">Vigencia</label>
                                    <select id="inputVigenciaEmpresa" name="inputVigenciaEmpresa" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="inputDireccionEmpresa">Direccion</label>
                                    <input type="text" class="form-control" onblur="mayus(this);" name="inputDireccionEmpresa" id="inputDireccionEmpresa">
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="inputCorreoEmpresa">Correo</label>
                                    <input type="text" class="form-control" onblur="mayus(this);" name="inputCorreoEmpresa" id="inputCorreoEmpresa">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="inputComunaEmpresa">Comuna / Region </label>

                                    <select class="form-control" id="inputComunaEmpresa" name="inputComunaEmpresa">
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="inputCiudadEmpresa">Ciudad</label>
                                    <select class="form-control" id="inputCiudadEmpresa" name="inputCiudadEmpresa">
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="inputTelefonoEmpresa">Numero Contacto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" id="inputTelefonoEmpresa" name="inputTelefonoEmpresa" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputCreateAtEmpresa">Registrado el</label>
                                    <input disabled type="text" class="form-control" id="inputCreateAtEmpresa">
                                </div>
                            </div>
                            <br>
                            <div id="card_documentos_empresa">
                            </div>
                            <br>
                            <?php if ($rol == 1 || $rol == 2) { ?>
                                <div class="card bg-light">
                                    <h6>Editar foto Carnet</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputCarnetFrontalEmpresa">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetFrontalEmpresa" name="inputCarnetFrontalEmpresa" required>
                                        </div>
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputCarnetTraseraEmpresa">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetTraseraEmpresa" name="inputCarnetTraseraEmpresa" required>
                                        </div>
                                    </div>
                                </div>
                                <br><br>

                                <div class="form-row">
                                    <div class="form-group col-xl-6">
                                        <h6 for="inputEstatuto">Editar documento estatuto</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputEstatuto" name="inputEstatuto" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <h6 for="inputDocumentotRol">Editar documento rol </h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputDocumentotRol" name="inputDocumentotRol" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <h6 for="inputDocumentoVigencia">Editar documento vigencia</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputDocumentoVigencia" name="inputDocumentoVigencia" required>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-dark" id="btn_editar_empresa">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_editar_empresa"></span>
                                    Editar empresa</button>
                            <?php } ?>
                        </div>
                    </div>
            </div>
            </form>
            <div class="modal-body" id="body_conductor">
                <form class="needs-validation" novalidate id="form_editar_conductor">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="inputNombreConductor">Nombre Completo</label>
                                    <input type="text" class="form-control" onblur="mayus(this);" name="inputNombreConductor" id="inputNombreConductor">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputRutConductor">Rut</label>
                                    <input disabled type="text" class="form-control" name="inputRutConductor" id="inputRutConductor">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputNacionalidadConductor">Nacionalidad</label>

                                    <select name="inputNacionalidadConductor" id="inputNacionalidadConductor" class="form-control">
                                        <option value="CHILENO/A" selected>Chileno/a</option>
                                        <option value="EXTRANJERO/A">Extranjero/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputTelefonoConductor">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" onblur="mayus(this);" id="inputTelefonoConductor" name="inputTelefonoConductor" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="inputDireccionConductor">Direccion</label>
                                    <input type="text" class="form-control" onblur="mayus(this);" name="inputDireccionConductor" id="inputDireccionConductor">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="inputClaseConductor">Clase licencia</label>
                                    <select name="inputClaseConductor" id="inputClaseConductor" class="form-control">
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
                                <div class="form-group col-lg-4">
                                    <label for="inputNumeroConductor">Numero serie</label>
                                    <input type="text" class="form-control" onblur="mayus(this);" name="inputNumeroConductor" id="inputNumeroConductor">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputVCTOconductor">VCTO licencia</label>
                                    <input type="text" onblur="mayus(this);" class="form-control input_data" readonly name="inputVCTOConductor" id="inputVCTOConductor" required />

                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="inputMunicipalidadConductor">Municipalidad</label>
                                    <input type="text" class="form-control" onblur="mayus(this);" name="inputMunicipalidadConductor" id="inputMunicipalidadConductor">
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="inputCreateAtConductor">Registrado el</label>
                                    <input disabled type="text" class="form-control" id="inputCreateAtConductor">
                                </div>
                            </div>
                            <br>
                            <div id="card_documentos_conductor">
                            </div>
                            <br>
                            <?php if ($rol == 1 || $rol == 2) { ?>
                                <div class="card bg-light">
                                    <h6>Editar foto licencia de conducir</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputlicenciaFrontalConductor">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputlicenciaFrontalConductor" name="inputlicenciaFrontalConductor" required>
                                        </div>
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputlicenciaTraseraConductor">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputlicenciaTraseraConductor" name="inputlicenciaTraseraConductor" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-dark" id="btn_editar_conductor">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_editar_conductor"></span>
                                    Editar conductor</button>
                            <?php } ?>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>