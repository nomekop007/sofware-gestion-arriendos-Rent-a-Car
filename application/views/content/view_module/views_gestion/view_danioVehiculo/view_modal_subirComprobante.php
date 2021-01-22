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