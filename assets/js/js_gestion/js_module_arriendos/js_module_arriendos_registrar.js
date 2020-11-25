//espiners de los forms cliente , conductor y empresa
$("#spinner_conductor").hide();
$("#spinner_cliente").hide();
$("#spinner_empresa").hide();
$("#spinner_btn_registrar").hide();
$("#spinner_btn_crearContrato").hide();



// Script para cambia el tab cliente de acuerdo al tipo de arriendo
(tipoArriendo = () => {
	const tipo = $("#inputTipo option:selected").val();
	switch (tipo) {
		case "PARTICULAR":
			$("#titulo_cliente").show();
			$("#form_cliente").show();
			$("#titulo_remplazo").hide();
			$("#form_remplazo").hide();
			$("#titulo_empresa").hide();
			$("#form_empresa").hide();
			$("#inputRutEmpresa").val("");
			break;
		case "REMPLAZO":
			$("#titulo_cliente").show();
			$("#form_cliente").show();
			$("#titulo_remplazo").show();
			$("#form_remplazo").show();
			$("#titulo_empresa").hide();
			$("#form_empresa").hide();
			$("#inputRutEmpresa").val("");
			break;
		case "EMPRESA":
			$("#titulo_empresa").show();
			$("#form_empresa").show();
			$("#titulo_remplazo").hide();
			$("#form_remplazo").hide();
			$("#titulo_cliente").hide();
			$("#form_cliente").hide();
			$("#inputRutCliente").val("");
			break;
	}
})();

const calcularDias = () => {
	let fechaEntrega = $("#inputFechaEntrega").val();
	let fechaRecepcion = $("#inputFechaRecepcion").val();

	let fechaini = new Date(fechaEntrega);
	let fechafin = new Date(fechaRecepcion);
	let diasdif = fechafin.getTime() - fechaini.getTime();
	let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
	$("#inputNumeroDias").val(dias);
};













//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	//cargar sucursales  (ruta,select)

	cargarSelect("cargar_Sucursales", "inputCiudadEntrega");

	cargarSelect("cargar_Sucursales", "inputCiudadRecepcion");

	cargarComunas("inputComunaCliente", "inputCiudadCliente");

	cargarComunas("inputComunaEmpresa", "inputCiudadEmpresa");

	//cargar vigencia Empresa (input)
	cargarOlder("inputVigencia");


	//cargar vehiculos en select
	(cargarVehiculos = async () => {
		//select2 de los vehiculos
		$("#select_vehiculos").select2(lenguajeSelect2);

		const data = new FormData();
		data.append("inputSucursal", $("#selectSucursal").val());
		const response = await ajax_function(data, "cargar_VehiculosPorSucursal");
		if (response.success) {
			if (response.data) {
				const select = document.getElementById("select_vehiculos");
				$.each(response.data.regione.vehiculos, (i, o) => {
					const option = document.createElement("option");
					option.innerHTML = `${o.patente_vehiculo} ${o.marca_vehiculo} ${o.modelo_vehiculo} ${o.año_vehiculo}`;
					option.value = o.patente_vehiculo;
					select.appendChild(option);
				});
				$("#select_vehiculos").attr("disabled", false);
			}
		}
	})();


	//cargar accesorios
	(cargarEmpresasRemplazo = async () => {
		const response = await ajax_function(null, "cargar_empresasRemplazo");
		if (response.success) {
			const select = document.getElementById("inputCodigoEmpresaRemplazo");
			$.each(response.data, (i, object) => {
				const option = document.createElement("option");
				option.innerHTML = object["codigo_empresaRemplazo"];
				option.value = object["codigo_empresaRemplazo"];
				select.appendChild(option);
			});
		}
	})();

	$('#select_vehiculos').on('select2:select', async (e) => {
		const patente = e.params.data.id;
		if (patente != "null") {
			const data = new FormData();
			data.append("patente", patente);
			const response = await ajax_function(data, "buscar_vehiculo");
			if (response.success) {
				console.log(response.data);

				var kilometros_mantencion = Number(response.data.Tmantencion_vehiculo);
				var kilometros_actual = Number(response.data.kilometraje_vehiculo);
				var kilometros_falta = Number(0);
				do {
					kilometros_falta = Number(kilometros_mantencion - kilometros_actual);
					if (kilometros_falta < 0) {
						kilometros_mantencion = kilometros_mantencion * 2;
					}
				} while (kilometros_falta < 0);
				$("#inputEntrada").val(kilometros_actual);
				$("#inputMantencion").val(kilometros_falta);
			}
		}
	});



	$("#btn_buscarCliente").click(async () => {
		const data = new FormData();
		let rut_cliente = $("#inputRutCliente").val();

		if ($("#inputNacionalidadCliente").val() == "EXTRANJERO/A") {
			rut_cliente = `@${rut_cliente}`;
		}

		data.append("rut_cliente", rut_cliente);
		if (rut_cliente.length != 0) {
			$("#spinner_cliente").show();
			const response = await ajax_function(data, "buscar_cliente");
			if (response.success) {
				const c = response.data;
				$("#inputNombreCliente").val(c.nombre_cliente);
				$("#inputDireccionCliente").val(c.direccion_cliente);
				$("#inputComunaCliente").val(c.comuna_cliente);
				$("#inputCiudadCliente").val(c.ciudad_cliente);
				$("#inputFechaNacimiento").val(
					c.fechaNacimiento_cliente ?
						c.fechaNacimiento_cliente.substring(0, 10) :
						null
				);
				$("#inputTelefonoCliente").val(c.telefono_cliente);
				$("#inputEstadoCivil").val(c.estadoCivil_cliente);
				$("#inputCorreoCliente").val(c.correo_cliente);
				$("#inputNacionalidadCliente").val(c.nacionalidad_cliente);

			} else {
				$("#inputNombreCliente").val("");
				$("#inputDireccionCliente").val("");
				$("#inputCiudadCliente").val("");
				$("#inputComunaCliente").val("");
				$("#inputTelefonoCliente").val("");
				$("#inputCorreoCliente").val("");
			}
			$("#spinner_cliente").hide();
		}
	});

	$("#btn_buscarEmpresa").click(async () => {
		const data = new FormData();
		const rut_empresa = $("#inputRutEmpresa").val();
		data.append("rut_empresa", rut_empresa);
		if (rut_empresa.length != 0) {
			$("#spinner_empresa").show();
			const response = await ajax_function(data, "buscar_empresa");
			if (response.success) {
				const c = response.data;
				$("#inputNombreEmpresa").val(c.nombre_empresa);
				$("#inputDireccionEmpresa").val(c.direccion_empresa);
				$("#inputComunaEmpresa").val(c.comuna_empresa);
				$("#inputCiudadEmpresa").val(c.ciudad_empresa);
				$("#inputTelefonoEmpresa").val(c.telefono_empresa);
				$("#inputCorreoEmpresa").val(c.correo_empresa);
				$("#inputVigencia").val(c.vigencia_empresa);
				$("#inputRol").val(c.rol_empresa);
			} else {
				$("#inputComunaEmpresa").val("");
				$("#inputNombreEmpresa").val("");
				$("#inputDireccionEmpresa").val("");
				$("#inputCiudadEmpresa").val("");
				$("#inputTelefonoEmpresa").val("");
				$("#inputCorreoEmpresa").val("");
				$("#inputRol").val("");
			}
			$("#spinner_empresa").hide();
		}
	});

	$("#btn_buscarConductor").click(async () => {
		const data = new FormData();
		let rut_conductor = $("#inputRutConductor").val();

		if ($("#inputNacionalidadConductor").val() == "EXTRANJERO/A") {
			rut_conductor = `@${rut_conductor}`;
		}

		data.append("rut_conductor", rut_conductor);
		if (rut_conductor.length != 0) {
			$("#spinner_conductor").show();
			const response = await ajax_function(data, "buscar_conductor");
			if (response.success) {
				const c = response.data;
				$("#inputNombreConductor").val(c.nombre_conductor);
				$("#inputTelefonoConductor").val(c.telefono_conductor);
				$("#inputClaseConductor").val(c.clase_conductor);
				$("#inputNumeroConductor").val(c.numero_conductor);
				$("#inputVCTOConductor").val(
					c.vcto_conductor ? c.vcto_conductor.substring(0, 10) : null
				);
				$("#inputNacionalidadConductor").val(c.nacionalidad_conductor)
				$("#inputMunicipalidadConductor").val(c.municipalidad_conductor);
				$("#inputDireccionConductor").val(c.direccion_conductor);

			} else {
				$("#inputNombreConductor").val("");
				$("#inputTelefonoConductor").val("");
				$("#inputNumeroConductor").val("");
				$("#inputVCTOConductor").val("");
				$("#inputMunicipalidadConductor").val("");
				$("#inputDireccionConductor").val("");
			}
			$("#spinner_conductor").hide();
		}
	});


	$("#btn_crear_arriendo").click(async () => {
		//AQUI SE VALIDAN TODOS LOS CAMPOS


		//datos arriendo
		const select_vehiculos = $("#select_vehiculos").val();
		const inputCiudadEntrega = $("#inputCiudadEntrega").val();
		const inputCiudadRecepcion = $("#inputCiudadRecepcion").val();
		const inputFechaRecepcion = $("#inputFechaRecepcion").val();
		const inputFechaEntrega = $("#inputFechaEntrega").val();
		const inputNumeroDias = $("#inputNumeroDias").val();
		const inputEntrada = $("#inputEntrada").val();
		const inputMantencion = $("#inputMantencion").val();

		//datos particular
		const inputRutCliente = $("#inputRutCliente").val();
		const inputNombreCliente = $("#inputNombreCliente").val();
		const inputTelefonoCliente = $("#inputTelefonoCliente").val();
		const inputCorreoCliente = $("#inputCorreoCliente").val();
		const inputDireccionCliente = $("#inputDireccionCliente").val();
		const inputFechaNacimiento = $("#inputFechaNacimiento").val();

		//datos empresa
		const inputRutEmpresa = $("#inputRutEmpresa").val();
		const inputNombreEmpresa = $("#inputNombreEmpresa").val();
		const inputTelefonoEmpresa = $("#inputTelefonoEmpresa").val();
		const inputCorreoEmpresa = $("#inputCorreoEmpresa").val();
		const inputDireccionEmpresa = $("#inputDireccionEmpresa").val();
		const inputCiudadEmpresa = $("#inputCiudadEmpresa").val();
		const inputRol = $("#inputRol").val();
		const inputVigencia = $("#inputVigencia").val();


		//datos conductor
		const inputRutConductor = $("#inputRutConductor").val();
		const inputNombreConductor = $("#inputNombreConductor").val();
		const inputTelefonoConductor = $("#inputTelefonoConductor").val();
		const inputDireccionConductor = $("#inputDireccionConductor").val();
		const inputVCTOConductor = $("#inputVCTOConductor").val();
		const inputNumeroConductor = $("#inputNumeroConductor").val();
		const inputMunicipalidadConductor = $("#inputMunicipalidadConductor").val();


		const inputTipoArriendo = $("#inputTipo").val();



		//VALIDACION DEL FORMULARIO ARRIENDO
		if (
			inputRutConductor.length != 0 &&
			inputNombreConductor.length != 0 &&
			inputTelefonoConductor.length != 0 &&
			inputDireccionConductor.length != 0 &&
			inputVCTOConductor.length != 0 &&
			inputNumeroConductor.length != 0 &&
			inputMunicipalidadConductor.length != 0 &&
			inputNumeroDias >= 0 &&
			inputCiudadEntrega.length != 0 &&
			inputFechaEntrega.length != 0 &&
			inputCiudadRecepcion.length != 0 &&
			inputFechaRecepcion.length != 0 &&
			inputEntrada.length != 0 &&
			inputMantencion.length != 0
		) {

			if (select_vehiculos == null || select_vehiculos == "null") {
				Swal.fire({
					icon: "warning",
					title: "debe seleccionar un vehiculo!",
				});
				return;
			}

			Swal.fire({
				title: "Estas seguro?",
				text: "estas seguro de registrar este arriendo?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: "Si, seguro",
				cancelButtonText: "No, cancelar!",
				reverseButtons: true,
			}).then(async (result) => {
				if (result.isConfirmed) {

					$("#btn_crear_arriendo").attr("disabled", true);
					$("#spinner_btn_registrar").show();
					//SE VALIDA EL FORMULARIO POR TIPO DE ARRIENDO
					switch (inputTipoArriendo) {
						case "PARTICULAR":
							if (
								inputRutCliente.length != 0 &&
								inputNombreCliente.length != 0 &&
								inputTelefonoCliente.length != 0 &&
								inputCorreoCliente.length != 0 &&
								inputDireccionCliente.length != 0 &&
								inputFechaNacimiento.length != 0
							) {
								let cliente = await guardarDatosCliente();
								if (cliente.success) {
									let conductor = await guardarDatosConductor();
									if (conductor.success) {
										await guardarDatosArriendo(null, conductor.data.rut_conductor, cliente.data.rut_cliente, null);
									}
								}
							} else {
								Swal.fire({
									icon: "warning",
									title: "Faltan datos del cliente en el formulario!",
								});
							}
							break;
						case "REMPLAZO":
							if (
								inputRutCliente.length != 0 &&
								inputNombreCliente.length != 0 &&
								inputTelefonoCliente.length != 0 &&
								inputCorreoCliente.length != 0 &&
								inputDireccionCliente.length != 0 &&
								inputFechaNacimiento.length != 0
							) {
								let cliente = await guardarDatosCliente();
								if (cliente.success) {
									let conductor = await guardarDatosConductor();
									if (conductor.success) {
										let remplazo = await guardarDatosRemplazo(cliente.data.rut_cliente);
										if (remplazo.success) {
											const id_remplazo = remplazo.data.id_remplazo;
											await guardarDatosArriendo(id_remplazo, conductor.data.rut_conductor, cliente.data.rut_cliente, null);
										}
									}
								}
							} else {
								Swal.fire({
									icon: "warning",
									title: "Faltan datos de la empresa o cliente en el formulario!",
								});
							}
							break;
						case "EMPRESA":
							if (
								inputRutEmpresa.length != 0 &&
								inputNombreEmpresa.length != 0 &&
								inputTelefonoEmpresa.length != 0 &&
								inputCorreoEmpresa.length != 0 &&
								inputDireccionEmpresa.length != 0 &&
								inputVigencia.length != 0 &&
								inputCiudadEmpresa.length != 0 &&
								inputRol.length != 0
							) {
								let empresa = await guardarDatosEmpresa();
								if (empresa.success) {
									let conductor = await guardarDatosConductor();
									if (conductor.success) {
										await guardarDatosArriendo(null, conductor.data.rut_conductor, null, empresa.data.rut_empresa);
									}
								}
							} else {
								Swal.fire({
									icon: "warning",
									title: "Faltan datos de la empresa en el formulario!",
								});
							}
							break;
					}


					$("#btn_crear_arriendo").attr("disabled", false);
					$("#spinner_btn_registrar").hide();

				}
			});
		} else {
			Swal.fire({
				icon: "warning",
				title: "Faltan datos en el formulario!",
			});
		}
	});




	const guardarDatosCliente = async () => {
		const data = new FormData();
		data.append("inputRutCliente", $("#inputRutCliente").val());
		data.append("inputNombreCliente", $("#inputNombreCliente").val());
		data.append("inputDireccionCliente", $("#inputDireccionCliente").val());
		data.append("inputCiudadCliente", $("#inputCiudadCliente").val());
		data.append("inputFechaNacimiento", $("#inputFechaNacimiento").val());
		data.append("inputTelefonoCliente", $("#inputTelefonoCliente").val());
		data.append("inputEstadoCivil", $("#inputEstadoCivil").val());
		data.append("inputCorreoCliente", $("#inputCorreoCliente").val());
		data.append("inputNacionalidadCliente", $("#inputNacionalidadCliente").val());
		data.append("inputComunaCliente", $("#inputComunaCliente").val());

		return await ajax_function(data, "registrar_cliente");
	};

	const guardarDatosEmpresa = async () => {
		const data = new FormData();
		data.append("inputRutEmpresa", $("#inputRutEmpresa").val());
		data.append("inputNombreEmpresa", $("#inputNombreEmpresa").val());
		data.append("inputDireccionEmpresa", $("#inputDireccionEmpresa").val());
		data.append("inputCiudadEmpresa", $("#inputCiudadEmpresa").val());
		data.append("inputTelefonoEmpresa", $("#inputTelefonoEmpresa").val());
		data.append("inputCorreoEmpresa", $("#inputCorreoEmpresa").val());
		data.append("inputVigencia", $("#inputVigencia").val());
		data.append("inputRol", $("#inputRol").val());
		data.append("inputComunaEmpresa", $("#inputComunaEmpresa").val());

		return await ajax_function(data, "registrar_empresa");
	};
	const guardarDatosConductor = async () => {
		const data = new FormData();
		data.append("inputRutConductor", $("#inputRutConductor").val());
		data.append("inputNombreConductor", $("#inputNombreConductor").val());
		data.append("inputTelefonoConductor", $("#inputTelefonoConductor").val());
		data.append("inputClaseConductor", $("#inputClaseConductor").val());
		data.append("inputNumeroConductor", $("#inputNumeroConductor").val());
		data.append("inputVCTOConductor", $("#inputVCTOConductor").val());
		data.append("inputMunicipalidadConductor", $("#inputMunicipalidadConductor").val());
		data.append("inputDireccionConductor", $("#inputDireccionConductor").val());
		data.append("inputNacionalidadConductor", $("#inputNacionalidadConductor").val());

		return await ajax_function(data, "registrar_conductor");
	};

	const guardarDatosRemplazo = async (rut_cliente) => {
		const data = new FormData();
		data.append("inputCodigoEmpresaRemplazo", $("#inputCodigoEmpresaRemplazo").val());
		data.append("inputRutCliente", rut_cliente);
		return await ajax_function(data, "registrar_remplazo");
	};

	const guardarDatosArriendo = async (id_remplazo, rut_conductor, rut_cliente, rut_empresa) => {


		const c1 = document.getElementById("inputCiudadEntrega");
		const c2 = document.getElementById("inputCiudadRecepcion");


		const data = new FormData();
		data.append("inputTipo", $("#inputTipo").val());
		data.append("inputCiudadEntrega", c1.options[c1.selectedIndex].innerText);
		data.append("inputFechaEntrega", $("#inputFechaEntrega").val());
		data.append("inputCiudadRecepcion", c2.options[c2.selectedIndex].innerText);
		data.append("inputFechaRecepcion", $("#inputFechaRecepcion").val());
		data.append("inputNumeroDias", $("#inputNumeroDias").val());
		data.append("inputEntrada", $("#inputEntrada").val());
		data.append("select_vehiculos", $("#select_vehiculos").val());
		data.append("inputIdRemplazo", id_remplazo);
		data.append("inputRutCliente", rut_cliente);
		data.append("inputRutEmpresa", rut_empresa);
		data.append("inputRutConductor", rut_conductor);

		const response = await ajax_function(data, "registrar_arriendo");

		if (response.success) {
			await guardarDatosContacto(response.data.id_arriendo);
			await cambiarEstadoVehiculo(response.data.patente_vehiculo);
			Swal.fire("Arriendo Registrado", response.msg, "success");
			limpiarCampos();
		}
	};


	const guardarDatosContacto = async (idArriendo) => {
		const data = new FormData();
		data.append("inputIdArriendo", idArriendo);
		data.append("inputNombreContacto", $("#inputNombreContacto").val());
		data.append("inputDomicilioContacto", $("#inputDomicilioContacto").val());
		data.append("inputNumeroCasaContacto", $("#inputNumeroCasaContacto").val());
		data.append("inputCiudadContacto", $("#inputCiudadContacto").val());
		data.append("inputTelefonoContacto", $("#inputTelefonoContacto").val());
		await ajax_function(data, "registrar_contacto");
	}

	const cambiarEstadoVehiculo = async (patente) => {
		const data = new FormData();
		data.append("inputPatenteVehiculo", patente);
		data.append("inputEstado", "RESERVADO");
		data.append("kilometros_mantencion", $("#inputMantencion").val());
		data.append("kilometraje_vehiculo", $("#inputEntrada").val());
		await ajax_function(data, "cambiarEstado_vehiculo");
	};

	const limpiarCampos = () => {
		$("#btn_crear_arriendo").attr("disabled", false);
		$("#spinner_btn_registrar").hide();
		$("#form_registrar_arriendo")[0].reset();
		$("#card-tarjeta").hide();
		$("#card-cheque").hide();

		$("#select_vehiculos").empty();
		cargarVehiculos();
	};
});
