<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Gestion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Daños vehiculo</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de daño vehiculo</h1>
    </div>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab"
                    aria-controls="pendientes" aria-selected="true">Pendientes de cotizar</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="todos-tab" data-toggle="tab" href="#todos" role="tab" aria-controls="todos"
                    aria-selected="false">Todos los daños registrados</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_pendientes_danios" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>Evidencia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>Evidencia</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tabla_danios_pendientes">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>



            </div>
            <div class="tab-pane fade" id="todos" role="tabpanel" aria-labelledby="todos-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_todos_danios" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>estado</th>
                                <th>Evidencia</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>estado</th>
                                <th>Evidencia</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tabla_danios">
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



<!-- Modal descripcion -->
<div class="modal fade" id="modal_mostrar_descripcion" tabindex="-1" aria-labelledby="modal_mostrar_descripcionLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_mostrar_descripcionLabel">Descripcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="descripcion_danio"></p>
            </div>
        </div>
    </div>
</div>


<!-- Modal subir comprobante -->
<div class="modal fade" id="modal_subir_comprobante" tabindex="-1" aria-labelledby="modal_subir_comprobanteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_subir_comprobanteLabel">Subir comprobante del <span
                        id="id_danio"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="needs-validation" novalidate id="form_subir_comprobante">
                        <h6>Facturacion</h6>
                        <div class="form-row card-body">
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="BOLETA" id="radioBoleta" name="customRadio1"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="radioBoleta">Boleta</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="FACTURA" id="radioFactura" name="customRadio1"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="radioFactura">Factura</label>
                            </div>
                        </div>
                        <div class="container">
                            <div class="form-row card-body">
                                <div class="form-group col-xl-4">
                                    <label for="inputNumFacturacion">Numero comprobante</label>
                                    <input maxLength="20" id="inputNumFacturacion" name="inputNumFacturacion"
                                        type="number" class="form-control" placeholder="Nº Boleta/Factura" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputFileFacturacion">Comprobante</label>
                                    <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf"
                                        type="file" class="form-control-file" id="inputFileFacturacion"
                                        name="inputFileFacturacion" required>
                                </div>
                            </div>
                            <h6>Metodo de pago</h6>
                            <div class="form-row card-body">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=1 id="radioEfectivo" name="customRadio2"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="radioEfectivo">Efectivo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=2 id="radioCheque" name="customRadio2"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="radioCheque">Cheque</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=3 id="radioTarjeta" name="customRadio2"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="radioTarjeta">Tarjeta
                                        credito/debito</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=4 id="radioTranferencia" name="customRadio2"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="radioTranferencia">Transferencia
                                        electronica</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row card-body">
                            <div class="form-group col-xl-6">
                                <label for="input_mecanico_pagoDanio">Nombre mecanico cotizante</label>
                                <input id="input_mecanico_pagoDanio" name="input_mecanico_pagoDanio" maxLength="50"
                                    type="text" class="form-control" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="input_pagador_pagoDanio">Nombre responsable del pago</label>
                                <input id="input_pagador_pagoDanio" name="input_pagador_pagoDanio" maxLength="50"
                                    type="text" class="form-control" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="input_precio_pagoDanio">Pago total daño (bruto)</label>
                                <input id="input_precio_pagoDanio" name="input_precio_pagoDanio"
                                    oninput="this.value = soloNumeros(this)" maxLength="11" type="number"
                                    class="form-control" required>
                            </div>
                            <button type="submit" id="btn_subir_comprobante" class="btn btn-success col-xl-12">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    id="spinner_btn_subir_comprobante"></span>
                                subir comprobante</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_danioVehiculo/js_module_daniosVehiculo.js"></script>