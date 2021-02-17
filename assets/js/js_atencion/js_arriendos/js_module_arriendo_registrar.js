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

let dataFormArriendo = null;

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
	if (fechaEntrega.length != 0 && fechaRecepcion.length != 0) {
		let fechaini = new Date(moment(fechaEntrega));
		let fechafin = new Date(moment(fechaRecepcion));
		let diasdif = fechafin.getTime() - fechaini.getTime();
		let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
		$("#inputNumeroDias").val(dias);
	}
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



const calcularMantencionVehiculo = () => {
	let cada = Number(10000);
	let actual = Number($("#inputEntrada").val());
	let ultima = Number($("#Tmantencion_vehiculo").val());
	let siguiente = Number(0);
	siguiente = cada - (actual - ultima)
	$("#inputMantencion").val(siguiente);
}






//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	//cargar sucursales  (ruta,select)

	cargarSelectSucursal("cargar_Sucursales", "inputCiudadEntrega");
	cargarSelectSucursal("cargar_Sucursales", "inputCiudadRecepcion");

	cargarComunas("inputComunaCliente", "inputCiudadCliente");
	cargarComunas("inputComunaEmpresa", "inputCiudadEmpresa");
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


	$("#btn_refresh_vehiculos").click(() => {
		cargarVehiculos();
	})

	//cargar vehiculos en select
	const cargarSucursales = async () => {
		console.log();
		$("#selectSucursal").empty()
		await cargarSelectSucursal("cargar_Sucursales", "selectSucursal");
		$("#selectSucursal").val($("#id_sucursal").val())
		cargarVehiculos();
	}
	cargarSucursales();



	const cargarVehiculos = async () => {
		$("#select_vehiculos").empty();
		//select2 de los vehiculos
		$("#select_vehiculos").select2(lenguajeSelect2);
		const data = new FormData();
		data.append("inputSucursal", $("#selectSucursal").val());
		console.log($("#selectSucursal").val());
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
				let kilometros_actual = Number(response.data.kilometraje_vehiculo);
				let kilometros_mantencion = Number(response.data.Tmantencion_vehiculo);
				$("#inputEntrada").val(kilometros_actual);
				$("#Tmantencion_vehiculo").val(kilometros_mantencion);
				calcularMantencionVehiculo();
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
		//opciones
		const inputTipoArriendo = $("#inputTipo").val();
		const cantidadConductor = $('[name="customRadio5"]:checked').val();
		//validando los datos del arriendo
		if (
			$("#inputNumeroDias").val() <= 0 ||
			$("#inputNumeroDias").val().length == 0 ||
			$("#inputFechaEntrega").val().length == 0 ||
			$("#inputFechaRecepcion").val().length == 0) {
			Swal.fire({ icon: "warning", title: "Faltan datos del arriendo!", });
			return;
		}
		//validar datos cliente
		switch (inputTipoArriendo) {
			case "PARTICULAR":
				if (
					$("#inputRutCliente").val().length == 0 ||
					$("#inputNombreCliente").val().length == 0 ||
					$("#inputTelefonoCliente").val().length == 0 ||
					$("#inputCorreoCliente").val().length == 0 ||
					$("#inputDireccionCliente").val().length == 0 ||
					$("#inputFechaNacimiento").val().length == 0
				) {
					Swal.fire({ icon: "warning", title: "Faltan datos del cliente!", });
					return;
				}
				break;
			case "REEMPLAZO":
				if (
					$("#inputRutCliente").val().length == 0 ||
					$("#inputNombreCliente").val().length == 0 ||
					$("#inputTelefonoCliente").val().length == 0 ||
					$("#inputCorreoCliente").val().length == 0 ||
					$("#inputDireccionCliente").val().length == 0 ||
					$("#inputFechaNacimiento").val().length == 0
				) {
					Swal.fire({ icon: "warning", title: "Faltan datos del cliente!", });
					return;
				}
				break;
			case "EMPRESA":
				if (
					$("#inputRutEmpresa").val().length == 0 ||
					$("#inputNombreEmpresa").val().length == 0 ||
					$("#inputTelefonoEmpresa").val().length == 0 ||
					$("#inputCorreoEmpresa").val().length == 0 ||
					$("#inputDireccionEmpresa").val().length == 0 ||
					$("#inputVigencia").val().length == 0 ||
					$("#inputCiudadEmpresa").val().length == 0 ||
					$("#inputRol").val().length == 0
				) {
					Swal.fire({ icon: "warning", title: "Faltan datos de la empresa!", });
					return;
				}
				break;
		}
		//validando los datos del contacto
		if (
			$("#inputNombreContacto").val().length == 0 ||
			$("#inputDomicilioContacto").val().length == 0 ||
			$("#inputNumeroCasaContacto").val().length == 0 ||
			$("#inputCiudadContacto").val().length == 0 ||
			$("#inputTelefonoContacto").val().length == 0) {
			Swal.fire({
				icon: "warning",
				title: "Faltan datos del contacto de emergencia!",
			});
			return;
		}
		//validando el o los conductores
		function validarConductor1() {
			if ($("#inputRutConductor").val().length == 0 ||
				$("#inputNombreConductor").val().length == 0 ||
				$("#inputTelefonoConductor").val().length == 0 ||
				$("#inputDireccionConductor").val().length == 0 ||
				$("#inputVCTOConductor").val().length == 0 ||
				$("#inputNumeroConductor").val().length == 0 ||
				$("#inputMunicipalidadConductor").val().length == 0) {
				return false;
			}
			return true;
		}
		function validarConductor2() {
			if ($("#inputRutConductor2").val().length == 0 ||
				$("#inputNombreConductor2").val().length == 0 ||
				$("#inputTelefonoConductor2").val().length == 0 ||
				$("#inputDireccionConductor2").val().length == 0 ||
				$("#inputVCTOConductor2").val().length == 0 ||
				$("#inputNumeroConductor2").val().length == 0 ||
				$("#inputMunicipalidadConductor2").val().length == 0) {
				return false;
			}
			return true;
		}
		function validarConductor3() {
			if ($("#inputRutConductor3").val().length == 0 ||
				$("#inputNombreConductor3").val().length == 0 ||
				$("#inputTelefonoConductor3").val().length == 0 ||
				$("#inputDireccionConductor3").val().length == 0 ||
				$("#inputVCTOConductor3").val().length == 0 ||
				$("#inputNumeroConductor3").val().length == 0 ||
				$("#inputMunicipalidadConductor3").val().length == 0) {
				return false;
			}
			return true;
		}
		switch (cantidadConductor) {
			case "1":
				if (!validarConductor1()) {
					Swal.fire({ icon: "warning", title: "Faltan datos del conductor ", });
					return;
				}
				break;
			case "2":
				if (!validarConductor1() || !validarConductor2()) {
					Swal.fire({ icon: "warning", title: "Faltan datos de los conductores ", });
					return;
				}
				break;
			case "3":
				if (!validarConductor1() || !validarConductor2() || !validarConductor3()) {
					Swal.fire({ icon: "warning", title: "Faltan datos de los conductores", });
					return;
				}
				break;
		}
		//validando los datos del vehiculo
		if ($("#select_vehiculos").val() == null ||
			$("#select_vehiculos").val() == "null" ||
			$("#inputEntrada").val().length == 0 ||
			$("#inputMantencion").val().length == 0) {
			Swal.fire({ icon: "warning", title: "debes colocar los datos del vehiculo!", });
			return;
		}
		//SI PASAN TODAS LAS VALIDACIONES , SE GUARDA
		alertQuestion(async () => {
			$("#btn_crear_arriendo").attr("disabled", true);
			$("#spinner_btn_registrar").show();
			const form = $("#form_registrar_arriendo")[0];
			dataFormArriendo = new FormData(form);
			await registrarTodoElArriendo(inputTipoArriendo, cantidadConductor);
			$("#btn_crear_arriendo").attr("disabled", false);
			$("#spinner_btn_registrar").hide();
		})
	});








	const registrarTodoElArriendo = async (inputTipoArriendo, cantidadConductor) => {
		const conductores = {};
		console.log(conductores);
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
		return await ajax_function(dataFormArriendo, "registrar_cliente");
	};

	const guardarDatosEmpresa = async () => {
		return await ajax_function(dataFormArriendo, "registrar_empresa");
	};
	const guardarDatosConductor = async () => {
		return await ajax_function(dataFormArriendo, "registrar_conductor");
	};

	const guardarDatosConductor2 = async () => {
		//no modificar
		const dataConductor2 = new FormData();
		dataConductor2.append("inputRutConductor", $("#inputRutConductor2").val());
		dataConductor2.append("inputNombreConductor", $("#inputNombreConductor2").val());
		dataConductor2.append("inputTelefonoConductor", $("#inputTelefonoConductor2").val());
		dataConductor2.append("inputClaseConductor", $("#inputClaseConductor2").val());
		dataConductor2.append("inputNumeroConductor", $("#inputNumeroConductor2").val());
		dataConductor2.append("inputVCTOConductor", $("#inputVCTOConductor2").val());
		dataConductor2.append("inputMunicipalidadConductor", $("#inputMunicipalidadConductor2").val());
		dataConductor2.append("inputDireccionConductor", $("#inputDireccionConductor2").val())
		dataConductor2.append("inputNacionalidadConductor", $("#inputNacionalidadConductor2").val());
		return await ajax_function(dataConductor2, "registrar_conductor");
	};


	const guardarDatosConductor3 = async () => {
		//no modificar
		const dataConductor3 = new FormData();
		dataConductor3.append("inputRutConductor", $("#inputRutConductor3").val());
		dataConductor3.append("inputNombreConductor", $("#inputNombreConductor3").val());
		dataConductor3.append("inputTelefonoConductor", $("#inputTelefonoConductor3").val());
		dataConductor3.append("inputClaseConductor", $("#inputClaseConductor3").val());
		dataConductor3.append("inputNumeroConductor", $("#inputNumeroConductor3").val());
		dataConductor3.append("inputVCTOConductor", $("#inputVCTOConductor3").val());
		dataConductor3.append("inputMunicipalidadConductor", $("#inputMunicipalidadConductor3").val());
		dataConductor3.append("inputDireccionConductor", $("#inputDireccionConductor3").val())
		dataConductor3.append("inputNacionalidadConductor", $("#inputNacionalidadConductor3").val());
		return await ajax_function(dataConductor3, "registrar_conductor");
	};


	const guardarDatosRemplazo = async (rut_cliente) => {
		dataFormArriendo.append("inputRutCliente", rut_cliente);
		return await ajax_function(dataFormArriendo, "registrar_remplazo");
	};

	const guardarDatosArriendo = async (id_remplazo, conductores, rut_cliente, rut_empresa) => {
		const c1 = document.getElementById("inputCiudadEntrega");
		const c2 = document.getElementById("inputCiudadRecepcion");
		const { rut_conductor, rut_conductor2, rut_conductor3 } = conductores;
		dataFormArriendo.append("inputCiudadRecepcion", c2.options[c2.selectedIndex].innerText);
		dataFormArriendo.append("inputCiudadEntrega", c1.options[c1.selectedIndex].innerText);
		dataFormArriendo.append("inputIdRemplazo", id_remplazo);
		dataFormArriendo.append("inputRutCliente", rut_cliente);
		dataFormArriendo.append("inputRutEmpresa", rut_empresa);
		dataFormArriendo.append("inputRutConductor", rut_conductor);
		dataFormArriendo.append("inputRutConductor2", rut_conductor2);
		dataFormArriendo.append("inputRutConductor3", rut_conductor3);
		const response = await ajax_function(dataFormArriendo, "registrar_arriendo");
		if (response.success) {
			await guardarDatosContacto(response.data.id_arriendo);
			await cambiarEstadoVehiculo(response.data.patente_vehiculo);
			Swal.fire("Arriendo Registrado", response.msg, "success");
			limpiarCampos();
		}
	};


	const guardarDatosContacto = async (idArriendo) => {
		dataFormArriendo.append("inputIdArriendo", idArriendo);
		await ajax_function(dataFormArriendo, "registrar_contacto");
	}

	const cambiarEstadoVehiculo = async (patente) => {
		dataFormArriendo.append("inputPatenteVehiculo", patente);
		dataFormArriendo.append("kilometraje_vehiculo", $("#inputEntrada").val());
		dataFormArriendo.append("kilometros_mantencion", $("#inputMantencion").val());
		dataFormArriendo.append("inputEstado", "RESERVADO");
		await ajax_function(dataFormArriendo, "cambiarEstado_vehiculo");
	};

	const limpiarCampos = () => {
		$("#btn_crear_arriendo").attr("disabled", false);
		$("#spinner_btn_registrar").hide();
		$("#form_registrar_arriendo")[0].reset();
		$("#card-tarjeta").hide();
		$("#card-cheque").hide();
		dataFormArriendo = null;
		$("#select_vehiculos").empty();
		cargarVehiculos();
	};





});
