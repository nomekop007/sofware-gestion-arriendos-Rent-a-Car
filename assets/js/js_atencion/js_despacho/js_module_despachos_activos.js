const arrayImagesRecepcion = [];
const array_id_pagos = [];
let totalAPagar_arriendo = 0;


const calcularDiasExtencion = () => {
	let fechaRecepcion = $("#inputFechaRecepcion_extenderPlazo").val();
	let fechaExtender = $("#inputFechaExtender_extenderPlazo").val();
	let fechaini = new Date(moment(fechaRecepcion));
	let fechafin = new Date(moment(fechaExtender));
	let diasdif = fechafin.getTime() - fechaini.getTime();
	let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
	$("#inputNumeroDias_extenderPlazo").val(dias);
};


const buscarArriendoExtender = async (id_arriendo) => {
	limpiarFormulario();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_arriendo");
	if (response.success) {
		const arriendo = response.data;
		$("#numeroArriendo").html("Nº " + arriendo.id_arriendo)
		$("#inputFechaRecepcion_extenderPlazo").val(moment(arriendo.fechaRecepcion_arriendo).format("YYYY/MM/DD h:m"));
		$("#id_arriendo").val(arriendo.id_arriendo);
		$("#dias_arriendo").val(arriendo.diasAcumulados_arriendo);
		$("#body_extender_arriendo").show();
	}
	$("#formSpinner_extender_arriendo").hide();
}



const mostrarPagosArriendo = async (id_arriendo) => {
	limpiarFormulario();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await consultarPagos(data);
	if (response.success) {
		const { arrayPago, totalPago, arriendo } = response.data;
		$("#body_actualizarPago_arriendo").show()
		$("#numero_arriendo_pago").html("Nº " + arriendo.id_arriendo)
		const formatter = new Intl.NumberFormat("CL");
		let n = 1;
		arrayPago.map(({ pago, pagoArriendo }) => {
			let html = `<tr>
						<th scope="row"> ${n} </th>
						<td> ${pago.deudor_pago.replace("@", "")} </td>
						<td> ${pago.estado_pago}</td>
						<td> $ ${formatter.format(pago.total_pago)} </td>
						<td> ${pagoArriendo.dias_pagoArriendo} </td>
						<td> ${formatearFechaHora(pago.createdAt)} </td>
					</tr>`;
			$("#tablaPago").append(html);
			n++;
			array_id_pagos.push(pago.id_pago);
		})
		totalAPagar_arriendo = totalPago;
		$("#total_a_pagar").html(`Total pago: ${formatter.format(totalAPagar_arriendo)} `);
		$("#dias_totales").html(`dias totales: ${arriendo.diasAcumulados_arriendo}`);
		$("#id_arriendo_recepcion").val(arriendo.id_arriendo);
		$("#descuento_copago").show();
		const fechaFinal = moment(arriendo.fechaRecepcion_arriendo);
		const fechaActual = moment();
		const diasRestantes = fechaFinal.diff(fechaActual, "days"); // 1
		const horasRestantes = moment.utc(fechaFinal.diff(moment())).format("HH");
		$("#dias_restantes").val(`${diasRestantes} ${diasRestantes == 1 ? "dia" : "dias"} con  ${horasRestantes} horas`);
	}
	$("#formSpinner_actualizarPago_arriendo").hide();
}


const mostrarRecepcionArriendo = async (id_arriendo) => {
	limpiarFormulario();

	const data = new FormData();
	data.append("id_despacho", id_arriendo);
	data.append("id_arriendo", id_arriendo);

	const responseArriendo = await ajax_function(data, "buscar_arriendo");
	const responseActa = await ajax_function(data, "buscar_actaEntrega");

	if (responseArriendo.success) {
		const arriendo = responseArriendo.data;
		if (arriendo.fotosDespachos.length > 0) {
			console.log(responseActa)
			fotoDespachoCarrucelRecepcion(arriendo.fotosDespachos, responseActa.data.url);
			$("#ventana_fotosDespacho").show();
		} else {
			if (responseActa.success) {
				const base64 = responseActa.data.base64;
				mostrarVisorPDF(base64, [
					"pdf_canvas_recepcion",
					"page_count_recepcion",
					"page_num_recepcion",
					"prev_recepcion",
					"next_recepcion"
				]);
			}
			$("#ventana_actaEntrega").show();
		}

		mostrarCanvasImgVehiculo([
			"canvas_fotoVehiculo_recepcion",
			"limpiar_fotoVehiculo_recepcion",
			"dibujar_canvas_recepcion",
			"inputImagen_vehiculo_recepcion"
		]);
		$("#numero_arriendo_recepcion").html("Nº " + arriendo.id_arriendo);
		$("#id_vehiculo_recepcion").val(arriendo.patente_vehiculo);
		$("#id_arriendo_recepcion").val(arriendo.id_arriendo);
		$("#body_recepcion_arriendo").show();
	}
	$("#formSpinner_finalizar_arriendo").hide();
}


const fotoDespachoCarrucelRecepcion = (array, url) => {
	let items = "";
	array.map(({ url_fotoDespacho }) => {
		const link = `${url}/${url_fotoDespacho}`;
		console.log(link);
		items += `<div class="item"><img src="${link}" /></div>`;

	});
	const html = `<div class="owl-carousel owl-theme">${items}</div></div>`;
	$("#ventana_fotosDespacho").html(html);
	$(".owl-carousel").owlCarousel({
		items: 1,
	});
};



const recalcularPagoDescuento = (desc) => {
	const formatter = new Intl.NumberFormat("CL");
	let descuento = Number(desc);
	let precioAntiguo = Number(totalAPagar_arriendo);
	let precioNuevo = precioAntiguo - descuento;
	$("#total_a_pagar").html(`Total a pagar: ${formatter.format(precioNuevo)} `);
}

const recalcularPagoExtra = (desc) => {
	const formatter = new Intl.NumberFormat("CL");
	let cobro = Number(desc);
	let precioAntiguo = Number(totalAPagar_arriendo);
	let precioNuevo = precioAntiguo + cobro;
	$("#total_a_pagar").html(`Total a pagar: ${formatter.format(precioNuevo)} `);
}





const consultarPagos = async (data) => {
	return await ajax_function(data, "consultar_pagoArriendos");
}



const limpiarFormulario = () => {
	$("#formSpinner_extender_arriendo").show();
	$("#formSpinner_finalizar_arriendo").show();
	$("#formSpinner_actualizarPago_arriendo").show();
	$("#body_actualizarPago_arriendo").hide()
	$("#body_recepcion_arriendo").hide();
	$("#body_extender_arriendo").hide();
	$("#descuento_copago").hide();

	$("#numeroArriendo").html("")
	$("#spinner_btn_actualizar_pago").hide();
	$("#spinner_btn_finalizar_contrato").hide();
	$("#spinner_btn_extenderArriendo").hide();
	$("#spinner_btn_registrar_danio").hide();
	arrayImagesRecepcion.length = 0;
	array_id_pagos.length = 0;
	totalAPagar_arriendo = 0;
	$("#carrucel_recepcion").empty();
	$("#tablaPago").empty();
	$("#id_vehiculo_recepcion").val("");
	$("#id_arriendo_recepcion").val("");
	$("#input_descripcion_danio").val("");
	$("#input_kilometraje_salida").val(0);
	$("#formExtenderArriendo")[0].reset();
	$("#form_pagos_pendientes")[0].reset();


	$("#ventana_fotosDespacho").hide();
	$("#ventana_actaEntrega").hide();
}




















//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//


$(document).ready(() => {

	let config = lenguaje;
	config.paging = false;
	const tablaArriendosActivos = $("#tablaArriendosActivos").DataTable(config);

	$("#nav-activos-tab").click(() => refrescarTablaActivos());


	$('#inputFechaRecepcion_extenderPlazo').datetimepicker({
		onChangeDateTime: function () {
			calcularDiasExtencion()
		},
	});
	$('#inputFechaExtender_extenderPlazo').datetimepicker({
		onChangeDateTime: function () {
			calcularDiasExtencion()
		},
	});






	const cargarArriendosActivos = async () => {
		$("#spinner_tablaArriendoActivos").show();
		const response = await ajax_function(null, "cargar_arriendosActivos");
		if (response) {
			$.each(response.data, (i, arriendo) => {
				cargarArriendoActivosEnTabla(arriendo);
			});
		}
		$("#spinner_tablaArriendoActivos").hide();
	};


	$("#btn_extenderArriendo").click(() => {
		const diasActuales = $("#dias_arriendo").val()
		const diasExtendidos = $("#inputNumeroDias_extenderPlazo").val();
		if (diasExtendidos.length == 0) {
			Swal.fire("faltan datos , o datos erroneos", "corriga el formulario!", "warning");
			return;
		}
		if (diasExtendidos <= 0) {
			Swal.fire("Extencion fallida", "la extencion del contrato tiene que ser mayor a 1 dia", "warning");
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_extenderArriendo").show();
			$("#btn_extenderArriendo").attr("disabled", true)
			const form = $("#formExtenderArriendo")[0];
			const data = new FormData(form);
			data.append("diasActuales", Number(diasExtendidos));
			data.append("diasAcumulados", Number(diasActuales) + Number(diasExtendidos));
			data.append("fechaEntrega", $("#inputFechaRecepcion_extenderPlazo").val())
			const response = await extenderContrato(data);
			if (response.success) {
				refrescarTablaActivos();
				Swal.fire("Arriendo extendido", "Arriendo extendido con exito!, proseguir a firmar el contrato", "success");
				$("#modal_ArriendoExtender").modal("toggle");
			}
			$("#spinner_btn_extenderArriendo").hide();
			$("#btn_extenderArriendo").attr("disabled", false)
		})
	});



	$("#btn_finalizar_arriendo").click(() => {
		if (arrayImagesRecepcion.length === 0) {
			Swal.fire({ icon: "warning", title: "falta tomar fotos al vehiculo!", });
			return;
		}
		if ($("#input_kilometraje_salida").val() == 0) {
			Swal.fire({ icon: "warning", title: "falta colocar el kilometraje del vehiculo", });
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_finalizar_contrato").show();
			$("#btn_finalizar_arriendo").attr("disabled", true);
			const data = new FormData();
			const response_revision = await guardarRevisionRecepcion(data);
			if (response_revision.success) {
				const response_vehiculo = await cambiarEstadoVehiculo(data);
				if (response_vehiculo.success) {
					data.append("id_arriendo", $("#id_arriendo_recepcion").val());
					data.append("estado", "RECEPCIONADO");
					data.append("kilometraje_salida", $("#input_kilometraje_salida").val());
					await cambiarEstadoArriendo(data);
					refrescarTablaActivos();
					$("#modal_ArriendoFinalizar").modal("toggle");
					Swal.fire(
						"Arriendo finalizado!",
						"Arriendo finalizado con exito!",
						"success"
					);
				}
			}
			$("#btn_finalizar_arriendo").attr("disabled", false);
			$("#spinner_btn_finalizar_contrato").hide();
		})
	});



	$("#limpiarArrayFotosRecepcion").click(() => {
		alertQuestion(() => {
			arrayImagesRecepcion.length = 0;
			$("#carrucel_recepcion").empty();
		})
	});


	$("#seleccionarFotoRecepcion").click(async () => {
		const inputImg = $("#inputImagen_vehiculo_recepcion").val();
		if (inputImg != 0) {
			const canvas = document.getElementById("canvas_fotoVehiculo_recepcion");
			const base64 = canvas.toDataURL("image/png");
			const url = await resizeBase64Img(base64, canvas.width, canvas.height, 3);
			if (arrayImagesRecepcion.length < 9) {
				arrayImagesRecepcion.push(url);
				agregarFotoACarrucelRecepcion(arrayImagesRecepcion);
				limpiarTodoCanvasVehiculo();
			} else {
				Swal.fire({
					icon: "error",
					title: "el maximo son 9 imagenes",
				});
			}
		} else {
			Swal.fire({
				icon: "error",
				title: "debe ingresar foto",
			});
		}
	});



	$("#actualizar_pago_arriendo").click(async () => {
		const inputDescuento = $("#descuento_pago").val();
		const inputExtra = $("#extra_pago").val();
		const inputObservaciones = `${$("#inputObservaciones").val()} ${$("#inputObservaciones2").val()} `
		const inputNumFacturacion = $("#inputNumFacturacion").val();
		const inputFileFacturacion = $("#inputFileFacturacion")[0].files[0];
		if (inputDescuento < 0 || inputExtra < 0 || inputDescuento.length == 0 || inputExtra.length == 0) {
			Swal.fire("campo vacio o invalidos", "rellene los campos erroneos", "warning");
			return;
		}
		if (inputDescuento > 0 && inputExtra > 0) {
			Swal.fire("valores invalidos", "no se puede aplicar un cobro extra y un descuento a la vez! , corriga", "warning");
			return;
		}
		if (totalAPagar_arriendo != 0 || inputDescuento != 0 || inputExtra != 0) {
			if (inputNumFacturacion == 0 || $("#inputFileFacturacion").val().length == 0) {
				Swal.fire("faltan datos en el formulario", "debe ingresar el Nº facturacion con su respectivo comprobante", "warning");
				return;
			}
		}
		alertQuestion(async () => {
			$("#spinner_btn_actualizar_pago").show();
			$("#actualizar_pago_arriendo").attr("disabled", true);
			const form = $("#form_pagos_pendientes")[0];
			const data = new FormData(form);
			data.append("arrayPagos", JSON.stringify(array_id_pagos));
			data.append("descuento_pago", inputDescuento);
			data.append("extra_pago", inputExtra);
			data.append("inputDocumento", inputFileFacturacion);
			data.append("inputObservaciones", inputObservaciones);
			data.append("inputEstado", "PAGADO");
			data.append("id_arriendo", $("#id_arriendo_recepcion").val());
			data.append("estado", "FINALIZADO");
			const responseDescuento = await descuentoPago(data);
			if (responseDescuento.success) {
				if ($("#inputFileFacturacion").val().length != 0) {
					const responseFactura = await guardarDatosFactura(data);
					if (responseFactura.success) {
						data.append("id_facturacion", responseFactura.data.id_facturacion);
						await guardarDocumentoFactura(data);
					}
				}
				const responsePago = await actualizarPagos(data);
				if (responsePago.success) {
					await cambiarEstadoArriendo(data);
					refrescarTablaActivos();
					$("#modalPagoArriendo").modal("toggle");
					Swal.fire("Pago Actualizado!", "se a actualizado exitosamente el pago", "success")
				}
			}
			$("#spinner_btn_actualizar_pago").hide();
			$("#actualizar_pago_arriendo").attr("disabled", false);
		})
	});



	$("#registrar_danio_vehiculo").click(() => {
		const id_arriendo = $("#id_arriendo_recepcion").val();
		const inputDescripcion = $("#input_descripcion_danio").val();
		if (arrayImagesRecepcion.length === 0) {
			Swal.fire({ icon: "warning", title: "falta tomar fotos al vehiculo!", });
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_registrar_danio").show();
			const data = new FormData();
			data.append("descripcion_danio", inputDescripcion);
			data.append("arrayImagenes", JSON.stringify(arrayImagesRecepcion));
			data.append("id_arriendo", id_arriendo);
			const responseDanio = await ajax_function(data, "registrar_danio_vehiculo");
			if (responseDanio.success) {
				Swal.fire("se registro exitoso!", "se registro el daño con exito", "success")
				$("#modalRegistrarDaño").modal("toggle");
			}
			$("#spinner_btn_registrar_danio").hide();
		})
	});



	const descuentoPago = async (data) => {
		return await ajax_function(data, "aplicarDescuento_UltimoPago");
	}


	const guardarDatosFactura = async (data) => {
		return await ajax_function(data, "registrar_facturacion");
	};


	const guardarDocumentoFactura = async (data) => {
		return await ajax_function(data, "guardar_documentoFacturacion");
	};


	const actualizarPagos = async (data) => {
		return await ajax_function(data, "actualizar_pagos");
	}


	const agregarFotoACarrucelRecepcion = (array) => {
		let items = "";
		for (let i = 0; i < array.length; i++) {
			let base64str = array[i].split('base64,')[1];
			let decoded = atob(base64str);
			items += `<div class="item"><img src="${array[i]}" /> <span>${decoded.length} kB </span></div>`;
		}
		const html = `<div class="owl-carousel owl-theme" id="carruselVehiculos">${items}</div></div>`;
		$("#carrucel_recepcion").html(html);
		$(".owl-carousel").owlCarousel({
			items: 1,
		});
	};


	const guardarRevisionRecepcion = async (data) => {
		data.append("id_despacho", $("#id_arriendo_recepcion").val());
		data.append("arrayImages", JSON.stringify(arrayImagesRecepcion));
		return await ajax_function(data, "registrar_revision");
	}


	const cambiarEstadoArriendo = async (data) => {
		return await ajax_function(data, "cambiarEstado_arriendo");
	};


	const cambiarEstadoVehiculo = async (data) => {
		data.append("inputPatenteVehiculo", $("#id_vehiculo_recepcion").val());
		data.append("inputEstado", "DISPONIBLE");
		data.append("kilometraje_vehiculo", $("#input_kilometraje_salida").val());
		return await ajax_function(data, "cambiarEstado_vehiculo");
	};


	const extenderContrato = async (data) => {
		return await ajax_function(data, "extender_arriendo");
	}


	const temporizador = (fechaRecepcion_arriendo, id_arriendo) => {
		$(`#time${id_arriendo}`).text("");
		const countDownDate = moment(fechaRecepcion_arriendo);
		const fechaFinal = moment(fechaRecepcion_arriendo);
		let time = countDownDate.diff(moment());
		time = setInterval(function () {
			alertaTemporizador(countDownDate, fechaFinal, time, id_arriendo);
		}, 1000);
	};


	const alertaTemporizador = (countDownDate, fechaFinal, time, id_arriendo) => {
		let diff = countDownDate.diff(moment());
		const fechaActual = moment();
		const diasRestantes = fechaFinal.diff(fechaActual, "days"); // 1
		if (diff <= 0) {
			clearInterval(time);
			// If the count down is finished, write some text
			$(`#time${id_arriendo}`).text("EXPIRADO");
			$(`#time${id_arriendo}`).addClass("text-danger");
		} else {
			if (diasRestantes > 0) {
				$(`#time${id_arriendo}`).text(`
                    ${diasRestantes}  ${diasRestantes == 1 ? " dia" : " dias"
					}  y ${moment.utc(diff).format(" HH:mm:ss")} horas `);
			} else {
				$(`#time${id_arriendo}`).text(
					moment.utc(diff).format(" HH:mm:ss") + " horas"
				);
			}
		}
	};



	const refrescarTablaActivos = () => {
		tablaArriendosActivos.row().clear().draw(false);
		cargarArriendosActivos();
	};



	const cargarArriendoActivosEnTabla = (arriendo) => {
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
			temporizador(arriendo.fechaRecepcion_arriendo, arriendo.id_arriendo);
			let btnFinalizar = "";
			let btnExtender = "";
			let viewTime = "";
			if (arriendo.estado_arriendo == "ACTIVO") {
				viewTime = `<div id=time${arriendo.id_arriendo}> </div>`;
				btnExtender = ` <button value='${arriendo.id_arriendo}' onclick='buscarArriendoExtender(this.value)'  data-toggle='modal'  data-target='#modal_ArriendoExtender' class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> `
				btnFinalizar = ` <button value='${arriendo.id_arriendo}' onclick='mostrarRecepcionArriendo(this.value)' data-toggle='modal'  data-target='#modal_ArriendoFinalizar'  class='btn btn btn-outline-dark'><i class="fas fa-external-link-square-alt"></i></button>`;
			} else {
				viewTime = "<div> RECEPCIONADO </div>";
				btnExtender = "";
				btnFinalizar = ` <button disabled value='${arriendo.id_arriendo}' onclick='mostrarPagosArriendo(this.value)' data-toggle='modal'  data-target='#modalPagoArriendo'  class='btn btn btn-outline-success'><i class="fas fa-pager"></i></button>`;
			}
			tablaArriendosActivos.row
				.add([
					arriendo.id_arriendo,
					cliente,
					arriendo.vehiculo.patente_vehiculo,
					arriendo.tipo_arriendo,
					formatearFechaHora(arriendo.fechaRecepcion_arriendo),
					`${viewTime}`,
					` ${btnExtender}
					  ${btnFinalizar}
                    `,
				])
				.draw(false);
		} catch (error) {
			console.log(error);
		}
	};
});
