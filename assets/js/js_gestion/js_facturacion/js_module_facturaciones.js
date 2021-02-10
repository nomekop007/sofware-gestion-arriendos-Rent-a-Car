$("#m_facturacion").addClass("active");
$("#l_facturacion").addClass("card");
$("#spinner_empresa_remplazo").hide();
$("#spinner_registrar_facturacion").hide();
const formatter = new Intl.NumberFormat("CL");
const arrayClaveER = [];


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
	$("#spinner_editar_factura").show();
	$("#form_editar_factura").hide();
	$("#form_editar_factura")[0].reset();
}








//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//











$(document).ready(() => {


	const tabla_pagosER = $("#tabla_pagos").DataTable(lenguaje);
	const tabla_pagoER = $("#tabla_pagoPendienteRemplazo").DataTable(lenguaje);
	$("#nav-pagos-tab").click(() => refrescarTabla());


	$("#btn_buscarPagoEmpresa").click(async () => {
		$("#spinner_empresa_remplazo").show();
		$("#totalFactura").val("");
		let codigoEmpresa = $("#inputCodigoEmpresaRemplazo").val();
		const data = new FormData();
		data.append("clave_empresaRemplazo", codigoEmpresa);
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
			tabla_pagoER.row
				.add([
					`<input type="checkbox" onClick='calcularTotalFactura()' name="checkPago[]" value="${pagosPendientes.id_pago}" >`,
					pagosPendientes.pagosArriendo.id_arriendo,
					pagosPendientes.pagosArriendo.dias_pagoArriendo,
					pagosPendientes.estado_pago,
					"$ " + formatter.format(pagosPendientes.neto_pago),
					"$ " + formatter.format(pagosPendientes.iva_pago),
					"$ " + formatter.format(pagosPendientes.total_pago),
					formatearFechaHora(pagosPendientes.createdAt),
					` <button value='${pagosPendientes.id_pago}' onclick='buscarPago(this.value)' data-toggle='modal' data-target='#modal_pagoArriendo' class='btn btn-outline-info'><i class='far fa-edit'></i></button>`,
				])
				.draw(false);
		} catch (error) {
			console.log("error al cargar este pago")
		}
	}

	const cargarPagosEnTabla = (pagosPendientes) => {
		try {
			tabla_pagosER.row
				.add([
					pagosPendientes.pagosArriendo.id_arriendo,
					pagosPendientes.deudor_pago,
					pagosPendientes.estado_pago,
					"$ " + formatter.format(pagosPendientes.neto_pago),
					"$ " + formatter.format(pagosPendientes.iva_pago),
					"$ " + formatter.format(pagosPendientes.total_pago),
					formatearFechaHora(pagosPendientes.createdAt)
				])
				.draw(false);
		} catch (error) {
			console.log("error al cargar este pago")
		}
	};

})
