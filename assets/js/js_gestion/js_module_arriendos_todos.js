//aqui se guarda el base64 del documento seleccionando
let global_base64_documento = null;
const global_documentosArriendo = {
	documentoCliente: false,
	documentoConductor: false
}

const buscarArriendo = async (id_arriendo, option) => {
	limpiarCampos();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_arriendo");
	if (response.success) {
		const arriendo = response.data;
		// si es true carga modal confirmar ; false carga modal editar

		switch (option) {
			case 1:
				mostrarArriendoModalVer(arriendo);
				break;
			case 2:
				mostrarArriendoModalPago(arriendo);
				break;
			case 3:
				$("#id_arriendo").val(arriendo.id_arriendo);
				$("#estado_arriendo").val(arriendo.estado_arriendo);
				mostrarContratoModalContrato(data);
				break;
		}
	}
	$("#formSpinnerPago").hide();
	$("#formSpinnerEditar").hide();
};






const mostrarArriendoModalVer = (arriendo) => {

	$("#body_editarArriendo").show();
	$("#inputFolioTarjeta").val(arriendo.id_arriendo);
	$("#inputIdArriendoEditar").val(arriendo.id_arriendo);
	$("#numeroArriendoEditar").text("Nº" + arriendo.id_arriendo);
	$("#inputEditarTipoArriendo").val(arriendo.tipo_arriendo);
	$("#inputEditarEstadoArriendo").val(arriendo.estado_arriendo);
	$("#inputEditarConductorArriendo").val(
		arriendo.conductore.nombre_conductor +
		" " +
		arriendo.conductore.rut_conductor
	);
	$("#inputEditarVehiculoArriendo").val(arriendo.patente_vehiculo);
	$("#inputEditarKentradaArriendo").val(arriendo.kilometrosEntrada_arriendo);
	$("#inputEditarKsalidaArriendo").val(arriendo.kilometrosSalida_arriendo);
	$("#inputEditarKmantencionArriendo").val(
		arriendo.kilometrosMantencion_arriendo
	);
	$("#inputEditarFechaInicioArriendo").val(
		formatearFechaHora(arriendo.fechaEntrega_arriendo)
	);
	$("#inputEditarFechaFinArriendo").val(
		formatearFechaHora(arriendo.fechaRecepcion_arriendo)
	);
	$("#inputEditarCiudadEntregaArriendo").val(arriendo.ciudadEntrega_arriendo);
	$("#inputEditarCiudadRecepcionArriendo").val(
		arriendo.ciudadRecepcion_arriendo
	);
	$("#inputEditarDiasArriendo").val(arriendo.diasAcumulados_arriendo);
	$("#inputEditarUsuarioArriendo").val(arriendo.usuario.nombre_usuario);
	$("#inputEditarSucursal").val(arriendo.sucursale.nombre_sucursal);
	$("#inputEditarRegistroArriendo").val(formatearFechaHora(arriendo.createdAt));


	$("#card_licencia").show();
	$("#card_carnet").show();



	let documentoCliente = null;
	switch (arriendo.tipo_arriendo) {
		case "PARTICULAR":
			$("#card_domicilio").show();
			$("#inputEditarClienteArriendo").val(`${arriendo.cliente.nombre_cliente}  ${arriendo.cliente.rut_cliente}`);
			documentoCliente = arriendo.cliente.documentosCliente;
			break;
		case "REEMPLAZO":
			$("#card_cartaRemplazo").show();
			$("#inputEditarTipoArriendo").val(arriendo.tipo_arriendo + " " + arriendo.remplazo.codigo_empresaRemplazo);
			$("#inputEditarClienteArriendo").val(`${arriendo.remplazo.cliente.nombre_cliente}  ${arriendo.remplazo.cliente.rut_cliente}`);
			documentoCliente = arriendo.remplazo.cliente.documentosCliente;
			break;
		case "EMPRESA":
			$("#inputEditarClienteArriendo").val(`${arriendo.empresa.nombre_empresa}  ${arriendo.empresa.rut_empresa}`);
			documentoCliente = arriendo.empresa.documentosEmpresa;
			break;
	}


	if (documentoCliente) {
		global_documentosArriendo.documentoCliente = true;
		const c1 = document.createElement("button");
		c1.addEventListener("click", () => buscarDocumento(documentoCliente.carnetFrontal, "requisito"));
		c1.textContent = "Foto carnet frontal";
		c1.className = "badge badge-pill badge-info m-1";
		document.getElementById("card_documentos").append(c1);
		const c2 = document.createElement("button");
		c2.addEventListener("click", () => buscarDocumento(documentoCliente.carnetTrasera, "requisito"));
		c2.textContent = "Foto carnet Trasera";
		c2.className = "badge badge-pill badge-info m-1";
		document.getElementById("card_documentos").append(c2);
	}


	if (arriendo.conductore.documentosConductore) {
		global_documentosArriendo.documentoConductor = true;
		const l1 = document.createElement("button");
		l1.addEventListener("click", () => buscarDocumento(arriendo.conductore.documentosConductore.licenciaConducirFrontal, "requisito"));
		l1.textContent = "Foto licencia de conducir frontal";
		l1.className = "badge badge-pill badge-info m-1";
		document.getElementById("card_documentos").append(l1);
		const l2 = document.createElement("button");
		l2.addEventListener("click", () => buscarDocumento(arriendo.conductore.documentosConductore.licenciaConducirTrasera, "requisito"));
		l2.textContent = "Foto licencia de conducir trasera";
		l2.className = "badge badge-pill badge-info m-1";
		document.getElementById("card_documentos").append(l2);
	}


	if (arriendo.estado_arriendo == "PENDIENTE" || arriendo.estado_arriendo == "CONFIRMADO" || arriendo.estado_arriendo == "FIRMADO") {
		$("#btn_anular_arriendo").show();
		$("#btn_anular_arriendo").attr("disabled", false);
	}
	/* 	if (arriendo.estado_arriendo == "ACTIVO" || arriendo.estado_arriendo == "FIRMADO") {
			$("#btn_finalizar_arriendo").show();
			$("#btn_finalizar_arriendo").attr("disabled", false);
		} */


	if (arriendo.pagosArriendos.length > 0) {
		let N = 1;
		arriendo.pagosArriendos.forEach((pagoArriendo) => {
			if (pagoArriendo.pagos[0].facturacione) {
				const doc = pagoArriendo.pagos[0].facturacione.documento_facturacion
				const facturacion = document.createElement("button");
				facturacion.addEventListener("click", () => buscarDocumento(doc, "facturacion"));
				facturacion.textContent = "Factura Nº" + N;
				facturacion.className = "badge badge-pill badge-info m-1";
				document.getElementById("card_documentos").append(facturacion);
			}
			N++;
		})
	}


	if (arriendo.requisito) {
		const requisito = arriendo.requisito;
		$("#btn_guardar_garantiaRequisitos").hide();



		if (requisito.carnetFrontal_requisito && !documentoCliente) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.carnetFrontal_requisito, "requisito"));
			a.textContent = "Foto carnet frontal";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.carnetTrasera_requisito && !documentoCliente) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.carnetTrasera_requisito, "requisito"));
			a.textContent = "Foto carnet Trasera";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.licenciaConducirFrontal_requisito && !arriendo.conductore.documentosConductore) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.licenciaConducirFrontal_requisito, "requisito"));
			a.textContent = "Foto licencia de conducir frontal";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.licenciaConducirTrasera_requisito && !arriendo.conductore.documentosConductore) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.licenciaConducirTrasera_requisito, "requisito"));
			a.textContent = "Foto licencia de conducir trasera";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}















		if (requisito.tarjetaCredito_requisito) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.tarjetaCredito_requisito, "requisito"));
			a.textContent = "Foto comprobante Tarjeta de credito";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.chequeGarantia_requisito) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.chequeGarantia_requisito, "requisito"));
			a.className = "badge badge-pill badge-info m-1";
			a.textContent = "Foto comprobante cheque ";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.comprobanteDomicilio_requisito) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.comprobanteDomicilio_requisito, "requisito"));
			a.textContent = "Foto comprobante de domicilio";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.cartaRemplazo_requisito) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.cartaRemplazo_requisito, "requisito"));
			a.textContent = "Foto carta de remplazo";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (requisito.boletaEfectivo_requisito) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(requisito.boletaEfectivo_requisito, "requisito"));
			a.textContent = "Foto comprobante efectivo";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.despacho) {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(arriendo.despacho.actasEntrega.documento, "acta"));
			a.textContent = "Acta de entrega";
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
			if (arriendo.despacho.revision_recepcion) {
				const a = document.createElement("button");
				a.addEventListener("click", () => buscarDocumento(arriendo.despacho.revision_recepcion, "recepcion"));
				a.textContent = "Revision recepcion";
				a.className = "badge badge-pill badge-info m-1";
				document.getElementById("card_documentos").append(a);
			}
		}
		let numeroContrato = 1;
		if (arriendo.contratos) {
			arriendo.contratos.map(contrato => {
				const a = document.createElement("button");
				a.addEventListener("click", () => buscarDocumento(contrato.documento, "contrato"));
				a.textContent = `Contrato Nº${numeroContrato}`;
				a.className = "badge badge-pill badge-info m-1";
				document.getElementById("card_documentos").append(a);
				numeroContrato++;
			})
		}
	} else {
		$("#formSubirDocumentos").show();
	}

	if (arriendo.garantia) {
		$("#inputEditarGarantiaArriendo").val(arriendo.garantia.modosPago.nombre_modoPago);
		$("#btn_guardar_garantiaRequisitos").hide();
		switch (arriendo.garantia.id_modoPago) {
			case 1:
				$("#card_cheque").hide();
				$("#card_tarjeta").hide();
				$("#card_efectivo").show();
				break;
			case 2:
				$("#card_tarjeta").hide();
				$("#card_efectivo").hide();
				$("#card_cheque").show();
				break;
			case 3:
				$("#card_efectivo").hide();
				$("#card_cheque").hide();
				$("#card_tarjeta").show();
				break;
		}
	} else {
		$("#formGarantia").show();
	}


};

const mostrarArriendoModalPago = (arriendo) => {
	if (arriendo.estado_arriendo == "PENDIENTE" || arriendo.estado_arriendo == "EXTENDIDO") {

		$("#formPagoArriendo").show();
		$("#numeroArriendoConfirmacion").text("Nº" + arriendo.id_arriendo);
		$("#inputIdArriendo").val(arriendo.id_arriendo);
		const vehiculo = arriendo.vehiculo;
		$("#inputPatenteVehiculo").val(vehiculo.patente_vehiculo);
		$("#textModeloVehiculo").html(`Modelo:  ${vehiculo.marca_vehiculo} ${vehiculo.modelo_vehiculo}  ${vehiculo.año_vehiculo}`)
		$("#textVehiculo").html("Vehiculo : " + arriendo.vehiculo.patente_vehiculo);
		$("#textTipo").html("Tipo de Arriendo: " + arriendo.tipo_arriendo);
		$("#textTipo").val(arriendo.tipo_arriendo);
		$("#inputEstadoArriendo_pago").val(arriendo.estado_arriendo);
		$("#textDias").html("Cantidad de Dias: " + arriendo.diasActuales_arriendo);
		$("#input_pago_dias").val(arriendo.diasActuales_arriendo);
		switch (arriendo.tipo_arriendo) {
			case "PARTICULAR":
				$("#card_pago").show();
				$("#textCliente").html("Cliente: " + arriendo.cliente.nombre_cliente);
				$("#inputDeudor").val(arriendo.rut_cliente);
				break;
			case "REEMPLAZO":
				$(".pago_empresa_remplazo").show();
				$("#inputDeudor").val(arriendo.remplazo.rut_cliente);
				$("#inputDeudorCopago").val(arriendo.remplazo.codigo_empresaRemplazo);
				$("#textCliente").html("Cliente: " + arriendo.remplazo.cliente.nombre_cliente);
				$("#textRemplazo").html("E. Remplazo: " + arriendo.remplazo.codigo_empresaRemplazo);
				break;
			case "EMPRESA":
				$("#card_pago").show();
				$("#inputDeudor").val(arriendo.rut_empresa);
				$("#textCliente").html("Cliente: " + arriendo.empresa.nombre_empresa);
				break;
		}
	} else {
		Swal.fire({
			icon: "warning",
			title: "este pago ya fue emitido",
			text: "ya se registro este pago ",
		});
	}
};



const mostrarContratoModalContrato = async (data) => {
	const response = await ajax_function(data, "generar_PDFcontrato");
	if (response.success) {
		$("#formContratoArriendo").show();

		mostrarVisorPDF(response.data.base64, [
			"pdf_canvas_contrato",
			"page_count_contrato",
			"page_num_contrato",
			"prev_contrato",
			"next_contrato"
		]);
		const a = document.getElementById("descargar_contrato");
		a.href = `data:application/pdf;base64,${response.data.base64}`;
		a.download = `contrato.pdf`;
		global_base64_documento = response.data.base64;

		if (response.data.firma) {
			$("#btn_confirmar_contrato").attr("disabled", false);
		}
	}
	$("#btn_firmar_contrato").attr("disabled", false);
	$("#spinner_btn_firmarContrato").hide();
	$("#formSpinnerContrato").hide();
};




const calcularCopago = () => {
	let valorCopago = Number($("#inputValorCopago").val());
	let dias = Number($("#input_pago_dias").val());
	let NewSubtotal = Number(valorCopago * dias);
	$("#inputSubTotalArriendo").val(NewSubtotal);
	calcularValores();
}


const calcularIvaPagoERemplazo = () => {
	let neto = Number($("#inputPagoEmpresa").val());
	let iva = Number($("#inputPagoIvaEmpresa").val());
	let total = Number($("#inputPagoTotalEmpresa").val());
	iva = Number(neto * 0.19);
	total = Number(neto + iva);
	$("#inputPagoIvaEmpresa").val(Math.round(iva));
	$("#inputPagoTotalEmpresa").val(decimalAdjust(Math.round(total), 1));
}

const calcularValores = () => {

	//variables
	let valorArriendo = Number($("#inputSubTotalArriendo").val());
	let iva = Number($("#inputIVA").val());
	let descuento = Number($("#inputDescuento").val());
	let total = Number($("#inputTotal").val());
	let TotalNeto = 0;
	//revisa todos los check y guardas sus valores en un array si estan okey
	let ArrayAccesorios = $('[name="accesorios[]"]')
		.map(function () {
			return this.value;
		})
		.get();
	for (let i = 0; i < ArrayAccesorios.length; i++) {
		const precioAccesorio = ArrayAccesorios[i];
		TotalNeto += Number(precioAccesorio);
	}
	TotalNeto = TotalNeto + valorArriendo - descuento;
	iva = TotalNeto * 0.19;
	total = TotalNeto + iva;
	$("#inputNeto").val(TotalNeto);
	$("#inputIVA").val(Math.round(iva));
	$("#inputTotal").val(decimalAdjust(Math.round(total), 1));
};




const facturacion = (value) => {
	switch (value) {
		case "PENDIENTE":
			$("#metodo_pago").hide();
			break;
		case "BOLETA":
			$("#metodo_pago").show();
			break;
		case "FACTURA":
			$("#metodo_pago").show();
			break;
	}
};



const tipoGarantia = (value) => {
	switch (value) {
		case "CHEQUE":
			$("#card_cheque_garantia").show();
			$("#foto_cheque").show();
			$("#card_tarjeta_garantia").hide();
			$("#card_abono_garantia").hide();
			$("#card_tarjeta").hide();
			$("#card_efectivo").hide();
			$("#card_cheque").show();

			break;
		case "TARJETA":
			$("#card_tarjeta_garantia").show();
			$("#card_abono_garantia").show();
			$("#foto_tarjeta").show();
			$("#card_cheque_garantia").hide();
			$("#card_efectivo").hide();
			$("#card_cheque").hide();
			$("#card_tarjeta").show();

			break;
		case "EFECTIVO":
			$("#card_abono_garantia").show();
			$("#card_cheque_garantia").hide();
			$("#card_tarjeta_garantia").hide();
			$("#card_cheque_garantia").hide();
			$("#card_cheque").hide();
			$("#card_tarjeta").hide();
			$("#card_efectivo").show();
			break;
	}
};

const tipoContrato = (value) => {
	switch (value) {
		case "FIRMAR":
			$("#body-firma").show();
			$("#body-subir-contrato").hide();

			break;
		case "SUBIR":
			$("#body-subir-contrato").show();
			$("#body-firma").hide();
			break;
	}
}


const limpiarCampos = () => {


	mostrarCanvasDosFirmas(
		["canvas_firma_cliente",
			"canvas_firma_usuario",
			"limpiar_firma_cliente",
			"limpiar_firma_usuario"
		]);

	$("#btn_guardar_garantiaRequisitos").show();
	$("#spinner_btn_subirDocumentos").hide();
	$("#spinner_btn_registrar_garantia").hide();
	$("#spinner_btn_registrarPago").hide();
	$("#spinner_btn_firmarContrato").hide();
	$("#spinner_btn_confirmarContrato").hide();
	$("#spinner_btn_guardar_garantiaRequisitos").hide();
	$("#spinner_btn_anular_arriendo").hide();
	$("#spinner_btn_finalizar_arriendo").hide();
	$("#spinner_btn_subirContrato").hide();

	$("#formPagoArriendo").hide();
	$("#formContratoArriendo").hide();
	$("#body_editarArriendo").hide();
	$("#formPagoArriendo")[0].reset();
	$("#formSubirDocumentos")[0].reset();
	$("#formGarantia")[0].reset();
	$("#formEditarArriendo")[0].reset();
	$("#subir_contrato")[0].reset();
	$("#body-firma").show();
	$("#body-subir-contrato").hide();

	$("#formSubirDocumentos").hide();
	$("#formGarantia").hide();

	$("#numeroArriendoConfirmacion").text("");
	$("#numeroArriendoEditar").text("");
	$("#id_arriendo").val("");
	$("#card_documentos").empty();

	$("#btn_confirmar_contrato").attr("disabled", true);
	$("#btn_anular_arriendo").attr("disabled", true);
	$("#btn_anular_arriendo").hide();
	$("#btn_finalizar_arriendo").attr("disabled", true);
	$("#btn_finalizar_arriendo").hide();
	$("#nombre_documento").val("");
	$(".pago_empresa_remplazo").hide();
	$("#formSpinnerPago").show();
	$("#formSpinnerEditar").show();
	$("#formSpinnerContrato").show();


	$("#textTipo").html("");
	$("#textDias").html("");
	$("#textVehiculo").html("");
	$("#textCliente").html("");
	$("#textRemplazo").html("");



	//modal detalle arriendo
	$("#card_tarjeta_garantia").hide();
	$("#card_cheque_garantia").hide();

	$("#card_tarjeta").hide();
	$("#card_cheque").hide();
	$("#card_efectivo").show();


	$("#card_pago").hide();
	$("#card_carnet").hide();
	$("#card_domicilio").hide();
	$("#card_cartaRemplazo").hide();
	$("#card_licencia").hide();

	$("#ingresarDocumentos").show();
	$("#metodo_pago").hide();
	global_base64_documento = null;
	global_documentosArriendo.documentoCliente = false;
	global_documentosArriendo.documentoConductor = false;
};












//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {

	"geolocation" in navigator ? console.log("Yeih! habemus geolocalización") : alert("el navegador no soporta la geolocalización");

	let config = lenguaje;
	config.paging = false;
	const tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(config);

	$("#nav-arriendos-tab").click(() => refrescarTabla());


	const cargarArriendos = async () => {
		$("#spinner_tablaTotalArriendos").show();
		const response = await ajax_function(null, "cargar_arriendos");
		if (response.success) {
			$.each(response.data, (i, arriendo) => {
				cargarArriendoEnTabla(arriendo);
			});
		}
		$("#spinner_tablaTotalArriendos").hide();
	};


	//cargar vehiculos en select

	const cargarVehiculosEditar = async () => {
		const data = new FormData();
		const response = await ajax_function(data, "cargar_Vehiculos");
		if (response.success) {
			if (response.data) {
				const select = document.getElementById("inputEditarVehiculoArriendo");
				$.each(response.data, (i, o) => {
					const option = document.createElement("option");
					option.innerHTML = `${o.patente_vehiculo} ${o.marca_vehiculo} ${o.modelo_vehiculo} ${o.año_vehiculo}`;
					option.value = o.patente_vehiculo;
					select.appendChild(option);
				});
				$("#inputEditarVehiculoArriendo").attr("disabled", false);
			}
		}
	}
	cargarVehiculosEditar();




	cargarAccesorios = async () => {
		const response = await ajax_function(null, "cargar_accesorios");
		if (response.success) {
			$.each(response.data, (i, o) => {
				if (o.id_accesorio == "1") {
					o.precio_accesorio = "";
				}
				let fila = `
                <div class='input-group '>
                    <label style='width: 70%;font-size: 0.6rem;' class='form-control'>${o.nombre_accesorio}  $${o.precio_accesorio} </label>
                    <input  style='width: 30%;font-size: 0.6rem;' min='0' id='${o.id_accesorio}' maxLength='11' name='accesorios[]' 
                     value='0'  oninput="this.value = soloNumeros(this) ;calcularValores()"
                        type='number' class='form-control' required>
				</div>`;

				$("#formAccesorios").append(fila);
			});
		}
	}
	cargarAccesorios();


	$("#btn_guardar_garantiaRequisitos").click(() => {

		//datos garantia
		const inputNumeroCheque = $("#inputNumeroCheque").val();
		const inputCodigoCheque = $("#inputCodigoCheque").val();
		const inputNumeroTarjeta = $("#inputNumeroTarjeta").val();
		const inputFechaTarjeta = $("#inputFechaTarjeta").val();
		const inputCodigoTarjeta = $("#inputCodigoTarjeta").val();
		const inputAbono = $("#inputAbono").val();
		const inputCarnetFrontal = $("#inputCarnetFrontal").val();
		const inputCarnetTrasera = $("#inputCarnetTrasera").val();
		const inputlicenciaFrontal = $("#inputlicenciaFrontal").val();
		const inputlicenciaTrasera = $("#inputlicenciaTrasera").val();
		const inputComprobanteDomicilio = $("#inputComprobanteDomicilio").val();
		const inputCartaRemplazo = $("#inputCartaRemplazo").val();
		const inputBoletaEfectivo = $("#inputBoletaEfectivo").val();
		const inputChequeGarantia = $("#inputChequeGarantia").val();
		const inputTarjeta = $("#inputTarjeta").val();
		const inputTipoArriendo = $("#inputEditarTipoArriendo").val();
		const inputTipoGarantia = $("input:radio[name=customRadio0]:checked").val();
		//VALIDACION DE LA GARANTIA
		switch (inputTipoGarantia) {
			case "CHEQUE":
				if (inputNumeroCheque.length == 0 || inputChequeGarantia.length == 0 || inputCodigoCheque.length == 0) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de cheque en garantia ",
					});
					return;
				}
				break;
			case "TARJETA":
				if (
					inputNumeroTarjeta.length == 0 ||
					inputFechaTarjeta.length == 0 ||
					inputCodigoTarjeta.length == 0 ||
					inputAbono.length == 0 ||
					inputTarjeta.length == 0
				) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de tarjeta en garantia ",
					});
					return;
				}
				break;
			case "EFECTIVO":
				if (inputAbono.length == 0 || inputBoletaEfectivo.length == 0) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de Abono en garantia ",
					});
					return;
				}
				break;
		}


		//VALIDACION DE LOS ARCHIVOS SI ES QUE NO EXISTEN ANTERIORMENTE

		if (!global_documentosArriendo.documentoCliente) {
			if (inputCarnetFrontal.length == 0 || inputCarnetTrasera.length == 0) {
				Swal.fire(
					"faltan archivos por subir",
					"se necesita subir los archivos requeridos",
					"warning"
				);
				return;
			}
		}

		if (!global_documentosArriendo.documentoConductor) {
			if (inputlicenciaFrontal.length == 0 || inputlicenciaTrasera.length == 0) {
				Swal.fire(
					"faltan archivos por subir",
					"se necesita subir los archivos requeridos",
					"warning"
				);
				return;
			}
		}





		switch (inputTipoArriendo) {
			case "PARTICULAR":
				if (inputComprobanteDomicilio.length == 0) {
					Swal.fire(
						"faltan archivos por subir",
						"se necesita subir los archivos requeridos",
						"warning"
					);
					return;
				}
				break;
			case "REEMPLAZO":
				if (inputCartaRemplazo.length == 0) {
					Swal.fire(
						"faltan archivos por subir",
						"se necesita subir los archivos requeridos",
						"warning"
					);
					return;
				}
				break;
			case "EMPRESA":

				break;
		}
		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de guardar los cambios!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_guardar_garantiaRequisitos").show();
				$("#btn_guardar_garantiaRequisitos").attr("disabled", true);
				const id_arriendo = $("#inputIdArriendoEditar").val();
				const garantia = await guardarDatosGarantia(id_arriendo);
				const requisitos = await guardarDocumentosRequistos(id_arriendo);
				if (garantia.success && requisitos) {

					refrescarTabla();
					Swal.fire(
						"registros guardados con exito!",
						"registros guardados",
						"success"
					);
					$("#modal_editar_arriendo").modal("toggle");
				}
				$("#btn_guardar_garantiaRequisitos").attr("disabled", false);
				$("#spinner_btn_guardar_garantiaRequisitos").hide();
			}
		});
	});





	$("#btn_registrar_pago").click(async () => {
		const tipoArriendo = $("#textTipo").val();
		const tipoPago = $('[name="customRadio1"]:checked').val();
		const numeroFacturacion = $("#inputNumFacturacion").val().length;
		const totalNeto = $("#inputNeto").val();
		const inputFileFacturacion = $("#inputFileFacturacion")[0].files[0];
		if (tipoPago != "PENDIENTE") {
			if (numeroFacturacion == 0 || $("#inputFileFacturacion").val().length == 0) {
				Swal.fire(
					"debe ingresar el comprobante de pago",
					"falta ingresar datos en el formulario",
					"warning"
				);
				return;
			}
		}
		if (totalNeto < 0) {
			Swal.fire(
				"Error en los totales",
				"corriga los totales del arriendo",
				"warning"
			);
			return;
		}
		//valdiacion para que solo los remplazos queden como pendiente
		/* 		if (tipoArriendo != "REEMPLAZO" && tipoPago == "PENDIENTE") {
					Swal.fire(
						"Falta ingresar facturacion",
						"solo los arriendos de remplazo pueden quedar con la facturacion pendiente",
						"warning"
					);
					return;
				} */
		if (
			$("#inputPagoEmpresa").val().length == 0 ||
			$("#inputValorCopago").val().length == 0 ||
			$("#inputSubTotalArriendo").val().length == 0 ||
			$("#inputDescuento").val().length == 0
		) {
			Swal.fire(
				"Error en el formulario",
				"coloque 0 en los campos vacios",
				"warning"
			);
			return;
		}
		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de guardar los cambios!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_registrarPago").show();
				$("#btn_registrar_pago").attr("disabled", true);
				const form = $("#formPagoArriendo")[0];
				const data = new FormData(form);
				const response = await guardarDatosPagoArriendo(data);
				if (response.success) {
					data.append("id_pagoArriendo", response.pagoArriendo.id_pagoArriendo);
					//si existe accesorios los agrega al pagoArriendo
					const matrizAccesorios = await capturarAccesorios();
					console.log(matrizAccesorios);
					if (matrizAccesorios[0].length != 0) {
						data.append("matrizAccesorios", JSON.stringify(matrizAccesorios));
						await guardarDatosPagoAccesorios(data);
					}

					// si se ingreso boleta/factura se guarda junto con el pago y cambia el estado
					if (numeroFacturacion > 0 && tipoPago != "PENDIENTE") {
						const responseFac = await guardarDatosFactura(data);
						if (responseFac.success) {
							data.append("inputEstado", "PAGADO");
							data.append("inputDocumento", inputFileFacturacion);
							data.append("id_facturacion", responseFac.data.id_facturacion);
							await guardarDocumentoFactura(data);
						}
					} else {
						if (Number($("#inputTotal").val()) === 0) {
							data.append("inputEstado", "PAGADO");
						} else {
							data.append("inputEstado", "PENDIENTE");
						}
					}

					data.append("inputDeudor", $("#inputDeudor").val());


					// se guarda el pago del cliente
					await guardarPago(data);

					// en caso de ser tipo remplazo , se guarda el pago PENDIENTE de la empresa remplazo
					if ($("#textTipo").val() === "REEMPLAZO" && $("#inputPagoEmpresa").val() > 0) {
						const data = new FormData();
						data.append("inputEstado", "PENDIENTE");
						data.append("id_pagoArriendo", response.pagoArriendo.id_pagoArriendo);
						data.append("inputDeudor", $("#inputDeudorCopago").val());

						data.append("inputNeto", Number($("#inputPagoEmpresa").val()));
						data.append("inputIVA", Number($("#inputPagoIvaEmpresa").val()));
						data.append("inputTotal", Number($("#inputPagoTotalEmpresa").val()));
						await guardarPago(data);
					}
					await cambiarEstadoArriendo($("#inputEstadoArriendo_pago").val(), $("#inputIdArriendo").val());

					refrescarTabla();
					Swal.fire(
						"datos registrados con exito",
						"se registraron los datos pertinentes!",
						"success"
					);
					$("#modal_pago_arriendo").modal("toggle");
				}

				$("#btn_registrar_pago").attr("disabled", false);
				$("#spinner_btn_registrarPago").hide();

			}
		});
	});


	$("#btn_anular_arriendo").click(() => {
		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de anular este arriendo , una vez anulado no se podra modificar!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_anular_arriendo").show();
				$("#btn_anular_arriendo").attr("disabled", true);
				await cambiarEstadoArriendo("ANULADO", $("#inputIdArriendoEditar").val());
				Swal.fire(
					"Arriendo anulado",
					"arriendo anulado con exito!",
					"success"
				);
				refrescarTabla();
				$("#btn_anular_arriendo").attr("disabled", false);
				$("#spinner_btn_anular_arriendo").hide();
				$("#modal_editar_arriendo").modal("toggle");
			}
		});
	})

	$("#btn_finalizar_arriendo").click(() => {
		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de finalizar este arriendo!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_finalizar_arriendo").show();
				$("#btn_finalizar_arriendo").attr("disabled", true);
				await cambiarEstadoArriendo("FINALIZADO", $("#inputIdArriendoEditar").val());
				Swal.fire(
					"Arriendo finalizado!",
					"arriendo finalizado con exito!",
					"success"
				);
				refrescarTabla();
				$("#btn_finalizar_arriendo").attr("disabled", false);
				$("#spinner_btn_finalizar_arriendo").hide();
				$("#modal_editar_arriendo").modal("toggle");
			}
		});


	});


	$("#btn_firmar_contrato").click(() => {
		$("#btn_firmar_contrato").attr("disabled", true);
		$("#spinner_btn_firmarContrato").show();
		const options = {
			enableHighAccuracy: true,
			timeout: 5000,
			maximumAge: 0,
		};
		navigator.geolocation.getCurrentPosition(
			(success = (pos) => {
				console.log(pos);
				const geo =
					"LAT: " +
					pos.coords.latitude +
					" - LOG: " +
					pos.coords.longitude +
					" - STAMP: " +
					pos.timestamp;
				firmarContrato(geo);
			}),
			(error = (err) => {
				console.log(err);
				alert("no se logro obtener la geolocalizacion , active manualmente");
				firmarContrato("no location");
			}),
			options
		);
	});

	$("#btn_confirmar_contrato").click(() => {
		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de guardar los cambios!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_confirmarContrato").show();
				$("#btn_firmar_contrato").attr("disabled", true);
				$("#btn_confirmar_contrato").attr("disabled", true);

				const data = new FormData();
				data.append("id_arriendo", $("#id_arriendo").val());

				await guardarContrato(data);
				await enviarCorreoContrato(data);
				await cambiarEstadoArriendo($("#estado_arriendo").val(), $("#id_arriendo").val());

				refrescarTabla();
				Swal.fire(
					"Contrato Firmado!",
					"contrato firmado y registrado con exito!",
					"success"
				);
				$("#btn_firmar_contrato").attr("disabled", false);
				$("#btn_confirmar_contrato").attr("disabled", false);
				$("#spinner_btn_confirmarContrato").hide();
				$("#modal_firmar_contrato").modal("toggle");
			}
		});
	});

	$("#btn_subir_contrato").click(() => {

		const inputSubirContrato = $("#inputSubirContrato")[0].files[0];

		if ($("#inputSubirContrato").val().length == 0) {
			Swal.fire(
				"Falta subir el archivo",
				"se debe ingresar el contrato firmado",
				"warning"
			);
			return;
		}

		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de subir el contrato firmado!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_subirContrato").show();
				$("#btn_subir_contrato").attr("disabled", true);

				const data = new FormData();
				data.append("id_arriendo", $("#id_arriendo").val());
				data.append("inputContrato", inputSubirContrato);
				await subirContrato(data);
				await enviarCorreoContrato(data);
				await cambiarEstadoArriendo($("#estado_arriendo").val(), $("#id_arriendo").val());

				Swal.fire(
					"Contrato subido!",
					"contrato  registrado con exito!",
					"success"
				);
				refrescarTabla();
				$("#btn_subir_contrato").attr("disabled", false);
				$("#spinner_btn_subirContrato").hide();
				$("#modal_firmar_contrato").modal("toggle");
			}
		});

	})



	const guardarDatosGarantia = async (idArriendo) => {
		const data = new FormData();
		data.append("inputIdArriendo", idArriendo);
		data.append("inputNumeroTarjeta", $("#inputNumeroTarjeta").val());
		data.append("inputFechaTarjeta", $("#inputFechaTarjeta").val());
		data.append("inputCodigoTarjeta", $("#inputCodigoTarjeta").val());
		data.append("inputNumeroCheque", $("#inputNumeroCheque").val());
		data.append("inputBancoCheque", $("#inputBancoCheque").val());
		data.append("inputFolioTarjeta", $("#inputFolioTarjeta").val());
		data.append("inputCodigoCheque", $("#inputCodigoCheque").val());
		data.append("inputAbono", Number($("#inputAbono").val()));
		data.append("customRadio0", $('[name="customRadio0"]:checked').val());
		return await ajax_function(data, "registrar_garantia");
	};



	const guardarDocumentoFactura = async (data) => {
		return await ajax_function(data, "guardar_documentoFacturacion");
	};

	const guardarPago = async (data) => {
		return await ajax_function(data, "registrar_pago");
	}

	const firmarContrato = (geo) => {
		const canvasCliente = document.getElementById("canvas_firma_cliente");
		const canvasUsuario = document.getElementById("canvas_firma_usuario");

		const data = new FormData();
		data.append("inputFirmaClientePNG", canvasCliente.toDataURL("image/png"));
		data.append("inputFirmaUsuarioPNG", canvasUsuario.toDataURL("image/png"));

		data.append("geolocalizacion", geo);
		data.append("id_arriendo", $("#id_arriendo").val());
		mostrarContratoModalContrato(data);
	};

	const guardarContrato = async (data) => {
		data.append("base64", global_base64_documento);
		await ajax_function(data, "registrar_contrato");
	};

	const subirContrato = async (data) => {
		await ajax_function(data, "subir_contrato");
	};

	const enviarCorreoContrato = async (data) => {
		await ajax_function(data, "enviar_correoContrato");
	};


	const cambiarEstadoArriendo = async (estadoArriendo, idArriendo) => {
		const data = new FormData();
		data.append("id_arriendo", idArriendo);
		switch (estadoArriendo) {
			case "PENDIENTE":
				data.append("estado", "CONFIRMADO");
				break;
			case "EXTENDIDO":
				data.append("estado", "E-CONFIRMADO");
				break;
			case "CONFIRMADO":
				data.append("estado", "FIRMADO");
				break;
			case "E-CONFIRMADO":
				data.append("estado", "ACTIVO");
				break;
			case "ANULADO":
				data.append("estado", "ANULADO");
				break;
			case "FINALIZADO":
				data.append("estado", "FINALIZADO");
				break;
		}
		await ajax_function(data, "cambiarEstado_arriendo");
	};


	const guardarDocumentosRequistos = async (idArriendo) => {
		const data = new FormData();
		//ERROR A SUBIR IMAGENES de mas de 3mbs
		data.append("idArriendo", idArriendo);
		data.append("inputCarnetFrontal", $("#inputCarnetFrontal")[0].files[0]);
		data.append("inputCarnetTrasera", $("#inputCarnetTrasera")[0].files[0]);
		data.append("inputlicenciaFrontal", $("#inputlicenciaFrontal")[0].files[0]);
		data.append("inputlicenciaTrasera", $("#inputlicenciaTrasera")[0].files[0]);
		data.append("inputTarjeta", $("#inputTarjeta")[0].files[0]);
		data.append("inputCheque", $("#inputChequeGarantia")[0].files[0]);
		data.append("inputCartaRemplazo", $("#inputCartaRemplazo")[0].files[0]);
		data.append("inputBoletaEfectivo", $("#inputBoletaEfectivo")[0].files[0]);
		data.append("inputComprobante", $("#inputComprobanteDomicilio")[0].files[0]);
		return await ajax_function(data, "registrar_requisitos");
	};

	const guardarDatosPagoArriendo = async (data) => {
		return await ajax_function(data, "registrar_pagoArriendo");
	};

	const guardarDatosPagoAccesorios = async (data) => {
		await ajax_function(data, "registrar_pagoAccesorios");
	};

	const capturarAccesorios = async () => {
		//cacturando los accesorios
		const matrizAccesorios = [];
		const arrayIdAccesorios = [];
		const arrayValorAccesorios = [];
		const list = $('[name="accesorios[]"]');
		for (let i = 0; i < list.length; i++) {
			let element = list[i];

			if (element.value > 0 && element.length != 0) {
				arrayIdAccesorios.push(element.id);
				arrayValorAccesorios.push(element.value);
			}
		}
		matrizAccesorios.push(arrayIdAccesorios);
		matrizAccesorios.push(arrayValorAccesorios);

		return matrizAccesorios;
	};

	const guardarDatosFactura = async (data) => {
		return await ajax_function(data, "registrar_facturacion");
	};

	const refrescarTabla = () => {
		//limpia la tabla
		tablaTotalArriendos.row().clear().draw(false);
		//carga nuevamente
		cargarArriendos();
	};

	const cargarArriendoEnTabla = (arriendo) => {
		try {
			let cliente = "";
			switch (arriendo.tipo_arriendo) {
				case "PARTICULAR":
					cliente = `${arriendo.cliente.nombre_cliente}`;
					break;
				case "REEMPLAZO":
					cliente = `${arriendo.remplazo.cliente.nombre_cliente}`;
					break;
				case "EMPRESA":
					cliente = `${arriendo.empresa.nombre_empresa}`;
					break;
			}

			let color = "";
			switch (arriendo.estado_arriendo) {
				case "CON DAÑO":
					color = "text-danger"
					break;
				case "FINALIZADO":
					color = "text-success"
					break;
				default:
					break;
			}

			if (arriendo.estado_arriendo == "ANULADO") {
				return;
			}
			tablaTotalArriendos.row
				.add([
					arriendo.id_arriendo,
					formatearFechaHora(arriendo.createdAt),
					cliente,
					arriendo.tipo_arriendo,
					`<span class="${color}">${arriendo.estado_arriendo}</span>`,
					arriendo.usuario.nombre_usuario,
					`<button id='a${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}'  onclick='buscarArriendo(this.value,1)' 
                        data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn-outline-primary'><i class="fas fa-upload"></i></button>
                        <button id='b${arriendo.id_arriendo}' value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,2)' 
                            data-toggle='modal' data-target='#modal_pago_arriendo' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
                            <button id='c${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,3)' 
                                data-toggle='modal' data-target='#modal_firmar_contrato' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>  
                                `,
				])
				.draw(true);


			if (arriendo.requisito && arriendo.garantia || arriendo.estado_arriendo == "ANULADO") {
				$(`#a${arriendo.id_arriendo}`).removeClass("btn-outline-primary");
				$(`#a${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
			}

			if (arriendo.estado_arriendo != "EXTENDIDO" && arriendo.estado_arriendo != "PENDIENTE" || arriendo.estado_arriendo == "ANULADO") {
				$(`#b${arriendo.id_arriendo}`).attr("disabled", true);
				$(`#b${arriendo.id_arriendo}`).removeClass("btn-outline-success");
				$(`#b${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
			}

			if (arriendo.estado_arriendo != "CONFIRMADO" && arriendo.estado_arriendo != "E-CONFIRMADO" || arriendo.estado_arriendo == "ANULADO") {
				$(`#c${arriendo.id_arriendo}`).attr("disabled", true);
				$(`#c${arriendo.id_arriendo}`).removeClass("btn-outline-info");
				$(`#c${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
			}

		} catch (error) {
			console.log("error al cargar este arriendo: " + error);
		}
	};
});
