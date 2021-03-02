<div class="modal fade" id="modal_pagoExtra" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar pago extra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="spinnerModalPagoExtra">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="modalViewPagoExtra">
                <br>
                <form class="needs-validation" id="formPagoExtra" novalidate>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="number" name="monto_pagoExtra" id="monto_pagoExtra" class="form-control" placeholder="monto bruto $">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" name="descripcion_pagoExtra" id="descripcion_pagoExtra" class="form-control" placeholder="descripcion">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="tipo_pagoExtra" id="tipo_pagoExtra">
                                    <option value="PAGO EXTRA" selected> PAGO EXTRA </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button id="btn_createPagoExtra" type="submit" class="btn btn-outline-success">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="scroll" style="overflow: scroll; height:250px;">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center"> Nº </th>
                                <th scope="col" class="text-center"> monto </th>
                                <th scope="col" class="text-center"> detalle </th>
                                <th scope="col" class="text-center"> tipo </th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody id="tbody_tabla_pagosExtra">
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <input disabled type="text" id="montoTotal_pagoExtra" class="form-control">
                    </div>
                    <div class="col-md-1" id="view_btnFacturaPagoExtra">
                    </div>
                </div>
                <br>
                <form class="needs-validation" id="formFacturacion_pagosExtra" novalidate>
                    <div class="container">
                        <h6>Facturacion</h6>
                        <div class="form-row card-body">
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="BOLETA" id="radioBoleta_pagoExtra" name="customRadio_pagoExtra1" class="custom-control-input" checked>
                                <label class="custom-control-label" for="radioBoleta_pagoExtra">Boleta</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="FACTURA" id="radioFactura_pagoExtra" name="customRadio_pagoExtra1" class="custom-control-input">
                                <label class="custom-control-label" for="radioFactura_pagoExtra">Factura</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row ">
                            <div class="form-group col-xl-4">
                                <label for="inputNumFacturacion_pagoExtra">Numero comprobante</label>
                                <input maxLength="20" id="inputNumFacturacion_pagoExtra" name="inputNumFacturacion_pagoExtra" type="number" class="form-control" placeholder="Nº Boleta/Factura" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="inputFileFacturacion_pagoExtra">Comprobante</label>
                                <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputFileFacturacion_pagoExtra" name="inputFileFacturacion_pagoExtra" required>
                            </div>
                        </div>
                        <br>
                        <h6>Metodo de pago</h6>
                        <div class="form-row">
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value=1 id="radioEfectivo_pagoExtra" name="customRadio_pagoExtra2" class="custom-control-input" checked>
                                <label class="custom-control-label" for="radioEfectivo_pagoExtra">Efectivo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value=2 id="radioCheque_pagoExtra" name="customRadio_pagoExtra2" class="custom-control-input">
                                <label class="custom-control-label" for="radioCheque_pagoExtra">Cheque</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value=3 id="radioTarjeta_pagoExtra" name="customRadio_pagoExtra2" class="custom-control-input">
                                <label class="custom-control-label" for="radioTarjeta_pagoExtra">Tarjeta
                                    credito/debito</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value=4 id="radioTranferencia_pagoExtra" name="customRadio_pagoExtra2" class="custom-control-input">
                                <label class="custom-control-label" for="radioTranferencia_pagoExtra">Transferencia
                                    electronica</label>
                            </div>
                        </div>
                        <br><br>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-success" id="btn_facturacion_pagoExtra">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_facturacionPagoExtra"></span>
                    Subir comprobante de todos los pagos extras</button>
            </div>
            </form>

        </div>
    </div>
</div>