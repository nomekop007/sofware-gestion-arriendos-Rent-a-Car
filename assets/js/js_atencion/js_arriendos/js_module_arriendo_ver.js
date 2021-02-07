
let global_documentosArriendo = {
	documentoCliente: {
		carnetFrontal: false,
		carnetTrasera: false,
		comprobanteDomicilio: false,
	},
	documentoConductor: {
		licenciaConducirFrontal: false,
		licenciaConducirTrasera: false,
	},
	documentoEmpresa: {
		documentoEstatuto: false,
		documentoRol: false,
		documentoVigencia: false,
		carnetFrontal: false,
		carnetTrasera: false,
	}
};



const mostrarArriendoModalVer = (arriendo) => {
	limpiarCamposModalver();
	$("#inputFolioTarjeta").val(arriendo.id_arriendo);
	$("#inputIdArriendoEditar").val(arriendo.id_arriendo);
	$("#numeroArriendoEditar").text("Nº" + arriendo.id_arriendo);
	$("#inputEditarTipoArriendo").val(arriendo.tipo_arriendo);
	$("#inputEditarEstadoArriendo").val(arriendo.estado_arriendo);
	$("#inputEditarConductorArriendo").val(`${arriendo.conductore.nombre_conductor} ${arriendo.conductore.rut_conductor}`);
	$("#inputEditarVehiculoArriendo").val(`${arriendo.vehiculo.patente_vehiculo} ${arriendo.vehiculo.marca_vehiculo} ${arriendo.vehiculo.modelo_vehiculo} ${arriendo.vehiculo.año_vehiculo}`);
	$("#inputEditarKentradaArriendo").val(arriendo.kilometrosEntrada_arriendo);
	$("#inputEditarKsalidaArriendo").val(arriendo.kilometrosSalida_arriendo);
	$("#inputEditarKmantencionArriendo").val(arriendo.kilometrosMantencion_arriendo);
	$("#inputEditarFechaInicioArriendo").val(formatearFechaHora(arriendo.fechaEntrega_arriendo));
	$("#inputEditarFechaFinArriendo").val(formatearFechaHora(arriendo.fechaRecepcion_arriendo));
	$("#inputEditarCiudadEntregaArriendo").val(arriendo.ciudadEntrega_arriendo);
	$("#inputEditarCiudadRecepcionArriendo").val(arriendo.ciudadRecepcion_arriendo);
	$("#inputEditarDiasArriendo").val(arriendo.diasAcumulados_arriendo);
	$("#inputEditarUsuarioArriendo").val(arriendo.usuario.nombre_usuario);
	$("#inputEditarSucursal").val(arriendo.sucursale.nombre_sucursal);
	$("#inputEditarRegistroArriendo").val(formatearFechaHora(arriendo.createdAt));
	if (arriendo.estado_arriendo == "PENDIENTE" || arriendo.estado_arriendo == "CONFIRMADO" || arriendo.estado_arriendo == "FIRMADO") {
		$("#btn_anular_arriendo").show();
		$("#btn_anular_arriendo").attr("disabled", false);
	}
	let clienteDoc = null;
	switch (arriendo.tipo_arriendo) {
		case "PARTICULAR":
			$("#card_licencia").show();
			$("#card_carnet").show();
			$("#card_domicilio").show();
			$("#inputEditarClienteArriendo").val(`${arriendo.cliente.nombre_cliente}  ${arriendo.cliente.rut_cliente}`);
			clienteDoc = arriendo.cliente;
			break;
		case "REEMPLAZO":
			$("#card_licencia").show();
			$("#card_carnet").show();
			$("#card_cartaRemplazo").show();
			$("#spanTipoArriendo").html("( E. Reemplazo : " + arriendo.remplazo.codigo_empresaRemplazo + " )");
			$("#inputEditarClienteArriendo").val(`${arriendo.remplazo.cliente.nombre_cliente}  ${arriendo.remplazo.cliente.rut_cliente}`);
			clienteDoc = arriendo.remplazo.cliente;
			break;
		case "EMPRESA":
			$("#card_licencia").show();
			$("#card_carnet").show();
			$("#card_estatuto").show();
			$("#card_rol").show();
			$("#card_vigencia").show();
			$("#card_carpetaTributaria").show();
			$("#card_cartaAutorizacion").show();
			$("#inputEditarClienteArriendo").val(`${arriendo.empresa.nombre_empresa}  ${arriendo.empresa.rut_empresa}`);
			clienteDoc = arriendo.empresa;
			break;
	}
	if (clienteDoc.documentosCliente && !arriendo.requisito) {
		const docs = clienteDoc.documentosCliente;
		for (const documento in docs) {
			if (docs[documento]) {
				global_documentosArriendo.documentoCliente[documento] = true;
				const button = document.createElement("button");
				button.addEventListener("click", () => buscarDocumento(docs[documento], "requisito"));
				button.textContent = documento;
				button.className = "badge badge-pill badge-warning m-1";
				document.getElementById("card_documentos").append(button);
			}
		}
	}
	if (clienteDoc.documentosEmpresa && !arriendo.requisito) {
		const docs = clienteDoc.documentosEmpresa;
		for (const documento in docs) {
			if (docs[documento]) {
				global_documentosArriendo.documentoEmpresa[documento] = true
				const button = document.createElement("button");
				button.addEventListener("click", () => buscarDocumento(docs[documento], "requisito"));
				button.textContent = documento;
				button.className = "badge badge-pill badge-warning m-1";
				document.getElementById("card_documentos").append(button);
			}
		}
	}
	if (arriendo.conductore.documentosConductore && !arriendo.requisito) {
		const docs = arriendo.conductore.documentosConductore;
		for (const documento in docs) {
			if (docs[documento]) {
				global_documentosArriendo.documentoConductor[documento] = true;
				const button = document.createElement("button");
				button.addEventListener("click", () => buscarDocumento(docs[documento], "requisito"));
				button.textContent = documento;
				button.className = "badge badge-pill badge-warning m-1";
				document.getElementById("card_documentos").append(button)
			}
		}
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
	if (arriendo.contratos) {
		let numeroContrato = 1;
		arriendo.contratos.map(contrato => {
			const a = document.createElement("button");
			a.addEventListener("click", () => buscarDocumento(contrato.documento, "contrato"));
			a.textContent = `Contrato Nº${numeroContrato}`;
			a.className = "badge badge-pill badge-info m-1";
			document.getElementById("card_documentos").append(a);
			numeroContrato++;
		})
	}
	if (arriendo.garantia) {
		$("#inputEditarGarantiaArriendo").val(arriendo.garantia.modosPago.nombre_modoPago);
	} else {
		$("#inputEditarGarantiaArriendo").val(" Sin Garantia ");
	}
	if (arriendo.requisito) {
		const requisito = arriendo.requisito;
		$("#btn_guardar_garantiaRequisitos").hide();
		for (const documento in requisito) {
			if (requisito[documento]) {
				if (requisito[documento]) {
					const button = document.createElement("button");
					button.addEventListener("click", () => buscarDocumento(requisito[documento], "requisito"));
					button.textContent = documento;
					button.className = "badge badge-pill badge-info m-1";
					document.getElementById("card_documentos").append(button);
				}
			}
		}
	} else {
		$("#formGarantia").show();
		$("#inputEditarGarantiaArriendo").val("");
		$("#formSubirDocumentos").show();
		// se ocultan los input de los documentos que ya estan subidos
		switch (arriendo.tipo_arriendo) {
			case "PARTICULAR":
				if (global_documentosArriendo.documentoCliente.carnetFrontal) $("#card_carnet").hide();
				if (global_documentosArriendo.documentoCliente.comprobanteDomicilio) $("#card_domicilio").hide();
				if (global_documentosArriendo.documentoConductor.licenciaConducirFrontal) $("#card_licencia").hide();
				break;
			case "REEMPLAZO":
				if (global_documentosArriendo.documentoCliente.carnetFrontal) $("#card_carnet").hide();
				if (global_documentosArriendo.documentoCliente.comprobanteDomicilio) $("#card_domicilio").hide();
				if (global_documentosArriendo.documentoConductor.licenciaConducirFrontal) $("#card_licencia").hide();
				break;
			case "EMPRESA":
				if (global_documentosArriendo.documentoEmpresa.carnetFrontal) $("#card_carnet").hide();
				if (global_documentosArriendo.documentoEmpresa.documentoEstatuto) $("#card_estatuto").hide();
				if (global_documentosArriendo.documentoEmpresa.documentoRol) $("#card_rol").hide();
				if (global_documentosArriendo.documentoEmpresa.documentoVigencia) $("#card_vigencia").hide();
				if (global_documentosArriendo.documentoConductor.licenciaConducirFrontal) $("#card_licencia").hide();
				break;
		}
	}
	$("#formSpinnerEditar").hide();
	$("#body_editarArriendo").show();
};





const tipoGarantia = (value) => {
	switch (value) {
		case "CHEQUE":
			$("#optionCard_abono_garantia").hide();
			$("#optionCard_cheque_garantia").show();
			$("#optionCard_tarjeta_garantia").hide();
			$("#card_efectivo").hide();
			$("#card_cheque").show();
			$("#card_tarjeta").hide();
			break;
		case "TARJETA":
			$("#optionCard_abono_garantia").show();
			$("#optionCard_cheque_garantia").hide();
			$("#optionCard_tarjeta_garantia").show();
			$("#card_efectivo").hide();
			$("#card_cheque").hide();
			$("#card_tarjeta").show();
			break;
		case "EFECTIVO":
			$("#optionCard_abono_garantia").show();
			$("#optionCard_cheque_garantia").hide();
			$("#optionCard_tarjeta_garantia").hide();
			$("#card_efectivo").show();
			$("#card_cheque").hide();
			$("#card_tarjeta").hide();
			break;
		case "SIN":
			$("#optionCard_abono_garantia").hide();
			$("#optionCard_cheque_garantia").hide();
			$("#optionCard_tarjeta_garantia").hide();
			$("#card_cheque").hide();
			$("#card_tarjeta").hide();
			$("#card_efectivo").hide();
			break;
	}
};



const limpiarCamposModalver = () => {
	$("#btn_guardar_garantiaRequisitos").show();
	$("#spinner_btn_subirDocumentos").hide();
	$("#spinner_btn_registrar_garantia").hide();
	$("#spinner_btn_guardar_garantiaRequisitos").hide();
	$("#spinner_btn_anular_arriendo").hide();
	$("#spinner_btn_finalizar_arriendo").hide();

	$("#formSubirDocumentos")[0].reset();
	$("#formGarantia")[0].reset();
	$("#formEditarArriendo")[0].reset();
	$("#formSubirDocumentos").hide();
	$("#formGarantia").hide();
	$("#numeroArriendoEditar").text("");
	$("#card_documentos").empty();
	$("#btn_anular_arriendo").attr("disabled", true);
	$("#btn_anular_arriendo").hide();
	$("#btn_finalizar_arriendo").attr("disabled", true);
	$("#btn_finalizar_arriendo").hide();
	$("#nombre_documento").val("");
	$("#formSpinnerEditar").show();
	$("#spanTipoArriendo").html("");
	$("#optionCard_abono_garantia").show();
	$("#optionCard_tarjeta_garantia").hide();
	$("#optionCard_cheque_garantia").hide();

	$("#card_tarjeta").hide();
	$("#card_cheque").hide();
	$("#card_efectivo").show();
	$("#card_pago").hide();
	$("#card_carnet").hide();
	$("#card_domicilio").hide();
	$("#card_cartaRemplazo").hide();
	$("#card_licencia").hide();
	$("#card_estatuto").hide();
	$("#card_rol").hide();
	$("#card_vigencia").hide();
	$("#card_carpetaTributaria").hide();
	$("#card_cartaAutorizacion").hide();

	$("#ingresarDocumentos").show();
	$("#body_editarArriendo").hide();
	global_documentosArriendo = {
		documentoCliente: {
			carnetFrontal: false,
			carnetTrasera: false,
			comprobanteDomicilio: false,
		},
		documentoConductor: {
			licenciaConducirFrontal: false,
			licenciaConducirTrasera: false,
		},
		documentoEmpresa: {
			documentoEstatuto: false,
			documentoRol: false,
			documentoVigencia: false,
			carnetFrontal: false,
			carnetTrasera: false,
		}
	};
};








$(document).ready(() => {



	$("#btn_guardar_garantiaRequisitos").click(() => {
		//SE VALIDAN LOS DOCUMENTOS
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
		const inputEstatuto = $("#inputEstatuto").val();
		const inputRol = $("#inputDocumentotRol").val();
		const inputVigencia = $("#inputDocumentoVigencia").val();
		const inputTipoGarantia = $("input:radio[name=customRadio0]:checked").val();



		//VALIDACION DE LA GARANTIA
		switch (inputTipoGarantia) {
			case "CHEQUE":
				if (inputNumeroCheque.length == 0 || inputChequeGarantia.length == 0 || inputCodigoCheque.length == 0) {
					Swal.fire({ icon: "warning", title: "Faltan datos de cheque en garantia ", });
					return;
				}
				break;
			case "TARJETA":
				if (inputNumeroTarjeta.length == 0 || inputFechaTarjeta.length == 0 || inputCodigoTarjeta.length == 0 || inputAbono.length == 0 || inputTarjeta.length == 0) {
					Swal.fire({ icon: "warning", title: "Faltan datos de tarjeta en garantia ", });
					return;
				}
				break;
			case "EFECTIVO":
				if (inputAbono.length == 0 || inputBoletaEfectivo.length == 0) {
					Swal.fire({ icon: "warning", title: "Faltan datos de Abono en garantia ", });
					return;
				}
				break;
			case "SIN":
				break;
		}


		//VALIDACION DE LOS ARCHIVOS SI ES QUE NO EXISTEN ANTERIORMENTE
		switch (inputTipoArriendo) {
			case "PARTICULAR":
				if (!global_documentosArriendo.documentoCliente.carnetFrontal) {
					if (inputCarnetFrontal.length == 0 || inputCarnetTrasera.length == 0) {
						Swal.fire("faltan archivos del cliente por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoCliente.comprobanteDomicilio) {
					if (inputComprobanteDomicilio.length == 0) {
						Swal.fire("faltan archivos del cliente por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoConductor.licenciaConducirFrontal) {
					if (inputlicenciaFrontal.length == 0 || inputlicenciaTrasera.length == 0) {
						Swal.fire("faltan archivos del conductor por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				break;
			case "REEMPLAZO":
				if (inputCartaRemplazo.length == 0) {
					Swal.fire("faltan archivos del cliente por subir", "se necesita subir los archivos requeridos", "warning");
					return;
				}
				if (!global_documentosArriendo.documentoCliente.carnetFrontal) {
					if (inputCarnetFrontal.length == 0 || inputCarnetTrasera.length == 0) {
						Swal.fire("faltan archivos del cliente por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoConductor.licenciaConducirFrontal) {
					if (inputlicenciaFrontal.length == 0 || inputlicenciaTrasera.length == 0) {
						Swal.fire("faltan archivos del conductor por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				break;
			case "EMPRESA":
				if (!global_documentosArriendo.documentoEmpresa.carnetFrontal) {
					if (inputCarnetFrontal.length == 0 || inputCarnetTrasera.length == 0) {
						Swal.fire("faltan carnet de representante por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoEmpresa.documentoEstatuto) {
					if (inputEstatuto.length == 0) {
						Swal.fire("faltan documento estatuto por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoEmpresa.documentoRol) {
					if (inputRol.length == 0) {
						Swal.fire("faltan documento rol por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoEmpresa.documentoVigencia) {
					if (inputVigencia.length == 0) {
						Swal.fire("faltan documento vigencia por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				if (!global_documentosArriendo.documentoConductor.licenciaConducirFrontal) {
					if (inputlicenciaFrontal.length == 0 || inputlicenciaTrasera.length == 0) {
						Swal.fire("faltan archivos del conductor por subir", "se necesita subir los archivos requeridos", "warning");
						return;
					}
				}
				break;
		}

		confirmarRequisitos(inputTipoGarantia);

	});


	const confirmarRequisitos = (inputTipoGarantia) => {
		alertQuestion(async () => {
			$("#spinner_btn_guardar_garantiaRequisitos").show();
			$("#btn_guardar_garantiaRequisitos").attr("disabled", true);
			const id_arriendo = $("#inputIdArriendoEditar").val();
			if (inputTipoGarantia !== "SIN") await guardarDatosGarantia(id_arriendo);
			const response = await guardarDocumentosRequistos(id_arriendo);
			if (response.success) {
				refrescarTabla();
				Swal.fire("registros guardados con exito!", "registros guardados", "success");
				$("#modal_editar_arriendo").modal("toggle");
			}
			$("#btn_guardar_garantiaRequisitos").attr("disabled", false);
			$("#spinner_btn_guardar_garantiaRequisitos").hide();
		})
	}



	$("#btn_anular_arriendo").click(() => {
		alertQuestion(async () => {
			$("#spinner_btn_anular_arriendo").show();
			$("#btn_anular_arriendo").attr("disabled", true);
			await cambiarEstadoArriendo("ANULADO", $("#inputIdArriendoEditar").val());
			Swal.fire("Arriendo anulado", "arriendo anulado con exito!", "success");
			refrescarTabla();
			$("#btn_anular_arriendo").attr("disabled", false);
			$("#spinner_btn_anular_arriendo").hide();
			$("#modal_editar_arriendo").modal("toggle");
		})
	})


	$("#btn_finalizar_arriendo").click(() => {
		alertQuestion(async () => {
			$("#spinner_btn_finalizar_arriendo").show();
			$("#btn_finalizar_arriendo").attr("disabled", true);
			await cambiarEstadoArriendo("FINALIZADO", $("#inputIdArriendoEditar").val());
			Swal.fire("Arriendo finalizado!", "arriendo finalizado con exito!", "success");
			refrescarTabla();
			$("#btn_finalizar_arriendo").attr("disabled", false);
			$("#spinner_btn_finalizar_arriendo").hide();
			$("#modal_editar_arriendo").modal("toggle");
		})
	});


	const guardarDatosGarantia = async (idArriendo) => {
		const form = $("#formGarantia")[0];
		const data = new FormData(form);
		data.append("inputIdArriendo", idArriendo);
		return await ajax_function(data, "registrar_garantia");
	};


	const guardarDocumentosRequistos = async (idArriendo) => {
		const data = new FormData();
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
		data.append("inputEstatuto", $("#inputEstatuto")[0].files[0]);
		data.append("inputRol", $("#inputDocumentotRol")[0].files[0]);
		data.append("inputVigencia", $("#inputDocumentoVigencia")[0].files[0]);
		data.append("inputCarpetaTributaria", $("#inputCarpetaTributaria")[0].files[0]);
		data.append("inputCartaAutorizacion", $("#inputCartaAutorizacion")[0].files[0]);
		return await ajax_function(data, "registrar_requisitos");
	};

})