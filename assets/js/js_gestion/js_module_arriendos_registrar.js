//espiners de los forms cliente , conductor y empresa
$("#spinner_conductor").hide();
$("#spinner_conductor2").hide();
$("#spinner_conductor3").hide();
$("#spinner_cliente").hide();
$("#spinner_empresa").hide();
$("#spinner_btn_registrar").hide();
$("#spinner_btn_crearContrato").hide();
$("#card_conductor_2").hide();
$("#card_conductor_3").hide();



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
		case "REEMPLAZO":
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
	let fechaini = new Date(moment(fechaEntrega));
	let fechafin = new Date(moment(fechaRecepcion));
	let diasdif = fechafin.getTime() - fechaini.getTime();
	let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
	$("#inputNumeroDias").val(dias);
};


const cantidadConductores = (opcion) => {
	switch (opcion) {
		case "1":
			$("#card_conductor_2").hide();
			$("#card_conductor_3").hide();
			break;
		case "2":
			$("#card_conductor_2").show();
			$("#card_conductor_3").hide();
			break;
		case "3":
			$("#card_conductor_2").show();
			$("#card_conductor_3").show();
			break;
	}
}


const calcularMantencionVehiculo = (k,) => {
	var kilometros_mantencion = Number(10000);
	var kilometros_actual = Number(k);
	var kilometros_falta = Number(0);
	do {
		kilometros_falta = Number(kilometros_mantencion - kilometros_actual);
		if (kilometros_falta < 0) {
			kilometros_mantencion = kilometros_mantencion + 10000;
		}
	} while (kilometros_falta < 0);
	$("#inputEntrada").val(kilometros_actual);
	$("#inputMantencion").val(kilometros_falta);
}







//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	//cargar sucursales  (ruta,select)

	cargarSelectSucursal("cargar_Sucursales", "inputCiudadEntrega");

	cargarSelectSucursal("cargar_Sucursales", "inputCiudadRecepcion");

	cargarComunas("inputComunaCliente", "inputCiudadCliente");

	cargarComunas("inputComunaEmpresa", "inputCiudadEmpresa");

	//cargar vigencia Empresa (input)
	cargarOlder("inputVigencia");


	$('#inputFechaEntrega').datetimepicker({
		onChangeDateTime: function () {
			calcularDias()
		},
	});
	$('#inputFechaRecepcion').datetimepicker({
		onChangeDateTime: function () {
			calcularDias()
		},
	});




	//cargar vehiculos en select

	const cargarVehiculos = async () => {
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
	}
	cargarVehiculos();


	const cargarEmpresasRemplazo = async () => {
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
	}
	cargarEmpresasRemplazo();


	$('#select_vehiculos').on('select2:select', async (e) => {
		const patente = e.params.data.id;
		if (patente != "null") {
			const data = new FormData();
			data.append("patente", patente);
			const response = await ajax_function(data, "buscar_vehiculo");
			if (response.success) {
				var kilometros_mantencion = Number(response.data.Tmantencion_vehiculo);
				var kilometros_actual = Number(response.data.kilometraje_vehiculo);
				var kilometros_falta = Number(0);
				do {
					kilometros_falta = Number(kilometros_mantencion - kilometros_actual);
					if (kilometros_falta < 0) {
						kilometros_mantencion = kilometros_mantencion + response.data.Tmantencion_vehiculo;
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
				//se agrega un option para el select ciudad
				const option = document.createElement('option');
				option.value = c.ciudad_cliente;
				option.text = c.ciudad_cliente;
				document.getElementById("inputCiudadCliente").appendChild(option);
				$("#inputComunaCliente").val(c.comuna_cliente);
				$("#inputCiudadCliente").val(c.ciudad_cliente);
				$("#inputNombreCliente").val(c.nombre_cliente);
				$("#inputDireccionCliente").val(c.direccion_cliente);
				$("#inputFechaNacimiento").val(moment(c.fechaNacimiento_cliente ? c.fechaNacimiento_cliente : null).format("YYYY/MM/DD"));
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
				//se agrega un option para el select ciudad
				const option = document.createElement('option');
				option.value = c.ciudad_empresa;
				option.text = c.ciudad_empresa;
				document.getElementById("inputCiudadEmpresa").appendChild(option);
				$("#inputComunaEmpresa").val(c.comuna_empresa);
				$("#inputCiudadEmpresa").val(c.ciudad_empresa);
				$("#inputNombreEmpresa").val(c.nombre_empresa);
				$("#inputDireccionEmpresa").val(c.direccion_empresa);
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
		let rut_conductor = $("#inputRutConductor").val();
		if (rut_conductor.length != 0) {
			if ($("#inputNacionalidadConductor").val() == "EXTRANJERO/A") {
				rut_conductor = `@${rut_conductor}`;
			}
			$("#spinner_conductor").show();
			const response = await buscarConductor(rut_conductor);
			if (response.success) {
				const c = response.data;
				$("#inputNombreConductor").val(c.nombre_conductor);
				$("#inputTelefonoConductor").val(c.telefono_conductor);
				$("#inputClaseConductor").val(c.clase_conductor);
				$("#inputNumeroConductor").val(c.numero_conductor);
				$("#inputVCTOConductor").val(moment(c.vcto_conductor ? c.vcto_conductor : null).format("YYYY/MM/DD"));
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


	$("#btn_buscarConductor2").click(async () => {
		let rut_conductor = $("#inputRutConductor2").val();

		if (rut_conductor.length != 0) {

			if ($("#inputNacionalidadConductor2").val() == "EXTRANJERO/A") {
				rut_conductor = `@${rut_conductor}`;
			}
			$("#spinner_conductor2").show();
			const response = await buscarConductor(rut_conductor);
			if (response.success) {
				const c = response.data;
				$("#inputNombreConductor2").val(c.nombre_conductor);
				$("#inputTelefonoConductor2").val(c.telefono_conductor);
				$("#inputClaseConductor2").val(c.clase_conductor);
				$("#inputNumeroConductor2").val(c.numero_conductor);
				$("#inputVCTOConductor2").val(moment(c.vcto_conductor ? c.vcto_conductor : null).format("YYYY/MM/DD"));
				$("#inputNacionalidadConductor2").val(c.nacionalidad_conductor)
				$("#inputMunicipalidadConductor2").val(c.municipalidad_conductor);
				$("#inputDireccionConductor2").val(c.direccion_conductor);
			} else {
				$("#inputNombreConductor2").val("");
				$("#inputTelefonoConductor2").val("");
				$("#inputNumeroConductor2").val("");
				$("#inputVCTOConductor2").val("");
				$("#inputMunicipalidadConductor2").val("");
				$("#inputDireccionConductor2").val("");
			}
			$("#spinner_conductor2").hide();
		}
	});

	$("#btn_buscarConductor3").click(async () => {
		let rut_conductor = $("#inputRutConductor3").val();

		if (rut_conductor.length != 0) {

			if ($("#inputNacionalidadConductor3").val() == "EXTRANJERO/A") {
				rut_conductor = `@${rut_conductor}`;
			}
			$("#spinner_conductor3").show();
			const response = await buscarConductor(rut_conductor);
			if (response.success) {
				const c = response.data;
				$("#inputNombreConductor3").val(c.nombre_conductor);
				$("#inputTelefonoConductor3").val(c.telefono_conductor);
				$("#inputClaseConductor3").val(c.clase_conductor);
				$("#inputNumeroConductor3").val(c.numero_conductor);
				$("#inputVCTOConductor3").val(moment(c.vcto_conductor ? c.vcto_conductor : null).format("YYYY/MM/DD"));
				$("#inputNacionalidadConductor3").val(c.nacionalidad_conductor)
				$("#inputMunicipalidadConductor3").val(c.municipalidad_conductor);
				$("#inputDireccionConductor3").val(c.direccion_conductor);
			} else {
				$("#inputNombreConductor3").val("");
				$("#inputTelefonoConductor3").val("");
				$("#inputNumeroConductor3").val("");
				$("#inputVCTOConductor3").val("");
				$("#inputMunicipalidadConductor3").val("");
				$("#inputDireccionConductor3").val("");
			}
			$("#spinner_conductor3").hide();
		}
	});



	const buscarConductor = async (rut_conductor) => {
		const data = new FormData();
		data.append("rut_conductor", rut_conductor);
		return await ajax_function(data, "buscar_conductor");
	}






	$("#btn_crear_arriendo").click(async () => {
		//AQUI SE VALIDAN TODOS LOS CAMPOS


		//datos arriendo
		const select_vehiculos = $("#select_vehiculos").val();
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

		//datos contacto
		const inputNombreContacto = $("#inputNombreContacto").val();
		const inputDomicilioContacto = $("#inputDomicilioContacto").val();
		const inputNumeroCasaContacto = $("#inputNumeroCasaContacto").val();
		const inputCiudadContacto = $("#inputCiudadContacto").val();
		const inputTelefonoContacto = $("#inputTelefonoContacto").val();

		//datos conductor
		const inputRutConductor = $("#inputRutConductor").val();
		const inputNombreConductor = $("#inputNombreConductor").val();
		const inputTelefonoConductor = $("#inputTelefonoConductor").val();
		const inputDireccionConductor = $("#inputDireccionConductor").val();
		const inputVCTOConductor = $("#inputVCTOConductor").val();
		const inputNumeroConductor = $("#inputNumeroConductor").val();
		const inputMunicipalidadConductor = $("#inputMunicipalidadConductor").val();

		//datos conductor 2
		const inputRutConductor2 = $("#inputRutConductor2").val();
		const inputNombreConductor2 = $("#inputNombreConductor2").val();
		const inputTelefonoConductor2 = $("#inputTelefonoConductor2").val();
		const inputDireccionConductor2 = $("#inputDireccionConductor2").val();
		const inputVCTOConductor2 = $("#inputVCTOConductor2").val();
		const inputNumeroConductor2 = $("#inputNumeroConductor2").val();
		const inputMunicipalidadConductor2 = $("#inputMunicipalidadConductor2").val();

		//datos conductor 3
		const inputRutConductor3 = $("#inputRutConductor3").val();
		const inputNombreConductor3 = $("#inputNombreConductor3").val();
		const inputTelefonoConductor3 = $("#inputTelefonoConductor3").val();
		const inputDireccionConductor3 = $("#inputDireccionConductor3").val();
		const inputVCTOConductor3 = $("#inputVCTOConductor3").val();
		const inputNumeroConductor3 = $("#inputNumeroConductor3").val();
		const inputMunicipalidadConductor3 = $("#inputMunicipalidadConductor3").val();

		//opciones
		const inputTipoArriendo = $("#inputTipo").val();
		const cantidadConductor = $('[name="customRadio5"]:checked').val();

		//validando los datos del arriendo
		if (
			inputNumeroDias <= 0 ||
			inputNumeroDias.length == 0 ||
			inputFechaEntrega.length == 0 ||
			inputFechaRecepcion.length == 0) {
			Swal.fire({
				icon: "warning",
				title: "Faltan datos del arriendo!",
			});
			return;
		}
		//validar datos cliente
		switch (inputTipoArriendo) {
			case "PARTICULAR":
				if (
					inputRutCliente.length == 0 ||
					inputNombreCliente.length == 0 ||
					inputTelefonoCliente.length == 0 ||
					inputCorreoCliente.length == 0 ||
					inputDireccionCliente.length == 0 ||
					inputFechaNacimiento.length == 0
				) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos del cliente!",
					});
					return;
				}
				break;
			case "REEMPLAZO":
				if (
					inputRutCliente.length == 0 ||
					inputNombreCliente.length == 0 ||
					inputTelefonoCliente.length == 0 ||
					inputCorreoCliente.length == 0 ||
					inputDireccionCliente.length == 0 ||
					inputFechaNacimiento.length == 0
				) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos del cliente!",
					});
					return;
				}
				break;
			case "EMPRESA":
				if (
					inputRutEmpresa.length == 0 ||
					inputNombreEmpresa.length == 0 ||
					inputTelefonoEmpresa.length == 0 ||
					inputCorreoEmpresa.length == 0 ||
					inputDireccionEmpresa.length == 0 ||
					inputVigencia.length == 0 ||
					inputCiudadEmpresa.length == 0 ||
					inputRol.length == 0
				) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de la empresa!",
					});
					return;
				}
				break;
		}
		//validando los datos del contacto
		if (
			inputNombreContacto.length == 0 ||
			inputDomicilioContacto.length == 0 ||
			inputNumeroCasaContacto.length == 0 ||
			inputCiudadContacto.length == 0 ||
			inputTelefonoContacto.length == 0) {
			Swal.fire({
				icon: "warning",
				title: "Faltan datos del contacto de emergencia!",
			});
			return;
		}
		//validando el o los conductores
		function validarConductor1() {
			if (inputRutConductor.length == 0 ||
				inputNombreConductor.length == 0 ||
				inputTelefonoConductor.length == 0 ||
				inputDireccionConductor.length == 0 ||
				inputVCTOConductor.length == 0 ||
				inputNumeroConductor.length == 0 ||
				inputMunicipalidadConductor.length == 0) {
				return false;
			}
			return true;
		}

		function validarConductor2() {
			if (inputRutConductor2.length == 0 ||
				inputNombreConductor2.length == 0 ||
				inputTelefonoConductor2.length == 0 ||
				inputDireccionConductor2.length == 0 ||
				inputVCTOConductor2.length == 0 ||
				inputNumeroConductor2.length == 0 ||
				inputMunicipalidadConductor2.length == 0) {
				return false;
			}
			return true;
		}

		function validarConductor3() {
			if (inputRutConductor3.length == 0 ||
				inputNombreConductor3.length == 0 ||
				inputTelefonoConductor3.length == 0 ||
				inputDireccionConductor3.length == 0 ||
				inputVCTOConductor3.length == 0 ||
				inputNumeroConductor3.length == 0 ||
				inputMunicipalidadConductor3.length == 0) {

				return false;
			}
			return true;
		}

		switch (cantidadConductor) {
			case "1":
				if (!validarConductor1()) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos del conductor ",
					});
					return;
				}
				break;
			case "2":
				if (!validarConductor1() || !validarConductor2()) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de los conductores ",
					});
					return;
				}
				break;
			case "3":
				if (!validarConductor1() || !validarConductor2() || !validarConductor3()) {
					Swal.fire({
						icon: "warning",
						title: "Faltan datos de los conductores",
					});
					return;
				}
				break;
		}
		//validando los datos del vehiculo
		if (select_vehiculos == null ||
			select_vehiculos == "null" ||
			inputEntrada.length == 0 ||
			inputMantencion.length == 0) {
			Swal.fire({
				icon: "warning",
				title: "debes colocar los datos del vehiculo!",
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

				await registrarTodoElArriendo(inputTipoArriendo, cantidadConductor);


				$("#btn_crear_arriendo").attr("disabled", false);
				$("#spinner_btn_registrar").hide();
			}
		});
	});






	const registrarTodoElArriendo = async (inputTipoArriendo, cantidadConductor) => {

		const conductores = {};
		const conductor = await guardarDatosConductor();
		conductores.rut_conductor = conductor.data.rut_conductor;

		if (cantidadConductor == "2") {
			const conductor2 = await guardarDatosConductor2();
			conductores.rut_conductor2 = conductor2.data.rut_conductor;
		}

		if (cantidadConductor == "3") {
			const conductor2 = await guardarDatosConductor2();
			conductores.rut_conductor2 = conductor2.data.rut_conductor;

			const conductor3 = await guardarDatosConductor3();
			conductores.rut_conductor3 = conductor3.data.rut_conductor;

		}

		switch (inputTipoArriendo) {
			case "PARTICULAR":
				const cliente = await guardarDatosCliente();
				if (conductor.success && cliente.success) {
					await guardarDatosArriendo(null, conductores, cliente.data.rut_cliente, null);
				}
				break;
			case "REEMPLAZO":
				const cliente2 = await guardarDatosCliente();
				if (cliente2.success && conductor.success) {
					const remplazo = await guardarDatosRemplazo(cliente2.data.rut_cliente);
					if (remplazo.success) {
						const id_remplazo = remplazo.data.id_remplazo;
						await guardarDatosArriendo(id_remplazo, conductores, cliente2.data.rut_cliente, null);
					}
				}
				break;
			case "EMPRESA":
				const empresa = await guardarDatosEmpresa();
				if (empresa.success && conductor.success) {
					await guardarDatosArriendo(null, conductores, null, empresa.data.rut_empresa);
				}
				break;
		}
	}


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

	const guardarDatosConductor2 = async () => {
		const data = new FormData();
		data.append("inputRutConductor", $("#inputRutConductor2").val());
		data.append("inputNombreConductor", $("#inputNombreConductor2").val());
		data.append("inputTelefonoConductor", $("#inputTelefonoConductor2").val());
		data.append("inputClaseConductor", $("#inputClaseConductor2").val());
		data.append("inputNumeroConductor", $("#inputNumeroConductor2").val());
		data.append("inputVCTOConductor", $("#inputVCTOConductor2").val());
		data.append("inputMunicipalidadConductor", $("#inputMunicipalidadConductor2").val());
		data.append("inputDireccionConductor", $("#inputDireccionConductor2").val());
		data.append("inputNacionalidadConductor", $("#inputNacionalidadConductor2").val());

		return await ajax_function(data, "registrar_conductor");
	};


	const guardarDatosConductor3 = async () => {
		const data = new FormData();
		data.append("inputRutConductor", $("#inputRutConductor3").val());
		data.append("inputNombreConductor", $("#inputNombreConductor3").val());
		data.append("inputTelefonoConductor", $("#inputTelefonoConductor3").val());
		data.append("inputClaseConductor", $("#inputClaseConductor3").val());
		data.append("inputNumeroConductor", $("#inputNumeroConductor3").val());
		data.append("inputVCTOConductor", $("#inputVCTOConductor3").val());
		data.append("inputMunicipalidadConductor", $("#inputMunicipalidadConductor3").val());
		data.append("inputDireccionConductor", $("#inputDireccionConductor3").val());
		data.append("inputNacionalidadConductor", $("#inputNacionalidadConductor3").val());

		return await ajax_function(data, "registrar_conductor");
	};


	const guardarDatosRemplazo = async (rut_cliente) => {
		const data = new FormData();
		data.append("inputCodigoEmpresaRemplazo", $("#inputCodigoEmpresaRemplazo").val());
		data.append("inputRutCliente", rut_cliente);
		return await ajax_function(data, "registrar_remplazo");
	};

	const guardarDatosArriendo = async (id_remplazo, conductores, rut_cliente, rut_empresa) => {


		const c1 = document.getElementById("inputCiudadEntrega");
		const c2 = document.getElementById("inputCiudadRecepcion");

		const { rut_conductor, rut_conductor2, rut_conductor3 } = conductores;

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
		data.append("inputRutConductor2", rut_conductor2);
		data.append("inputRutConductor3", rut_conductor3);


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
