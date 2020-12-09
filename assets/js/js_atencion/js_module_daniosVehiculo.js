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


	const refrescar_tabla_danios = () => {
		tabla_todos_danios.row().clear().draw(false);
		cargar_todos_danios();
	};
	const refrescar_tabla_danios_pendientes = () => {
		tabla_pendientes_danios.row().clear().draw(false);
		cargar_todos_danios_pendiente();

	}

	(cargar_todos_danios_pendiente = async () => {
		$("#spinner_tabla_danios_pendientes").show();
		const response = await ajax_function(null, "cargar_todos_danios");
		if (response.success) {
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

		const precio = $("#input_pago_total_danio").val();
		const file = $("#input_file_comprobante")[0].files[0];
		const id_danio = danio.id_danio;

		if (precio.length == 0 || $("#input_file_comprobante").val().length == 0) {
			Swal.fire(
				"debe ingresar el comprobante",
				"falta ingresar datos en el formulario",
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
				const data = new FormData();
				data.append("precio", precio);
				data.append("comprobante", file);
				data.append("id_danio", id_danio);
				const response = await ajax_function(data, "registrar_pagoDanio");
				if (response.success) {
					data.append("id_pagoDanio", response.data.id_pagoDanio);
					const responseComprobante = await ajax_function(data, "guardar_comprobantePagoDanio");
					if (responseComprobante.success) {
						const responseDanio = await ajax_function(data, "cambiar_estadoDanioVehiculo");
						if (responseDanio.success) {
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
		console.log(danio);
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
				comprobante = `<button  value='${danio.pagosDanio.comprobante_pagoDanio}'  onclick='buscarDocumento(this.value,"facturacion")'  class='btn btn-outline-dark'><i class="fas fa-file-alt"></i></button>`;
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
