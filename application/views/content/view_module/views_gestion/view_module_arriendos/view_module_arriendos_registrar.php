<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-registrar-tab">
    <br>
    <form class="needs-validation" novalidate name="formulario">
        <p>
            <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseCliente" role="button"
                aria-expanded="false" aria-controls="collapseCliente">
                Datos cliente
            </a>
            <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseConductor" role="button"
                aria-expanded="false" aria-controls="collapseConductor">
                Datos Conductor
            </a>
            <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseVehiculos" role="button"
                aria-expanded="false" aria-controls="collapseVehiculos">
                Seleccion de Vehiculo
            </a>
            <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseArriendo" role="button"
                aria-expanded="false" aria-controls="collapseArriendo">
                Datos Arriendo
            </a>
            <button type="submit" id="btn_crear_arriendo" class="btn btn-success btn-sm">Crear
                Arriendo</button>
        </p>
        <div class="collapse" id="collapseCliente">
            <div class="card card-body">
                <br>
                <h4>Datos Cliente</h4>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputNombreCliente">Nombre completo </label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputNombreCliente" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDireccionCliente">Direccion </label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputDireccionCliente">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCiudadCliente">Ciudad </label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputCiudadCliente" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputRutCliente">Rut o Pasaporte</label>
                        <input onblur=" value ? this.value=formateaRut(this.value) : null" type="text"
                            class="form-control" id="inputrutCliente" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDireccionComercial">Direccion Comercial o Extranjera </label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputDireccionComercial" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCiudadClienteComercial">Ciudad Comercial</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputCiudadClienteComercial" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputFechaNacimiento">Fecha Nacimiento </label>
                        <input oninput="mayus(this);" maxLength="30" type="date" class="form-control"
                            id="inputFechaNacimiento" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputTelefonoCliente">Telefono </label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputTelefonoCliente" required>
                    </div>

                </div>
            </div>
        </div>

        <div class="collapse" id="collapseConductor">
            <div class="card card-body">
                <br>
                <h4>Datos Conductor</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNombreConductor">Nombre completo </label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputNombreConductor" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputRutConductor">Rut</label>
                        <input onblur=" value ? this.value=formateaRut(this.value) : null" type="text"
                            class="form-control" id="inputRutConductor" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputTelefonoConductor">Telefono</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputTelefonoConductor" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputClase">Clase</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputClase"
                            required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputNumero">Numero</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputNumero"
                            required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputVCTO">VCTO</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputVCTO"
                            required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputMunicipalidad">Municipalidad</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputMunicipalidad" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputDireccion">Direccion</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                            id="inputDireccion" required>
                    </div>
                </div>

                <br>
                <h4>Documentacion Conductor</h4>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputDocCarnet">Carnet de identidad o pasaporte</label>
                        <input type="file" class="form-control-file" id="inputDocCarnet">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDocConducir">Licencia de conducir</label>
                        <input type="file" class="form-control-file" id="inputDocConducir">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDocDomicilio">Comprobante de domicilio</label>
                        <input type="file" class="form-control-file" id="inputDocDomicilio">
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseVehiculos">
            <div class="card card-body">
                <br>
                <h4>Seleccion de Vehiculo</h4>
                <br>
                <div class="form-row">
                    <div class="input-group col-md-5">
                        <select class="custom-select" id="inputSucursal" aria-label="Example select with button addon">
                        </select>
                        <div class="input-group-append">
                            <bustton class="btn btn-outline-secondary" id="buscar_vehiculos" type="button">
                                Buscar</button>
                        </div>
                    </div>
                    <div class="input-group col-md-7" required>
                        <select disabled class="custom-select form-control" id="select_vehiculos" style="width: 100%;">
                        </select>
                    </div>

                </div>
                <br>
                <h4>Kilometros</h4>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEntrada">Entrada</label>
                        <input oninput="mayus(this);" min="0" value="0" type="number" class="form-control"
                            id="inputEntrada" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputSalida">Salida</label>
                        <input oninput="mayus(this);" min="0" value="0" type="number" class="form-control"
                            id="inputSalida" required>
                    </div>
                </div>
                <br>
                <h4>Accessorios</h4>
                <div class="form-row">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_traslado" value="Traslado">
                        <label class="form-check-label" for="box_traslado">Traslado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_dedicible" value="Deducible">
                        <label class="form-check-label" for="box_dedicible">Deducible</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_bencina" value="Bencina">
                        <label class="form-check-label" for="box_bencina">Bencina</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_enganche" value="Enganche">
                        <label class="form-check-label" for="box_enganche">Enganche</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_silla" value="Silla para bebe">
                        <label class="form-check-label" for="box_silla">Silla para bebe</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_pase" value="Pase diario">
                        <label class="form-check-label" for="box_pase">Pase diario</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="box_rastreo" value="Rastreo satelital">
                        <label class="form-check-label" for="box_rastreo">Rastreo satelital</label>
                    </div>

                    <div class="form-group col-md-3">
                        <br>
                        <label for="inputOtros">Otros</label>
                        <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" name="otros"
                            id="inputOtros">
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse" id="collapseArriendo">
            <div class="card card-body">
                <br>
                <h4>Datos Arriendo</h4>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputNumeroDias">Numeros de Dias</label>
                        <input min="1" value="1" type="number" class="form-control" id="inputNumeroDias" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputFechaInicio">Fecha de inicio</label>
                        <input type="date" class="form-control" id="inputFechaInicio" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputFechaFin">Fecha fin</label>
                        <input type="date" class="form-control" id="inputFechaFin" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputTipo">Tipo de Arriendo</label>
                        <select id="inputTipo" class="form-control">
                            <option value="persona natural" selected>Arriendo persona natural</option>
                            <option value="empresa remplazo copago" selected>Arriendo empresa remplazo
                                copago</option>
                            <option value="solo empresa" selected>Arriendo solo empresa</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCiudadEntrega">Ciudad de Entrega</label>
                        <input type="text" class="form-control" id="inputCiudadEntrega" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputFechaEntrega">Fecha</label>
                        <input type="datetime-local" class="form-control" id="inputFechaEntrega" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputCiudadRecepcion">Ciudad de Recepcion</label>
                        <input type="text" class="form-control" id="inputCiudadRecepcion" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputFechaRecepcion">Fecha</label>
                        <input type="datetime-local" class="form-control" id="inputFechaRecepcion" required>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>