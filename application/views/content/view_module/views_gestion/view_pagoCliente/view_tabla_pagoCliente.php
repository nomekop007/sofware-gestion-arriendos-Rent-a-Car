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
                <?php if (validarPermiso(20)) { ?>
                    <a class="nav-link" id="nav-pagostotal-tab" data-toggle="tab" href="#nav-pagos" role="tab" aria-controls="nav-pagos" aria-selected="false">lista de todos los pagos</a>
                <?php } ?>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel" aria-labelledby="nav-registrarFactura-tab">
                <br>
                <input id="id_arriendo" type="text" hidden>
                <input id="tipo_arriendo" type="text" hidden>
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" id="btn_buscar_pagos" type="button">Buscar pagos por Folio </button>
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
                </div>
                <br>
                <h6> Cada pago que se muestra corresponde a cada contrato y extencion del arriendo. </h6>
                <br><br>
                <div id="tabla_cliente">
                    <button id="btn_pagosExtras" class="btn btn-outline-primary" data-toggle='modal' data-target='#modal_pagoExtra'>
                        pagos extras y descuentos
                    </button>
                    <br><br><br>
                    <div class="scroll">
                        <table id="tabla_pagosCliente" class="table table-striped table-bordered" style="width:100%">
                            <thead class="btn-dark">
                                <tr>
                                    <th scope="row">#</th>
                                    <th>cliente</th>
                                    <th>estado</th>
                                    <th>monto</th>
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
                                    <th>cliente</th>
                                    <th>estado</th>
                                    <th>monto</th>
                                    <th>dias</th>
                                    <th>fecha registro</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div id="tabla_clienteRemplazo">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="scroll container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">deudor</th>
                                            <th scope="col">estado</th>
                                            <th scope="col">monto</th>
                                            <th scope="col">dias</th>
                                            <th scope="col">fecha registro</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaPago">
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 id="total_a_pagar"></h5>
                                    <h6 id="dias_totales"></h6>
                                </div>
                                <div class="col-md-8">
                                    <button data-toggle='modal' data-target='#modal_pago' onclick="modalSubirPagoRemplazo()" class="btn btn-success">
                                        añadir comprobante
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="descuento_copago">
                                <p>
                                    <button class="badge badge-info" type="button" data-toggle="collapse" data-target="#collapseDescuento" aria-expanded="false" aria-controls="collapseDescuento">
                                        aplicar descuento
                                    </button>
                                    <button class="badge badge-primary" type="button" data-toggle="collapse" data-target="#collapseExtra" aria-expanded="false" aria-controls="collapseExtra">
                                        agregar pago extra
                                    </button>
                                </p>
                                <div class="collapse" id="collapseDescuento">
                                    <div class="card card-body">
                                        <div class="form-row">
                                            <div class="form-group col-xl-12">
                                                <h6>Aplicar descuento al pago total</h6>
                                                <p>en caso de que el cliente devuelva el vehículo antes de tiempo ,o por
                                                    cualquier inconveniente se
                                                    puede aplicar un descuento al último pago realizado (el descuento no sera valido si este supera el monto del ultimo pago de la lista). </p>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for="descuento_pago">descuento (bruto)($) </label>
                                                <input oninput="this.value = soloNumeros(this);recalcularPagoDescuento(this.value)" maxLength="11" value=0 id="descuento_pago" name="descuento_pago" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for="dias_restantes">dias restantes</label>
                                                <input oninput="this.value = soloNumeros(this);recalculaDiasRestantes(this.value)" maxLength="11" value=0 id="dias_restantes" name="dias_restantes" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group col-xl-12">
                                                <label for="inputObservaciones">Observaciones</label>
                                                <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones" name="inputObservaciones" rows="2" maxLength="300"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExtra">
                                    <div class="card card-body">
                                        <div class="form-row">
                                            <div class="form-group col-xl-12">
                                                <h6>Agregar pagos extras</h6>
                                                <p>En caso de existir gastos extras , los cuales no figuraron en el
                                                    contrato , se deben detallar en observaciones y colocar el pago extra el
                                                    cual se le sumara al ultimo pago</p>
                                            </div>
                                            <div class="form-group col-xl-12">
                                                <label for="extra_pago">Pago adicional (bruto)($) </label>
                                                <input oninput="this.value = soloNumeros(this);recalcularPagoExtra(this.value)" maxLength="11" value=0 id="extra_pago" name="extra_pago" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group col-xl-12">
                                                <label for="inputObservaciones2">Observaciones</label>
                                                <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones2" name="inputObservaciones2" rows="2" maxLength="300"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="nav-pagos" role="tabpanel" aria-labelledby="nav-pagostotal-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_totalPagos" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th scope="row">Nº arriendo</th>
                                <th>cliente</th>
                                <th>tipo </th>
                                <th>estado</th>
                                <th>monto</th>
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
                                <th>cliente</th>
                                <th>tipo </th>
                                <th>estado</th>
                                <th>monto</th>
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

    <br><br><br><br>
</main>
</div>
</div>







<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_pagoCliente/js_module_pagoCliente.js?v=<?php echo version(); ?>">
</script>

<script src="<?php echo base_route() ?>assets/js/js_gestion/js_pagoCliente/js_module_tablaPagos.js?v=<?php echo version(); ?>">
</script>