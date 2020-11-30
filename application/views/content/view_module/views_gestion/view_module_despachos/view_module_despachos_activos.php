<div class="tab-pane fade show " id="nav-activos" role="tabpanel" aria-labelledby="nav-activos-tab">
    <br><br>
    <div class="scroll">
        <table id="tablaArriendosActivos" class=" table table-striped table-bordered " style="width:100%">
            <thead class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>Cliente</th>
                    <th>Vehiculo</th>
                    <th>tipo arriendo</th>
                    <th>Fecha Recepcion</th>
                    <th>tiempo restante</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>Cliente</th>
                    <th>Vehiculo</th>
                    <th>tipo arriendo</th>
                    <th>Fecha Recepcion</th>
                    <th>tiempo restante</th>
                    <th> </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center" id="spinner_tablaArriendoActivos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>
</div>



<!-- Modal extender plazo arriendo-->
<div class="modal fade" id="modal_ArriendoExtender" data-keyboard="false" tabindex="-1"
    aria-labelledby="modal_ArriendoExtenderLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoExtenderLabel">Extender plazo arriendo <span
                        id="numeroArriendo">Nº</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner_extender_arriendo">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="body_extender_arriendo">
                <form class="needs-validation" id="formExtenderArriendo" novalidate>
                    <input id="id_arriendo" name="id_arriendo" type="text" hidden>
                    <input id="dias_arriendo" name="dias_arriendo" type="text" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputFechaRecepcion_extenderPlazo">Fecha de recepcion</label>
                            <input oninput="calcularDiasExtencion()" type="datetime-local" class="form-control"
                                name="inputFechaRecepcion_extenderPlazo" id="inputFechaRecepcion_extenderPlazo" required
                                disabled>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputFechaExtender_extenderPlazo">Fecha a extender</label>
                            <input oninput="calcularDiasExtencion()" type="datetime-local" class="form-control"
                                name="inputFechaExtender_extenderPlazo" id="inputFechaExtender_extenderPlazo" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputNumeroDias_extenderPlazo">Dias</label>
                            <input min="0" oninput="calcularDiasExtencion()" type="number" class="form-control"
                                name="inputNumeroDias_extenderPlazo" id="inputNumeroDias_extenderPlazo" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" id="btn_extenderArriendo" class="btn btn-primary">extender plazo
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                        id="spinner_btn_extenderArriendo"></span>
                </button>
            </div>
        </div>
    </div>
</div>




<!-- Modal recepcion de arriendo-->
<div class="modal fade" id="modal_ArriendoFinalizar" data-keyboard="false" tabindex="-1" data-backdrop="static"
    style="overflow-y: scroll;" aria-labelledby="modal_ArriendoFinalizarLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoFinalizarLabel">Recepcion de arriendo <span
                        id="numero_arriendo_recepcion">Nº</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner_finalizar_arriendo">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="body_recepcion_arriendo">
                <input id="id_arriendo_recepcion" type="text" hidden>
                <input id="id_vehiculo_recepcion" type="text" hidden>

                <div class="row">
                    <div class="col-md-6">
                        <button id="prev_recepcion" class=" btn-info">
                            < </button> <button id="next_recepcion" class=" btn-info "> >
                                </button>
                                &nbsp; &nbsp;
                                <span>Pagina: <span id="page_num_recepcion"></span> / <span
                                        id="page_count_recepcion"></span></span>
                                <canvas id="pdf_canvas_recepcion" class="img-fluid rounded pdf-canvas"></canvas>
                    </div>
                    <div class="col-md-6">
                        <br><br>
                        <div class="form-group col-lg-12">
                            <div class="container pdf-canvas" id="carrucel_recepcion">
                            </div>
                            <br>
                            <button type="button" class=" btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modalFotosVehiculoRecepcion">
                                Tomar Fotos al vehiculo
                            </button>
                            <button type="button" class="  btn btn-danger btn-sm"
                                id="limpiarArrayFotosRecepcion">limpiar
                                lista</button>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="input_kilometraje_salida">Kilomentraje recepcion del vehiculo</label>
                            <input oninput="this.value = soloNumeros(this)" maxLength="11" type="number" value="0"
                                class="form-control" id="input_kilometraje_salida" name="input_kilometraje_salida"
                                required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-warning" data-toggle="modal"
                    data-target="#modalRegistrarDaño">Registrar daño</button>
                <button type="button" class="btn btn-primary" id="btn_finalizar_arriendo">Finalizar Arriendo
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                        id="spinner_btn_finalizar_contrato"></span>
                </button>
            </div>
        </div>
    </div>
</div>




<!-- Modal fotos auto -->
<div class="modal fade" id="modalFotosVehiculoRecepcion" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cargar Fotos del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <input type="file" class="form-control-file" id="inputImagen_vehiculo_recepcion"
                            accept="image/*">
                        <h4>Maximo 9 fotos </h4>
                    </div>
                    <div class="form-group col-lg-2">
                        <button type="button" id="limpiar_fotoVehiculo_recepcion"
                            class="btn btn-secondary btn-sm form-control ">
                            limpiar pizarra</button>
                    </div>
                    <div class="form-group col-lg-1">
                        <input type="color" class=" form-control" oninput="defcolor(this.value)">
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="grosor">Grosor de linea</label>
                        <input type="range" class="custom-range" oninput="defgrosor(this.value)" value="0" min="1"
                            max="5">
                    </div>
                    <div class="form-group col-lg-3">
                        <button type="button" id="seleccionarFotoRecepcion"
                            class="btn btn-success btn-sm form-control ">
                            añadir foto</button>
                    </div>
                    <div class="form-group col-lg-12 text-center">
                        <br>
                        <p><i class="far fa-square"></i> Abolladuras <i class="far fa-circle"></i> Rayaduras <i
                                class="fas fa-times"></i> Piezas rotas </p>
                        <div class="form-group form-check">
                            <label class="form-check-label" for="dibujar_canvas_recepcion"><input type="checkbox"
                                    class="form-check-input" id="dibujar_canvas_recepcion"
                                    name="dibujar_canvas_recepcion">dibujar en pizarra</label>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="form-group col-lg-12">
                        <div class="vehiculo-canvas" id="cont-canvas">
                            <canvas id="canvas_fotoVehiculo_recepcion" style="background:#d9d9d9"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal registro de daño-->
<div class="modal fade" id="modalRegistrarDaño" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="registrardañoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrardañoLabel">Registrar daño del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>se registrará junto con las fotos sacada al vehículo</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="input_descripcion_danio">Descripcion de los daños</label>
                            <textarea onblur="mayus(this);" class="form-control" id="input_descripcion_danio"
                                name="input_descripcion_danio" rows="3" maxLength="500"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                <button type="button" id="registrar_danio_vehiculo" class="btn btn-warning">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                        id="spinner_btn_registrar_danio"></span>
                    Registrar daño</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal realizar pago -->
<div class="modal fade" id="modalPagoArriendo" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalPagoArriendoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="needs-validation" id="form_pagos_pendientes" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagoArriendoLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="container card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Deudor</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Deuda</th>
                                    <th scope="col">Fecha registro</th>
                                </tr>
                            </thead>
                            <tbody id="tablaPago">
                            </tbody>
                        </table>
                        <h5 id="total_a_pagar"></h5>
                        <br>
                    </div>
                    <br><br>

                    <div class="container card">
                        <br>
                        <div class="container">
                            <h6>Facturacion</h6>
                            <div class="form-row card-body">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" onclick="facturacion(this.value);" value="BOLETA"
                                        id="radioBoleta" name="customRadio1" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="radioBoleta">Boleta</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" onclick="facturacion(this.value);" value="FACTURA"
                                        id="radioFactura" name="customRadio1" class="custom-control-input">
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
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-primary" id="actualizar_pago_arriendo">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_actualizar_pago"></span>Actualizar estado de pago</button>
                </div>

            </div>
        </form>
    </div>
</div>