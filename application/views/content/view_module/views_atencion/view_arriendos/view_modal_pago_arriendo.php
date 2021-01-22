<?php
$nombreUsuario = $this->session->userdata('nombre')
?>

<!-- Modal pago arriendo -->
<div class="modal fade" id="modal_pago_arriendo" data-backdrop="static" style="overflow-y: scroll;"
    data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
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
                    <div class="form-row">
                        <div class=" col-lg-4">
                            <h5>Datos del arriendo</h5>
                            <div class="form-group">
                                <span id="textTipo" class="input-group-text form-control"></span>
                            </div>
                            <div class="form-group">
                                <span id="textDias" class="input-group-text form-control"></span>
                            </div>
                            <div class="form-group">
                                <span id="textVehiculo" class="input-group-text form-control"></span>
                            </div>
                            <div class="form-group">
                                <span id="textModeloVehiculo" style='font-size: 0.8rem;'
                                    class="input-group-text form-control"></span>
                            </div>
                            <div class="form-group">
                                <span id="textCliente" class="input-group-text form-control"></span>
                            </div>
                            <div class="form-group">
                                <span id="textRemplazo" class="input-group-text form-control"></span>
                            </div>
                            <br>
                            <h5>Agregar mas detalles</h5>
                            <div class="form-group">
                                <label for="inputDigitador">Digitado por</label>
                                <input disabled type="text" class="form-control" id="inputDigitador"
                                    name="inputDigitador" value="<?php echo $nombreUsuario ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="inputObservaciones">Observaciones</label>
                                <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones"
                                    name="inputObservaciones" rows="3" maxLength="300"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5>Pago Cliente</h5>
                            <div class="form-group ">
                                <label for="inputValorCopago">Valor neto copago / valor neto diario arriendo
                                </label>
                                <input value="0" type="number" class="form-control" id="inputValorCopago" maxLength="11"
                                    name="inputValorCopago" oninput="this.value = soloNumeros(this) ;calcularCopago()"
                                    required>
                            </div>
                            <div class="form-group ">
                                <label for="inputSubTotalArriendo">Sub Total neto</label>
                                <input value="0" type="number" class="form-control" id="inputSubTotalArriendo"
                                    maxLength="11" name="inputSubTotalArriendo"
                                    oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>
                            <p>
                                <button class=" badge badge-info" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Agregar accesorios ( + )
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <h5>Accesorios (neto)</h5>
                                <div id="formAccesorios"></div>
                                <br>
                            </div>
                            <div class="form-group ">
                                <label for="inputDescuento">Descuento ( - ) </label>
                                <input min="0" value="0" type="number" class="form-control" id="inputDescuento"
                                    maxLength="11" name="inputDescuento"
                                    oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputNeto">Total neto</label> <span id="lb_neto"></span>
                                <input min="0" value="0" type="number" class="form-control" id="inputNeto"
                                    maxLength="11" name="inputNeto" oninput="calcularValores()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputIVA">Iva</label> <span id="lb_iva"></span>
                                <input min="0" value="0" type="number" class="form-control" id="inputIVA" maxLength="11"
                                    name="inputIVA" oninput="calcularValores()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputTotal" class="font-weight-bold">Total a pagar </label> <span
                                    id="lb_total"></span>
                                <input min="0" value="0" type="number" class="form-control font-weight-bold"
                                    id="inputTotal" maxLength="11" name="inputTotal" oninput="calcularValores()"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="pago_empresa_remplazo">
                                <h5>Pago E. Remplazo</h5>
                                <div class="form-group ">
                                    <label for="inputPagoEmpresa">Pago neto E. reemplazo <span
                                            id="lb_neto_er"></span></label>
                                    <input min="0" value="0" type="number" class="form-control" id="inputPagoEmpresa"
                                        maxLength="11" name="inputPagoEmpresa"
                                        oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputPagoIvaEmpresa">Iva E. reemplazo <span
                                            id="lb_iva_er"></span></label>
                                    <input min="0" value="0" type="number" class="form-control" id="inputPagoIvaEmpresa"
                                        maxLength="11" name="inputPagoIvaEmpresa"
                                        oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputPagoTotalEmpresa">Pago total E. reemplazo <span
                                            id="lb_total_er"></span></label>
                                    <input min="0" value="0" type="number" class="form-control"
                                        id="inputPagoTotalEmpresa" maxLength="11" name="inputPagoTotalEmpresa"
                                        oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
                                </div>
                            </div>
                            <div id="card_pago">
                                <h5>Facturacion</h5>
                                <br>
                                <div class="form-row">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" onclick="facturacion(this.value);" value="PENDIENTE"
                                            id="radioPendiente" name="customRadio1" class="custom-control-input"
                                            checked>
                                        <label class="custom-control-label" for="radioPendiente">Pendiente</label>
                                    </div>
                                    <div hidden class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" onclick="facturacion(this.value);" value="BOLETA"
                                            id="radioBoleta" name="customRadio1" class="custom-control-input">
                                        <label class="custom-control-label" for="radioBoleta">Boleta</label>
                                    </div>
                                    <div hidden class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" onclick="facturacion(this.value);" value="FACTURA"
                                            id="radioFactura" name="customRadio1" class="custom-control-input">
                                        <label class="custom-control-label" for="radioFactura">Factura</label>
                                    </div>
                                </div>
                                <br> <br>
                                <div id="metodo_pago">
                                    <div class="form-group">
                                        <label for="inputNumFacturacion">Numero comprobante</label>
                                        <input maxLength="20" id="inputNumFacturacion" name="inputNumFacturacion"
                                            type="number" class="form-control" placeholder="Nº Boleta/Factura" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFileFacturacion">comprobante</label>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf"
                                            type="file" class="form-control-file" id="inputFileFacturacion"
                                            name="inputFileFacturacion" required>
                                    </div>
                                    <br><br>
                                    <h5>Metodo de pago</h5>
                                    <div class="form-row card-body m-2">
                                        <div class="custom-control custom-radio custom-control-inline col-xl-12 ">
                                            <input type="radio" value=1 id="radioEfectivo" name="customRadio2"
                                                class="custom-control-input" checked>
                                            <label class="custom-control-label" for="radioEfectivo">Pago en
                                                efectivo</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline col-xl-12 ">
                                            <input type="radio" value=2 id="radioCheque" name="customRadio2"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="radioCheque">Pago con
                                                cheque</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline col-xl-12 ">
                                            <input type="radio" value=3 id="radioTarjeta" name="customRadio2"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="radioTarjeta">Pago con Tarjeta
                                                credito/debito</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline col-xl-12 ">
                                            <input type="radio" value=4 id="radioTranferencia" name="customRadio2"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="radioTranferencia">
                                                Pago con Transferencia
                                                electronica</label>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_registrar_pago" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_registrarPago"></span>
                        Registrar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>