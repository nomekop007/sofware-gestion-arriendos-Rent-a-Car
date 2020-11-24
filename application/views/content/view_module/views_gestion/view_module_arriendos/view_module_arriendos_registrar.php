<?php
switch ($this->session->userdata('sucursal')) {
    case '1':
        $sucursal = "TALCA";
        break;
    case '2':
        $sucursal = "LINARES";
        break;
    case '3':
        $sucursal = "CURICO";
        break;
    case '4':
        $sucursal = "CONCEPCION";
        break;
    default:
        $sucursal = "DESCONOCIDO";
        break;
}
?>


<!-- Tab donde se registran los arriendos -->
<div class="tab-pane fade show active" id="nav-registrar" role="tabpanel" aria-labelledby="nav-registrar-tab">
    <br>
    <form class="needs-validation" novalidate id="form_registrar_arriendo">
        <!-- list de card de registrar arriendo -->
        <div class="row">


            <div class="col-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action list-group-item-dark active"
                        id="list-arriendo-list" data-toggle="list" href="#list-arriendo" role="tab"
                        aria-controls="arriendo"> Datos arriendo</a>
                    <a class="list-group-item list-group-item-action list-group-item-dark" id="list-cliente-list"
                        data-toggle="list" href="#list-cliente" role="tab" aria-controls="cliente">Datos cliente</a>
                    <a class="list-group-item list-group-item-action list-group-item-dark" id="list-contacto-list"
                        data-toggle="list" href="#list-contacto" role="tab" aria-controls="contacto"> Datos contacto</a>
                    <a class="list-group-item list-group-item-action list-group-item-dark" id="list-conductor-list"
                        data-toggle="list" href="#list-conductor" role="tab" aria-controls="conductor"> Datos
                        conductor</a>
                    <a class="list-group-item list-group-item-action list-group-item-dark" id="list-garantia-list"
                        data-toggle="list" href="#list-garantia" role="tab" aria-controls="garantia"> Garantia
                        requerida</a>
                    <a class="list-group-item list-group-item-action list-group-item-dark" id="list-vehiculo-list"
                        data-toggle="list" href="#list-vehiculo" role="tab" aria-controls="vehiculo"> Seleccion de
                        vehiculo</a>
                    <br>
                    <button type="submit" id="btn_crear_arriendo" class="btn btn-success ">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_registrar"></span>
                        Registrar Arriendo</button>
                </div>
            </div>


            <div class="col-9">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-arriendo" role="tabpanel"
                        aria-labelledby="list-arriendo-list">
                        <div class="card card-body">
                            <br>
                            <h4>Datos Arriendo</h4>
                            <div class="form-row">
                                <div class="form-group col-xl-6">
                                    <label for="inputCiudadEntrega">Sucursal entrega</label>
                                    <select id="inputCiudadEntrega" name="inputCiudadEntrega" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCiudadRecepcion">Sucursal de recepcion</label>
                                    <select id="inputCiudadRecepcion" name="inputCiudadRecepcion" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputFechaEntrega">Fecha de entrega</label>
                                    <input oninput="calcularDias()" type="datetime-local" class="form-control"
                                        name="inputFechaEntrega" id="inputFechaEntrega" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputFechaRecepcion">Fecha de Recepcion</label>
                                    <input oninput="calcularDias()" type="datetime-local" class="form-control"
                                        name="inputFechaRecepcion" id="inputFechaRecepcion" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNumeroDias">Numeros de Dias</label>
                                    <input min="0" oninput="calcularDias()" type="number" class="form-control"
                                        name="inputNumeroDias" id="inputNumeroDias" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputTipo">Tipo de Arriendo</label>
                                    <select onblur="tipoArriendo();" name="inputTipo" id="inputTipo"
                                        class="form-control">
                                        <option value="PARTICULAR" selected>ARRIENDO PARTICULAR</option>
                                        <option value="REMPLAZO">ARRIENDO E. REMPLAZO</option>
                                        <option value="EMPRESA">ARRIENDO EMPRESA</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="selectSucursal">Agencia de Arriendo</label>
                                    <input type="text" class="form-control " id="selectSucursal" name="selectSucursal"
                                        value="<?php echo $sucursal ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-cliente" role="tabpanel" aria-labelledby="list-cliente-list">
                        <div class="card card-body">
                            <br>
                            <div id="form_remplazo">
                                <h4 id="titulo_remplazo">Datos Empresa remplazo</h4>
                                <div class="form-row">
                                    <div class="form-group col-xl-lg-3">
                                        <label for="inputCodigoEmpresaRemplazo">Empresa Remplazo</label>
                                        <select id="inputCodigoEmpresaRemplazo" name="inputCodigoEmpresaRemplazo"
                                            class="form-control">
                                        </select>
                                    </div>
                                    <br>
                                </div>
                                <br>
                            </div>
                            <h4 id="titulo_cliente">Datos Cliente</h4>
                            <div class="form-row" id="form_cliente">
                                <div class="form-group col-xl-6">
                                    <label for="inputRutCliente">Rut o Pasaporte (ejemplo: 12.345.678-9)</label>
                                    <div class="input-group">
                                        <input maxLength="12" type="text" class="form-control" id="inputRutCliente"
                                            name="inputRutCliente" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="btn_buscarCliente">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true" id="spinner_cliente"></span>
                                                Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNacionalidadCliente">Nacionalidad</label>
                                    <select name="inputNacionalidadCliente" id="inputNacionalidadCliente"
                                        class="form-control">
                                        <option value="CHILENO/A" selected>Chileno/a</option>
                                        <option value="EXTRANJERO/A">Extranjero/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNombreCliente">Nombre completo</label>
                                    <input onblur="mayus(this);" maxLength="40" type="text" class="form-control"
                                        id="inputNombreCliente" name="inputNombreCliente" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputDireccionCliente">Direccion </label>
                                    <input onblur="mayus(this);" maxLength="40" type="text" class="form-control"
                                        id="inputDireccionCliente" name="inputDireccionCliente" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputFechaNacimiento">Fecha Nacimiento </label>
                                    <input onblur="mayus(this);" value="1990-01-01" maxLength="30" type="date"
                                        class="form-control" id="inputFechaNacimiento" name="inputFechaNacimiento"
                                        required>
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
                                    <select class="form-control" id="inputComunaCliente" name="inputComunaCliente">
                                    </select>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="inputCiudadCliente">Ciudad / pueblo </label>
                                    <select class="form-control" id="inputCiudadCliente" name="inputCiudadCliente">
                                    </select>
                                </div>


                                <div class="form-group col-xl-6">
                                    <label for="inputTelefonoCliente">Telefono </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number"
                                            class="form-control" id="inputTelefonoCliente" name="inputTelefonoCliente"
                                            required>
                                    </div>

                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCorreoCliente">Correo electronico </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input onblur="mayus(this);" maxLength="40" type="email" class="form-control"
                                            id="inputCorreoCliente" name="inputCorreoCliente" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4 id="titulo_empresa">Datos Empresa</h4>
                            <div class="form-row" id="form_empresa">
                                <div class="form-group col-xl-6">
                                    <label for="inputRutEmpresa">Rut (ejemplo: 12.345.678-9) </label>
                                    <div class="input-group">
                                        <input maxLength="12" type="text" type="text" class="form-control"
                                            id="inputRutEmpresa" name="inputRutEmpresa" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="btn_buscarEmpresa">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true" id="spinner_empresa"></span>
                                                Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNombreEmpresa">Nombre </label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                        id="inputNombreEmpresa" name="inputNombreEmpresa" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCorreoEmpresa">Correo electronico</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input onblur="mayus(this);" maxLength="50" type="email" class="form-control"
                                            id="inputCorreoEmpresa" name="inputCorreoEmpresa" required>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputDireccionEmpresa">Direccion comercial</label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                        id="inputDireccionEmpresa" name="inputDireccionEmpresa" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputComunaEmpresa">Comuna / region </label>
                                    <select class="form-control" id="inputComunaEmpresa" name="inputComunaEmpresa">
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCiudadEmpresa">Ciudad / pueblo </label>
                                    <select class="form-control" id="inputCiudadEmpresa" name="inputCiudadEmpresa">
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputTelefonoEmpresa">Telefono </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number"
                                            class="form-control" id="inputTelefonoEmpresa" name="inputTelefonoEmpresa"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputVigencia">Vigecia</label>
                                    <select id="inputVigencia" name="inputVigencia" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputRol">Rol o rubro</label>
                                    <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                                        name="inputRol" id="inputRol" required>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-contacto" role="tabpanel" aria-labelledby="list-contacto-list">
                        <div class="card card-body">
                            <br>
                            <h4>Datos Contacto de emergencia</h4>
                            <div class="form-row">
                                <div class="form-group col-xl-6">
                                    <label for="inputNombreContacto">Nombre completo </label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                        id="inputNombreContacto" name="inputNombreContacto" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputDomicilioContacto">Domicilio </label>
                                    <input onblur="mayus(this);" maxLength="20" type="text" class="form-control"
                                        id="inputDomicilioContacto" name="inputDomicilioContacto" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNumeroCasaContacto">Numero casa </label>
                                    <input oninput="this.value = soloNumeros(this)" maxLength="5" type="number"
                                        class="form-control" id="inputNumeroCasaContacto" name="inputNumeroCasaContacto"
                                        required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCiudadContacto">Ciudad </label>
                                    <input onblur="mayus(this);" maxLength="20" type="text" class="form-control"
                                        id="inputCiudadContacto" name="inputCiudadContacto" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputTelefonoContacto">Telefono </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number"
                                            class="form-control" id="inputTelefonoContacto" name="inputTelefonoContacto"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-conductor" role="tabpanel"
                        aria-labelledby="list-conductor-list">
                        <div class="card card-body">
                            <br>
                            <h4>Datos Conductor asignado</h4>
                            <div class="form-row">
                                <div class="form-group  col-xl-6">
                                    <label for="inputRutConductor">Rut (ejemplo: 12.345.678-9)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxLength="12" type="text"
                                            id="inputRutConductor" name="inputRutConductor" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="btn_buscarConductor">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true" id="spinner_conductor"></span>
                                                Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNacionalidadConductor">Nacionalidad</label>
                                    <select name="inputNacionalidadConductor" id="inputNacionalidadConductor"
                                        class="form-control">
                                        <option value="CHILENO/A" selected>Chileno/a</option>
                                        <option value="EXTRANJERO/A">Extranjero/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNombreConductor">Nombre completo </label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                        id="inputNombreConductor" name="inputNombreConductor" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputDireccionConductor">Direccion</label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                        id="inputDireccionConductor" name="inputDireccionConductor" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputTelefonoConductor">Telefono </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number"
                                            class="form-control" id="inputTelefonoConductor"
                                            name="inputTelefonoConductor" required>
                                    </div>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="inputClaseConductor">Clase</label>
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
                                <div class="form-group col-xl-6">
                                    <label for="inputVCTOConductor">VCTO</label>
                                    <input type="date" class="form-control" id="inputVCTOConductor"
                                        name="inputVCTOConductor" required>
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="inputNumeroConductor">Numero serie</label>
                                    <input oninput="this.value = soloNumeros(this)" maxLength="11" type="number"
                                        class="form-control" id="inputNumeroConductor" name="inputNumeroConductor"
                                        required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputMunicipalidadConductor">Municipalidad</label>
                                    <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                                        id="inputMunicipalidadConductor" name="inputMunicipalidadConductor" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-garantia" role="tabpanel" aria-labelledby="list-garantia-list">
                        <div class="card  card-body">
                            <br>

                            <h4>Datos garantia</h4>
                            <div class="form-row card-body">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input onclick="tipoGarantia(this.value);" type="radio" value="EFECTIVO"
                                        id="radioEfectivoGarantia" name="customRadio0" class="custom-control-input"
                                        checked>
                                    <label class="custom-control-label" for="radioEfectivoGarantia">Efectivo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input onclick="tipoGarantia(this.value);" type="radio" value="CHEQUE"
                                        id="radioChequeGarantia" name="customRadio0" class="custom-control-input">
                                    <label class="custom-control-label" for="radioChequeGarantia">Cheque</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input onclick="tipoGarantia(this.value);" type="radio" value="TARJETA"
                                        id="radioTarjetaGarantia" name="customRadio0" class="custom-control-input">
                                    <label class="custom-control-label" for="radioTarjetaGarantia">Tarjeta</label>
                                </div>
                            </div>
                            <div class="form-row card-body">
                                <div class="form-group col-xl-62" id="card-tarjeta">
                                    <label for="inputNumeroTarjeta">Tarjeta de credito</label>
                                    <div class="input-group">
                                        <input style="width: 40%;" oninput="this.value = soloNumeros(this)"
                                            type="number" class="form-control" id="inputNumeroTarjeta"
                                            name="inputNumeroTarjeta" maxLength="16" placeholder="Nº Tarjeta de credito"
                                            required>
                                        <input style="width: 20%;" name="inputFechaTarjeta" id="inputFechaTarjeta"
                                            type="text" aria-label="Last name" class="form-control" maxLength="5"
                                            placeholder="ej: 01/01" required>
                                        <input style="width: 20%;" onclick="this.value = calcularFolioArriendo()"
                                            name="inputFolioTarjeta" id="inputFolioTarjeta" type="number"
                                            aria-label="Last name" class="form-control" maxLength="5"
                                            placeholder="Nº folio" required>
                                        <input style="width: 20%;" name="inputCodigoTarjeta" id="inputCodigoTarjeta"
                                            type="text" aria-label="Last name" class="form-control" maxLength="20"
                                            placeholder="codigo retencion" required>
                                    </div>

                                </div>
                                <div class="form-group col-xl-62" id="card-cheque">
                                    <label for="inputNumeroCheque">Cheque</label>
                                    <div class="input-group">
                                        <input style="width: 40%;" oninput="this.value = soloNumeros(this)"
                                            type="number" class="form-control" id="inputNumeroCheque"
                                            name="inputNumeroCheque" maxLength="25" placeholder="Nº Cheque" required>
                                        <input style="width: 30%;" name="inputBancoCheque" id="inputBancoCheque"
                                            type="text" aria-label="Last name" class="form-control" maxLength="20"
                                            placeholder="Emisor cheque" required>
                                        <input style="width: 30%;" name="inputCodigoCheque" id="inputCodigoCheque"
                                            type="text" aria-label="Last name" class="form-control" maxLength="20"
                                            placeholder="Codigo autorizacion" required>
                                    </div>
                                </div>
                                <div class="input-group col-xl-62" id="card-abono">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Abono $</span>
                                    </div>
                                    <select id="inputAbono" name="inputAbono" class="form-control" required>
                                        <option value="400000">400.000</option>
                                        <option value="600000">600.000</option>
                                        <option value="650000">650.000</option>


                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-vehiculo" role="tabpanel" aria-labelledby="list-vehiculo-list">
                        <div class="card card-body">
                            <br>
                            <h4>Seleccion de Vehiculo</h4>
                            <div class="form-row">
                                <div class="input-group col-xl-6">
                                    <select class="custom-select " id="select_vehiculos" name="select_vehiculos"
                                        style="width: 100%;" aria-label="Example select with button addon">
                                        <option value="null" selected="selected">Seleccione un vehiculo</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <h4>Kilometros</h4>
                            <div class="form-row">
                                <div class="form-group col-xl-6">
                                    <label for="inputEntrada">Actual</label>
                                    <input hidden type="text" id="Tmantencion_vehiculo" value=0>
                                    <input oninput="this.value = soloNumeros(this)" value=0 maxLength="7" type="number"
                                        class="form-control" id="inputEntrada" name="inputEntrada" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputMantencion">kilometros para siguiente mantencion</label>
                                    <input oninput="this.value = soloNumeros(this)" value=0 maxLength="7" type="number"
                                        class="form-control" id="inputMantencion" name="inputMantencion" required>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>




</div>