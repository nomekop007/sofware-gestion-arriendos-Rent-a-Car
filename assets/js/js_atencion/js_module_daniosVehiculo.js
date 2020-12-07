$("#m_danios").addClass("active");
$("#l_danios").addClass("card");
$("#spinner_tabla_danios").hide();
$("#spinner_tabla_danios_pendientes").hide();


const mostrarDescripcion = (descripcion) => {
	$("#descripcion_danio").html(descripcion)
}


const buscarDanio = (id_danio) => {
	console.log(id_danio);

	//abrir modal con form para presupuesto de daño
}






$(document).ready(() => {

	$("#todos-tab").click(() => refrescar_tabla_danios());
	$("#pendientes-tab").click(() => refrescar_tabla_danios_pendientes());


	const danio = {};
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


	const cargar_danio_en_tabla_pendiente = (danio) => {

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

			tabla_pendientes_danios.row
				.add([
					danio.arriendo.patente_vehiculo,
					cliente,
					danio.arriendo.id_arriendo,
					danio.userAt,
					formatearFechaHora(danio.createdAt),
					`<button  value='${danio.descripcion_danioVehiculo}'  	onclick='mostrarDescripcion(this.value)' data-toggle='modal' data-target='#modal_mostrar_descripcion' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>
					 <button  value='${danio.documento_danioVehiculo}'  	onclick='buscarDocumento(this.value,"fotosDañoVehiculo")' class='btn btn-outline-primary'><i class="fas fa-file-alt"></i></button>`,
					`<button  value='${danio.id_arriendo}'  				onclick='buscarDanio(this.value)' data-toggle='modal' data-target='#modal_registrar_cotizacion' class='btn btn-outline-success'><i class="fas fa-upload"></i></button>`
				]).draw(false);

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
			if (danio.presupuestoDanio) {
				comprobante = `<button  value='${danio.presupuestoDanio.comprobante_presupuestoDanio}'  onclick='buscarDocumento(this.value,"facturacion")'  class='btn btn-outline-primary'><i class="fas fa-file-alt"></i></button>`;
			}
			tabla_todos_danios.row
				.add([
					danio.arriendo.patente_vehiculo,
					cliente,
					danio.arriendo.id_arriendo,
					danio.userAt,
					formatearFechaHora(danio.createdAt),
					`<button  value='${danio.descripcion_danioVehiculo}'  onclick='mostrarDescripcion(this.value)' data-toggle='modal' data-target='#modal_mostrar_descripcion' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>
					<button  value='${danio.documento_danioVehiculo}'  onclick='buscarDocumento(this.value,"fotosDañoVehiculo")' class='btn btn-outline-primary'><i class="fas fa-file-alt"></i></button>
						${comprobante}
					`
				])
				.draw(false);
		} catch (error) {
			console.log("error al cargar")
		}
	}



})
