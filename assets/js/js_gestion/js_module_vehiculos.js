$(document).ready(() => {
	const tablaVehiculos = $("#tablaVehiculos").DataTable(lenguaje);

	//cargar sucursales  (ruta,select)
	cargarSelect("cargar_Sucursales", "inputSucursal");
	cargarSelect("cargar_Sucursales", "inputEditarSucursal");
	cargarSelect("cargar_propietarios", "inputPropietario");
	cargarSelect("cargar_propietarios", "inputEditarPropietario");

	//cargar año vehiculo (input)
	cargarOlder("inputedad");
	cargarOlder("inputEditarEdad");

	(cargarVehiculos = () => {
		$("#spinner_tablaVehiculos").show();
		const url = base_url + "cargar_Vehiculos";
		$.getJSON(url, (result) => {
			if (result.success) {
				$("#spinner_tablaVehiculos").hide();
				$.each(result.data, (i, vehiculo) => {
					cargarVehiculoEnTabla(vehiculo);
				});
			} else {
				console.log("ah ocurrido un error al cargar vehiculos");
			}
		});
	})();

	//Registrar Vehiculo
	$("#btn_registrar_vehiculo").click(async () => {
		const patente = $("#inputPatente").val();
		const modelo = $("#inputModelo").val();
		const color = $("#inputColor").val();
		const propietario = $("#inputPropietario").val();
		const compra = $("#inputCompra").val();
		const fechaCompra = $("#inputFechaCompra").val();
		const chasis = $("#inputChasis").val();
		const n_motor = $("#inputNumeroMotor").val();
		const marca = $("#inputMarca").val();

		if (
			n_motor.length != 0 &&
			marca.length != 0 &&
			chasis.length != 0 &&
			patente.length != 0 &&
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
				if (response.data) {
					cargarVehiculoEnTabla(response.data);
					//pregunta si hay imagen para subir
					if ($("#inputFoto").val().length != 0) {
						const file = $("#inputFoto")[0].files[0];
						const size = $("#inputFoto")[0].files[0].size;
						const patente = response.data.patente_vehiculo;
						await guardarImagenVehiculo(patente, file, size);
					}
					Swal.fire("Exito", response.msg, "success");
					$("#form_registrar_vehiculo")[0].reset();
				} else {
					Swal.fire("algo paso", response.msg, "error");
				}
			}
			$("#btn_registrar_vehiculo").attr("disabled", false);
			$("#spinner_btn_registrar").hide();
		}
	});

	$("#btn_editar_vehiculo").click(async () => {
		$("#btn_editar_vehiculo").attr("disabled", true);
		$("#spinner_btn_editarVehiculo").show();

		const form = $("#formEditarVehiculo")[0];
		const data = new FormData(form);
		const response = await ajax_function(data, "editar_vehiculo");
		if (response.success) {
			//pregunta si hay imagen para subir
			if ($("#inputEditarFoto").val().length != 0) {
				const file = $("#inputEditarFoto")[0].files[0];
				const size = $("#inputEditarFoto")[0].files[0].size;
				const patente = response.data.patente_vehiculo;
				await guardarImagenVehiculo(patente, file, size);
			}

			Swal.fire("Exito", response.msg, "success");
			$("#modal_editar").modal("toggle");
			refrescarTabla();
		}
		$("#btn_editar_vehiculo").attr("disabled", false);
		$("#spinner_btn_editarVehiculo").hide();
	});

	//guarda exclusivamente la imagen en el servidor
	const guardarImagenVehiculo = async (patente, file, size) => {
		const data = new FormData();
		data.append("inputPatente", patente);
		data.append("inputFoto", file);

		if (size > 21000000) {
			Swal.fire({
				icon: "error",
				title: "la foto es demaciado grande",
				text: "el maximo permitido son 20mb",
			});
			return;
		}
		await ajax_function(data, "guardar_fotoVehiculo");
	};

	const refrescarTabla = () => {
		//limpia la tabla
		tablaVehiculos.row().clear().draw(false);
		//carga nuevamente
		cargarVehiculos();
	};

	const cargarVehiculoEnTabla = (vehiculo) => {
		tablaVehiculos.row
			.add([
				vehiculo.patente_vehiculo,
				vehiculo.marca_vehiculo + " " + vehiculo.modelo_vehiculo,
				vehiculo.año_vehiculo,
				vehiculo.tipo_vehiculo,
				vehiculo.transmision_vehiculo,
				vehiculo.sucursale ? vehiculo.sucursale.nombre_sucursal : "",
				vehiculo.estado_vehiculo,
				" <button value='" +
					vehiculo.patente_vehiculo +
					"' " +
					" onclick='buscarVehiculo(this.value)'" +
					" data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-info'><i class='far fa-edit'></i></button> ",
			])
			.draw(false);
	};
});
