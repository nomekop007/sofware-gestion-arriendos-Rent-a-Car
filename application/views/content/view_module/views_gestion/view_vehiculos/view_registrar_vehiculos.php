<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vehiculos</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion Vehiculos</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-registrar-tab" data-toggle="tab" href="#nav-registrar" role="tab"
                    aria-controls="nav-registrar" aria-selected="true">Registrar vehiculo</a>
                <a class="nav-link" id="nav-vehiculos-tab" data-toggle="tab" href="#nav-vehiculos" role="tab"
                    aria-controls="nav-vehiculos" aria-selected="false">Vehiculos registrados</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <!-- Tab Formulario de Registrar vehiculos -->
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel"
                aria-labelledby="nav-registrar-tab">
                <br><br>
                <form class="needs-validation" novalidate id="form_registrar_vehiculo">
                    <div class="form-row">
                        <div class="form-group col-lg-2">
                            <label for="inputPatente">Patente (no modificable)</label>
                            <input onblur="mayus(this);" maxLength="10" type="text" class="form-control"
                                id="inputPatente" name="inputPatente" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputMarca">Marca</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="inputMarca"
                                name="inputMarca" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputModelo">Modelo</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputModelo" name="inputModelo" required>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputedad">Año</label>
                            <select id="inputedad" name="inputedad" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputTipo">Tipo</label>
                            <select id="inputTipo" name="inputTipo" class="form-control">
                                <option value="AUTOMOVIL" selected>Automovil</option>
                                <option value="CAMIONETA">Camioneta</option>
                                <option value="FURGON">Furgón</option>
                                <option value="CONVERTIBLE">Convertible</option>
                                <option value="DOBLE CABINA">Doble Cabina</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputNumeroMotor">Nº Motor</label>
                            <input type="text" maxLength="40" class="form-control" id="inputNumeroMotor"
                                name="inputNumeroMotor">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputChasis">Chasis de Vehiculo</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputChasis" name="inputChasis">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputNumeroGps">Nº GPS del vehiculo</label>
                            <input type="text" maxLength="40" class="form-control" id="inputNumeroGps"
                                name="inputNumeroGps">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputNumeroTab">Nº Tab del Vehiculo</label>
                            <input type="text" maxLength="40" class="form-control" id="inputNumeroTab"
                                name="inputNumeroTab">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputColor">Color</label>
                            <input onblur="mayus(this);" maxLength="40" type="text" class="form-control" id="inputColor"
                                name="inputColor" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputTransmision">Transmision</label>
                            <select id="inputTransmision" name="inputTransmision" class="form-control">
                                <option value="AUTOMATICO" selected>Automatico</option>
                                <option value="MANUAL">Manual</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="inputEstado">Estado</label>
                            <select id="inputEstado" name="inputEstado" class="form-control">
                                <option value="DISPONIBLE" selected>Disponible</option>
                                <option value="INACTIVO">Inactivo</option>
                                <option value="ARRENDADO">Arrendado</option>
                                <option value="SINIESTRADO">Siniestrado</option>
                                <option value="MANTENCION">En mantencion</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputPropietario">Propietario</label>
                            <select id="inputPropietario" name="inputPropietario" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputCompra">Donde se compro</label>
                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputCompra" name="inputCompra" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputRegion">Region</label>
                            <select id="inputRegion" name="inputRegion" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-xl-3">
                            <label for="inputFechaCompra">Fecha de compra</label>
                            <input type="text" class="form-control input_data" name="inputFechaCompra"
                                id="inputFechaCompra" required />
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputFoto">Foto (opcional)</label>
                            <input accept="image/*" type="file" class="form-control-file" id="inputFoto"
                                name="inputFoto">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-dark" id="btn_registrar_vehiculo">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_registrar"></span>
                        Registrar Vehiculo</button>
                </form>
            </div>

            <!-- Tab con la tabla de los vehiculos -->
            <div class="tab-pane fade" id="nav-vehiculos" role="tabpanel" aria-labelledby="nav-vehiculos-tab">
                <br><br>
                <div class="scroll">
                    <table id="tablaVehiculos" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Patente</th>
                                <th>Marca modelo</th>
                                <th>año</th>
                                <th>Tipo</th>
                                <th>transmision</th>
                                <th>Region</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="vehiculos">

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Patente</th>
                                <th>Marca modelo</th>
                                <th>año</th>
                                <th>Tipo</th>
                                <th>transmision</th>
                                <th>Region</th>
                                <th>Estado</th>
                                <th></th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaVehiculos">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
            <br><br><br><br>
        </div>

    </div>


</main>

</div>
</div>



<!-- importando archivo js vehiculos -->
<script
    src="<?php echo base_route() ?>assets/js/js_gestion/js_vehiculos/js_module_vehiculos.js?v=<?php echo version(); ?>">
</script>