const arrayImages = [];
let base64_documento = null;

const buscarArriendo = async (id_arriendo) => {
	limpiarCampos();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_arriendo");
	if (response.success) {
		const arriendo = response.data;
		$("#inputIdArriendo").val(arriendo.id_arriendo);
		$("#numero_arriendo_despacho").html("Nº " + arriendo.id_arriendo + " vehiculo : " + arriendo.patente_vehiculo);
		$("#inputMarcaVehiculoDespacho").val(arriendo.vehiculo.marca_vehiculo);
		$("#inputModeloVehiculoDespacho").val(arriendo.vehiculo.modelo_vehiculo);
		$("#inputEdadVehiculoDespacho").val(arriendo.vehiculo.año_vehiculo);
		$("#inputColorVehiculoDespacho").val(arriendo.vehiculo.color_vehiculo);
		$("#inputPatenteVehiculoDespacho").val(arriendo.vehiculo.patente_vehiculo);
		$("#inputKilomentrajeVehiculoDespacho").val(arriendo.vehiculo.kilometraje_vehiculo ? arriendo.vehiculo.kilometraje_vehiculo : 0);
		$("#formActaEntrega").show();
		switch (arriendo.tipo_arriendo) {
			case "PARTICULAR":
				$("#inputRecibidorDespacho").val(arriendo.cliente.nombre_cliente);
				break;
			case "REEMPLAZO":
				$("#inputRecibidorDespacho").val(arriendo.remplazo.cliente.nombre_cliente);
				break;
			case "EMPRESA":
				$("#inputRecibidorDespacho").val(arriendo.empresa.nombre_empresa);
				break;
		}
	}
	$("#formSpinner").hide();
};

const limpiarCampos = () => {

	mostrarCanvasImgVehiculo([
		"canvas-fotoVehiculo",
		"limpiar-fotoVehiculo",
		"dibujarCanvas",
		"inputImagenVehiculo"
	]);


	mostrarCanvasCombustible("canvas-combustible", "output");

	mostrarCanvasDosFirmas(
		["canvas-firma1",
			"canvas-firma2",
			"limpiar-firma1",
			"limpiar-firma2"
		]);


	$("#body-documento").hide();
	$("#body-firma").hide();
	$("#body-sinContrato").show();
	$("#nombre_documento").val("");
	$("#subtotal-copago").hide();
	$("#spinner_btn_generarActaEntrega").hide();
	$("#formActaEntrega")[0].reset();
	$("#formSpinner").show();
	$("#formActaEntrega").hide();

	$("#btn_firmar_actaEntrega").attr("disabled", false);
	$("#spinner_btn_firmarActaEntrega").hide();
	$("#spinner_btn_confirmarActaEntrega").hide();
	$("#btn_confirmar_actaEntrega").attr("disabled", true);
	$("#spinner_btn_seleccionar").hide();
	arrayImages.length = 0;
	base64_documento = null;
	$("#carrucel").empty();

};
















//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	//se inician los datatable
	const tablaControldespacho = $("#tablaControldespacho").DataTable(lenguaje);

	$("#nav-despachos-tab").click(() => refrescarTabla());


	(cargarArriendos = async () => {
		$("#spinner_tablaDespacho").show();
		const response = await ajax_function(null, "cargar_arriendosDespachos");
		tablaControldespacho.row().clear().draw(false);
		if (response.success) {
			$.each(response.data, (i, arriendo) => {
				cargarArriendoEnTabla(arriendo);
			});
		}
		$("#spinner_tablaDespacho").hide();
	})();


	$("#seleccionarFoto").click(async () => {
		$("#spinner_btn_seleccionar").show();
		$("#seleccionarFoto").attr("disabled", true);

		console.log($("#inputImagenVehiculo").val().length);
		if (arrayImages.length > 9 || $("#inputImagenVehiculo").val().length === 0) {
			Swal.fire({ icon: "error", title: "minimo 1 y maximo 9 imagenes" });
			$("#spinner_btn_seleccionar").hide();
			$("#seleccionarFoto").attr("disabled", false);
			return;
		}

		const canvas = document.getElementById("canvas-fotoVehiculo");
		const base64 = canvas.toDataURL("image/png");
		const url = await resizeBase64Img(base64, canvas.width, canvas.height, 2);

		arrayImages.push(url);
		agregarFotoACarrucel(arrayImages);
		limpiarTodoCanvasVehiculo();

		$("#spinner_btn_seleccionar").hide();
		$("#seleccionarFoto").attr("disabled", false);

	});




	$("#btn_confirmar_actaEntrega").click(() => {
		alertQuestion(async () => {
			$("#spinner_btn_confirmarActaEntrega").show();
			$("#btn_confirmar_actaEntrega").attr("disabled", true);
			const form = $("#formActaEntrega")[0];
			const data = new FormData(form);
			const response = await guardarDatosDespacho(data);
			console.log(response);
			if (response.success) {
				const response2 = await guardarActaEntrega(data, response.id_despacho);
				if (response2.success) {
					await cambiarEstadoArriendo(data);
					await cambiarEstadoVehiculo(data);
					await enviarCorreoDespacho(data);
					refrescarTabla();
					Swal.fire("Acta de entrega Firmado!", "acta de entrega firmado y registrado con exito!", "success"
					);
					$("#modal_signature").modal("toggle");
					$("#modal_despachar_arriendo").modal("toggle");
				}
			}
			$("#btn_confirmar_actaEntrega").attr("disabled", false);
		})
	});



	$("#btn_firmar_actaEntrega").click(async () => {
		$("#spinner_btn_firmarActaEntrega").show();
		obtenerGeolocalizacion();
	});


	$("#limpiarArrayFotos").click(() => {
		alertQuestion(() => {
			arrayImages.length = 0;
			$("#carrucel").empty();
		})
	});


	const obtenerGeolocalizacion = () => {
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
				firmarActaEntrega(geo);
			}),
			(error = (err) => {
				console.log(err);
				alert("no se logro obtener la geolocalizacion , active manualmente");
				firmarActaEntrega("no location");
			}),
			options
		);
	};



	$("#btn_crear_ActaEntrega").click(async () => {
		const form = $("#formActaEntrega")[0];
		const data = new FormData(form);
		if (arrayImages.length === 0) {
			Swal.fire({ icon: "warning", title: "falta tomar fotos al vehiculo!", });
			return;
		}

		$("#spinner_btn_generarActaEntrega").show();
		$("#btn_crear_ActaEntrega").attr("disabled", true);

		arrayImages.forEach((url, i) => {
			let blob = dataURItoBlob(url);
			let file = imagen = new File([blob], 'imagen.png', { type: 'image/png' });
			data.append(`file${i}`, file);
		});
		const response = await ajax_function(data, "guardar_fotosVehiculo");
		if (response.success) {
			await generarActaEntrega(data);
		}
		$("#spinner_btn_generarActaEntrega").hide();
		$("#btn_crear_ActaEntrega").attr("disabled", false);

	});




	const firmarActaEntrega = async (geo) => {
		const canvas1 = document.getElementById("canvas-firma1");
		const canvas2 = document.getElementById("canvas-firma2");
		const form = $("#formActaEntrega")[0];
		const data = new FormData(form);
		data.append("inputFirma1PNG", canvas1.toDataURL("image/png"));
		data.append("inputFirma2PNG", canvas2.toDataURL("image/png"));
		data.append("geolocalizacion", geo);
		await generarActaEntrega(data);
	};



	const generarActaEntrega = async (data) => {
		const canvas = document.getElementById("canvas-combustible");
		const url = canvas.toDataURL("image/png");
		const matrizRecepcion = await capturarControlDespachoArray();
		data.append("matrizRecepcion", JSON.stringify(matrizRecepcion));
		data.append("imageCombustible", url);

		const response = await ajax_function(data, "generar_PDFactaEntrega");
		if (response.success) {
			$("#modal_signature").modal({ show: true });
			$("#body-documento").show();
			$("#body-firma").show();
			$("#body-sinContrato").hide();
			$("#recibido").text($("#inputRecibidorDespacho").val());
			$("#entregado").text($("#inputEntregadorDespacho").val());
			mostrarVisorPDF(response.data.base64, [
				"pdf_canvas_despacho", "page_count_despacho",
				"page_num_despacho", "prev_despacho",
				"next_despacho"]);
			const a = document.getElementById("descargar_actaEntrega");
			a.href = `data:application/pdf;base64,${response.data.base64}`;
			a.download = `actaEntrega.pdf`;
			base64_documento = response.data.base64;
			if (response.data.firma1 && response.data.firma2) {
				$("#btn_confirmar_actaEntrega").attr("disabled", false);
			}
		}
		$("#spinner_btn_firmarActaEntrega").hide();
		$("#btn_crear_ActaEntrega").attr("disabled", false);
	};


	const agregarFotoACarrucel = (array) => {
		let items = "";
		for (let i = 0; i < array.length; i++) {
			let base64str = array[i].split('base64,')[1];
			let decoded = atob(base64str);

			items += `<div class="item"><img value="${i}" src="${array[i]}" /> <span>${decoded.length} kB </span></div>`;
		}
		const html = `<div class="owl-carousel owl-theme" id="carruselVehiculos">${items}</div></div>`;
		$("#carrucel").html(html);
		$(".owl-carousel").owlCarousel({
			items: 1,
		})
	};


	const capturarControlDespachoArray = async () => {
		//cacturando los accesorios
		const matrizRecepcion = [];
		matrizRecepcion.push(
			$('[name="listA[]"]:checked')
				.map(function () {
					return this.value;
				})
				.get()
		);

		matrizRecepcion.push(
			$('[name="listB[]"]:checked')
				.map(function () {
					return this.value;
				})
				.get()
		);

		matrizRecepcion.push(
			$('[name="listC[]"]:checked')
				.map(function () {
					return this.value;
				})
				.get()
		);

		return matrizRecepcion;
	};

	const guardarDatosDespacho = async (data) => {
		return await ajax_function(data, "registrar_despacho");
	};

	const guardarActaEntrega = async (data, id_despacho) => {
		data.append("base64", base64_documento);
		data.append("inputIdDespacho", id_despacho);
		return await ajax_function(data, "registrar_actaEntrega");
	};

	const cambiarEstadoArriendo = async (data) => {
		data.append("id_arriendo", $("#inputIdArriendo").val());
		data.append("estado", "ACTIVO");
		await ajax_function(data, "cambiarEstado_arriendo");
	};

	const cambiarEstadoVehiculo = async (data) => {
		data.append(
			"inputPatenteVehiculo",
			$("#inputPatenteVehiculoDespacho").val()
		);
		data.append("inputEstado", "ARRENDADO");
		data.append(
			"kilometraje_vehiculo",
			$("#inputKilomentrajeVehiculoDespacho").val()
		);
		await ajax_function(data, "cambiarEstado_vehiculo");
	};

	const enviarCorreoDespacho = async (data) => {
		await ajax_function(data, "enviar_correoActaEntrega");
	};

	const refrescarTabla = () => {
		//limpia la tabla
		tablaControldespacho.row().clear().draw(false);
		//carga nuevamente
		cargarArriendos();
	};

	//carga tablaTotalArriendos
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

			tablaControldespacho.row
				.add([
					arriendo.id_arriendo,
					cliente,
					arriendo.vehiculo.patente_vehiculo,
					formatearFechaHora(arriendo.fechaEntrega_arriendo),
					formatearFechaHora(arriendo.fechaRecepcion_arriendo),
					arriendo.tipo_arriendo,
					arriendo.usuario.nombre_usuario,
					arriendo.sucursale.nombre_sucursal,
					` <button value='${arriendo.id_arriendo}'  onclick='buscarArriendo(this.value)'   data-toggle='modal'
                    data-target='#modal_despachar_arriendo' class='btn btn btn-outline-success'><i class='fas fa-concierge-bell'></i></button>  `,
				])
				.draw(false);
		} catch (error) {
			console.log(error);
		}
	};
});
