<?php
$nombreUsuario = $this->session->userdata('nombre')
?>


<!-- Tab con la tabla de los arriendos activos -->
<div class="tab-pane fade" id="nav-arriendos" role="tabpanel" aria-labelledby="nav-arriendos-tab">
    <br><br>
    <div class="scroll">
        <table id="tablaTotalArriendos" class="table table-striped table-bordered " style="width:100%">
            <thead class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>Cliente</th>
                    <th>fecha registro</th>
                    <th>tipo arriendo</th>
                    <th>estado</th>
                    <th>vendedor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>Cliente</th>
                    <th>fecha registro</th>
                    <th>tipo arriendo</th>
                    <th>estado</th>
                    <th>vendedor</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center" id="spinner_tablaTotalArriendos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>
</div>




<!-- Modal ver arriendo -->
<div class="modal fade" id="modal_editar_arriendo" tabindex="-1" aria-labelledby="editarModal" style="overflow-y: scroll;" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModal">Detalle arriendo <span id="numeroArriendoEditar">Nº</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinnerEditar">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="modal-body" id="body_editarArriendo">
                <form class="needs-validation" id="formEditarArriendo" novalidate>
                    <input type="text" id="inputIdArriendoEditar" hidden>
                    <div class=" form-row">
                        <div class="form-group col-lg-2">
                            <label for="inputEditarTipoArriendo">Tipo</label>
                            <input disabled type="text" class="form-control" id="inputEditarTipoArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarEstadoArriendo">Estado</label>
                            <input disabled type="text" class="form-control" id="inputEditarEstadoArriendo">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEditarClienteArriendo">Cliente</label>
                            <input disabled type="text" class="form-control" id="inputEditarClienteArriendo">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEditarConductorArriendo">Conductor</label>
                            <input disabled type="text" class="form-control" id="inputEditarConductorArriendo">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEditarVehiculoArriendo">Vehiculo</label>
                            <input disabled type="text" class="form-control" id="inputEditarVehiculoArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarKentradaArriendo">kilometros inicio</label>
                            <input disabled type="text" class="form-control" id="inputEditarKentradaArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarKsalidaArriendo">kilometros termino</label>
                            <input disabled type="text" class="form-control" id="inputEditarKsalidaArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarCiudadEntregaArriendo">sucursal entrega</label>
                            <input disabled type="text" class="form-control" id="inputEditarCiudadEntregaArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarCiudadRecepcionArriendo">sucursal recepcion</label>
                            <input disabled type="text" class="form-control" id="inputEditarCiudadRecepcionArriendo">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputEditarFechaInicioArriendo">Fecha Inicio</label>
                            <input disabled type="text" class="form-control" id="inputEditarFechaInicioArriendo">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputEditarFechaFinArriendo">Fecha Fin</label>
                            <input disabled type="text" class="form-control" id="inputEditarFechaFinArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarDiasArriendo">Total Dias</label>
                            <input disabled type="text" class="form-control" id="inputEditarDiasArriendo">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="inputEditarSucursal">Sucursal</label>
                            <input disabled type="text" class="form-control" id="inputEditarSucursal">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEditarUsuarioArriendo">Vendedor</label>
                            <input disabled type="text" class="form-control" id="inputEditarUsuarioArriendo">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="inputEditarRegistroArriendo">fecha registro</label>
                            <input disabled type="text" class="form-control" id="inputEditarRegistroArriendo">
                        </div>
                    </div>
                </form>
                <br><br>
                <div id="verDocumentos">
                    <h5>Documentos adjuntos:</h5>
                    <div id="card_documentos">
                    </div>
                </div>
                <form class="needs-validation" id="formSubirDocumentos" novalidate>
                    <div id="ingresarDocumentos">
                        <div class="form-row">
                            <div class="container">
                                <h5> adjuntar Documentos </h5>
                                <div class="card bg-light" id="card_carnet">
                                    <h6>Foto Carnet</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-md-6 ">
                                            <label for="inputCarnetFrontal">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetFrontal" name="inputCarnetFrontal" required>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="inputCarnetTrasera">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetTrasera" name="inputCarnetTrasera" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card bg-light" id="card_licencia">
                                    <h6>Foto licencia de conducir</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-md-6 ">
                                            <label for="inputlicenciaFrontal">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputlicenciaFrontal" name="inputlicenciaFrontal" required>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="inputlicenciaTrasera">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputlicenciaTrasera" name="inputlicenciaTrasera" required>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-12" id="card_domicilio">
                                        <h6 for="inputComprobanteDomicilio">Comprobante de domicilio</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputComprobanteDomicilio" name="inputComprobanteDomicilio" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-md-12" id="card_cartaRemplazo">
                                        <h6 for="inputCartaRemplazo">Carta Empresa Remplazo</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCartaRemplazo" name="inputCartaRemplazo" required>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <h5>Documentos garantia en <span id="nombre_garantia"></span></h5>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-12" id="card_tarjeta">
                                        <h6 for="inputTarjeta">Foto Tarjeta </h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputTarjeta" name="inputTarjeta" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-md-12" id="card_cheque">
                                        <h6 for="inputChequeGarantia">Foto cheque</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputChequeGarantia" name="inputChequeGarantia" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-md-12" id="card_efectivo">
                                        <h6 for="inputBoletaEfectivo">Foto boleta efectivo</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputBoletaEfectivo" name="inputBoletaEfectivo" required>
                                        <br>
                                    </div>
                                </div>
                                <button type="submit" id="btn_subirDocumentos" class="btn btn-sm btn-primary">subir
                                    documentos<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_subirDocumentos"></span></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                    <button disabled type="button" class="btn btn-danger">Anular arriendo</button>
                </div>
            </div>
        </div>
    </div>
</div>








<!-- Modal pago arriendo -->
<div class="modal fade" id="modal_pago_arriendo" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arriendo <span id="numeroArriendoConfirmacion">Nº</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinnerPago">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="formPagoArriendo" novalidate>
                <input type="text" name="inputIdArriendo" id="inputIdArriendo" hidden />
                <input type="text" id="inputDeudor" hidden />
                <input type="text" id="inputDeudorCopago" hidden />
                <input type="text" id="input_pago_dias" hidden />
                <input type="text" name="inputPatenteVehiculo" id="inputPatenteVehiculo" hidden />
                <input type="text" name="inputEstadoArriendo_pago" id="inputEstadoArriendo_pago" hidden>
                <div class="modal-body">
                    <div class="card">
                        <div class="form-row card-body text-center">
                            <span style="width: 50%;" id="textCliente" class=" text-center input-group-text form-control"></span>
                            <span style="width: 50%;" id="textVehiculo" class="  text-center input-group-text form-control"></span>
                        </div>
                    </div>
                    <br><br>
                    <h5>Valor Arriendo</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="input-group col-md-12">
                                <span style="width: 50%;" id="textTipo" value="" class="input-group-text form-control">Tipo
                                    Arriendo:
                                </span>
                                <span style="width: 50%;" id="textDias" class="input-group-text form-control">Cantidad de dias: X</span>
                            </div>
                            <div class="input-group col-md-12 pago_empresa_remplazo">
                                <span style="width: 60%;" class="input-group-text form-control">Pago neto E. remplazo
                                    $</span>
                                <input style="width: 40%;" id="inputPagoEmpresa" name="inputPagoEmpresa" maxLength="11" value="0" type="number" class="form-control" oninput="calcularValores()" required>
                            </div>
                            <div class="input-group col-md-12 pago_empresa_remplazo">
                                <span style="width: 60%;" class="input-group-text form-control">Valor copago $</span>
                                <input style="width: 40%;" oninput="calcularCopago()" id="inputValorCopago" name="inputValorCopago" maxLength="11" value="0" type="number" class="form-control" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>

                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Sub Total neto</span>
                                <input style="width: 40%;" id="inputSubTotalArriendo" name="inputSubTotalArriendo" maxLength="11" value="0" type="number" class="form-control" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>

                        </div>
                    </div>
                    <br><br>
                    <h5>Accesorios</h5>
                    <div class="card">
                        <div class="form-row card-body" id="formAccesorios">
                            <!-- se meustran todos los accesoriso disponibles -->
                        </div>
                    </div>
                    <br><br>
                    <h5>Totales</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Descuento $</span>
                                <input style="width: 40%;" step="0" id="inputDescuento" name="inputDescuento" maxLength="11" value="0" type="number" min=0 class="form-control" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Total Neto $</span>
                                <input oninput="calcularValores()" style="width: 40%;" id="inputNeto" name="inputNeto" min="0" value="0" type="number" class="form-control" required>
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">IVA $</span>
                                <input style="width: 40%;" id="inputIVA" name="inputIVA" min="0" value="0" type="number" class="form-control" oninput="calcularValores()">
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Total a Pagar
                                    $</span>
                                <input style="width: 40%;" value="0" id="inputTotal" name="inputTotal" type="number" min="0" class="form-control" required oninput="calcularValores()">
                            </div>
                        </div>
                    </div>
                    <div id="card_pago">

                        <br><br>
                        <h5>Pago</h5>
                        <div class="card">
                            <h6>Facturacion</h6>
                            <div class="form-row card-body">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" onclick="facturacion(this.value);" value="PENDIENTE" id="radioPendiente" name="customRadio1" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="radioPendiente">Pendiente</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" onclick="facturacion(this.value);" value="BOLETA" id="radioBoleta" name="customRadio1" class="custom-control-input">
                                    <label class="custom-control-label" for="radioBoleta">Boleta</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" onclick="facturacion(this.value);" value="FACTURA" id="radioFactura" name="customRadio1" class="custom-control-input">
                                    <label class="custom-control-label" for="radioFactura">Factura</label>
                                </div>
                            </div>
                            <div id="metodo_pago" class="container">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputNumFacturacion">Numero facturacion</label>
                                        <input maxLength="20" id="inputNumFacturacion" name="inputNumFacturacion" type="number" class="form-control" placeholder="Nº Boleta/Factura" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFileFacturacion">documento facturacion</label>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputFileFacturacion" name="inputFileFacturacion" required>
                                    </div>
                                </div>
                                <h6>Metodo de pago</h6>
                                <div class="form-row card-body">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" value="EFECTIVO" id="radioEfectivo" name="customRadio2" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="radioEfectivo">Efectivo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" value="CHEQUE" id="radioCheque" name="customRadio2" class="custom-control-input">
                                        <label class="custom-control-label" for="radioCheque">Cheque</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" value="TARJETA" id="radioTarjeta" name="customRadio2" class="custom-control-input">
                                        <label class="custom-control-label" for="radioTarjeta">Tarjeta</label>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h5>Mas detalles</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="form-group col-md-12">
                                <label for="inputDigitador">Digitado por</label>
                                <input disabled type="text" class="form-control" id="inputDigitador" name="inputDigitador" value="<?php echo $nombreUsuario ?>" required>
                                <div class="form-group col-md-12">
                                    <label for="inputObservaciones">Observaciones</label>
                                    <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones" name="inputObservaciones" rows="3" maxLength="300"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_registrar_pago" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_registrarPago"></span>
                        Guardar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Modal signature-->
<div class="modal fade" id="modal_firmar_contrato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_firmar_contrato">Firmar Contrato </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="formSpinnerContrato">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="formContratoArriendo">
                <input type="text" id="id_arriendo" hidden>
                <input type="text" id="estado_arriendo" hidden>

                <div class="container ">
                    <a class="row justify-content-md-center" target="_blank" id="descargar_contrato">Descargar contrato</a>
                    <br>
                    <button id="prev_contrato" class=" btn-info">
                        < </button> <button id="next_contrato" class=" btn-info "> >
                    </button>
                    &nbsp; &nbsp;
                    <span>Pagina: <span id="page_num_contrato"></span> / <span id="page_count_contrato"></span></span>
                    <canvas id="pdf_canvas_contrato" class="img-fluid rounded pdf-canvas"></canvas>
                </div>


                <div class="container" id="body-firma">
                    <br>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                            <canvas id="canvas-firma" class="canvas-firma ">
                            </canvas>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="button" id="limpiar-firma" class="btn btn-secondary btn-sm ">
                                limpiar</button>
                            <button type="button" id="btn_firmar_contrato" class="btn btn-success btn-sm ">
                                firmar contrato
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_firmarContrato"></span>
                            </button>
                            <button type="button" id="btn_confirmar_contrato" class="btn btn-primary btn-sm ">
                                guardar cambios
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_confirmarContrato"></span>
                            </button>
                        </div>
                    </div>
                    <br>
                </div>


            </div>
        </div>
    </div>
</div>
