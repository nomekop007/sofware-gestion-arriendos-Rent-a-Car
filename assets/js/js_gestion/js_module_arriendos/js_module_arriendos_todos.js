//aqui se guarda el base64 del documento seleccionando
let base64_documento = null;


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

	console.log(arriendo)
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
	$("#inputEditarVehiculoArriendo").val(
		arriendo.vehiculo.patente_vehiculo +
		" " +
		arriendo.vehiculo.modelo_vehiculo +
		"  " +
		arriendo.vehiculo.marca_vehiculo +
		" " +
		arriendo.vehiculo.año_vehiculo
	);
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

	$("#card_carnet").show();
	$("#card_licencia").show();
	switch (arriendo.tipo_arriendo) {
		case "PARTICULAR":
			$("#card_domicilio").show();
			$("#inputEditarClienteArriendo").val(
				arriendo.cliente.nombre_cliente + " " + arriendo.cliente.rut_cliente
			);
			break;
		case "REEMPLAZO":
			$("#card_cartaRemplazo").show();
			$("#inputEditarClienteArriendo").val(
				arriendo.remplazo.cliente.nombre_cliente +
				" " +
				arriendo.remplazo.cliente.rut_cliente
			);
			break;
		case "EMPRESA":
			$("#inputEditarClienteArriendo").val(
				arriendo.empresa.nombre_empresa + " " + arriendo.empresa.rut_empresa
			);
			break;
	}

	if (arriendo.garantia == null) {
		$("#formGarantia").show();
	}

	if (arriendo.requisito == null) {
		$("#formSubirDocumentos").show();
	}
};

const mostrarArriendoModalPago = (arriendo) => {
	if (arriendo.estado_arriendo == "PENDIENTE" || arriendo.estado_arriendo == "EXTENDIDO") {

		$("#formPagoArriendo").show();
		$("#numeroArriendoConfirmacion").text("Nº" + arriendo.id_arriendo);
		$("#inputIdArriendo").val(arriendo.id_arriendo);
		$("#inputPatenteVehiculo").val(arriendo.vehiculo.patente_vehiculo);
		$("#textTipo").html("Tipo de Arriendo: " + arriendo.tipo_arriendo);
		$("#textTipo").val(arriendo.tipo_arriendo);
		$("#inputEstadoArriendo_pago").val(arriendo.estado_arriendo);
		$("#textDias").html("Cantidad de Dias: " + arriendo.diasActuales_arriendo);
		$("#input_pago_dias").val(arriendo.diasActuales_arriendo);
		switch (arriendo.tipo_arriendo) {
			case "PARTICULAR":
				$("#card_pago").show();
				$("#textCliente").html(arriendo.cliente.nombre_cliente);
				$("#inputDeudor").val(arriendo.rut_cliente);
				$("#textVehiculo").html(
					"Vehiculo : " + arriendo.vehiculo.patente_vehiculo
				);

				break;
			case "REEMPLAZO":
				$(".pago_empresa_remplazo").show();
				$("#inputDeudor").val(arriendo.remplazo.rut_cliente);
				$("#inputDeudorCopago").val(arriendo.remplazo.codigo_empresaRemplazo);

				$("#textCliente").html(
					arriendo.remplazo.cliente.nombre_cliente +
					" - " +
					arriendo.remplazo.codigo_empresaRemplazo
				);
				$("#textVehiculo").html(
					"Vehiculo : " + arriendo.vehiculo.patente_vehiculo
				);
				break;
			case "EMPRESA":
				$("#card_pago").show();
				$("#inputDeudor").val(arriendo.rut_empresa);
				$("#textCliente").html(arriendo.empresa.nombre_empresa);
				$("#textVehiculo").html(
					"Vehiculo : " + arriendo.vehiculo.patente_vehiculo
				);

				break;
		}
	} else {
		Swal.fire({
			icon: "error",
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


		base64_documento = response.data.base64;

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


//redondea el ultimo valor de un numero 
function decimalAdjust(value, exp) {
	let type = 'round';
	// Si el exp es indefinido o cero...
	if (typeof exp === 'undefined' || +exp === 0) {
		return Math[type](value);
	}
	value = +value;
	exp = +exp;
	// Si el valor no es un número o el exp no es un entero...
	if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
		return NaN;
	}
	// Cambio
	value = value.toString().split('e');
	value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
	// Volver a cambiar
	value = value.toString().split('e');
	return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}




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


const limpiarCampos = () => {


	mostrarCanvasDosFirmas(
		["canvas_firma_cliente",
			"canvas_firma_usuario",
			"limpiar_firma_cliente",
			"limpiar_firma_usuario"
		]);

	//mostrarCanvasFirma("canvas-firma", "limpiar-firma");

	$("#spinner_btn_subirDocumentos").hide();
	$("#spinner_btn_registrar_garantia").hide();
	$("#spinner_btn_registrarPago").hide();
	$("#spinner_btn_firmarContrato").hide();
	$("#spinner_btn_confirmarContrato").hide();

	$("#formPagoArriendo").hide();
	$("#formContratoArriendo").hide();
	$("#body_editarArriendo").hide();

	$("#formPagoArriendo")[0].reset();
	$("#formSubirDocumentos")[0].reset();
	$("#formGarantia")[0].reset();



	$("#formSubirDocumentos").hide();
	$("#formGarantia").hide();

	$("#numeroArriendoConfirmacion").text("");
	$("#numeroArriendoEditar").text("");
	$("#id_arriendo").val("");
	$("#card_documentos").empty();

	$("#btn_confirmar_contrato").attr("disabled", true);

	$("#nombre_documento").val("");
	$(".pago_empresa_remplazo").hide();
	$("#formSpinnerPago").show();
	$("#formSpinnerEditar").show();
	$("#formSpinnerContrato").show();


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
	base64_documento = null;
};












//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {

	"geolocation" in navigator ? console.log("Yeih! habemus geolocalización") : alert("el navegador no soporta la geolocalización");

	const tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);

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


	(cargarAccesorios = async () => {
		const response = await ajax_function(null, "cargar_accesorios");
		if (response.success) {
			$.each(response.data, (i, o) => {
				if (o.id_accesorio == "1") {
					o.precio_accesorio = "";
				}
				let fila = `
                <div class='input-group col-md-12'>
                    <span style='width: 60%;' class='input-group-text form-control'>${o.nombre_accesorio} $${o.precio_accesorio} </span>
                    <input  style='width: 40%;' min='0' id='${o.id_accesorio}' maxLength='11' name='accesorios[]' 
                     value='0'  oninput="this.value = soloNumeros(this) ;calcularValores()"
                        type='number' class='form-control' required>
                </div>`;
				$("#formAccesorios").append(fila);
			});
		}
	})();



	$("#btn_registrar_garantia").click(() => {

		//datos garantia
		const inputNumeroCheque = $("#inputNumeroCheque").val();
		const inputCodigoCheque = $("#inputCodigoCheque").val();
		const inputNumeroTarjeta = $("#inputNumeroTarjeta").val();
		const inputFechaTarjeta = $("#inputFechaTarjeta").val();
		const inputCodigoTarjeta = $("#inputCodigoTarjeta").val();
		const inputAbono = $("#inputAbono").val();
		const inputTipoGarantia = $("input:radio[name=customRadio0]:checked").val();

		//VALIDACION DE LA GARANTIA
		switch (inputTipoGarantia) {
			case "CHEQUE":
				if (inputNumeroCheque.length == 0 || inputCodigoCheque.length == 0) {
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
					inputAbono.length == 0
				) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de tarjeta en garantia ",
					});
					return;
				}
				break;
			case "EFECTIVO":
				if (inputAbono.length == 0) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de Abono en garantia ",
					});
					return;
				}
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
				$("#spinner_btn_registrar_garantia").show();
				$("#btn_registrar_garantia").attr("disabled", true);
				const id_arriendo = $("#inputIdArriendoEditar").val();
				const garantia = await guardarDatosGarantia(id_arriendo);

				if (garantia.success) {

					refrescarTabla();
					Swal.fire(
						"Garantia registrada con exito!",
						"se guardaron la garantia",
						"success"
					);
					$("#modal_editar_arriendo").modal("toggle");
				}
				$("#btn_registrar_garantia").attr("disabled", false);
				$("#spinner_btn_registrar_garantia").hide();
			}
		});


	})


	$("#btn_subirDocumentos").click(() => {


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
				$("#spinner_btn_subirDocumentos").show();
				$("#btn_subirDocumentos").attr("disabled", true);
				const id_arriendo = $("#inputIdArriendoEditar").val();
				const response = await guardarDocumentosRequistos(id_arriendo);
				if (response.success) {

					refrescarTabla();
					Swal.fire(
						"documentos subidos con exito!",
						"se guardaron los documentos",
						"success"
					);
					$("#modal_editar_arriendo").modal("toggle");
				}
				$("#btn_subirDocumentos").attr("disabled", false);
				$("#spinner_btn_subirDocumentos").hide();
			}
		});
	});

	$("#btn_registrar_pago").click(async () => {

		const tipoPago = $('[name="customRadio1"]:checked').val();
		const numeroFacturacion = $("#inputNumFacturacion").val().length;
		const totalNeto = $("#inputNeto").val();
		const inputFileFacturacion = $("#inputFileFacturacion")[0].files[0];
		if (tipoPago != "PENDIENTE") {
			if (numeroFacturacion == 0 || $("#inputFileFacturacion").val().length == 0) {
				Swal.fire(
					"debe ingresar el pago correspondiente",
					"falta ingresar datos en el formulario",
					"error"
				);
				return;
			}
		}
		if (totalNeto < 0) {
			Swal.fire(
				"Error en los totales",
				"corriga los totales del arriendo",
				"error"
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
						data.append("inputEstado", "PENDIENTE");
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

						// se calcula el pago de la empresa remplazo
						let valor = Number($("#inputPagoEmpresa").val());
						let iva = Number(valor * 0.19);
						let total = Number(valor + iva);

						data.append("inputNeto", valor);
						data.append("inputIVA", iva);
						data.append("inputTotal", total);
						await guardarPago(data);
					}
					await cambiarEstadoArriendo($("#inputEstadoArriendo_pago").val(), $("#inputIdArriendo").val());

					refrescarTabla();
					Swal.fire(
						"datos registrados con exito",
						"se registraron los datos pertinentes!",
						"success"
					);
				}

				$("#btn_registrar_pago").attr("disabled", false);
				$("#spinner_btn_registrarPago").hide();
				$("#modal_pago_arriendo").modal("toggle");
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
		data.append("base64", base64_documento);
		await ajax_function(data, "registrar_contrato");
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
		data.append(
			"inputComprobante",
			$("#inputComprobanteDomicilio")[0].files[0]
		);
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
			tablaTotalArriendos.row
				.add([
					arriendo.id_arriendo,
					formatearFechaHora(arriendo.createdAt),
					cliente,
					arriendo.tipo_arriendo,
					arriendo.estado_arriendo,
					arriendo.usuario.nombre_usuario,
					`
                    <button id='a${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}'  onclick='buscarArriendo(this.value,1)' 
                        data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn-outline-primary'><i class="fas fa-upload"></i></button>
                         
                        <button id='b${arriendo.id_arriendo}' value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,2)' 
                            data-toggle='modal' data-target='#modal_pago_arriendo' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
                     
                            <button id='c${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,3)' 
                                data-toggle='modal' data-target='#modal_firmar_contrato' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>  
                                `,
				])
				.draw(false);


			if (arriendo.requisito && arriendo.garantia) {
				$(`#a${arriendo.id_arriendo}`).removeClass("btn-outline-primary");
				$(`#a${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
			}

			if (arriendo.estado_arriendo != "EXTENDIDO" && arriendo.estado_arriendo != "PENDIENTE") {
				$(`#b${arriendo.id_arriendo}`).attr("disabled", true);
				$(`#b${arriendo.id_arriendo}`).removeClass("btn-outline-success");
				$(`#b${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
			}

			if (arriendo.estado_arriendo != "CONFIRMADO" && arriendo.estado_arriendo != "E-CONFIRMADO") {
				$(`#c${arriendo.id_arriendo}`).attr("disabled", true);
				$(`#c${arriendo.id_arriendo}`).removeClass("btn-outline-info");
				$(`#c${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
			}

		} catch (error) {
			console.log("error al cargar este arriendo: " + error);
		}
	};
});
