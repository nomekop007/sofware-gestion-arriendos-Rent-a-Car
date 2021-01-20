$("#m_facturacion").addClass("active");
$("#l_facturacion").addClass("card");
$("#spinner_empresa_remplazo").hide();
$("#spinner_registrar_facturacion").hide();
const formatter = new Intl.NumberFormat("CL");
const arrayClaveER = [];


const buscarPagoArriendo = (id_pagoArriendo) => {
	console.log(id_pagoArriendo)
	//buscar info del pago

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
			Swal.fire(
				"faltan datos",
				"faltan datos en el formulario",
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
							Swal.fire(
								"Pago Actualizado!",
								"se a actualizado exitosamente el pago",
								"success"
							)
							tabla_pagoER.row().clear().draw(false);
							$("#totalFactura").val(0);
						}
					}
				}
				$("#spinner_registrar_facturacion").hide();
				$("#btn_registrar_facturacion").attr("disabled", false);

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
		return await ajax_function(data, "actualizar_pago");
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
					pagosPendientes.estado_pago,
					"$ " + formatter.format(pagosPendientes.neto_pago),
					"$ " + formatter.format(pagosPendientes.iva_pago),
					"$ " + formatter.format(pagosPendientes.total_pago),
					formatearFechaHora(pagosPendientes.createdAt),
					` <button value='${pagosPendientes.id_pago}' onclick='buscarPagoArriendo(this.value)' data-toggle='modal' data-target='#modal_pagoArriendo' class='btn btn-outline-info'><i class='far fa-edit'></i></button>`,

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
