<div class="modal fade" id="modal_pago" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="titulo_modal"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="formPagoCliente" novalidate>
                <input id="id_pago" type="text" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input disabled type="text" class="form-control" id="deuda_pago">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input disabled type="text" class="form-control" id="dias_pago">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input disabled type="text" class="form-control" id="fecha_registro">
                            </div>
                        </div>
                    </div>
                    <div class="form-row card-body">
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input onclick="tipoComprobante(this.value);" type="radio" value="1" id="radioUnComprobante" name="customRadio0" class="custom-control-input" checked>
                            <label class="custom-control-label" for="radioUnComprobante">pago total</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input onclick="tipoComprobante(this.value);" type="radio" value="2" id="radioMuchosComprobantes" name="customRadio0" class="custom-control-input">
                            <label class="custom-control-label" for="radioMuchosComprobantes">pagos parciales</label>
                        </div>
                    </div>
                    <div class="container card" id="card_un_comprobante">
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
                    <div class="container card" id="card_muchos_comprobantes">

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-xl-3">
                                    <label for="inputCantidad">cantidad de comprobantes</label>
                                    <select onblur="cantidadComprobantes(this.value);" name="inputCantidad" id="inputCantidad" class="form-control">
                                        <option value="null" selected>seleccionar</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6"></div>
                                <div class="form-group col-xl-3">
                                    <label>Pago pendiente?</label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" value="no" id="no" name="customRadio3" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="no">no</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" value="si" id="si" name="customRadio3" class="custom-control-input">
                                        <label class="custom-control-label" for="si">si</label>
                                    </div>
                                </div>
                            </div>
                            <div class="scroll">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="text-center"> facturacion </th>
                                            <th scope="col" class="text-center"> modo pago </th>
                                            <th scope="col" class="text-center"> monto </th>
                                            <th scope="col" class="text-center"> Nº Doc </th>
                                            <th scope="col" class="text-center"> archivo </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_tabla_pagos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_subirComprobantePagoTotal" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_registrarPago"></span>
                        subir comprobante Pago</button>
                    <button type="submit" id="btn_subirComprobates" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_registrarMuchosPagos"></span>
                        subir todos los comprobantes</button>
                </div>
            </form>
        </div>
    </div>
</div>