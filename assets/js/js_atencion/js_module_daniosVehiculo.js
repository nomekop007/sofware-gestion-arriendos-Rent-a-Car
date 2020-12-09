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



const limpiar = () => {
	danio.id_danio = null;
	$("#spinner_btn_subir_comprobante").hide();
	$("#form_subir_comprobante")[0].reset();
}




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
			console.log(response.data);
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
			}
		});
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
						danio.id_danioVehiculo,
						danio.arriendo.id_arriendo,
						`${danio.arriendo.patente_vehiculo} ${danio.vehiculo.marca_vehiculo} ${danio.vehiculo.modelo_vehiculo}`,
						cliente,
						danio.userAt,
						formatearFechaHora(danio.createdAt),
						`<button  value='${danio.descripcion_danioVehiculo}'  	onclick='mostrarDescripcion(this.value)' data-toggle='modal' data-target='#modal_mostrar_descripcion' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>
					 <button  value='${danio.documento_danioVehiculo}'  	onclick='buscarDocumento(this.value,"fotosDañoVehiculo")' class='btn btn-outline-primary'><i class="fas fa-camera-retro"></i></button>`,
						`<button  value='${danio.id_danioVehiculo}'  				onclick='buscarDanio(this.value)' data-toggle='modal' data-target='#modal_subir_comprobante' class='btn btn-outline-success'><i class="fas fa-upload"></i></button>`
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
					danio.id_danioVehiculo,
					danio.arriendo.id_arriendo,
					`${danio.arriendo.patente_vehiculo} ${danio.vehiculo.marca_vehiculo} ${danio.vehiculo.modelo_vehiculo}`,
					cliente,
					danio.userAt,
					formatearFechaHora(danio.createdAt),
					danio.estado_danioVehiculo,
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



})
