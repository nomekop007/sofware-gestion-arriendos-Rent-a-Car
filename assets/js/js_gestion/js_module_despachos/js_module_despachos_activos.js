const arrayImagesRecepcion = [];


const calcularDiasExtencion = () => {
	let fechaRecepcion = $("#inputFechaRecepcion_extenderPlazo").val();
	let fechaExtender = $("#inputFechaExtender_extenderPlazo").val();

	let fechaini = new Date(fechaRecepcion);
	let fechafin = new Date(fechaExtender);
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
		$("#inputFechaRecepcion_extenderPlazo").val(arriendo.fechaRecepcion_arriendo.substring(0, 16));
		$("#inputFechaExtender_extenderPlazo").prop('min', arriendo.fechaRecepcion_arriendo.substring(0, 16));
		$("#id_arriendo").val(arriendo.id_arriendo);
		$("#dias_arriendo").val(arriendo.diasAcumulados_arriendo);
		$("#body_extender_arriendo").show();
	}
	$("#formSpinner_extender_arriendo").hide();
}


const buscarArriendoFinalizar = async (id_arriendo) => {
	limpiarFormulario();

	mostrarCanvasImgVehiculo([
		"canvas_fotoVehiculo_recepcion",
		"limpiar_fotoVehiculo_recepcion",
		"dibujar_canvas_recepcion",
		"inputImagen_vehiculo_recepcion"
	]);
	const data = new FormData();
	data.append("id_despacho", id_arriendo);
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_actaEntrega");
	if (response.success) {
		const base64 = response.data.base64;
		mostrarVisorPDF(base64, [
			"pdf_canvas_recepcion",
			"page_count_recepcion",
			"page_num_recepcion",
			"prev_recepcion",
			"next_recepcion"
		]);
		const response2 = await ajax_function(data, "buscar_arriendo");
		if (response2.success) {
			const arriendo = response2.data;

			$("#numero_arriendo_recepcion").html("Nº " + arriendo.id_arriendo);
			$("#body_recepcion_arriendo").show();
			$("#id_vehiculo_recepcion").val(arriendo.patente_vehiculo);
			$("#id_arriendo_recepcion").val(arriendo.id_arriendo);
		}
	}
	$("#formSpinner_finalizar_arriendo").hide();
}

const limpiarFormulario = () => {

	$("#formSpinner_extender_arriendo").show();
	$("#formSpinner_finalizar_arriendo").show();
	$("#body_recepcion_arriendo").hide();
	$("#body_extender_arriendo").hide();
	$("#numeroArriendo").html("")
	$("#spinner_btn_finalizar_contrato").hide();
	$("#spinner_btn_extenderArriendo").hide();
	$("#formExtenderArriendo")[0].reset();
	arrayImagesRecepcion.length = 0;
	$("#carrucel_recepcion").empty();
	$("#id_vehiculo_recepcion").val("");
	$("#id_arriendo_recepcion").val("");

}




















//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//


$(document).ready(() => {


	const tablaArriendosActivos = $("#tablaArriendosActivos").DataTable(lenguaje);

	$("#nav-activos-tab").click(() => refrescarTablaActivos());

	const cargarArriendosActivos = async () => {
		$("#spinner_tablaArriendoActivos").show();
		const data = new FormData();
		data.append("filtro", "ACTIVO");
		const response = await ajax_function(data, "cargar_arriendos");

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
			Swal.fire(
				"faltan datos , o datos erroneos",
				"corriga el formulario!",
				"error"
			);
			return;
		}
		if (diasExtendidos <= 0) {
			Swal.fire(
				"Extencion fallida",
				"la extencion del contrato tiene que ser mayor a 1 dia",
				"error"
			);
			return;
		}
		Swal.fire({
			title: "Estas seguro?",
			text: "estas a punto de extender el plazo de un arriendo!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, seguro",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true,
		}).then(async (result) => {
			if (result.isConfirmed) {
				$("#spinner_btn_extenderArriendo").show();
				$("#btn_extenderArriendo").attr("disabled", true)
				const form = $("#formExtenderArriendo")[0];
				const data = new FormData(form);

				data.append("diasActuales", Number(diasExtendidos));
				data.append("diasAcumulados", Number(diasActuales) + Number(diasExtendidos));

				const response = await extenderContrato(data);
				if (response.success) {
					refrescarTablaActivos();
					Swal.fire(
						"Arriendo extendido",
						"Arriendo extendido con exito!, proseguir a firmar el contrato",
						"success"
					);
					$("#modal_ArriendoExtender").modal("toggle");
				}
				$("#spinner_btn_extenderArriendo").hide();
				$("#btn_extenderArriendo").attr("disabled", false)
			}
		});
	});

	$("#btn_finalizar_arriendo").click(() => {
		if (arrayImagesRecepcion.length > 0) {

			Swal.fire({
				title: "Estas seguro?",
				text: "estas a punto de finalizar el arriendo!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: "Si, seguro",
				cancelButtonText: "No, cancelar!",
				reverseButtons: true,
			}).then(async (result) => {
				if (result.isConfirmed) {
					$("#spinner_btn_finalizar_contrato").show();
					$("#btn_finalizar_arriendo").attr("disable", true);

					const data = new FormData();
					$("#tablaPago").empty();
					const response_estadoPago = await revisarEstadosPagos(data);
					if (response_estadoPago.success) {

						// si existe deuda , se levanta el modal para pagarla
						if (response_estadoPago.deuda) {

							mostrarPagosPendientes(response_estadoPago.data);
							$("#modalPagoArriendo").modal({
								show: true,
							});

						} else {
							const response_revision = await guardarRevisionRecepcion(data);
							if (response_revision.success) {
								const response_vehiculo = await cambiarEstadoVehiculo(data);
								if (response_vehiculo.success) {
									await cambiarEstadoArriendo(data);
								}
							}
							refrescarTablaActivos();
							$("#modal_ArriendoFinalizar").modal("toggle");
							Swal.fire(
								"Arriendo finalizado!",
								"Arriendo finalizado con exito!",
								"success"
							);
						}
					}
					$("#spinner_btn_finalizar_contrato").hide();
					$("#btn_finalizar_arriendo").attr("disable", false);
				}
			});
		} else {
			Swal.fire({
				icon: "error",
				title: "falta tomar fotos al vehiculo!",
			});
		}
	});

	$("#limpiarArrayFotosRecepcion").click(() => {
		arrayImagesRecepcion.length = 0;
		$("#carrucel_recepcion").empty();
	});


	$("#seleccionarFotoRecepcion").click(async () => {
        /*
        se redimenciona la imagen por que los archivos base64 tiene un peso de caracteres elevado y 
		el servidor solo puede recibir un maximo de 2mb en cada consulta.
        Actualizado: es posible que esto cambie debido al ambiente de desarrollo
        o capacidad de la maquina en la que se este ejecutando (local/produccion)
        */
		const inputImg = $("#inputImagen_vehiculo_recepcion").val();
		if (inputImg != 0) {
			const canvas = document.getElementById("canvas_fotoVehiculo_recepcion");
			const base64 = canvas.toDataURL("image/png");
			const url = await resizeBase64Img(base64, canvas.width, canvas.height, 2);
			if (arrayImagesRecepcion.length < 5) {
				arrayImagesRecepcion.push(url);
				agregarFotoACarrucelRecepcion(arrayImagesRecepcion);
				limpiarTodoCanvasVehiculo();
				console.log(arrayImagesRecepcion);
			} else {
				Swal.fire({
					icon: "error",
					title: "el maximo son 5 imagenes",
				});
			}
		} else {
			Swal.fire({
				icon: "error",
				title: "debe ingresar foto",
			});
		}
	});


	const mostrarPagosPendientes = ({ arrayPago, totalPago }) => {
		const formatter = new Intl.NumberFormat("CL");

		let n = 1;
		arrayPago.map((pago) => {
			let html = `<tr>
							<th scope="row">${n}</th>
							<td>${pago.deudor_pago.replace("@", "")}</td>
							<td>${pago.estado_pago}</td>
							<td> $ ${formatter.format(pago.total_pago)}</td>
							<td>${formatearFechaHora(pago.createdAt)}</td>
						</tr>`;
			$("#tablaPago").append(html);
			n++;
		})

		console.log(totalPago)
	}

	const agregarFotoACarrucelRecepcion = (array) => {
		let items = "";
		for (let i = 0; i < array.length; i++) {
			items += `<div class="item"><img src="${array[i]}" /></div>`;
		}
		const html = `<div class="owl-carousel owl-theme" id="carruselVehiculos">${items}</div></div>`;
		$("#carrucel_recepcion").html(html);
		$(".owl-carousel").owlCarousel({
			items: 1,
		});
	};


	const revisarEstadosPagos = async (data) => {
		data.append("id_arriendo", $("#id_arriendo_recepcion").val());
		return await ajax_function(data, "revisar_estadoPago");
	}


	const guardarRevisionRecepcion = async (data) => {
		data.append("id_despacho", $("#id_arriendo_recepcion").val());
		data.append("arrayImages", JSON.stringify(arrayImagesRecepcion));
		return await ajax_function(data, "registrar_revision");
	}

	const cambiarEstadoArriendo = async (data) => {
		data.append("id_arriendo", $("#id_arriendo_recepcion").val());
		data.append("estado", "FINALIZADO");
		data.append("kilometraje_salida", $("#input_kilometraje_salida").val());
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
                    ${diasRestantes}  ${
					diasRestantes == 1 ? " dia" : " dias"
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

			tablaArriendosActivos.row
				.add([
					arriendo.id_arriendo,
					cliente,
					arriendo.vehiculo.patente_vehiculo,
					arriendo.tipo_arriendo,
					formatearFechaHora(arriendo.fechaRecepcion_arriendo),
					`<div id=time${arriendo.id_arriendo}> </div>`,
					` <button value='${arriendo.id_arriendo}' onclick='buscarArriendoExtender(this.value)'  data-toggle='modal'  data-target='#modal_ArriendoExtender' 
                         class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> 
                          <button value='${arriendo.id_arriendo}' onclick='buscarArriendoFinalizar(this.value)'  data-toggle='modal' data-target='#modal_ArriendoFinalizar'
                             class='btn btn btn-outline-success'><i class="fas fa-external-link-square-alt"></i></button>
                    `,
				])
				.draw(false);
		} catch (error) {
			console.log(error);
		}
	};
});
