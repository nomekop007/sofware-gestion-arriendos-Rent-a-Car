$("#m_danios").addClass("active");
$("#l_danios").addClass("card");
$("#spinner_tabla_danios").hide();
$("#spinner_tabla_danios_pendientes").hide();


const danio = {
	id_danio: null
};

const mostrarDescripcion = (descripcion) => {
	$("#descripcion_danio").html(descripcion)
}


const buscarDanio = (id_danio) => {
	limpiar()
	danio.id_danio = id_danio;
	$("#id_danio").html("Daño Nº " + id_danio)
}



const EliminarRegistroDanio = async (id_) => {

	console.log(id_);

	alertQuestion(async () => {

		const data = new FormData();
		const estado = new FormData();
		data.append("id_danio", id_);  //si quiero pasar mas parametros añadirlos al data
		data.append("estado", "ANULADO");

		let response = await ajax_function(data, "eliminar_danio_vehiculo_new");


		if (response.success) {


			Swal.fire(
				"Se ha eliminado el registro de daños",
				"el registro se ha borrado exitosamente",
				"success"
			)

			location.reload();

		} else {
			Swal.fire(
				"Error eliminando el registro de daños",
				"el registro no se ha eliminado",
				"warning"
			)
		}

	});





}




const limpiar = () => {
	danio.id_danio = null;
	$("#spinner_btn_subir_comprobante").hide();
	$("#form_subir_comprobante")[0].reset();
}

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//


$(document).ready(() => {

	$("#todos-tab").click(() => refrescar_tabla_danios());
	$("#pendientes-tab").click(() => refrescar_tabla_danios_pendientes());
	const tabla_todos_danios = $("#tabla_todos_danios").DataTable(lenguaje);
	const tabla_pendientes_danios = $("#tabla_pendientes_danios").DataTable(lenguaje);

	const refrescar_tabla_danios_pendientes = () => {
		tabla_pendientes_danios.row().clear().draw(false);
		cargar_todos_danios_pendiente();
	}


	const refrescar_tabla_danios = () => {
		tabla_todos_danios.row().clear().draw(false);
		cargar_todos_danios();
	};



	(cargar_todos_danios_pendiente = async () => {
		$("#spinner_tabla_danios_pendientes").show();
		const response = await ajax_function(null, "cargar_todos_danios");
		if (response.success) {
			tabla_pendientes_danios.row().clear().draw(false);
			$.each(response.data, (i, danio) => {
				cargar_danio_en_tabla_pendiente(danio);
			})
		}
		$("#spinner_tabla_danios_pendientes").hide();
	})();


	const cargar_todos_danios = async () => {
		$("#spinner_tabla_danios").show();
		const response = await ajax_function(null, "cargar_todos_danios");
		if (response.success) {
			tabla_todos_danios.row().clear().draw(false);
			$.each(response.data, (i, danio) => {
				cargar_danio_en_tabla(danio);
			})
		}
		$("#spinner_tabla_danios").hide();
	}



	$("#btn_subir_comprobante").click(() => {
		const id_danio = danio.id_danio;
		const precio = $("#input_precio_pagoDanio").val();
		const mecanico = $("#input_mecanico_pagoDanio").val();
		const pagador = $("#input_pagador_pagoDanio").val();
		const numFactura = $("#inputNumFacturacion").val();
		const fileFacturacion = $("#inputFileFacturacion").val();
		if (precio.length == 0 || mecanico.length == 0 || pagador.length == 0 || numFactura.length == 0 || fileFacturacion.length == 0) {
			Swal.fire(
				"falta algunos datos",
				"faltan datos en el formulario, por favor complete",
				"warning"
			);
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_subir_comprobante").show();
			$("#btn_subir_comprobante").attr("disabled", true);
			const form = $("#form_subir_comprobante")[0];
			const data = new FormData(form);
			const responseFacturacion = await ajax_function(data, "registrar_facturacion");
			if (responseFacturacion.success) {
				data.append("inputDocumento", $("#inputFileFacturacion")[0].files[0]);
				data.append("id_facturacion", responseFacturacion.data.id_facturacion);
				data.append("id_danioVehiculo", id_danio);
				const responseDocFacturacion = await ajax_function(data, "guardar_documentoFacturacion");
				if (responseDocFacturacion.success) {
					const responsePagoDanio = await ajax_function(data, "registrar_pagoDanio");
					if (responsePagoDanio.success) {
						const responseEstado = await ajax_function(data, "cambiar_estadoDanioVehiculo");
						if (responseEstado.success) {
							Swal.fire(
								"Pago Daño vehiculo registrado!",
								"el registro se guardo con exito",
								"success"
							)
							refrescar_tabla_danios_pendientes();
							$("#modal_subir_comprobante").modal("toggle");
						}
					}
				}
			}
			$("#btn_subir_comprobante").attr("disabled", false);
			$("#spinner_btn_subir_comprobante").hide();
		})
	});




	const cargar_danio_en_tabla_pendiente = (danio) => {
		try {
			if (danio.estado_danioVehiculo == "PENDIENTE") {
				let cliente = "";
				switch (danio.arriendo.tipo_arriendo) {
					case "PARTICULAR":
						cliente = `${danio.arriendo.cliente.nombre_cliente}`;
						break;
					case "REEMPLAZO":
						cliente = `${danio.arriendo.remplazo.cliente.nombre_cliente}`;
						break;
					case "EMPRESA":
						cliente = `${danio.arriendo.empresa.nombre_empresa}`;
						break;
				}
				tabla_pendientes_danios.row
					.add([
						danio.arriendo.id_arriendo,
						`${danio.arriendo.patente_vehiculo} ${danio.vehiculo.marca_vehiculo} ${danio.vehiculo.modelo_vehiculo}`,
						cliente,
						danio.userAt,
						formatearFechaHora(danio.createdAt),
						danio.arriendo.sucursale.nombre_sucursal,
						`<button  value='${danio.descripcion_danioVehiculo}'  	onclick='mostrarDescripcion(this.value)' data-toggle='modal' data-target='#modal_mostrar_descripcion' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>
					    <button  value='${danio.documento_danioVehiculo}'  	onclick='buscarDocumento(this.value,"fotosDañoVehiculo")' class='btn btn-outline-primary'><i class="fas fa-camera-retro"></i></button>`,
						`<button  value='${danio.id_danioVehiculo}'  				onclick='buscarDanio(this.value)' data-toggle='modal' data-target='#modal_subir_comprobante' class='btn btn-outline-success'><i class="fas fa-upload"></i></button>
						<button  value='${danio.id_danioVehiculo}' id='eliminar_danio' onclick='EliminarRegistroDanio(this.value)' class='btn btn-outline-danger'><i class="fas fa-trash-alt"></i></i></button>
`
					]).draw(false);
			}
		} catch (error) {
			console.log(error);
			console.log("error al cargar")
		}
	}


	const cargar_danio_en_tabla = (danio) => {
		try {
			let cliente = "";
			switch (danio.arriendo.tipo_arriendo) {
				case "PARTICULAR":
					cliente = `${danio.arriendo.cliente.nombre_cliente}`;
					break;
				case "REEMPLAZO":
					cliente = `${danio.arriendo.remplazo.cliente.nombre_cliente}`;
					break;
				case "EMPRESA":
					cliente = `${danio.arriendo.empresa.nombre_empresa}`;
					break;
			}
			let comprobante = "";
			if (danio.pagosDanio) {
				comprobante = `<button  value='${danio.pagosDanio.facturacione.documento_facturacion}'  onclick='buscarDocumento(this.value,"facturacion")'  class='btn btn-outline-dark'><i class="fas fa-file-alt"></i></button>`;
			}
			tabla_todos_danios.row
				.add([
					danio.arriendo.id_arriendo,
					`${danio.arriendo.patente_vehiculo} ${danio.vehiculo.marca_vehiculo} ${danio.vehiculo.modelo_vehiculo}`,
					cliente,
					danio.userAt,
					formatearFechaHora(danio.createdAt),
					danio.estado_danioVehiculo,
					danio.arriendo.sucursale.nombre_sucursal,
					`<button  value='${danio.descripcion_danioVehiculo}'  onclick='mostrarDescripcion(this.value)' data-toggle='modal' data-target='#modal_mostrar_descripcion' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>
						<button  value='${danio.documento_danioVehiculo}'  onclick='buscarDocumento(this.value,"fotosDañoVehiculo")' class='btn btn-outline-primary'><i class="fas fa-camera-retro"></i></button>
						${comprobante}
					`
				])
				.draw(false);
		} catch (error) {
			console.log("error al cargar")
		}
	}




	/* ********************** Agregar Daño Vehicular - Esteban Mallea ************************** */

	// funcion para ocultar elemtos html mediante Jquery



	$("#cerrar_agregarDaño").click(async () => {

		$("#buscar_button").val('');
		$("#nombre").val('');
		$("#rut").val('');
		$("#email").val('');
		$("#telefono").val('');
		$("#direccion").val('');
	});



	$("#NuevodanioVehicular").click(async () => {

		$('#div_observacion').hide();
		$('#fotografia_recepcion_daño').hide();
		$('#div_observacion').hide();
		$('#registar_danio_vehicular').hide();
		$('#Alerta_arriendo').hide();
		$('#Alerta_arriendo_success').hide();

	});


	$("#registar_danio_vehicular").click(async () => {


		let input = $("#buscar_button");
		let Input_observacion = $("#textareaObservacion");
		let numero_arriendo1 = $(input).val();
		let Observacion1 = $(Input_observacion).val();


		numero_arriendo = parseInt(numero_arriendo1);

		console.log(numero_arriendo);
		console.log(Observacion1);

		const data = new FormData();
		data.append("id_danio", numero_arriendo);  //si quiero pasar mas parametros añadirlos al data
		data.append("descripcion_danio", Observacion1);


		const response = await ajax_function(data, "registrar_danio_vehiculo_new");

		if (response.success) {
			$("#buscar_button").val('');
			$("#nombre").val('');
			$("#rut").val('');
			$("#email").val('');
			$("#telefono").val('');
			$("#direccion").val('');
			$('#textareaObservacion').val('');
			$('#fotografia_recepcion_daño').hide(); // ocultar titulo de carrusel
			$('#Alerta_arriendo_success').show();
			$('#textareaObservacion').hide('');
			$('#div_observacion').hide();
			$('#registar_danio_vehicular').hide();
			refrescar_tabla_danios_pendientes();
			Swal.fire(
				"Se ha actualizado el registro de daños",
				"el registro se guardado exitosamente",
				"success"
			)
		} else {
			Swal.fire(
				"Error actualizando el registro de daños",
				"el registro no se ha guardado",
				"warning"
			)
		}

	});




	$("#buscar-Arriendo").click(async () => {

		$("#contenedorImagenes").empty();
		$('#textareaObservacion').val('');
		$('#Alerta_arriendo_success').hide();

		$('.buscar_button1').on('input', function () {
			this.value = this.value.replace(/[^0-9]/g, '');
		});


		let input = $("#buscar_button");
		let numero_arriendo = $(input).val();
		let base_url = "https://www.imlchile.cl:3010/";
		var items = "";
		let variable = [];

		const data = new FormData();
		data.append("id_arriendo", parseInt(numero_arriendo));  //si quiero pasar mas parametros añadirlos al data


		if (parseInt(numero_arriendo) > 0) {


			//registrar_danio_vehiculo


			const response = await ajax_function(data, "buscar_arriendo");

			if (response.data.estado_arriendo == "RECEPCIONADO") {

				let nombre_cliente = '';
				let rut_cliente = '';
				let correo_cliente = '';
				let telefono_cliente = '';
				let direccion_cliente = '';

				switch (response.data.tipo_arriendo) {
					case "PARTICULAR":
						nombre_cliente = response.data.cliente.nombre_cliente;
						rut_cliente = response.data.cliente.rut_cliente;
						correo_cliente = response.data.cliente.correo_cliente;
						telefono_cliente = response.data.cliente.telefono_cliente;
						direccion_cliente = response.data.cliente.direccion_cliente;
						break;
					case "REEMPLAZO":
						nombre_cliente = response.data.remplazo.cliente.nombre_cliente;
						rut_cliente = response.data.remplazo.cliente.rut_cliente;
						correo_cliente = response.data.remplazo.cliente.correo_cliente;
						telefono_cliente = response.data.remplazo.cliente.telefono_cliente;
						direccion_cliente = response.data.remplazo.cliente.direccion_cliente;
						break;
					case "EMPRESA":
						nombre_cliente = response.data.empresa.nombre_empresa;
						rut_cliente = response.data.empresa.rut_empresa;
						correo_cliente = response.data.empresa.correo_empresa;
						telefono_cliente = response.data.empresa.telefono_empresa;
						direccion_cliente = response.data.empresa.direccion_empresa;
						break;
				}


				let i = 0;
				let imagenes_despacho = response.data.fotosDespachos;
				let cantidad_fotografias = imagenes_despacho.length;
				let nombre = nombre_cliente
				let rut = rut_cliente
				let email = correo_cliente
				let telefono = telefono_cliente
				let direccion = direccion_cliente

				$("#nombre").prop({ 'value': nombre });
				$("#rut").prop({ 'value': rut });
				$("#email").prop({ 'value': email });
				$("#telefono").prop({ 'value': telefono });
				$("#direccion").prop({ 'value': direccion });




				for (i = 0; i < cantidad_fotografias; i++) {
					variable.push(base_url + imagenes_despacho[i].url_fotoDespacho);
				}

				items += `<div class="carousel-item active">
							<img class="d-block w-100" src="${variable[0]}" />
							<div class="carousel-caption d-none d-md-block">
								<p>Imagenes de vehiculo N° ${"1"}</p>
							</div>
						
						</div>`;

				for (i = 1; i < cantidad_fotografias; i++) {

					items += `<div class="carousel-item">
								<img class="d-block w-100" src="${variable[i]}" />
								<div class="carousel-caption d-none d-md-block">
									<p>Imagenes de vehiculo N° ${i + 1}</p>
								</div>
								
							  </div>`;
				}

				$("#contenedorImagenes").html(items);
				$('#div_observacion').show();
				$('#Alerta_arriendo').hide(); // alerta de arriendo
				$('#textareaObservacion').show();   //mostrar textarea 
				$('#fotografia_recepcion_daño').show(); // mostrar titulo de carrusel
				$('#div_observacion').show(); // mostrar carrusel de fotofrafia
				$('#registar_danio_vehicular').show(); //btn registrar


			} else {
				$('#div_observacion').hide();
				$('#registar_danio_vehicular').hide(); //btn registrar
				$('#fotografia_recepcion_daño').hide(); // mostrar titulo de carrusel
				$('#Alerta_arriendo').show(); // mostrar carrusel de fotofrafia
				return;
			}



		}



	});


});





