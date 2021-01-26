const formatter = new Intl.NumberFormat("CL");


const mostrarArriendoModalPago = async (arriendo) => {
	limpiarCamposModalPago();
	if (arriendo.estado_arriendo == "PENDIENTE" || arriendo.estado_arriendo == "EXTENDIDO") {
		if (arriendo.tipoArriendo != "REEMPLAZO") {
			const response = await buscarTarifaVehiculo(arriendo.patente_vehiculo, arriendo.diasActuales_arriendo);
			if (response.success) {
				$("#inputValorCopago").val(Number(response.data.valorDia).toFixed());
				$("#inputSubTotalArriendo").val(Number(response.data.valorNeto).toFixed());
				calcularValores();
			}
		}
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
	$("#formSpinnerPago").hide();
};


const buscarTarifaVehiculo = async (patente, dias) => {
	const data = new FormData();
	data.append("patente_vehiculo", patente);
	data.append("dias_arriendo", dias);
	return await ajax_function(data, "buscarTarifasVehiculo");
}


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
	$("#lb_neto_er").html("( $ " + formatter.format(neto) + " )");
	$("#lb_iva_er").html("( $ " + formatter.format(Math.round(iva)) + " )");
	$("#lb_total_er").html("( $ " + formatter.format(decimalAdjust(Math.round(total), 1)) + " )");
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

	$("#inputNeto").val(TotalNeto.toFixed());
	$("#inputIVA").val(Math.round(iva));
	$("#inputTotal").val(decimalAdjust(Math.round(total), 1));
	$("#lb_neto").html("( $ " + formatter.format(TotalNeto.toFixed()) + " )");
	$("#lb_iva").html("( $ " + formatter.format(Math.round(iva)) + " )");
	$("#lb_total").html("( $ " + formatter.format(decimalAdjust(Math.round(total), 1)) + " )");
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

const limpiarCamposModalPago = () => {
	$("#spinner_btn_registrarPago").hide();
	$("#formPagoArriendo").hide();
	$("#formPagoArriendo")[0].reset();
	$(".pago_empresa_remplazo").hide();
	$("#formSpinnerPago").show();
	$("#numeroArriendoConfirmacion").text("");
	$("#textTipo").html("");
	$("#textDias").html("");
	$("#textVehiculo").html("");
	$("#textCliente").html("");
	$("#textRemplazo").html("");
	$("#metodo_pago").hide();
}





$(document).ready(() => {

	$("#btn_registrar_pago").click(async () => {
		const tipoPago = $('[name="customRadio1"]:checked').val();
		const numeroFacturacion = $("#inputNumFacturacion").val().length;
		const totalNeto = $("#inputNeto").val();
		const inputFileFacturacion = $("#inputFileFacturacion")[0].files[0];
		if (tipoPago != "PENDIENTE") {
			if (numeroFacturacion == 0 || $("#inputFileFacturacion").val().length == 0) {
				Swal.fire("debe ingresar el comprobante de pago", "falta ingresar datos en el formulario", "warning");
				return;
			}
		}
		if (totalNeto < 0) {
			Swal.fire("Error en los totales", "corriga los totales del arriendo", "warning");
			return;
		}
		if (
			$("#inputPagoEmpresa").val().length == 0 ||
			$("#inputValorCopago").val().length == 0 ||
			$("#inputSubTotalArriendo").val().length == 0 ||
			$("#inputDescuento").val().length == 0
		) {
			Swal.fire("Error en el formulario", "coloque 0 en los campos vacios", "warning");
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_registrarPago").show();
			$("#btn_registrar_pago").attr("disabled", true);
			const form = $("#formPagoArriendo")[0];
			const data = new FormData(form);
			const response = await guardarDatosPagoArriendo(data);
			if (response.success) {
				data.append("id_pagoArriendo", response.pagoArriendo.id_pagoArriendo);
				//si existe accesorios los agrega al pagoArriendo
				const matrizAccesorios = await capturarAccesorios();
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
				Swal.fire("datos registrados con exito", "se registraron los datos pertinentes!", "success");
				$("#modal_pago_arriendo").modal("toggle");
			}
			$("#btn_registrar_pago").attr("disabled", false);
			$("#spinner_btn_registrarPago").hide();
		})
	});



	const guardarDocumentoFactura = async (data) => {
		return await ajax_function(data, "guardar_documentoFacturacion");
	};

	const guardarPago = async (data) => {
		return await ajax_function(data, "registrar_pago");
	}


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


})