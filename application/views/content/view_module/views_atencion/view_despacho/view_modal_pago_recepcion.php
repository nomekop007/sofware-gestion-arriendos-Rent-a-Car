<!-- Modal realizar pago -->
<div class="modal fade" id="modalPagoArriendo" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalPagoArriendoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="needs-validation" id="form_pagos_pendientes" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagoArriendoLabel">Actualizacion de pago, arriendo <span
                            id="numero_arriendo_pago">Nº</span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="formSpinner_actualizarPago_arriendo">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="body_actualizarPago_arriendo">

                    <div class="container card">
                        <div class="scroll">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Deudor</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Deuda</th>
                                        <th scope="col">Dias</th>
                                        <th scope="col">Fecha registro</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaPago">
                                </tbody>
                            </table>
                        </div>
                        <h5 id="total_a_pagar"></h5>
                        <h6 id="dias_totales"></h6>
                        <div id="descuento_copago">
                            <br>
                            <p>
                                <button class="badge badge-info" type="button" data-toggle="collapse"
                                    data-target="#collapseDescuento" aria-expanded="false"
                                    aria-controls="collapseDescuento">
                                    aplicar descuento
                                </button>
                            </p>
                            <div class="collapse" id="collapseDescuento">
                                <div class="card card-body">
                                    <div class="form-row">
                                        <div class="form-group col-xl-12">
                                            <h5>Aplicar descuento al pago total</h5>
                                            <span>en caso de que el cliente devuelva el vehículo antes de tiempo ,o por
                                                cualquier inconveniente se
                                                puede aplicar un descuento al último pago realizado </span>
                                        </div>
                                        <div class="form-group col-xl-5">
                                            <label for="descuento_pago">descuento (bruto)($) </label>
                                            <input
                                                oninput="this.value = soloNumeros(this);recalcularPagoDescuento(this.value)"
                                                maxLength="11" value=0 id="descuento_pago" name="descuento_pago"
                                                type="number" class="form-control" required>
                                        </div>
                                        <div class="form-group col-xl-7">
                                            <label for="dias_restantes">dias restantes</label>
                                            <input id="dias_restantes" name="dias_restantes" type="text"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-xl-12">
                                            <label for="inputObservaciones">Observaciones</label>
                                            <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones"
                                                name="inputObservaciones" rows="3" maxLength="300"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <p>
                                <button class="badge badge-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseExtra" aria-expanded="false" aria-controls="collapseExtra">
                                    agregar pago extra
                                </button>
                            </p>
                            <div class="collapse" id="collapseExtra">
                                <div class="card card-body">
                                    <div class="form-row">
                                        <div class="form-group col-xl-12">
                                            <h5>Agregar pagos extras</h5>
                                            <span>En caso de existir gastos extras , los cuales no figuraron en el
                                                contrato , se deben detallar en observaciones y colocar el pago extra el
                                                cual se le sumara al ultimo pago</span>
                                        </div>
                                        <div class="form-group col-xl-5">
                                            <label for="extra_pago">Pago adicional (bruto)($) </label>
                                            <input
                                                oninput="this.value = soloNumeros(this);recalcularPagoExtra(this.value)"
                                                maxLength="11" value=0 id="extra_pago" name="extra_pago" type="number"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-xl-7">
                                        </div>
                                        <div class="form-group col-xl-12">
                                            <label for="inputObservaciones2">Observaciones</label>
                                            <textarea onblur="mayus(this);" class="form-control"
                                                id="inputObservaciones2" name="inputObservaciones2" rows="3"
                                                maxLength="300"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
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
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                        <button type="submit" class="btn btn-success" id="actualizar_pago_arriendo">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                id="spinner_btn_actualizar_pago"></span>Actualizar estado de pago</button>
                    </div>

                </div>
        </form>
    </div>
</div>