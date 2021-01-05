$("#m_vehiculo").addClass("active");
$("#l_vehiculo").addClass("card");

//sniper de btn registrar
$("#spinner_btn_registrar").hide();

const buscarVehiculo = async (patente) => {
	limpiarCampos();
	const data = new FormData();
	data.append("patente", patente);
	const response = await ajax_function(data, "buscar_vehiculo");
	if (response.success) {
		const vehiculo = response.data;

		//se pregunta si tiene imagen el vehiculo
		if (vehiculo.foto_vehiculo) {
			document.getElementById("imagen").src = await buscarFotoVehiculo(vehiculo.foto_vehiculo, "fotoVehiculo");
		} else {
			document.getElementById("imagen").src = base_route + "assets/images/imageDefault.png";
		}


		$("#inputEditarPatente").val(vehiculo.patente_vehiculo);
		$("#exampleModalLongTitle").text(
			"Editar Vehiculo " + vehiculo.patente_vehiculo
		);
		$("#inputEditarEstado").val(vehiculo.estado_vehiculo);
		$("#inputEditarMarca").val(vehiculo.marca_vehiculo);
		$("#inputEditarModelo").val(vehiculo.modelo_vehiculo);
		$("#inputEditarEdad").val(vehiculo.año_vehiculo);
		$("#inputEditarTipo").val(vehiculo.tipo_vehiculo);
		$("#inputEditarNumeroGps").val(vehiculo.numero_gps_vehiculo);
		$("#inputEditarNumeroTab").val(vehiculo.numero_tab_vehiculo);
		$("#inputEditarTransmision").val(vehiculo.transmision_vehiculo);
		$("#inputEditarChasis").val(vehiculo.chasis_vehiculo);
		$("#inputEditarColor").val(vehiculo.color_vehiculo);
		$("#inputEditarNumeroMotor").val(vehiculo.numeroMotor_vehiculo);
		$("#inputEditarkilomentrosMantencion").val(vehiculo.Tmantencion_vehiculo);
		$("#inputEditarRegion").val(vehiculo.id_region);
		$("#inputEditarCompra").val(vehiculo.compra_vehiculo);
		$("#inputEditarPropietario").val(vehiculo.rut_propietario);
		$("#inputEditarFechaCompra").val(
			moment(vehiculo.fechaCompra_vehiculo ? vehiculo.fechaCompra_vehiculo : null).format('YYYY/MM/DD'));

		$("#inputCreateAt").val(formatearFechaHora(vehiculo.createdAt));
		$("#modal_vehiculo").show();
	}
	$("#spinner_vehiculo").hide();
};




const buscarFotoVehiculo = async (documento, tipo) => {
	const data = new FormData();
	data.append("nombreDocumento", documento);
	data.append("tipo", tipo);
	const response = await ajax_function(data, "buscar_documento");
	if (response.success) {
		let byteCharacters = atob(response.data.base64);
		let byteNumbers = new Array(byteCharacters.length);
		for (let i = 0; i < byteCharacters.length; i++) {
			byteNumbers[i] = byteCharacters.charCodeAt(i);
		}
		let byteArray = new Uint8Array(byteNumbers);
		let file = new Blob([byteArray], { type: `image/png;base64` });
		return URL.createObjectURL(file);
	}
	return base_route + "assets/images/imageDefault.png";
}

const limpiarCampos = () => {
	$("#spinner_vehiculo").show();
	$("#spinner_btn_editarVehiculo").hide();
	$("#modal_vehiculo").hide();
	$("#spinner_vehiculo").show();
	$("#formEditarVehiculo")[0].reset();
	document.getElementById("imagen").src = "";
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	const tablaVehiculos = $("#tablaVehiculos").DataTable(lenguaje);

	$("#nav-vehiculos-tab").click(() => refrescarTabla());

	//cargar sucursales  (ruta,select)
	cargarSelect("cargar_regiones", "inputRegion");
	cargarSelect("cargar_regiones", "inputEditarRegion");
	cargarSelect("cargar_propietarios", "inputPropietario");
	cargarSelect("cargar_propietarios", "inputEditarPropietario");

	//cargar año vehiculo (input)
	cargarOlder("inputedad");
	cargarOlder("inputEditarEdad");




	const cargarVehiculos = async () => {
		$("#spinner_tablaVehiculos").show();
		const response = await ajax_function(null, "cargar_Vehiculos");
		if (response.success) {
			$.each(response.data, (i, vehiculo) => {
				cargarVehiculoEnTabla(vehiculo);
			});
		}
		$("#spinner_tablaVehiculos").hide();
	};

	const refrescarTabla = () => {
		//limpia la tabla
		tablaVehiculos.row().clear().draw(false);
		//carga nuevamente
		cargarVehiculos();
	};

	//Registrar Vehiculo
	$("#btn_registrar_vehiculo").click(async () => {
		const patente = $("#inputPatente").val();
		const modelo = $("#inputModelo").val();
		const color = $("#inputColor").val();
		const propietario = $("#inputPropietario").val();
		const compra = $("#inputCompra").val();
		const fechaCompra = $("#inputFechaCompra").val();
		const marca = $("#inputMarca").val();
		if (
			patente.length != 0 &&
			marca.length != 0 &&
			modelo.length != 0 &&
			color.length != 0 &&
			propietario.length != 0 &&
			compra.length != 0 &&
			fechaCompra.length != 0
		) {
			$("#btn_registrar_vehiculo").attr("disabled", true);
			$("#spinner_btn_registrar").show();

			const form = $("#form_registrar_vehiculo")[0];
			const data = new FormData(form);
			const response = await ajax_function(data, "registrar_vehiculo");
			if (response.success) {
				//pregunta si hay imagen para subir
				if ($("#inputFoto").val().length != 0) {
					const file = $("#inputFoto")[0].files[0];
					const size = $("#inputFoto")[0].files[0].size;
					const patente = $("#inputPatente").val();
					const responseFoto = await guardarImagenVehiculo(
						patente,
						file,
						size
					);
					if (responseFoto.success) {
						Swal.fire("Exito", responseFoto.msg, "success");
						$("#form_registrar_vehiculo")[0].reset();
					}
				} else {
					Swal.fire("Exito", response.msg, "success");
					$("#form_registrar_vehiculo")[0].reset();
				}
			}
			$("#btn_registrar_vehiculo").attr("disabled", false);
			$("#spinner_btn_registrar").hide();
		}
	});

	$("#btn_editar_vehiculo").click(async () => {
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
				$("#btn_editar_vehiculo").attr("disabled", true);
				$("#spinner_btn_editarVehiculo").show();
				const form = $("#formEditarVehiculo")[0];
				const data = new FormData(form);
				const response = await ajax_function(data, "editar_vehiculo");
				if (response.success) {
					//pregunta si hay imagen para subir
					if ($("#inputEditarFoto").val().length != 0) {
						const file = $("#inputEditarFoto")[0].files[0];
						const patente = $("#inputEditarPatente").val();
						const responseFoto = await guardarImagenVehiculo(patente, file);
						if (responseFoto.success) {
							Swal.fire("Exito", responseFoto.msg, "success");
							$("#modal_editar").modal("toggle");
						}
					} else {
						Swal.fire("Exito", response.msg, "success");
						$("#modal_editar").modal("toggle");
					}
					refrescarTabla();
				}
				$("#btn_editar_vehiculo").attr("disabled", false);
				$("#spinner_btn_editarVehiculo").hide();
			}
		});
	});

	//guarda exclusivamente la imagen en el servidor
	const guardarImagenVehiculo = async (patente, file) => {
		const data = new FormData();
		data.append("inputPatente", patente);
		data.append("inputFoto", file);
		return await ajax_function(data, "guardar_fotoVehiculo");
	};

	const cargarVehiculoEnTabla = (vehiculo) => {
		try {
			tablaVehiculos.row
				.add([
					vehiculo.patente_vehiculo,
					vehiculo.marca_vehiculo + " " + vehiculo.modelo_vehiculo,
					vehiculo.año_vehiculo,
					vehiculo.tipo_vehiculo,
					vehiculo.transmision_vehiculo,
					vehiculo.regione ? vehiculo.regione.nombre_region : "",
					vehiculo.estado_vehiculo,
					` <button value='${vehiculo.patente_vehiculo}' onclick='buscarVehiculo(this.value)'
                       data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-info'><i class='far fa-edit'></i></button> `,
				])
				.draw(false);
		} catch (error) { }
	};
});
