$("#m_facturacion").addClass("active");
$("#l_facturacion").addClass("card");
$("#spinner_empresa_remplazo").hide();
$("#spinner_registrar_facturacion").hide();
const formatter = new Intl.NumberFormat("CL");
const arrayClaveER = [];
let global_totalNeto = 0;

const buscarPago = async (id_pago) => {
	const data = new FormData();
	limpiarCampos();
	data.append("id_pago", id_pago);
	const response = await ajax_function(data, "buscar_pago");
	if (response.success) {
		const pago = response.data;
		$("#modal_pagoArriendoLabel").html(`Pago E.remplazo del Arriendo Nº ${pago.pagosArriendo.id_arriendo}`);
		$("#id_pago").val(pago.id_pago);
		$("#id_pagoArriendo").val(pago.id_pagoArriendo);
		$("#deudor_pago").val(pago.deudor_pago);
		$("#dias_pago").val(pago.pagosArriendo.dias_pagoArriendo);
		$("#editar_neto_pago").val(Number(pago.neto_pago));
		$("#editar_iva_pago").val(Number(pago.iva_pago));
		$("#editar_bruto_pago").val(Number(pago.total_pago));
		$("#form_editar_factura").show();
		$("#lb_neto").html("( $ " + formatter.format(Number(pago.neto_pago)) + " )");
		$("#lb_iva").html("( $ " + formatter.format(Math.round(Number(pago.iva_pago))) + " )");
		$("#lb_total").html("( $ " + formatter.format(decimalAdjust(Math.round(Number(pago.total_pago)), 1)) + " )");
	}
	$("#spinner_editar_factura").hide();
}

const calcularTotalFactura = async () => {
	const arrayCheck = cacturarCheckPago();
	if (arrayCheck.length > 0) {
		const data = new FormData();
		data.append("arrayPagos", JSON.stringify(arrayCheck));
		const response = await ajax_function(data, "calcularTotal_pago");
		if (response.success) {

			$("#totalNeto").val("$ " + formatter.format(response.data.total_factura));
			$("#totalIva").val("$ " + formatter.format(response.data.total_factura));
			$("#totalFactura").val("$ " + formatter.format(response.data.total_factura));
		}
	} else {
		$("#totalFactura").val("$ " + formatter.format(0));
	}
}



const cacturarCheckPago = () => {
	const array = [];
	$('[name="checkPago[]"]:checked')
		.map(function () {
			array.push(this.value)
		})
		.get()
	return array;
};


const calcularIvaPagoERemplazo = () => {
	let neto = Number($("#editar_neto_pago").val());
	let iva = Number($("#editar_iva_pago").val());
	let total = Number($("#editar_bruto_pago").val());
	iva = Number(neto * 0.19);
	total = Number(neto + iva);
	$("#editar_iva_pago").val(Math.round(iva));
	$("#editar_bruto_pago").val(decimalAdjust(Math.round(total), 1));
	$("#lb_neto").html("( $ " + formatter.format(neto) + " )");
	$("#lb_iva").html("( $ " + formatter.format(Math.round(iva)) + " )");
	$("#lb_total").html("( $ " + formatter.format(decimalAdjust(Math.round(total), 1)) + " )");
}



const limpiarCampos = () => {
	global_totalNeto = 0;
	$("#totalNeto").val("");
	$("#totalIva").val("");
	$("#totalFactura").val("");
	$("#spinner_editar_factura").show();
	$("#form_editar_factura").hide();
	$("#form_editar_factura")[0].reset();
}








//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//











$(document).ready(() => {


	const tabla_pagosER = $("#tabla_pagos").DataTable(lenguaje);
	const tabla_pagoER = $("#tabla_pagoPendienteRemplazo").DataTable(lenguaje);
	$("#nav-pagos-tab").click(() => refrescarTabla());

	cargarSelectSucursal("cargar_Sucursales", "inputSucursal");

	$('#inputFechaInicio').datetimepicker({
		format: 'd/m/Y'
	});

	$('#inputFechaFin').datetimepicker({
		format: 'd/m/Y'
	});



	$("#btn_buscarPagoEmpresa").click(async () => {
		if ($("#inputFechaInicio").val().length == 0 || $("#inputFechaFin").val().length == 0) {
			Swal.fire("faltan datos", "faltan colocar fecha inicio , fecha fin", "warning");
			return;
		}
		limpiarCampos();
		const data = new FormData();
		data.append("clave_empresaRemplazo", $("#inputCodigoEmpresaRemplazo").val());

		// FALTA FILTRAR
		data.append("inputSucursal", $("#inputSucursal").val());
		data.append("inputFechaFin", $("#inputFechaInicio").val());
		data.append("inputFechaFin", $("#inputFechaFin").val());
		$("#spinner_empresa_remplazo").show();
		const response = await ajax_function(data, "buscar_pagoER");
		if (response.success) {
			//limpia la tabla
			tabla_pagoER.row().clear().draw(false);
			$.each(response.data, (i, item) => {
				cargarPagoER(item);
			});
		}
		$("#spinner_empresa_remplazo").hide();
	});


	$("#btn_registrar_facturacion").click(() => {
		const arrayCheck = cacturarCheckPago();
		const inputNumFacturacion = $("#inputNumFacturacion").val();
		const inputFileFacturacion = $("#inputFileFacturacion")[0].files[0];
		if (arrayCheck.length == 0 || inputNumFacturacion.length == 0 || $("#inputFileFacturacion").val().length == 0) {
			Swal.fire("faltan datos", "faltan datos en el formulario", "warning");
			return;
		}
		alertQuestion(async () => {
			$("#btn_registrar_facturacion").attr("disabled", true);
			$("#spinner_registrar_facturacion").show();
			const form = $("#form_registrar_factura")[0];
			const data = new FormData(form);
			const responseFac = await guardarDatosFactura(data);
			if (responseFac.success) {
				data.append("inputEstado", "PAGADO");
				data.append("inputDocumento", inputFileFacturacion);
				data.append("id_facturacion", responseFac.data.id_facturacion);
				data.append("arrayPagos", JSON.stringify(arrayCheck));
				const responseDoc = await guardarDocumentoFactura(data);
				if (responseDoc.success) {
					const responsePago = await actualizarPagos(data);
					if (responsePago.success) {
						Swal.fire("factura generada!", "se a actualizado exitosamente el pago y la factura", "success")
						tabla_pagoER.row().clear().draw(false);
						$("#totalFactura").val("");
					}
				}
			}
			$("#spinner_registrar_facturacion").hide();
			$("#btn_registrar_facturacion").attr("disabled", false);
		})
	});


	$("#btn_editar_pago").click(async () => {
		if ($("#editar_neto_pago").val().length === 0 || $("#editar_observaciones_pago").val().length === 0) {
			Swal.fire("campos vacio!", "por favor rellene el campo precio", "warning");
			return;
		}
		alertQuestion(async () => {
			const form = $("#form_editar_factura")[0];
			const data = new FormData(form);
			const response = await ajax_function(data, "modificar_pago");
			if (response.success) {
				Swal.fire("Pago Actualizado!", "se a actualizado exitosamente el pago", "success")
				tabla_pagoER.row().clear().draw(false);
				$("#totalFactura").val("");
				$("#modal_pagoArriendo").modal("toggle");
			}
		});
	});

	const guardarDatosFactura = async (data) => {
		return await ajax_function(data, "registrar_facturacion");
	};

	const guardarDocumentoFactura = async (data) => {
		return await ajax_function(data, "guardar_documentoFacturacion");
	};

	const actualizarPagos = async (data) => {
		return await ajax_function(data, "actualizar_pagos");
	}


	(cargarEmpresasRemplazo = async () => {
		const response = await ajax_function(null, "cargar_empresasRemplazo");
		if (response.success) {
			const select = document.getElementById("inputCodigoEmpresaRemplazo");
			$.each(response.data, (i, object) => {
				const option = document.createElement("option");
				option.innerHTML = object["codigo_empresaRemplazo"];
				option.value = object["codigo_empresaRemplazo"];
				arrayClaveER.push(object["codigo_empresaRemplazo"]);
				select.appendChild(option);
			});
		}
	})();





	const refrescarTabla = () => {
		//limpia la tabla
		tabla_pagosER.row().clear().draw(false);
		//carga nuevamente
		cargarPagosPendientes();
	};




	const cargarPagosPendientes = async () => {
		$("#spinner_tabla_pagos").show();
		const response = await ajax_function(null, "cargar_pagosERpendientes");
		if (response.success) {
			tabla_pagosER.row().clear().draw(false);
			$.each(response.data, (i, facturacion) => {
				arrayClaveER.map((clave) => {
					if (facturacion.deudor_pago === clave) {
						cargarPagosEnTabla(facturacion);
					}
				})
			});
		}
		$("#spinner_tabla_pagos").hide();
	};



	const cargarPagoER = (pagosPendientes) => {
		try {

			let dias = pagosPendientes.pagosArriendo.dias_pagoArriendo;
			let tarifa = pagosPendientes.neto_pago;
			let copago = pagosPendientes.pagosArriendo.valorCopago_pagoArriendo;
			let tagDiario = 0;
			let otros = 0;
			let traslados = 0;
			let totalNeto = (tarifa - copago) * dias + (dias * tagDiario) + otros + traslados;


			let nombreCarta = pagosPendientes.pagosArriendo.arriendo.requisito.cartaRemplazo_requisito;
			let fechaInicio = pagosPendientes.pagosArriendo.arriendo.fechaEntrega_arriendo;


			if (pagosPendientes.pagosArriendo.extencione) {
				let extencion = pagosPendientes.pagosArriendo.extencione;
				fechaInicio = extencion.fechaInicio_extencion;
				//nombreCarta = extencion.carta_empresaReemplazo;
				nombreCarta = '';
			}

			global_totalNeto = global_totalNeto + totalNeto;
			let totalIva = global_totalNeto * 0.19;
			let totalBruto = global_totalNeto + totalIva;
			$("#totalNeto").val("$ " + formatter.format(global_totalNeto));
			$("#totalIva").val("$ " + formatter.format(totalIva));
			$("#totalFactura").val("$ " + formatter.format(totalBruto));

			tabla_pagoER.row
				.add([
					`<button class='btn-sm btn btn-outline-primary'><i class="far fa-envelope"></i></button>`,
					pagosPendientes.pagosArriendo.arriendo.patente_vehiculo,
					pagosPendientes.pagosArriendo.arriendo.remplazo.cliente.nombre_cliente,
					pagosPendientes.pagosArriendo.arriendo.remplazo.cliente.rut_cliente,
					formatearFecha(fechaInicio),
					"$ " + formatter.format(tarifa),
					dias,
					"$ " + formatter.format(copago),
					"$ " + formatter.format(tagDiario),
					"$ " + formatter.format(otros),
					"$ " + formatter.format(traslados),
					"$ " + formatter.format(totalNeto),
					` <button value='${pagosPendientes.id_pago}' onclick='buscarPago(this.value)' data-toggle='modal' data-target='#modal_pagoArriendo' class=' btn-sm btn btn-outline-info'><i class='far fa-edit'></i></button>`,
				]).draw(false);


		} catch (error) {
			console.log("error al cargar este pago")
		}
	}

	const cargarPagosEnTabla = (pagosPendientes) => {
		try {
			if (pagosPendientes.estado_pago == 'PAGADO') {
				estado = `<p class='text-success'> ${pagosPendientes.estado_pago} </p>`
			} else {
				estado = `<p class='text-danger'>  ${pagosPendientes.estado_pago} </p>`
			}
			tabla_pagosER.row
				.add([
					pagosPendientes.pagosArriendo.id_arriendo,
					pagosPendientes.deudor_pago,
					estado,
					"$ " + formatter.format(pagosPendientes.neto_pago),
					"$ " + formatter.format(pagosPendientes.iva_pago),
					"$ " + formatter.format(pagosPendientes.total_pago),
					formatearFechaHora(pagosPendientes.createdAt),
					pagosPendientes.pagosArriendo.arriendo.sucursale.nombre_sucursal,

				])
				.draw(false);
		} catch (error) {
			console.log("error al cargar este pago")
		}
	};

})
