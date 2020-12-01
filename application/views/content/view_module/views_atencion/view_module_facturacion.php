<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Atencion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Facturacion</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de Facturaciones</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-registrar-tab" data-toggle="tab" href="#nav-registrar" role="tab"
                    aria-controls="nav-registrar" aria-selected="true">Registrar Facturacion E. Remplazo</a>
                <a class="nav-link" id="nav-pagos-tab" data-toggle="tab" href="#nav-pagos" role="tab"
                    aria-controls="nav-pagos" aria-selected="false">Pagos pendientes E. Remplazo </a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <!-- Tab Formulario de Registrar facturaciones -->
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel"
                aria-labelledby="nav-registrar-tab">
                <br><br>
                <form class="needs-validation" novalidate id="form_registrar_factura">
                    <div class="form-row">
                        <div class="container card">
                            <br>
                            <div class="container">
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
                                <br>
                                <div class="form-row card-body">
                                    <div class="form-group col-xl-6">
                                        <label for="inputCodigoEmpresaRemplazo">Empresas de reemplazo</label>
                                        <div class="input-group">
                                            <select id="inputCodigoEmpresaRemplazo" name="inputCodigoEmpresaRemplazo"
                                                class="form-control">
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="btn_buscarPagoEmpresa">
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true" id="spinner_empresa_remplazo"></span>
                                                    Buscar pagos pendientes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <br><br>
                            <div class="container">
                                <table id="tabla_pagoPendienteRemplazo" class="table table-striped table-bordered"
                                    style="width:100%">
                                    <thead class="btn-dark">
                                        <tr>
                                            <th></th>
                                            <th>estado</th>
                                            <th>neto</th>
                                            <th>iva</th>
                                            <th>total</th>
                                            <th>fecha registro</th>
                                            <th>Nº Arriendo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="vehiculos">

                                    </tbody>
                                    <tfoot class="btn-dark">
                                        <tr>
                                            <th></th>
                                            <th>estado</th>
                                            <th>neto</th>
                                            <th>iva</th>
                                            <th>total</th>
                                            <th>fecha registro</th>
                                            <th>Nº Arriendo</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <br><br>
                                <button type="submit" id="btn_registrar_facturacion" class="btn btn-success">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                        id="spinner_registrar_facturacion"></span>
                                    Ingresar facturacion</button>
                                <br>
                            </div>
                            <br>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tab con la tabla de los pagos -->
            <div class="tab-pane fade" id="nav-pagos" role="tabpanel" aria-labelledby="nav-pagos-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_pagos" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>E. Remplazo</th>
                                <th>estado</th>
                                <th>neto</th>
                                <th>iva</th>
                                <th>total</th>
                                <th>fecha registro</th>
                                <th>Nº Arriendo</th>
                            </tr>
                        </thead>
                        <tbody id="vehiculos">
                            <br>
                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>E. Remplazo</th>
                                <th>estado</th>
                                <th>neto</th>
                                <th>iva</th>
                                <th>total</th>
                                <th>fecha registro</th>
                                <th>Nº Arriendo</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tabla_pagos">
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


<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_atencion/js_module_facturaciones.js"></script>