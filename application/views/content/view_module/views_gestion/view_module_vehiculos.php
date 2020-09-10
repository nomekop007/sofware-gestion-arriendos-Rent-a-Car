<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargarPanel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vehiculos</li>
            </ol>
        </nav>
        <h1 class="h3">Modulo Vehiculos</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-registrar-tab" data-toggle="tab" href="#nav-registrar" role="tab"
                    aria-controls="nav-registrar" aria-selected="true">Registrar nuevo vehiculo</a>
                <a class="nav-link" id="nav-vehiculos-tab" data-toggle="tab" href="#nav-vehiculos" role="tab"
                    aria-controls="nav-vehiculos" aria-selected="false">Mostrar todos los vehiculos</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <!-- Tab Formulario de Registrar vehiculos -->
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel"
                aria-labelledby="nav-registrar-tab">
                <br><br>
                <form class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputPatente">Patente del Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="10" type="text" class="form-control"
                                id="inputPatente" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputMarca">Marca del Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputMarca" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputModelo">Modelo del Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputModelo" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputedad">Año del Vehiculo</label>
                            <select id="inputedad" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputTipo">Tipo de Vehiculo</label>
                            <select id="inputTipo" class="form-control">
                                <option value="AUTOMOVIL" selected>Automovil</option>
                                <option value="CAMIONETA">Camioneta</option>
                                <option value="FURGON">Furgon</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputTransmision">Transmision del Vehiculo</label>
                            <select id="inputTransmision" class="form-control">
                                <option value="AUTOMATICA" selected>Automatica</option>
                                <option value="MANUAL">Manual</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputChasis">Chasis de Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputChasis" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputColor">Color del Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="15" type="text" class="form-control"
                                id="inputColor" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputNumeroMotor">Nº Motor del Vehiculo</label>
                            <input type="text" maxLength="30" class="form-control" id="inputNumeroMotor" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPrecio">Precio del Vehiculo</label>
                            <input min="0" type="number" class="form-control" id="inputPrecio" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPropietario">Propietario del Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputPropietario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCompra">Donde se compro</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputCompra" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputSucursal">Sucursal actual</label>
                            <select id="inputSucursal" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputFechaCompra">Fecha de compra</label>
                            <input type="date" class="form-control" id="inputFechaCompra" required>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputFoto">Foto del vehiculo (opcional)</label>
                            <input type="file" class="form-control-file" id="inputFoto">
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-dark" id="btn_registrar_vehiculo">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_registrar"></span>
                        Registrar Vehiculo</button>
                </form>
            </div>

            <!-- Tab con la tabla de los vehiculos -->
            <div class="tab-pane fade" id="nav-vehiculos" role="tabpanel" aria-labelledby="nav-vehiculos-tab">
                <br><br>
                <table id="tablaVehiculos" class="table table-striped table-bordered" style="width:100%">
                    <thead class="btn-dark">
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>año</th>
                            <th>Tipo</th>
                            <th>Sucursal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="vehiculos">

                    </tbody>
                    <tfoot class="btn-dark">
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>año</th>
                            <th>Tipo</th>
                            <th>Sucursal</th>
                            <th></th>

                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
        <br><br>
    </div>


</main>

</div>
</div>

<!-- Modal  editar  (PENDIENTE)-->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                En Construccion...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ver  (PENDIENTE)-->
<div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Mostrar Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                En Construccion...
            </div>
        </div>
    </div>
</div>



<script>
// Script para cargar año vehiculo
(() => {
    var n = (new Date()).getFullYear()
    var select = document.getElementById("inputedad");
    for (var i = n; i >= 1970; i--) select.options.add(new Option(i, i));
})();

//sniper de btn registrar
$("#spinner_btn_registrar").hide();
</script>


<!-- importando archivo js vehiculos -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_vehiculos.js"></script>