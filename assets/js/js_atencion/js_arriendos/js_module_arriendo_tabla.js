
let config = lenguaje;
config.paging = false;
const tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(config);

$("#nav-arriendos-tab").click(() => refrescarTabla());

const buscarArriendo = async (id_arriendo, option) => {
	limpiarCampos();
	const data = new FormData();
	data.append("id_arriendo", id_arriendo);
	const response = await ajax_function(data, "buscar_arriendo");
	if (response.success) {
		const arriendo = response.data;
		switch (option) {
			case 1:
				mostrarArriendoModalVer(arriendo);
				break;
			case 2:
				mostrarArriendoModalPago(arriendo);
				break;
			case 3:
				mostrarContratoModalContrato(arriendo);
				break;
		}
	}
};

const limpiarCampos = () => {
	limpiarCamposModalver();
	limpiarCamposModalPago();
	limpiarCamposModalFirma();
};


const cambiarEstadoArriendo = async (estadoArriendo, idArriendo) => {
	const data = new FormData();
	data.append("id_arriendo", idArriendo);
	switch (estadoArriendo) {
		case "PENDIENTE":
			data.append("estado", "CONFIRMADO");
			break;
		case "EXTENDIDO":
			data.append("estado", "E-CONFIRMADO");
			break;
		case "CONFIRMADO":
			data.append("estado", "FIRMADO");
			break;
		case "E-CONFIRMADO":
			data.append("estado", "ACTIVO");
			break;
		case "ANULADO":
			data.append("estado", "ANULADO");
			break;
		case "FINALIZADO":
			data.append("estado", "FINALIZADO");
			break;
	}
	await ajax_function(data, "cambiarEstado_arriendo");
};




const cargarArriendos = async () => {
	$("#spinner_tablaTotalArriendos").show();
	const response = await ajax_function(null, "cargar_arriendos_Unico");
	if (response.success) {
		tablaTotalArriendos.row().clear().draw(false);
		$.each(response.data, (i, arriendo) => {
			cargarArriendoEnTabla(arriendo);
		});
	}
	$("#spinner_tablaTotalArriendos").hide();
};

const refrescarTabla = () => {
	//limpia la tabla
	tablaTotalArriendos.row().clear().draw(false);
	//carga nuevamente
	cargarArriendos();
};

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
		let color = "";
		switch (arriendo.estado_arriendo) {
			case "CON DAÑO":
				color = "btn-danger"
				break;
			case "FINALIZADO":
				color = "btn-success"
				break;
			case "RECEPCIONADO":
				color = "btn-warning"
				break;
			default:
				break;
		}

		if (arriendo.estado_arriendo == "ANULADO") {
			return;
		}



		let tipo = '';
		if (arriendo.tipo_arriendo === "REEMPLAZO") {
			tipo = arriendo.tipo_arriendo + ` (${arriendo.remplazo.codigo_empresaRemplazo})`;
		} else {
			tipo = arriendo.tipo_arriendo;
		}


		tablaTotalArriendos.row
			.add([
				arriendo.id_arriendo,
				formatearFechaHora(arriendo.createdAt),
				cliente,
				arriendo.patente_vehiculo,
				tipo,
				`<span class="${color}"> ${arriendo.estado_arriendo} </span>`,
				arriendo.sucursale.nombre_sucursal
				, `<button id='a${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}'  onclick='buscarArriendo(this.value,1)' 
                        data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn-outline-primary'><i class="fas fa-upload"></i></button>
                        <button id='b${arriendo.id_arriendo}' value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,2)' 
                            data-toggle='modal' data-target='#modal_pago_arriendo' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
                            <button id='c${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,3)' 
                                data-toggle='modal' data-target='#modal_firmar_contrato' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>  
                                `,
			])
			.draw(true);
		if (arriendo.requisito || arriendo.estado_arriendo == "ANULADO") {
			$(`#a${arriendo.id_arriendo}`).removeClass("btn-outline-primary");
			$(`#a${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
		}
		if (arriendo.estado_arriendo != "EXTENDIDO" && arriendo.estado_arriendo != "PENDIENTE" || arriendo.estado_arriendo == "ANULADO") {
			$(`#b${arriendo.id_arriendo}`).attr("disabled", true);
			$(`#b${arriendo.id_arriendo}`).removeClass("btn-outline-success");
			$(`#b${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
		}
		if (arriendo.estado_arriendo != "CONFIRMADO" && arriendo.estado_arriendo != "E-CONFIRMADO" || arriendo.estado_arriendo == "ANULADO") {
			$(`#c${arriendo.id_arriendo}`).attr("disabled", true);
			$(`#c${arriendo.id_arriendo}`).removeClass("btn-outline-info");
			$(`#c${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
		}
	} catch (error) {
		console.log("error al cargar este arriendo: " + error);
	}
};

