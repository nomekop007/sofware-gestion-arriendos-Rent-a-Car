<div class="modal fade" id="modal_pago" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="titulo_modal"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="formPagoArriendo" novalidate>
                <input id="id_pago" type="text" hidden>
                <div class="modal-body">
                    <div class="form-row card-body">
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input type="radio" value="TOTAL" id="radioPagoTotal" name="customRadio0" class="custom-control-input" checked>
                            <label class="custom-control-label" for="radioPagoTotal">Pago total</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input type="radio" value="PARCIAL" id="radioPagoParcial" name="customRadio0" class="custom-control-input">
                            <label class="custom-control-label" for="radioPagoParcial">Pago parcial</label>
                        </div>
                    </div>
                    <div class="container card">
                        <br>
                        <div class="container">
                            <h6>Facturacion</h6>
                            <div class="form-row card-body">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value="BOLETA" id="radioBoleta" name="customRadio1" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="radioBoleta">Boleta</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value="FACTURA" id="radioFactura" name="customRadio1" class="custom-control-input">
                                    <label class="custom-control-label" for="radioFactura">Factura</label>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="form-row card-body">
                                <div class="form-group col-xl-4">
                                    <label for="inputNumFacturacion">Numero comprobante</label>
                                    <input maxLength="20" id="inputNumFacturacion" name="inputNumFacturacion" type="number" class="form-control" placeholder="Nº Boleta/Factura" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputFileFacturacion">Comprobante</label>
                                    <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputFileFacturacion" name="inputFileFacturacion" required>
                                </div>
                            </div>
                            <h6>Metodo de pago</h6>
                            <div class="form-row card-body">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=1 id="radioEfectivo" name="customRadio2" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="radioEfectivo">Efectivo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=2 id="radioCheque" name="customRadio2" class="custom-control-input">
                                    <label class="custom-control-label" for="radioCheque">Cheque</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=3 id="radioTarjeta" name="customRadio2" class="custom-control-input">
                                    <label class="custom-control-label" for="radioTarjeta">Tarjeta
                                        credito/debito</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" value=4 id="radioTranferencia" name="customRadio2" class="custom-control-input">
                                    <label class="custom-control-label" for="radioTranferencia">Transferencia
                                        electronica</label>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_registrar_pago" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_registrarPago"></span>
                        subir comprobante Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>