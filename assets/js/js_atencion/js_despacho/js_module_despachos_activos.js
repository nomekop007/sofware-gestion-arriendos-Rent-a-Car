const arrayImagesRecepcion = [];
const formatter = new Intl.NumberFormat("CL");



const mostrarArriendoExtender = async (id_arriendo) => {
	limpiarFormularios();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_arriendo");
	if (response.success) {
		const arriendo = response.data;
		await cargarExtencionesEnTabla(data)
		$("#numeroArriendo").html("Nº " + arriendo.id_arriendo)
		$("#titulo_numero_arriendo").html("Nº " + arriendo.id_arriendo)
		$("#inputFechaRecepcion_extenderPlazo").val(moment(arriendo.fechaRecepcion_arriendo).format("YYYY/MM/DD hh:mm"));
		$("#id_arriendo_extencion").val(arriendo.id_arriendo);
		$("#inputVehiculo_extenderPlazo").val(arriendo.patente_vehiculo);
		$("#body_extender_arriendo").show();
		$("#inputTipoArriendo_extenderPlazo").val(arriendo.tipo_arriendo);
		$("#inputDiasAcumulados_extenderPlazo").val(arriendo.diasAcumulados_arriendo);
		if (arriendo.estado_arriendo === "RECEPCIONADO") {
			$("#btn_extenderArriendo").hide();
			$("#btn_extenderArriendo").attr("disabled", true);
			$("#btn_modal_registrarExtencion").hide();
			$("#btn_modal_registrarExtencion").attr("disabled", true);
			$("#txt_modal_registrarExtencion").show()
		} else {
			$("#btn_extenderArriendo").show();
			$("#btn_extenderArriendo").attr("disabled", false);
			$("#btn_modal_registrarExtencion").show();
			$("#btn_modal_registrarExtencion").attr("disabled", false);
			$("#txt_modal_registrarExtencion").hide()
		}
		switch (arriendo.tipo_arriendo) {
			case "PARTICULAR":
				$("#inputDeudor_extenderPlazo").val(arriendo.rut_cliente);
				break;
			case "REEMPLAZO":
				$("#inputDeudor_extenderPlazo").val(arriendo.remplazo.rut_cliente);
				$("#inputDeudorCopago_extenderPlazo").val(arriendo.remplazo.codigo_empresaRemplazo);
				$(".ventana_pago_empresa_remplazo").show();
				break;
			case "EMPRESA":
				$("#inputDeudor_extenderPlazo").val(arriendo.rut_empresa);
				break;
		}
	}
	$("#formSpinner_extender_arriendo").hide();
}

const cargarExtencionesEnTabla = async (data) => {
	//cargar en tabla solo se necesita la id_arriendo
	const response = await ajax_function(data, "cargar_extenciones");
	const resposeArriendo = await ajax_function(data, "buscar_arriendo");
	let array = orderByCreatedAt(resposeArriendo.data.pagosArriendos);
	array = array.map((pago) => pago.id_pagoArriendo);
	$.each(response.data, (i, { id_pagoArriendo, id_extencion, fechaInicio_extencion, fechaFin_extencion, dias_extencion, estado_extencion, patente_vehiculo }) => {
		let n = array.indexOf(id_pagoArriendo);
		let btn = '';
		let estado = '';
		if (estado_extencion != "FIRMADO") {
			btn = `<button class='btn btn-outline-info'  value='${id_extencion}'  onclick='mostrarExtencionContrato(this.value,${n})' 
			data-toggle='modal' data-target='#modal_firmar_contrato'><i class='fas fa-feather-alt'></i></button>`;
			estado = `<div>${estado_extencion}</div>`
		} else {
			btn = '<div class="text-success"><i class="fas fa-check-circle fa-2x"></i></div>';
			estado = `<div class="text-success">${estado_extencion}</div>`
		}

		let fila = `
        <tr>
            <td scope="row"> ${n} </td>
            <td> ${moment(fechaInicio_extencion).format("YYYY/MM/DD hh:mm")} </td>
            <td> ${moment(fechaFin_extencion).format("YYYY/MM/DD hh:mm")} </td>
            <td> ${dias_extencion} </td>
			<td> ${estado} </td>
            <td> ${patente_vehiculo} </td>
            <td> ${btn} </td>
        </tr>`;
		$("#tbody_extenciones").append(fila)
	})
}



const mostrarRecepcionArriendo = async (id_arriendo) => {
	limpiarFormularios();
	const data = new FormData();
	data.append("id_despacho", id_arriendo);
	data.append("id_arriendo", id_arriendo);
	const responseArriendo = await ajax_function(data, "buscar_arriendo");
	const responseActa = await ajax_function(data, "buscar_actaEntrega");
	if (responseArriendo.success) {
		const arriendo = responseArriendo.data;
		if (arriendo.fotosDespachos.length > 0) {
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

		console.log(arriendo);
		$("#inputMarcaVehiculoRecepcion").val(arriendo.vehiculo.marca_vehiculo);
		$("#inputModeloVehiculoRecepcion").val(arriendo.vehiculo.modelo_vehiculo);
		$("#inputEdadVehiculoRecepcion").val(arriendo.vehiculo.año_vehiculo);
		$("#inputColorVehiculoRecepcion").val(arriendo.vehiculo.color_vehiculo);
		$("#inputPatenteVehiculoRecepcion").val(arriendo.vehiculo.patente_vehiculo);
		$("#numero_arriendo_recepcion").html(arriendo.id_arriendo);
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
		items += `<div class="item"><img src="${link}" /></div>`;
	});
	const html = `<div class="owl-carousel owl-theme">${items}</div></div>`;
	$("#ventana_fotosDespacho").html(html);
	$(".owl-carousel").owlCarousel({
		items: 1,
	});
};



const calcularDiasExtencion = () => {
	let fechaRecepcion = $("#inputFechaRecepcion_extenderPlazo").val();
	let fechaExtender = $("#inputFechaExtender_extenderPlazo").val();
	let fechaini = new Date(moment(fechaRecepcion));
	let fechafin = new Date(moment(fechaExtender));
	let diasdif = fechafin.getTime() - fechaini.getTime();
	let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
	$("#inputNumeroDias_extenderPlazo").val(Number(dias));
	calcularCopago()
};


const calcularCopago = () => {
	let valorCopago = Number($("#inputValorCopago_extenderPlazo").val());
	let dias = Number($("#inputNumeroDias_extenderPlazo").val());
	let NewSubtotal = Number(valorCopago * dias);
	$("#inputSubTotalArriendo_extenderPlazo").val(NewSubtotal);
	calcularValores();
}


const calcularIvaPagoERemplazo = () => {
	let neto = Number($("#inputPagoEmpresa_extenderPlazo").val());
	let iva = Number($("#inputPagoIvaEmpresa_extenderPlazo").val());
	let total = Number($("#inputPagoTotalEmpresa_extenderPlazo").val());
	iva = Number(neto * 0.19);
	total = Number(neto + iva);
	$("#inputPagoIvaEmpresa_extenderPlazo").val(Math.round(iva));
	$("#inputPagoTotalEmpresa_extenderPlazo").val(decimalAdjust(Math.round(total), 1));
	$("#lb_neto_er").html("( $ " + formatter.format(neto) + " )");
	$("#lb_iva_er").html("( $ " + formatter.format(Math.round(iva)) + " )");
	$("#lb_total_er").html("( $ " + formatter.format(decimalAdjust(Math.round(total), 1)) + " )");
}


const calcularValores = () => {
	//variables
	let valorArriendo = Number($("#inputSubTotalArriendo_extenderPlazo").val());
	let iva = Number($("#inputIVA_extenderPlazo").val());
	let descuento = Number($("#inputDescuento_extenderPlazo").val());
	let total = Number($("#inputTotal_extenderPlazo").val());
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
	$("#inputNeto_extenderPlazo").val(TotalNeto.toFixed());
	$("#inputIVA_extenderPlazo").val(Math.round(iva));
	$("#inputTotal_extenderPlazo").val(decimalAdjust(Math.round(total), 1));
	$("#lb_neto").html("( $ " + formatter.format(TotalNeto.toFixed()) + " )");
	$("#lb_iva").html("( $ " + formatter.format(Math.round(iva)) + " )");
	$("#lb_total").html("( $ " + formatter.format(decimalAdjust(Math.round(total), 1)) + " )");
};




const limpiarFormularios = () => {

	mostrarCanvasCombustible("canvas-combustible-recepcion", "output-recepcion");

	$("#formSpinner_extender_arriendo").show();
	$("#formSpinner_finalizar_arriendo").show();
	$("#body_recepcion_arriendo").hide();
	$("#body_extender_arriendo").hide();
	$("#titulo_numero_arriendo").html("")
	$("#numeroArriendo").html("")
	$("#spinner_btn_generar_actaRecepcion").hide();
	$("#spinner_btn_extenderArriendo").hide();
	$("#spinner_btn_registrar_danio").hide();
	arrayImagesRecepcion.length = 0;
	$("#carrucel_recepcion").empty();
	$("#id_vehiculo_recepcion").val("");
	$("#id_arriendo_recepcion").val("");
	$("#input_descripcion_danio").val("");
	$("#input_kilometraje_salida").val(0);
	$("#formExtenderArriendo")[0].reset();
	$(".ventana_pago_empresa_remplazo").hide();
	$("#ventana_fotosDespacho").hide();
	$("#ventana_actaEntrega").hide();
	$("#tbody_extenciones").empty();
	$("#spinner_btn_seleccionar_recepcion").hide();
}

















//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//


$(document).ready(() => {

	let config = lenguaje;
	config.paging = false;
	const tablaArriendosActivos = $("#tablaArriendosActivos").DataTable(config);

	$("#nav-activos-tab").click(async () => {
		await estadoArriendosRecepcionados();
		refrescarTablaActivos();
	});


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


	(cargarAccesorios = async () => {
		const response = await ajax_function(null, "cargar_accesorios");
		if (response.success) {
			$.each(response.data, (i, o) => {
				if (o.id_accesorio == "1") {
					o.precio_accesorio = "";
				}
				let fila = `
                <div class='input-group '>
                    <label style='width: 70%;font-size: 0.6rem;' class='form-control'>${o.nombre_accesorio}  $ ${formatter.format(o.precio_accesorio)} </label>
                    <input  style='width: 30%;font-size: 0.6rem;' min='0' id='${o.id_accesorio}' maxLength='11' name='accesorios[]' 
                     value='0'  oninput="this.value = soloNumeros(this) ;calcularValores()"
                        type='number' class='form-control' required>
				</div>`;
				$("#formAccesorios").append(fila);
			});
		}
	})();


	(cargarVehiculos = async () => {
		const response = await ajax_function(null, "cargar_Vehiculos");
		if (response.success) {
			if (response.data) {
				const select = document.getElementById("inputVehiculo_extenderPlazo");
				$.each(response.data, (i, o) => {
					let option = document.createElement("option");
					option.innerHTML = `${o.patente_vehiculo} ${o.marca_vehiculo} ${o.modelo_vehiculo} ${o.año_vehiculo}`;
					option.value = o.patente_vehiculo;
					select.appendChild(option);
				});
				$("#vehiculo").attr("disabled", false);
			}
		}
	})();



	const cargarArriendosActivos = async () => {
		$("#spinner_tablaArriendoActivos").show();
		const response = await ajax_function(null, "cargar_arriendosActivos");
		if (response.success) {
			tablaArriendosActivos.row().clear().draw(false);
			$.each(response.data, (i, arriendo) => {
				cargarArriendoActivosEnTabla(arriendo);
			});
		}
		$("#spinner_tablaArriendoActivos").hide();
	}


	const estadoArriendosRecepcionados = async () => {
		const response = await ajax_function(null, "finalizar_arriendos");
		if (response.success) {
			if (response.data.length > 0) {
				$("#accordionArriendos").empty();
				$.each(response.data, (i, info) => {
					mostrarCollapsibles(info, i);
				});
				$('#modal_estadoArriendoRecepcionados').modal('show');
			}
		}
	}

	const mostrarCollapsibles = (info, i) => {
		const { id_arriendo, sucursal, falta } = info;
		$("#accordionArriendos").append(`
		<div class="card">
            <div class="card-header" id="heading${i}">
                <h2 class="mb-0">
                    <button class=" text-center btn scroll btn-outline-danger btn-block" type="button" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
                     Se requieren las siguientes acciones para finalizar el arriendo Nº ${id_arriendo} - ${sucursal}
                    </button>
                </h2>
            </div>
            <div id="collapse${i}" class="collapse" aria-labelledby="heading${i}" data-parent="#accordionArriendos">
                <div class="card-body text-center">
					${falta.map(({ msg }) => (`<br><i class="far text-danger fa-check-square"></i> ${msg} <br>`))}
				</div>
            </div>
        </div>`);
	}


	$("#btn_extenderArriendo").click(() => {
		const diasExtendidos = $("#inputNumeroDias_extenderPlazo").val();
		if (diasExtendidos.length == 0) {
			Swal.fire("faltan datos , o datos erroneos", "corriga el formulario!", "warning");
			return;
		}
		if (diasExtendidos <= 0) {
			Swal.fire("Extencion fallida", "la extencion del contrato tiene que ser mayor a 1 dia", "warning");
			return;
		}
		if ($("#inputNeto_extenderPlazo").val() < 0) {
			Swal.fire("Error en los totales", "corriga los totales del arriendo", "warning");
			return;
		}
		if (
			$("#inputPagoEmpresa_extenderPlazo").val().length == 0 ||
			$("#inputValorCopago_extenderPlazo").val().length == 0 ||
			$("#inputSubTotalArriendo_extenderPlazo").val().length == 0 ||
			$("#inputDescuento_extenderPlazo").val().length == 0
		) {
			Swal.fire("Error en el formulario", "coloque 0 en los campos vacios", "warning");
			return;
		}
		if ($("#inputVehiculo_extenderPlazo").val() === "null") {
			Swal.fire("Error en el formulario", "falto seleccionar el vehiculo", "warning");
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_extenderArriendo").show();
			$("#btn_extenderArriendo").attr("disabled", true)
			const data = new FormData();
			const response1 = await actualizarArriendo(data);
			if (response1.success) {
				const response2 = await guardarPagoArriendo(data);
				if (response2.success) {
					data.append("id_pagoArriendo", response2.pagoArriendo.id_pagoArriendo);
					const matrizAccesorios = await capturarAccesorios();
					if (matrizAccesorios[0].length != 0) {
						data.append("matrizAccesorios", JSON.stringify(matrizAccesorios));
						await ajax_function(data, "registrar_pagoAccesorios");
					}
					await guardarPagoCliente(data);
					if ($("#inputTipoArriendo_extenderPlazo").val() === "REEMPLAZO" && $("#inputPagoEmpresa_extenderPlazo").val() > 0) {
						await guardarPagoRemplazo(data);
					}
					const response3 = await guardarExtencion(data);
					if (response3.success) {
						await mostrarArriendoExtender(response3.data.id_arriendo);
						refrescarTablaActivos();
						Swal.fire("datos registrados con exito", "se registro la nueva extencion!", "success");
						$("#modal_registrar_extencion").modal("toggle");
					}
				}
			}
			$("#spinner_btn_extenderArriendo").hide();
			$("#btn_extenderArriendo").attr("disabled", false)
		})
	});




	$("#btn_generar_actaRecepcion").click(async () => {
		if (arrayImagesRecepcion.length === 0) {
			Swal.fire({ icon: "warning", title: "falta tomar fotos al vehiculo!", });
			return;
		}
		if ($("#input_kilometraje_salida").val() == 0) {
			Swal.fire({ icon: "warning", title: "falta colocar el kilometraje del vehiculo", });
			return;
		}

		arrayImagesRecepcion.forEach(async (url, i) => {
			let blob = dataURItoBlob(url);
			let file = imagen = new File([blob], 'imagen.png', { type: 'image/png' });
			const data = new FormData();
			data.append(`file`, file);
			//await ajax_function(data, "guardar_fotoRecepcion");
		});


		const data = new FormData();
		await generarActaRecepcion(data);

	});



	const generarActaRecepcion = async (data) => {
		$("#spinner_btn_generar_actaRecepcion").show();
		$("#btn_generar_actaRecepcion").attr("disabled", true);
		const canvas = document.getElementById("canvas-combustible-recepcion");
		const url = canvas.toDataURL("image/png");
		const matrizRecepcion = await capturarControlRecepcionArray();
		data.append("matrizRecepcion", JSON.stringify(matrizRecepcion));
		data.append("imageCombustible", url);

		console.log(matrizRecepcion);
		//const response = await ajax_function(data, "generar_PDFactaEntrega");

		$("#spinner_btn_generar_actaRecepcion").hide();
		$("#btn_generar_actaRecepcion").attr("disabled", false);
	};


	const capturarControlRecepcionArray = async () => {
		//cacturando los accesorios
		const matrizRecepcion = [];
		matrizRecepcion.push(
			$('[name="listA2[]"]:checked')
				.map(function () {
					return this.value;
				})
				.get()
		);
		matrizRecepcion.push(
			$('[name="listB2[]"]:checked')
				.map(function () {
					return this.value;
				})
				.get()
		);
		matrizRecepcion.push(
			$('[name="listC2[]"]:checked')
				.map(function () {
					return this.value;
				})
				.get()
		);
		return matrizRecepcion;
	};

	/* 	$("#btn_recepcionar_arriendo").click(() => {
			if (arrayImagesRecepcion.length === 0) {
				Swal.fire({ icon: "warning", title: "falta tomar fotos al vehiculo!", });
				return;
			}
			if ($("#input_kilometraje_salida").val() == 0) {
				Swal.fire({ icon: "warning", title: "falta colocar el kilometraje del vehiculo", });
				return;
			}
			alertQuestion(async () => {
				$("#spinner_btn_generar_actaRecepcion").show();
				$("#btn_recepcionar_arriendo").attr("disabled", true);
				const data = new FormData();
				const response_revision = await guardarRevisionRecepcion(data);
				if (response_revision.success) {
					const response_vehiculo = await cambiarEstadoVehiculo(data);
					if (response_vehiculo.success) {
						data.append("id_arriendo", $("#id_arriendo_recepcion").val());
						data.append("estado", "RECEPCIONADO");
						data.append("kilometraje_salida", $("#input_kilometraje_salida").val());
						await cambiarEstadoArriendo(data);
						data.append("tipo", "RECEPCION");
						await ajax_function(data, "registrar_bloqueoUsuario");
						refrescarTablaActivos();
						cargarArriendosPendientesDelUsuario();
						$("#modal_ArriendoFinalizar").modal("toggle");
						Swal.fire("Arriendo finalizado!", "Arriendo finalizado con exito!", "success");
					}
				}
				$("#btn_recepcionar_arriendo").attr("disabled", false);
				$("#spinner_btn_generar_actaRecepcion").hide();
			})
		});
	 */


	$("#limpiarArrayFotosRecepcion").click(() => {
		alertQuestion(() => {
			arrayImagesRecepcion.length = 0;
			$("#carrucel_recepcion").empty();
			$("#carrucel_recepcion2").empty();
		})
	});



	$("#seleccionarFotoRecepcion").click(async () => {
		$("#seleccionarFotoRecepcion").attr("disabled", true);
		$("#spinner_btn_seleccionar_recepcion").show();
		if (arrayImagesRecepcion.length > 9 || $("#inputImagen_vehiculo_recepcion").val().length === 0) {
			Swal.fire({ icon: "error", title: "minimo 1 y maximo 9 imagenes" });
			$("#spinner_btn_seleccionar_recepcion").hide();
			$("#seleccionarFotoRecepcion").attr("disabled", false);
			return;
		}

		const canvas = document.getElementById("canvas_fotoVehiculo_recepcion");
		const base64 = canvas.toDataURL("image/png");
		const url = await resizeBase64Img(base64, canvas.width, canvas.height, 2);

		arrayImagesRecepcion.push(url);
		agregarFotoACarrucelRecepcion(arrayImagesRecepcion);
		limpiarTodoCanvasVehiculo();

		$("#spinner_btn_seleccionar_recepcion").hide();
		$("#seleccionarFotoRecepcion").attr("disabled", false);

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





	const agregarFotoACarrucelRecepcion = (array) => {
		let items = "";
		for (let i = 0; i < array.length; i++) {
			let base64str = array[i].split('base64,')[1];
			let decoded = atob(base64str);
			items += `<div class="item"><img src="${array[i]}" /> <span>${decoded.length} kB </span></div>`;
		}
		const html = `<div class="owl-carousel owl-theme" id="carruselVehiculos">${items}</div></div>`;
		$("#carrucel_recepcion").html(html);
		$("#carrucel_recepcion2").html(html);

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

	const actualizarArriendo = async (data) => {
		data.append("id_arriendo", $("#id_arriendo_extencion").val());
		data.append("diasActuales", $("#inputNumeroDias_extenderPlazo").val());
		data.append("diasAcumulados", Number($("#inputDiasAcumulados_extenderPlazo").val()) + Number($("#inputNumeroDias_extenderPlazo").val()));
		data.append("inputFechaExtender_extenderPlazo", $("#inputFechaExtender_extenderPlazo").val())
		return await ajax_function(data, "extender_arriendo");
	}

	const guardarPagoArriendo = async (data) => {
		data.append("inputIdArriendo", $("#id_arriendo_extencion").val());
		data.append("inputSubTotalArriendo", $("#inputSubTotalArriendo_extenderPlazo").val());
		data.append("inputPagoEmpresa", $("#inputPagoEmpresa_extenderPlazo").val());
		data.append("inputValorCopago", $("#inputValorCopago_extenderPlazo").val());
		data.append("inputNeto", $("#inputNeto_extenderPlazo").val());
		data.append("inputIVA", $("#inputIVA_extenderPlazo").val());
		data.append("inputDescuento", $("#inputDescuento_extenderPlazo").val());
		data.append("inputTotal", $("#inputTotal_extenderPlazo").val());
		data.append("inputObservaciones", $("#inputObservaciones_extenderPlazo").val());
		data.append("digitador", $("#inputDigitador_extenderPlazo").val());
		return await ajax_function(data, "registrar_pagoArriendo");
	}

	const guardarPagoCliente = async (data) => {
		data.append("inputDeudor", $("#inputDeudor_extenderPlazo").val());
		data.append("inputNeto", $("#inputNeto_extenderPlazo").val());
		data.append("inputIVA", $("#inputIVA_extenderPlazo").val());
		data.append("inputTotal", $("#inputTotal_extenderPlazo").val());
		data.append("inputEstado", "PENDIENTE");
		return await ajax_function(data, "registrar_pago");
	}


	const guardarPagoRemplazo = async (data) => {
		data.append("inputEstado", "PENDIENTE");
		data.append("inputDeudor", $("#inputDeudorCopago_extenderPlazo").val());
		data.append("inputNeto", $("#inputPagoEmpresa_extenderPlazo").val());
		data.append("inputIVA", $("#inputPagoIvaEmpresa_extenderPlazo").val());
		data.append("inputTotal", $("#inputPagoTotalEmpresa_extenderPlazo").val());
		return await ajax_function(data, "registrar_pago");
	}


	const guardarExtencion = async (data) => {
		data.append("patente_vehiculo", $("#inputVehiculo_extenderPlazo").val());
		data.append("fechaInicio", $("#inputFechaRecepcion_extenderPlazo").val())
		data.append("fechaFin", $("#inputFechaExtender_extenderPlazo").val())
		return await ajax_function(data, "registrar_extencion")
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


	const alertaTemporizador = (countDownDate, fechaFinal, time, id_arriendo) => {
		let diff = countDownDate.diff(moment());
		const fechaActual = moment();
		const diasRestantes = fechaFinal.diff(fechaActual, "days"); // 1
		if (diff <= 0) {
			clearInterval(time);
			// If the count down is finished, write some text
			$(`#time${id_arriendo}`).html("<div> EXPIRADO </div>");
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
				viewTime = `<div id=time${arriendo.id_arriendo}> EXPIRADO </div>`;
				btnExtender = ` <button value='${arriendo.id_arriendo}' onclick='mostrarArriendoExtender(this.value)'  data-toggle='modal'  data-target='#modal_ArriendoExtender' class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> `
				btnFinalizar = ` <button value='${arriendo.id_arriendo}' onclick='mostrarRecepcionArriendo(this.value)' data-toggle='modal'  data-target='#modal_ArriendoFinalizar'  class='btn btn btn-outline-dark'><i class="fas fa-external-link-square-alt"></i></button>`;
			} else {
				viewTime = "<div> RECEPCIONADO </div>";
				btnExtender = ` <button value='${arriendo.id_arriendo}' onclick='mostrarArriendoExtender(this.value)'  data-toggle='modal'  data-target='#modal_ArriendoExtender' class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> `
				btnFinalizar = ` <button disabled value='${arriendo.id_arriendo}'   class='btn btn btn-outline-success'><i class="fas fa-check"></i></button>`;
			}
			tablaArriendosActivos.row
				.add([
					arriendo.id_arriendo,
					cliente,
					arriendo.vehiculo.patente_vehiculo,
					arriendo.tipo_arriendo,
					formatearFechaHora(arriendo.fechaRecepcion_arriendo),
					`${viewTime}`,
					arriendo.sucursale.nombre_sucursal,
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
