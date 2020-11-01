const buscarArriendo = async (id_arriendo, option) => {
	limpiarCampos();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_arriendo");
	if (response.success) {
		const arriendo = response.data;
		// si es true carga modal confirmar ; false carga modal editar
		option
			? mostrarArriendoModalConfirmacion(arriendo)
			: mostrarArriendoModalEditar(arriendo);
	}
	$("#formSpinner").hide();
};

const mostrarArriendoModalConfirmacion = (arriendo) => {
	if (arriendo.requisito) {
		$("#formContrato").show();
		$("#numeroArriendoConfirmacion").text("Nº" + arriendo.id_arriendo);
		$("#inputIdArriendo").val(arriendo.id_arriendo);
		$("#inputPatenteVehiculo").val(arriendo.vehiculo.patente_vehiculo);
		$("#textTipo").html("Tipo de Arriendo: " + arriendo.tipo_arriendo);
		$("#textTipo").val(arriendo.tipo_arriendo);
		$("#textDias").html("Cantidad de Dias: " + arriendo.numerosDias_arriendo);
		switch (arriendo.tipo_arriendo) {
			case "PARTICULAR":
				$("#textCliente").html(arriendo.cliente.nombre_cliente);
				$("#textVehiculo").html(
					"Vehiculo : " + arriendo.vehiculo.patente_vehiculo
				);
				break;
			case "REMPLAZO":
				$("#subtotal-copago").show();
				$("#textCliente").html(
					arriendo.remplazo.cliente.nombre_cliente +
						" - " +
						arriendo.remplazo.nombreEmpresa_remplazo
				);
				$("#textVehiculo").html(
					"Vehiculo : " + arriendo.vehiculo.patente_vehiculo
				);
				break;
			case "EMPRESA":
				$("#textCliente").html(arriendo.empresa.nombre_empresa);
				$("#textVehiculo").html(
					"Vehiculo : " + arriendo.vehiculo.patente_vehiculo
				);
				break;
		}
		mostrarAccesorios(arriendo);
	} else {
		Swal.fire({
			icon: "warning",
			title: "falta documentos adjuntos!",
			text: "se debe ingresar la documentacion correspondiente para continuar",
		});
		$("#modal_confirmar_arriendo").modal("toggle");
	}
};

const mostrarArriendoModalEditar = (arriendo) => {
	$("#formSpinnerEditar").hide();
	$("#body_editarArriendo").show();
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
	$("#inputEditarDiasArriendo").val(arriendo.numerosDias_arriendo);
	$("#inputEditarUsuarioArriendo").val(arriendo.usuario.nombre_usuario);
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
		case "REMPLAZO":
			$("#card_cartaRemplazo").show();
			$("#card_domicilio").show();
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

	switch (arriendo.garantia.id_modoPago) {
		case 1:
			//EFECTIVO
			$("#nombre_garantia").html("EFECTIVO");
			$("#card_efectivo").show();
			break;
		case 2:
			//CHEQUE
			$("#nombre_garantia").html("CHEQUE");
			$("#card_cheque").show();
			break;
		case 3:
			//TARJETA
			$("#nombre_garantia").html("TARJETA");
			$("#card_tarjeta").show();
			break;
		default:
			break;
	}

	const url = storage + "documentos/requisitosArriendo/";

	if (arriendo.requisito) {
		if (arriendo.requisito.carnetFrontal_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.carnetFrontal_requisito;
			a.text = "Foto carnet frontal";
			a.target = "_blank";
			a.className = "badge badge-pill badge-info";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.carnetTrasera_requisito) {
			const a = document.createElement("a");
			a.text = "Foto carnet Trasera";
			a.href = url + arriendo.requisito.carnetTrasera_requisito;
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.cartaRemplazo_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.cartaRemplazo_requisito;
			a.text = "Carta de remplazo";
			a.target = "_blank";
			a.className = "badge badge-pill badge-info";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.chequeGarantia_requisito) {
			const a = document.createElement("a");
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			a.href = url + arriendo.requisito.chequeGarantia_requisito;
			a.text = "Cheque en garantia";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.comprobanteDomicilio_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.comprobanteDomicilio_requisito;
			a.text = "Comprobante de domicilio";
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.licenciaConducir_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.licenciaConducir_requisito;
			a.text = "Licencia de conducir";
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.tarjetaCreditoFrontal_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.tarjetaCreditoFrontal_requisito;
			a.text = "Foto Tarjeta de credito frontal";
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.tarjetaCreditoTrasera_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.tarjetaCreditoTrasera_requisito;
			a.text = "Foto tarjeta de credito trasera";
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			document.getElementById("card_documentos").append(a);
		}
		if (arriendo.requisito.boletaEfectivo_requisito) {
			const a = document.createElement("a");
			a.href = url + arriendo.requisito.boletaEfectivo_requisito;
			a.text = "Comprobante efectivo";
			a.className = "badge badge-pill badge-info";
			a.target = "_blank";
			document.getElementById("card_documentos").append(a);
		}
		$("#verDocumentos").show();
		$("#ingresarDocumentos").hide();
	} else {
		$("#verDocumentos").hide();
		$("#ingresarDocumentos").show();
	}
};

const mostrarAccesorios = (arriendo) => {
	if (arriendo.accesorios.length) {
		$.each(arriendo.accesorios, (i, o) => {
			let precio = 0;
			if (o.precio_accesorio != null) {
				precio = o.precio_accesorio;
			}
			let fila = `
			<div class='input-group col-md-12'>
				<span style='width: 60%;' class='input-group-text form-control'>${o.nombre_accesorio} $</span>
				<input  style='width: 40%;' min='0' id='${o.nombre_accesorio}' maxLength='11' name='accesorios[]' 
				 value='${precio}'  oninput="this.value = soloNumeros(this) ;calcularValores()"
					type='number' class='form-control' required>
			</div>`;
			$("#formAccesorios").append(fila);
		});
	} else {
		let sinAccesorios =
			" <span class=' col-md-12 text-center' id='spanAccesorios'>Sin Accesorios</span>";
		$("#formAccesorios").append(sinAccesorios);
	}
};

const calcularValores = () => {
	//variables
	let valorArriendo = Number($("#inputValorArriendo").val());
	let valorCopago = Number($("#inputValorCopago").val());
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
	TotalNeto = TotalNeto + valorArriendo - descuento - valorCopago;
	iva = TotalNeto * 0.19;
	total = TotalNeto + iva;
	$("#inputNeto").val(TotalNeto);
	$("#inputIVA").val(Math.round(iva));
	$("#inputTotal").val(Math.round(total));
};

const limpiarCampos = () => {
	$("#body_editarArriendo").hide();
	$("#formContrato").hide();
	$("#card_documentos").empty();
	$("#formAccesorios").empty();
	$("#formContrato")[0].reset();
	$("#btn_crear_contrato").attr("disabled", false);
	$("#spinner_btn_crearContrato").hide();
	$("#spinner_btn_firmarContrato").hide();
	$("#spinner_btn_confirmarContrato").hide();
	$("#btn_confirmar_contrato").attr("disabled", true);
	$("#body-documento").hide();
	$("#body-firma").hide();
	$("#body-sinContrato").show();
	$("#nombre_documento").val("");
	$("#subtotal-copago").hide();
	$("#formSpinner").show();
	$("#formSpinnerEditar").show();
	$("#formContrato").hide();
	$("#spinner_btn_subirDocumentos").hide();
	$("#card_carnet").hide();
	$("#card_domicilio").hide();
	$("#card_cartaRemplazo").hide();
	$("#card_licencia").hide();
	$("#card_tarjeta").hide();
	$("#card_cheque").hide();
	$("#card_efectivo").hide();
	//se limpia el canvas de firma
	dibujar = false;
	ctx.clearRect(0, 0, cw, ch);
	Trazados.length = 0;
	puntos.length = 0;
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	(cargarArriendos = async () => {
		$("#spinner_tablaTotalArriendos").show();
		const response = await ajax_function(null, "cargar_arriendos");
		if (response.success) {
			$.each(response.data, (i, arriendo) => {
				cargarArriendoEnTabla(arriendo);
			});
		}
		$("#spinner_tablaTotalArriendos").hide();
	})();

	$("#btn_crear_contrato").click(() => {
		const form = $("#formContrato")[0];
		const data = new FormData(form);
		generarContrato(data);
	});

	$("#btn_firmar_contrato").click(() => {
		const canvas = document.getElementById("canvas-firma");
		const form = $("#formContrato")[0];
		const data = new FormData(form);
		data.append("inputFirmaPNG", canvas.toDataURL("image/png"));
		generarContrato(data);
	});

	const generarContrato = async (data) => {
		const descuento = $("#inputDescuento").val();
		const valorArriendo = $("#inputValorArriendo").val();
		const valorCopago = $("#inputValorCopago").val();
		const numFacturacion = $("#inputNumFacturacion").val();
		const total = Number($("#inputTotal").val());

		//cacturando los accesorios
		const arrayNombreAccesorios = [];
		const arrayValorAccesorios = [];
		const list = $('[name="accesorios[]"]');
		for (let i = 0; i < list.length; i++) {
			let element = list[i];
			arrayNombreAccesorios.push(element.id);
			arrayValorAccesorios.push(element.value);
		}
		if (arrayNombreAccesorios.length != 0) {
			data.append("arrayNombreAccesorios", arrayNombreAccesorios);
			data.append("arrayValorAccesorios", arrayValorAccesorios);
		}

		if (
			numFacturacion.length != 0 &&
			total >= 0 &&
			descuento.length != 0 &&
			valorArriendo.length != 0 &&
			valorCopago.length != 0
		) {
			$("#spinner_btn_firmarContrato").show();
			desactivarBotones();

			const response = await ajax_function(data, "generar_PDFcontrato");
			if (response.success) {
				if (response.data) {
					$("#modal_signature").modal({
						show: true,
					});
					$("#nombre_documento").val(response.data.nombre_documento);
					$("#body-documento").show();
					$("#body-firma").show();
					$("#body-sinContrato").hide();

					const url =
						storage +
						"documentos/contratos/" +
						response.data.nombre_documento +
						".pdf";
					mostrarPDF(url);

					if (response.data.firma) {
						$("#btn_confirmar_contrato").attr("disabled", false);
					}
				} else {
					Swal.fire({
						icon: "error",
						title: response.msg,
					});
				}
			}
		} else {
			Swal.fire({
				icon: "warning",
				title: "campos vacios y/o valores invalidos",
			});
		}
		activarBotones();
	};

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
				desactivarBotones();
				$("#spinner_btn_confirmarContrato").show();

				const form = $("#formContrato")[0];
				const data = new FormData(form);
				await guardarContrato(data);
				await guardarDatosPago(data);
				await enviarCorreoArriendo(data);
				await cambiarEstadoArriendo(data);

				refrescarTabla();
				Swal.fire(
					"Contrato Firmado!",
					"contrato firmado y registrado con exito!",
					"success"
				);

				$("#modal_signature").modal("toggle");
				$("#modal_confirmar_arriendo").modal("toggle");
			}
		});
	});

	const mostrarPDF = (url) => {
		$("#body-documento").html(
			`<a href="${url}" target="_blank" >Descargar contrato</a><br><iframe width="100%" height="700px" src="${url}" target="_parent"></iframe>`
		);
	};

	const guardarContrato = async (data) => {
		data.append("nombre_documento", $("#nombre_documento").val());
		await ajax_function(data, "registrar_contrato");
	};

	const guardarDatosPago = async (data) => {
		data.append("digitador", $("#inputDigitador").val());
		await ajax_function(data, "registrar_pago");
	};

	const enviarCorreoArriendo = async (data) => {
		await ajax_function(data, "enviar_correoArriendo");
	};

	const cambiarEstadoArriendo = async (data) => {
		data.append("estado", "FIRMADO");
		await ajax_function(data, "cambiarEstado_arriendo");
	};

	$("#btn_subirDocumentos").click(async () => {
		const id_arriendo = $("#inputIdArriendoEditar").val();
		$("#spinner_btn_subirDocumentos").show();
		$("#btn_subirDocumentos").attr("disabled", true);
		const response = await guardarDocumentosRequistos(id_arriendo);
		$("#btn_subirDocumentos").attr("disabled", false);
		$("#spinner_btn_subirDocumentos").hide();
		if (response.success) {
			Swal.fire(
				"documentos subidos con exito!",
				"se guardaron los documentos",
				"success"
			);
			$("#modal_editar_arriendo").modal("toggle");
		}
	});

	const guardarDocumentosRequistos = async (idArriendo) => {
		const data = new FormData();
		//ERROR A SUBIR IMAGENES
		data.append("idArriendo", idArriendo);
		data.append("inputCarnetFrontal", $("#inputCarnetFrontal")[0].files[0]);
		data.append("inputCarnetTrasera", $("#inputCarnetTrasera")[0].files[0]);
		data.append("inputTarjetaFrontal", $("#inputTarjetaFrontal")[0].files[0]);
		data.append("inputTarjetaTrasera", $("#inputTarjetaTrasera")[0].files[0]);
		data.append("inputLicencia", $("#inputLicencia")[0].files[0]);
		data.append("inputCheque", $("#inputChequeGarantia")[0].files[0]);
		data.append("inputCartaRemplazo", $("#inputCartaRemplazo")[0].files[0]);
		data.append("inputBoletaEfectivo", $("#inputBoletaEfectivo")[0].files[0]);
		data.append(
			"inputComprobante",
			$("#inputComprobanteDomicilio")[0].files[0]
		);
		console.log(data);
		return await ajax_function(data, "registrar_requisitos");
	};

	const refrescarTabla = () => {
		//limpia la tabla
		$("#tablaTotalArriendos").DataTable(lenguaje).row().clear().draw(false);
		//carga nuevamente
		cargarArriendos();
	};

	const desactivarBotones = () => {
		$("#btn_crear_contrato").attr("disabled", true);
		$("#btn_confirmar_contrato").attr("disabled", true);
		$("#btn_firmar_contrato").attr("disabled", true);
		$("#limpiar-firma").attr("disabled", true);
		$("#spinner_btn_crearContrato").show();
	};

	const activarBotones = () => {
		$("#spinner_btn_crearContrato").hide();
		$("#spinner_btn_firmarContrato").hide();
		$("#btn_crear_contrato").attr("disabled", false);
		$("#btn_firmar_contrato").attr("disabled", false);
		$("#limpiar-firma").attr("disabled", false);
	};
});
