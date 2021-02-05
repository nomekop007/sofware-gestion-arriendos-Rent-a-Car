<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Gestion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Facturacion pagos clientes</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de Facturacion de clientes</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-registrarFactura-tab" data-toggle="tab" href="#nav-registrar" role="tab" aria-controls="nav-registrar" aria-selected="true">subir comprobante de pago</a>
                <a class="nav-link" id="nav-pagostotal-tab" data-toggle="tab" href="#nav-pagos" role="tab" aria-controls="nav-pagos" aria-selected="false">lista de todos los pagos</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel" aria-labelledby="nav-registrarFactura-tab">
                <br><br>
                <input id="id_arriendo" type="text" hidden>
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" id="btn_buscar_pagos" type="button">Buscar pagos </button>
                            </div>
                            <input type="number" id="txt_id_arriendo" class="form-control" placeholder="Nº Arriendo">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div class="form-group">
                            <input disabled type="text" class="form-control" id="inputTipoArriendo">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <br>
                        <div class="form-group">
                            <input disabled type="text" class="form-control" id="nombreCliente">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <br>
                        <button class="btn btn-outline-success" id="btn_pagoExtra" type="button">Añadir Pago Extra</button>
                    </div>
                </div>
                <br>
                <div class="scroll" id="tabla_cliente">
                    <table id="tabla_pagosCliente" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th scope="row">#</th>
                                <th>deudor</th>
                                <th>estado</th>
                                <th>deuda</th>
                                <th>dias</th>
                                <th>fecha registro</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th scope="row">#</th>
                                <th>deudor</th>
                                <th>estado</th>
                                <th>deuda</th>
                                <th>dias</th>
                                <th>fecha registro</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="tabla_clienteRemplazo">
                    <h6>clientes remplazo.. modulo en construccion!</h6>
                </div>
            </div>
            <br>
            <div class="tab-pane fade" id="nav-pagos" role="tabpanel" aria-labelledby="nav-pagostotal-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_totalPagos" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th scope="row">Nº arriendo</th>
                                <th>deudor</th>
                                <th>tipo </th>
                                <th>estado</th>
                                <th>Deuda</th>
                                <th>dias</th>
                                <th>fecha registro</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th scope="row">Nº arriendo</th>
                                <th>deudor</th>
                                <th>tipo </th>
                                <th>estado</th>
                                <th>Deuda</th>
                                <th>dias</th>
                                <th>fecha registro</th>
                                <th></th>
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
        </div>
    </div>
    </nav>


</main>
</div>
</div>







<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_pagoCliente/js_module_pagoCliente.js?v=<?php echo version(); ?>">
</script>

<script src="<?php echo base_route() ?>assets/js/js_gestion/js_pagoCliente/js_module_tablaPagos.js?v=<?php echo version(); ?>">
</script>