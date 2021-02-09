<!-- Modal tabla extenciones-->
<div class="modal fade" id="modal_ArriendoExtender" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ArriendoExtenderLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoExtenderLabel">Extenciones del arriendo <span id="numeroArriendo">Nº</span> </h5>
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
                <div class="container">
                    <div class="scroll">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">fecha inicio</th>
                                    <th scope="col">fecha fin</th>
                                    <th scope="col">dias</th>
                                    <th scope="col">estado</th>
                                    <th scope="col">vehiculo</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_extenciones">

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button data-toggle='modal' data-target='#modal_registrar_extencion' type="button" class="btn btn-outline-primary">registrar nueva extencion </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal registrar extencion-->
<div class="modal fade" id="modal_registrar_extencion" style="overflow-y: scroll;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nueva extencion del arriendo <span id="titulo_numero_arriendo"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="formExtenderArriendo" novalidate>
                <input hidden type="text" id="id_arriendo_extencion">
                <input hidden type="text" id="inputDeudor_extenderPlazo">
                <input hidden type="text" id="inputDeudorCopago_extenderPlazo">
                <input hidden type="text" id="inputTipoArriendo_extenderPlazo">
                <input hidden type="text" id="inputDiasAcumulados_extenderPlazo">

                <div class="modal-body">
                    <div class="form-row">
                        <div class=" col-lg-4">
                            <h5>Datos del arriendo</h5>
                            <div class="form-group">
                                <label for="inputFechaRecepcion_extenderPlazo">Fecha de recepcion actual</label>
                                <input disabled class="form-control" type="text" name="inputFechaRecepcion_extenderPlazo" id="inputFechaRecepcion_extenderPlazo" readonly required />
                            </div>
                            <div class="form-group">
                                <label for="inputFechaExtender_extenderPlazo">Fecha a extender</label>
                                <input type="text" class="form-control" name="inputFechaExtender_extenderPlazo" id="inputFechaExtender_extenderPlazo" readonly required />
                            </div>
                            <div class="form-group">
                                <label for="inputNumeroDias_extenderPlazo">cantidad de dias</label>
                                <input min="0" value="0" oninput="calcularDiasExtencion()" type="number" class="form-control" name="inputNumeroDias_extenderPlazo" id="inputNumeroDias_extenderPlazo" required>
                            </div>
                            <div class="form-group">
                                <label for="inputVehiculo_extenderPlazo">vehiculo seleccionado</label>
                                <select id="inputVehiculo_extenderPlazo" name="inputVehiculo_extenderPlazo" class="form-control">
                                    <option value="null" selected="selected">Seleccione un vehiculo</option>
                                </select>
                            </div>
                            <br>
                            <h5>Agregar mas detalles</h5>
                            <div class="form-group">
                                <label for="inputDigitador_extenderPlazo">Digitado por</label>
                                <input disabled type="text" class="form-control" id="inputDigitador_extenderPlazo" name="inputDigitador_extenderPlazo" value="<?php echo $this->session->userdata('nombre') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="inputObservaciones_extenderPlazo">Observaciones</label>
                                <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones_extenderPlazo" name="inputObservaciones_extenderPlazo" rows="3" maxLength="300"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5>Pago Cliente</h5>
                            <div class="form-group ">
                                <label for="inputValorCopago_extenderPlazo">Valor neto copago / valor neto diario arriendo
                                </label>
                                <input value="0" type="number" class="form-control" id="inputValorCopago_extenderPlazo" maxLength="11" name="inputValorCopago_extenderPlazo" oninput="this.value = soloNumeros(this) ;calcularCopago()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputSubTotalArriendo_extenderPlazo">Sub Total neto</label>
                                <input value="0" type="number" class="form-control" id="inputSubTotalArriendo_extenderPlazo" maxLength="11" name="inputSubTotalArriendo_extenderPlazo" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>
                            <p>
                                <button class=" badge badge-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Agregar accesorios ( + )
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <h5>Accesorios (neto)</h5>
                                <div id="formAccesorios"></div>
                                <br>
                            </div>
                            <div class="form-group ">
                                <label for="inputDescuento_extenderPlazo">Descuento ( - ) </label>
                                <input min="0" value="0" type="number" class="form-control" id="inputDescuento_extenderPlazo" maxLength="11" name="inputDescuento_extenderPlazo" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputNeto_extenderPlazo">Total neto</label> <span id="lb_neto"></span>
                                <input min="0" value="0" type="number" class="form-control" id="inputNeto_extenderPlazo" maxLength="11" name="inputNeto_extenderPlazo" oninput="calcularValores()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputIVA_extenderPlazo">Iva</label> <span id="lb_iva"></span>
                                <input min="0" value="0" type="number" class="form-control" id="inputIVA_extenderPlazo" maxLength="11" name="inputIVA_extenderPlazo" oninput="calcularValores()" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputTotal_extenderPlazo" class="font-weight-bold">Total a pagar </label> <span id="lb_total"></span>
                                <input min="0" value="0" type="number" class="form-control font-weight-bold" id="inputTotal_extenderPlazo" maxLength="11" name="inputTotal_extenderPlazo" oninput="calcularValores()" required>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="ventana_pago_empresa_remplazo">
                                <h5>Pago E. Remplazo</h5>
                                <div class="form-group ">
                                    <label for="inputPagoEmpresa_extenderPlazo">Pago neto E. reemplazo <span id="lb_neto_er"></span></label>
                                    <input min="0" value="0" type="number" class="form-control" id="inputPagoEmpresa_extenderPlazo" maxLength="11" name="inputPagoEmpresa_extenderPlazo" oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputPagoIvaEmpresa_extenderPlazo">Iva E. reemplazo <span id="lb_iva_er"></span></label>
                                    <input min="0" value="0" type="number" class="form-control" id="inputPagoIvaEmpresa_extenderPlazo" maxLength="11" name="inputPagoIvaEmpresa_extenderPlazo" oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputPagoTotalEmpresa_extenderPlazo">Pago total E. reemplazo <span id="lb_total_er"></span></label>
                                    <input min="0" value="0" type="number" class="form-control" id="inputPagoTotalEmpresa_extenderPlazo" maxLength="11" name="inputPagoTotalEmpresa_extenderPlazo" oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_extenderArriendo" class="btn btn-success">registrar nueva extencion
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_extenderArriendo"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>