$("#m_cliente").addClass("active");
$("#l_cliente").addClass("card");

const buscarCliente = async (rut_cliente) => {
	limpiarCampos();
	const data = new FormData();
	data.append("rut_cliente", rut_cliente);
	const response = await ajax_function(data, "buscar_cliente");
	if (response.success) {
		const cliente = response.data;
		$("#form_header").text("Cliente particular");

		//se agrega un option para el select ciudad
		const option = document.createElement('option');
		option.value = cliente.ciudad_cliente;
		option.text = cliente.ciudad_cliente;
		document.getElementById("inputCiudadCliente").appendChild(option);
		$("#inputCiudadCliente").val(cliente.ciudad_cliente);
		$("#inputComunaCliente").val(cliente.comuna_cliente);
		$("#inputNombreCliente").val(cliente.nombre_cliente);
		$("#inputRutCliente").val(cliente.rut_cliente);
		$("#inputEstadoCivilCliente").val(cliente.estadoCivil_cliente);
		$("#inputNacimientoCliente").val(moment(cliente.fechaNacimiento_cliente ? cliente.fechaNacimiento_cliente : null).format('YYYY/MM/DD'));
		$("#inputNacionalidadCliente").val(cliente.nacionalidad_cliente);
		$("#inputCorreoCliente").val(cliente.correo_cliente);
		$("#inputDireccionCliente").val(cliente.direccion_cliente);
		$("#inputTelefonoCliente").val(cliente.telefono_cliente);
		$("#inputCreateAtCliente").val(formatearFechaHora(cliente.createdAt));

		//carga los documentos
		if (cliente.documentosCliente) {
			const docs = cliente.documentosCliente;
			for (const documento in docs) {
				if (docs[documento]) {
					const button = document.createElement("button");
					button.addEventListener("click", () => buscarDocumento(docs[documento], "requisito"));
					button.textContent = documento;
					button.className = "badge badge-pill badge-info m-1";
					document.getElementById("card_documentos_cliente").append(button);
				}
			}
		}
		$("#body_cliente").show();
	}
	$("#spinner_cliente").hide();
};

const buscarEmpresa = async (rut_empresa) => {
	limpiarCampos();
	const data = new FormData();
	data.append("rut_empresa", rut_empresa);
	const response = await ajax_function(data, "buscar_empresa");
	if (response.success) {
		const empresa = response.data;
		$("#form_header").text("Cliente Empresa");

		const option = document.createElement('option');
		option.value = empresa.ciudad_empresa;
		option.text = empresa.ciudad_empresa;
		document.getElementById("inputCiudadEmpresa").appendChild(option);
		$("#inputCiudadEmpresa").val(empresa.ciudad_empresa);
		$("#inputComunaEmpresa").val(empresa.comuna_empresa);
		$("#inputCorreoEmpresa").val(empresa.correo_empresa);
		$("#inputCreateAtEmpresa").val(formatearFechaHora(empresa.createdAt));
		$("#inputDireccionEmpresa").val(empresa.direccion_empresa);
		$("#inputNombreEmpresa").val(empresa.nombre_empresa);
		$("#inputRolEmpresa").val(empresa.rol_empresa);
		$("#inputRutEmpresa").val(empresa.rut_empresa);
		$("#inputTelefonoEmpresa").val(empresa.telefono_empresa);
		$("#inputVigenciaEmpresa").val(empresa.vigencia_empresa);

		//carga los documentos
		if (empresa.documentosEmpresa) {
			const docs = empresa.documentosEmpresa;
			for (const documento in docs) {
				if (docs[documento]) {
					const button = document.createElement("button");
					button.addEventListener("click", () => buscarDocumento(docs[documento], "requisito"));
					button.textContent = documento;
					button.className = "badge badge-pill badge-info m-1";
					document.getElementById("card_documentos_empresa").append(button);
				}
			}
		}
		$("#body_empresa").show();
	}
	$("#spinner_cliente").hide();
};

const buscarConductor = async (rut_conductor) => {
	limpiarCampos();
	const data = new FormData();
	data.append("rut_conductor", rut_conductor);
	const response = await ajax_function(data, "buscar_conductor");
	if (response.success) {
		const conductor = response.data;
		$("#form_header").text("Conductor");
		$("#inputClaseConductor").val(conductor.clase_conductor);
		$("#inputCreateAtConductor").val(formatearFechaHora(conductor.createdAt));
		$("#inputNacionalidadConductor").val(conductor.nacionalidad_conductor);
		$("#inputDireccionConductor").val(conductor.direccion_conductor);
		$("#inputMunicipalidadConductor").val(conductor.municipalidad_conductor);
		$("#inputNombreConductor").val(conductor.nombre_conductor);
		$("#inputNumeroConductor").val(conductor.numero_conductor);
		$("#inputRutConductor").val(conductor.rut_conductor);
		$("#inputTelefonoConductor").val(conductor.telefono_conductor);
		$("#inputVCTOConductor").val(moment(conductor.vcto_conductor ? conductor.vcto_conductor : null).format("YYYY/MM/DD"));
		//carga los documentos
		if (conductor.documentosConductore) {
			const docs = conductor.documentosConductore;
			for (const documento in docs) {
				if (docs[documento]) {
					const button = document.createElement("button");
					button.addEventListener("click", () => buscarDocumento(docs[documento], "requisito"));
					button.textContent = documento;
					button.className = "badge badge-pill badge-info m-1";
					document.getElementById("card_documentos_conductor").append(button);
				}
			}
		}
		$("#body_conductor").show();
	}
	$("#spinner_cliente").hide();
};

const limpiarCampos = () => {
	$("#spinner_cliente").show();
	$("#form_header").text("");
	$("#card_documentos_cliente").empty();
	$("#card_documentos_conductor").empty();
	$("#card_documentos_empresa").empty();
	$("#form_editar_cliente")[0].reset();
	$("#form_editar_conductor")[0].reset();
	$("#form_editar_empresa")[0].reset();
	$("#body_cliente").hide();
	$("#body_conductor").hide();
	$("#body_empresa").hide();
	$("#spinner_btn_editar_cliente").hide();
	$("#spinner_btn_editar_empresa").hide();
	$("#spinner_btn_editar_conductor").hide();
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
	//se inician los datatable
	const tablaCliente = $("#tablaClientes").DataTable(lenguaje);
	const tablaEmpresa = $("#tablaEmpresas").DataTable(lenguaje);
	const tablaConductor = $("#tablaConductores").DataTable(lenguaje);

	cargarComunas("inputComunaCliente", "inputCiudadCliente");

	cargarComunas("inputComunaEmpresa", "inputCiudadEmpresa");

	cargarOlder("inputVigenciaEmpresa");


	$("#nav-clientes-tab").click(() => refrescarTablaCliente());
	$("#nav-empresas-tab").click(() => refrescarTablaEmpresa());
	$("#nav-conductores-tab").click(() => refrescarTablaConductor());


	const refrescarTablaCliente = () => {
		//limpia la tabla
		tablaCliente.row().clear().draw(false);
		//carga nuevamente
		cargarClientes();
	};
	const refrescarTablaEmpresa = () => {
		//limpia la tabla
		tablaEmpresa.row().clear().draw(false);
		//carga nuevamente
		cargarEmpresas();
	};
	const refrescarTablaConductor = () => {
		//limpia la tabla
		tablaConductor.row().clear().draw(false);
		//carga nuevamente
		cargarConductores();
	};







	$("#btn_editar_cliente").click(() => {
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
				$("#spinner_btn_editar_cliente").show();
				$("#btn_editar_cliente").attr("disabled", true);
				const form = $("#form_editar_cliente")[0];
				const data = new FormData(form);
				data.append("inputRutCliente", $("#inputRutCliente").val())
				const response = await ajax_function(data, "modificar_cliente");
				if (response.success) {
					await editarArchivoCliente(data);
					$("#btn_editar_cliente").attr("disabled", false);
					$("#spinner_btn_editar_cliente").hide();
					$("#modal_ver").modal("toggle");
					Swal.fire("registro actualizado", response.msg, "success");
					refrescarTablaCliente();
				}
			}
		});
	})

	$("#btn_editar_empresa").click(() => {
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
				$("#spinner_btn_editar_empresa").show();
				$("#btn_editar_empresa").attr("disabled", true);
				const form = $("#form_editar_empresa")[0];
				const data = new FormData(form);
				data.append("inputRutEmpresa", $("#inputRutEmpresa").val())
				const response = await ajax_function(data, "modificar_empresa");
				if (response.success) {
					await editarArchivoEmpresa(data);
					$("#btn_editar_empresa").attr("disabled", false);
					$("#spinner_btn_editar_empresa").hide();
					$("#modal_ver").modal("toggle");
					Swal.fire("registro actualizado", response.msg, "success");
					refrescarTablaEmpresa();
				}
			}
		});
	})

	$("#btn_editar_conductor").click(() => {
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
				$("#spinner_btn_editar_conductor").show();
				$("#btn_editar_conductor").attr("disabled", true);
				const form = $("#form_editar_conductor")[0];
				const data = new FormData(form);
				data.append("inputRutConductor", $("#inputRutConductor").val())
				const response = await ajax_function(data, "modificar_conductor");
				if (response.success) {
					await editarArchivoConductor(data);
					$("#btn_editar_conductor").attr("disabled", false);
					$("#spinner_btn_editar_conductor").hide();
					$("#modal_ver").modal("toggle");
					Swal.fire("registro actualizado", response.msg, "success");
					refrescarTablaConductor();
				}

			}
		});
	})


	const editarArchivoCliente = async (data) => {
		if ($("#inputCarnetTraseraCliente").val().length != 0 || $("#inputCarnetFrontalCliente").val().length != 0) {
			await ajax_function(data, "editarArchivos_cliente");
		}
	}

	const editarArchivoEmpresa = async (data) => {
		if ($("#inputCarnetFrontalEmpresa").val().length != 0 ||
			$("#inputCarnetTraseraEmpresa").val().length != 0 ||
			$("#inputEstatuto").val().length != 0 ||
			$("#inputDocumentotRol").val().length != 0 ||
			$("#inputDocumentoVigencia").val().length != 0) {
			await ajax_function(data, "editarArchivos_empresa");
		}
	}

	const editarArchivoConductor = async (data) => {
		if ($("#inputlicenciaFrontalConductor").val().length != 0 || $("#inputlicenciaTraseraConductor").val().length != 0) {
			await ajax_function(data, "editarArchivos_conductor");
		}
	}



	const cargarClientes = async () => {
		$("#spinner_tablaClientes").show();
		const response = await ajax_function(null, "cargar_clientes");
		if (response.success) {
			$.each(response.data, (i, o) => {
				try {
					tablaCliente.row
						.add([
							o.rut_cliente,
							o.nombre_cliente,
							o.nacionalidad_cliente,
							"+569 " + o.telefono_cliente,
							o.correo_cliente,
							` <button value='${o.rut_cliente}' onclick='buscarCliente(this.value)' data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>`,
						])
						.draw(false);
				} catch (error) { }
			});
		}
		$("#spinner_tablaClientes").hide();
	}
	cargarClientes();

	const cargarEmpresas = async () => {
		$("#spinner_tablaEmpresas").show();
		const response = await ajax_function(null, "cargar_empresas");
		if (response.success) {
			$.each(response.data, (i, o) => {
				try {
					tablaEmpresa.row
						.add([
							o.rut_empresa,
							o.nombre_empresa,
							o.rol_empresa,
							"+569 " + o.telefono_empresa,
							o.correo_empresa,
							` <button value='${o.rut_empresa}' onclick='buscarEmpresa(this.value)' data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>`,
						])
						.draw(false);
				} catch (error) { }
			});
		}
		$("#spinner_tablaEmpresas").hide();
	};

	const cargarConductores = async () => {
		$("#spinner_tablaConductores").show();
		const response = await ajax_function(null, "cargar_conductores");
		if (response.success) {
			$.each(response.data, (i, o) => {
				try {
					tablaConductor.row
						.add([
							o.rut_conductor,
							o.nombre_conductor,
							o.nacionalidad_conductor,
							o.clase_conductor,
							"+569 " + o.telefono_conductor,
							` <button value='${o.rut_conductor}' onclick='buscarConductor(this.value)' data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>`,
						])
						.draw(false);
				} catch (error) { }
			});
		}
		$("#spinner_tablaConductores").hide();
	};






});
