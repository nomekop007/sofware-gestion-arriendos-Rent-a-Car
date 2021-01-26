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
                        <div class="form-group col-lg-3">
                            <label for="inputEditarTipoArriendo">Tipo <span id="spanTipoArriendo"> </span></label>
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
                        <div class="form-group col-lg-3">
                            <label for="inputEditarConductorArriendo">Conductor</label>
                            <input disabled type="text" class="form-control" id="inputEditarConductorArriendo">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEditarVehiculoArriendo">Vehiculo</label>
                            <input disabled type="text" class="form-control" name="inputEditarVehiculoArriendo" id="inputEditarVehiculoArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarCiudadEntregaArriendo">sucursal entrega</label>
                            <input disabled type="text" class="form-control" name="inputEditarCiudadEntregaArriendo" id="inputEditarCiudadEntregaArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarCiudadRecepcionArriendo">sucursal recepcion</label>
                            <input disabled type="text" class="form-control" name="inputEditarCiudadRecepcionArriendo" id="inputEditarCiudadRecepcionArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarKentradaArriendo">kilometros inicio</label>
                            <input disabled type="text" class="form-control" name="inputEditarKentradaArriendo" id="inputEditarKentradaArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarKsalidaArriendo">kilometros termino</label>
                            <input disabled type="text" class="form-control" id="inputEditarKsalidaArriendo">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputEditarFechaInicioArriendo">Fecha Inicio</label>
                            <input disabled type="text" class="form-control" name="inputEditarFechaInicioArriendo" id="inputEditarFechaInicioArriendo">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputEditarFechaFinArriendo">Fecha Fin</label>
                            <input disabled type="text" class="form-control" name="inputEditarFechaFinArriendo" id="inputEditarFechaFinArriendo">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEditarDiasArriendo">Total Dias</label>
                            <input disabled type="text" class="form-control" name="inputEditarDiasArriendo" id="inputEditarDiasArriendo">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="inputEditarSucursal">Sucursal</label>
                            <input disabled type="text" class="form-control" id="inputEditarSucursal">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEditarGarantiaArriendo">Garantia</label>
                            <input disabled type="text" class="form-control" id="inputEditarGarantiaArriendo">
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
                <br>
                <div id="card_documentos">
                </div>
                <br>
                <form class="needs-validation" id="formGarantia" novalidate>
                    <div class="card  card-body">
                        <br>
                        <h4>Datos garantia</h4>
                        <div class="form-row card-body">
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input onclick="tipoGarantia(this.value);" type="radio" value="EFECTIVO" id="radioEfectivoGarantia" name="customRadio0" class="custom-control-input" checked>
                                <label class="custom-control-label" for="radioEfectivoGarantia">Efectivo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input onclick="tipoGarantia(this.value);" type="radio" value="CHEQUE" id="radioChequeGarantia" name="customRadio0" class="custom-control-input">
                                <label class="custom-control-label" for="radioChequeGarantia">Cheque</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input onclick="tipoGarantia(this.value);" type="radio" value="TARJETA" id="radioTarjetaGarantia" name="customRadio0" class="custom-control-input">
                                <label class="custom-control-label" for="radioTarjetaGarantia">Tarjeta</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input onclick="tipoGarantia(this.value);" type="radio" value="SIN" id="radioSinGarantia" name="customRadio0" class="custom-control-input">
                                <label class="custom-control-label" for="radioSinGarantia">Sin Garantia</label>
                            </div>
                        </div>
                        <div class="form-row card-body">
                            <div class="form-group col-xl-12" id="optionCard_tarjeta_garantia">
                                <label for="inputNumeroTarjeta">Tarjeta de credito</label>
                                <div class="input-group">
                                    <input style="width: 40%;" oninput="this.value = soloNumeros(this)" type="number" class="form-control" id="inputNumeroTarjeta" name="inputNumeroTarjeta" maxLength="16" placeholder="Nº Tarjeta de credito" required>
                                    <input style="width: 20%;" name="inputFechaTarjeta" id="inputFechaTarjeta" type="text" aria-label="Last name" class="form-control" maxLength="5" placeholder="ej: 01/01" required>
                                    <input style="width: 20%;" name="inputFolioTarjeta" id="inputFolioTarjeta" type="number" aria-label="Last name" class="form-control" maxLength="5" placeholder="Nº folio" required>
                                    <input style="width: 20%;" name="inputCodigoTarjeta" id="inputCodigoTarjeta" type="text" aria-label="Last name" class="form-control" maxLength="20" placeholder="codigo retencion" required>
                                </div>

                            </div>
                            <div class="form-group col-xl-12" id="optionCard_cheque_garantia">
                                <label for="inputNumeroCheque">Cheque</label>
                                <div class="input-group">
                                    <input style="width: 40%;" oninput="this.value = soloNumeros(this)" type="number" class="form-control " id="inputNumeroCheque" name="inputNumeroCheque" maxLength="25" placeholder="Nº Cheque" required>
                                    <input style="width: 30%;" name="inputBancoCheque" id="inputBancoCheque" type="text" aria-label="Last name" class="form-control" maxLength="20" placeholder="Emisor cheque" required>
                                    <input style="width: 30%;" name="inputCodigoCheque" id="inputCodigoCheque" type="text" aria-label="Last name" class="form-control" maxLength="20" placeholder="Codigo autorizacion" required>
                                </div>
                            </div>
                            <div class="input-group col-xl-12" id="optionCard_abono_garantia">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Abono $</span>
                                </div>
                                <select id="inputAbono" name="inputAbono" class="form-control" required>
                                    <option value="400000">400.000</option>
                                    <option value="600000">600.000</option>
                                    <option value="650000">650.000</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br><br>
                </form>
                <form class="needs-validation" id="formSubirDocumentos" novalidate>
                    <div class="container card  card-body" id="ingresarDocumentos">
                        <div class="form-row">
                            <div class="container card-body">
                                <br>
                                <h5>Adjuntar garantia </h5>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-xl-12" id="card_tarjeta">
                                        <h6 for="inputTarjeta">Foto comprobante Tarjeta </h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputTarjeta" name="inputTarjeta" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_cheque">
                                        <h6 for="inputChequeGarantia">Foto comprobante cheque</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputChequeGarantia" name="inputChequeGarantia" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_efectivo">
                                        <h6 for="inputBoletaEfectivo">Foto comprobante efectivo</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputBoletaEfectivo" name="inputBoletaEfectivo" required>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <h5>Adjuntar Documentos </h5>
                                <br>
                                <div class="card bg-light" id="card_carnet">
                                    <h6>Foto Carnet</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputCarnetFrontal">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetFrontal" name="inputCarnetFrontal" required>
                                        </div>
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputCarnetTrasera">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarnetTrasera" name="inputCarnetTrasera" required>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="card bg-light" id="card_licencia">
                                    <h6>Foto licencia de conducir</h6>
                                    <div class="row text-center">
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputlicenciaFrontal">(frontal)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputlicenciaFrontal" name="inputlicenciaFrontal" required>
                                        </div>
                                        <div class="form-group col-xl-6 ">
                                            <label for="inputlicenciaTrasera">(trasera)</label>
                                            <input accept="image/x-png,image/gif,image/jpeg ,image/jpg,application/pdf" type="file" class="form-control-file" id="inputlicenciaTrasera" name="inputlicenciaTrasera" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-xl-12" id="card_domicilio">
                                        <h6 for="inputComprobanteDomicilio">Comprobante de domicilio</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputComprobanteDomicilio" name="inputComprobanteDomicilio" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_cartaRemplazo">
                                        <h6 for="inputCartaRemplazo">Carta Empresa Reemplazo</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCartaRemplazo" name="inputCartaRemplazo" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_estatuto">
                                        <h6 for="inputEstatuto">Documento estatuto</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputEstatuto" name="inputEstatuto" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_rol">
                                        <h6 for="inputDocumentotRol">Documento rol </h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputDocumentotRol" name="inputDocumentotRol" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_vigencia">
                                        <h6 for="inputDocumentoVigencia">Documento vigencia</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputDocumentoVigencia" name="inputDocumentoVigencia" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_carpetaTributaria">
                                        <h6 for="inputCarpetaTributaria">Carpeta tributaria (opcional)</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCarpetaTributaria" name="inputCarpetaTributaria" required>
                                        <br>
                                    </div>
                                    <div class="form-group col-xl-12" id="card_cartaAutorizacion">
                                        <h6 for="inputCartaAutorizacion">Carta de autorizacion (opcional)</h6>
                                        <input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputCartaAutorizacion" name="inputCartaAutorizacion" required>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">cerrar</button>
                    <button id="btn_anular_arriendo" type="button" class="btn btn-sm btn-danger col-xl-3">
                        Anular arriendo
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_anular_arriendo"></span></button>
                    <button hidden id="btn_finalizar_arriendo" type="button" class="btn  btn-success col-xl-3">
                        Finalizar arriendo
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_finalizar_arriendo"></span></button>
                    <button type="submit" id="btn_guardar_garantiaRequisitos" class="btn  btn-primary col-xl-3">Guardar
                        cambios
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_guardar_garantiaRequisitos"></span></button>
                </div>
            </div>
        </div>
    </div>

</div>