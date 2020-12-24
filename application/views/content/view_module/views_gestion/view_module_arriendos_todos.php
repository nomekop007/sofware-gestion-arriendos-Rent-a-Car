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
					<th>fecha registro</th>
					<th>Cliente</th>
					<th>tipo arriendo</th>
					<th>estado</th>
					<th>usuario</th>
					<th></th>
				</tr>
			</thead>
			<tbody style='font-size: 0.8rem;'>
			</tbody>
			<tfoot class="btn-dark">
				<tr>
					<th>Nº</th>
					<th>fecha registro</th>
					<th>Cliente</th>
					<th>tipo arriendo</th>
					<th>estado</th>
					<th>usuario</th>
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
						<div class="form-group col-lg-3">
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
						<div class="form-group col-lg-3">
							<label for="inputEditarConductorArriendo">Conductor</label>
							<input disabled type="text" class="form-control" id="inputEditarConductorArriendo">
						</div>
						<div class="form-group col-lg-4">
							<label for="inputEditarVehiculoArriendo">Vehiculo</label>
							<select class="custom-select " id="inputEditarVehiculoArriendo" name="inputEditarVehiculoArriendo" style="width: 100%;" aria-label="Example select with button addon">
							</select>
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
						</div>
						<div class="form-row card-body">
							<div class="form-group col-xl-12" id="card_tarjeta_garantia">
								<label for="inputNumeroTarjeta">Tarjeta de credito</label>
								<div class="input-group">
									<input style="width: 40%;" oninput="this.value = soloNumeros(this)" type="number" class="form-control" id="inputNumeroTarjeta" name="inputNumeroTarjeta" maxLength="16" placeholder="Nº Tarjeta de credito" required>
									<input style="width: 20%;" name="inputFechaTarjeta" id="inputFechaTarjeta" type="text" aria-label="Last name" class="form-control" maxLength="5" placeholder="ej: 01/01" required>
									<input style="width: 20%;" name="inputFolioTarjeta" id="inputFolioTarjeta" type="number" aria-label="Last name" class="form-control" maxLength="5" placeholder="Nº folio" required>
									<input style="width: 20%;" name="inputCodigoTarjeta" id="inputCodigoTarjeta" type="text" aria-label="Last name" class="form-control" maxLength="20" placeholder="codigo retencion" required>
								</div>
							</div>
							<div class="form-group col-xl-12" id="card_cheque_garantia">
								<label for="inputNumeroCheque">Cheque</label>
								<div class="input-group">
									<input style="width: 40%;" oninput="this.value = soloNumeros(this)" type="number" class="form-control " id="inputNumeroCheque" name="inputNumeroCheque" maxLength="25" placeholder="Nº Cheque" required>
									<input style="width: 30%;" name="inputBancoCheque" id="inputBancoCheque" type="text" aria-label="Last name" class="form-control" maxLength="20" placeholder="Emisor cheque" required>
									<input style="width: 30%;" name="inputCodigoCheque" id="inputCodigoCheque" type="text" aria-label="Last name" class="form-control" maxLength="20" placeholder="Codigo autorizacion" required>
								</div>
							</div>
							<div class="input-group col-xl-12" id="card_abono_garantia">
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
					<button id="btn_finalizar_arriendo" type="button" class="btn  btn-success col-xl-3">
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








<!-- Modal pago arriendo -->
<div class="modal fade" id="modal_pago_arriendo" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								<span id="textModeloVehiculo" class="input-group-text form-control"></span>
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
								<input disabled type="text" class="form-control" id="inputDigitador" name="inputDigitador" value="<?php echo $nombreUsuario ?>" required>
							</div>
							<div class="form-group">
								<label for="inputObservaciones">Observaciones</label>
								<textarea onblur="mayus(this);" class="form-control" id="inputObservaciones" name="inputObservaciones" rows="3" maxLength="300"></textarea>
							</div>
						</div>
						<div class="col-lg-4">
							<h5>Pago Cliente</h5>
							<div class="form-group ">
								<label for="inputValorCopago">Valor neto copago / valor neto diario arriendo </label>
								<input value="0" type="number" class="form-control" id="inputValorCopago" maxLength="11" name="inputValorCopago" oninput="this.value = soloNumeros(this) ;calcularCopago()" required>
							</div>
							<div class="form-group ">
								<label for="inputSubTotalArriendo">Sub Total neto</label>
								<input value="0" type="number" class="form-control" id="inputSubTotalArriendo" maxLength="11" name="inputSubTotalArriendo" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
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
								<label for="inputDescuento">Descuento ( - ) </label>
								<input min="0" value="0" type="number" class="form-control" id="inputDescuento" maxLength="11" name="inputDescuento" oninput="this.value = soloNumeros(this) ;calcularValores()" required>
							</div>
							<div class="form-group ">
								<label for="inputNeto">Total neto</label>
								<input min="0" value="0" type="number" class="form-control" id="inputNeto" maxLength="11" name="inputNeto" oninput="calcularValores()" required>
							</div>
							<div class="form-group ">
								<label for="inputIVA">Iva</label>
								<input min="0" value="0" type="number" class="form-control" id="inputIVA" maxLength="11" name="inputIVA" oninput="calcularValores()" required>
							</div>
							<div class="form-group ">
								<label for="inputTotal" class="font-weight-bold">Total a pagar </label>
								<input min="0" value="0" type="number" class="form-control font-weight-bold" id="inputTotal" maxLength="11" name="inputTotal" oninput="calcularValores()" required>
							</div>
						</div>
						<div class="col-lg-4 ">
							<div class="pago_empresa_remplazo">
								<h5>Pago E. Remplazo</h5>
								<div class="form-group ">
									<label for="inputPagoEmpresa">Pago neto E. reemplazo</label>
									<input min="0" value="0" type="number" class="form-control" id="inputPagoEmpresa" maxLength="11" name="inputPagoEmpresa" oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
								</div>
								<div class="form-group ">
									<label for="inputPagoIvaEmpresa">Iva E. reemplazo</label>
									<input min="0" value="0" type="number" class="form-control" id="inputPagoIvaEmpresa" maxLength="11" name="inputPagoIvaEmpresa" oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
								</div>
								<div class="form-group ">
									<label for="inputPagoTotalEmpresa">Pago total E. reemplazo</label>
									<input min="0" value="0" type="number" class="form-control" id="inputPagoTotalEmpresa" maxLength="11" name="inputPagoTotalEmpresa" oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()" required>
								</div>
							</div>
							<div id="card_pago">
								<h5>Facturacion</h5>
								<br>
								<div class="form-row">
									<div class="custom-control custom-radio custom-control-inline ">
										<input type="radio" onclick="facturacion(this.value);" value="PENDIENTE" id="radioPendiente" name="customRadio1" class="custom-control-input" checked>
										<label class="custom-control-label" for="radioPendiente">Pendiente</label>
									</div>
									<div hidden class="custom-control custom-radio custom-control-inline ">
										<input type="radio" onclick="facturacion(this.value);" value="BOLETA" id="radioBoleta" name="customRadio1" class="custom-control-input">
										<label class="custom-control-label" for="radioBoleta">Boleta</label>
									</div>
									<div hidden class="custom-control custom-radio custom-control-inline ">
										<input type="radio" onclick="facturacion(this.value);" value="FACTURA" id="radioFactura" name="customRadio1" class="custom-control-input">
										<label class="custom-control-label" for="radioFactura">Factura</label>
									</div>
								</div>
								<br> <br>
								<div id="metodo_pago">
									<div class="form-group">
										<label for="inputNumFacturacion">Numero comprobante</label>
										<input maxLength="20" id="inputNumFacturacion" name="inputNumFacturacion" type="number" class="form-control" placeholder="Nº Boleta/Factura" required>
									</div>
									<div class="form-group">
										<label for="inputFileFacturacion">comprobante</label>
										<input accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" id="inputFileFacturacion" name="inputFileFacturacion" required>
									</div>
									<br><br>
									<h5>Metodo de pago</h5>
									<div class="form-row card-body m-2">
										<div class="custom-control custom-radio custom-control-inline col-xl-12 ">
											<input type="radio" value=1 id="radioEfectivo" name="customRadio2" class="custom-control-input" checked>
											<label class="custom-control-label" for="radioEfectivo">Pago en
												efectivo</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline col-xl-12 ">
											<input type="radio" value=2 id="radioCheque" name="customRadio2" class="custom-control-input">
											<label class="custom-control-label" for="radioCheque">Pago con
												cheque</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline col-xl-12 ">
											<input type="radio" value=3 id="radioTarjeta" name="customRadio2" class="custom-control-input">
											<label class="custom-control-label" for="radioTarjeta">Pago con Tarjeta
												credito/debito</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline col-xl-12 ">
											<input type="radio" value=4 id="radioTranferencia" name="customRadio2" class="custom-control-input">
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
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_registrarPago"></span>
						Registrar Pago</button>
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
					<a class="row justify-content-md-center btn-success" target="_blank" id="descargar_contrato">
						<i class="fas fa-download"></i>
						Descargar contrato</a>
					<br>
					<button id="prev_contrato" class=" btn-info">
						< </button> <button id="next_contrato" class=" btn-info "> >
					</button>
					&nbsp; &nbsp;
					<span>Pagina: <span id="page_num_contrato"></span> / <span id="page_count_contrato"></span></span>
					<canvas id="pdf_canvas_contrato" class="img-fluid rounded pdf-canvas"></canvas>
				</div>
				<form id="subir_contrato">
					<div class="form-row card-body">
						<div class="custom-control custom-radio custom-control-inline ">
							<input onclick="tipoContrato(this.value);" type="radio" value="FIRMAR" name="customRadio5" class="custom-control-input" id="radioFirma" checked>
							<label class="custom-control-label" for="radioFirma">Firmar contrato</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline ">
							<input onclick="tipoContrato(this.value);" type="radio" value="SUBIR" name="customRadio5" class="custom-control-input" id="radioSubir">
							<label class="custom-control-label" for="radioSubir">Subir contrato firmado</label>
						</div>
					</div>
					<div class="row" id="body-firma">
						<div class="container col-md-6">
							<br>
							<h6 class="text-center">Firma arrendatario/a:</h6>
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
									<canvas id="canvas_firma_cliente" class="canvas-firma">
									</canvas>
								</div>
								<div class="col-md-12 d-flex justify-content-center">
									<button type="button" id="limpiar_firma_cliente" class="btn btn-secondary btn-sm ">
										limpiar</button>
								</div>
							</div>
						</div>
						<div class="container col-md-6">
							<br>
							<h6 class="text-center">Firma Rent A Car:</h6>
							<div class="row">
								<div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
									<canvas id="canvas_firma_usuario" class="canvas-firma">
									</canvas>
								</div>
								<div class="col-md-12 d-flex justify-content-center">
									<button type="button" id="limpiar_firma_usuario" class="btn btn-secondary btn-sm ">
										limpiar</button>
								</div>
							</div>
						</div>
						<br><br>
						<div class="col-md-12 text-center">
							<button type="button" id="btn_firmar_contrato" class="btn btn-success btn-sm ">
								firmar contrato
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_firmarContrato"></span>
							</button>
							<button type="button" id="btn_confirmar_contrato" class="btn btn-primary btn-sm ">
								Guardar cambios
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_confirmarContrato"></span>
							</button>
						</div>
					</div>
					<div class="row" id="body-subir-contrato">
						<div class="container col-md-12">
							<br><br><br><br>
							<div class="row justify-content-md-center">
								<input type="file" id="inputSubirContrato" name="inputSubirContrato">
							</div>
						</div>
						<div class="container col-md-12 text-center">
							<br><br><br><br><br>
							<button type="button" id="btn_subir_contrato" class="btn btn-primary  ">
								Subir contrato firmado
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_subirContrato"></span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
