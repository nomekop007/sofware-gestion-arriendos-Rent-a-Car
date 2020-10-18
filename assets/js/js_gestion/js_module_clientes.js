$(document).ready(() => {
	//se inician los datatable
	const tablaCliente = $("#tablaClientes").DataTable(lenguaje);
	const tablaEmpresa = $("#tablaEmpresas").DataTable(lenguaje);
	const tablaConductor = $("#tablaConductores").DataTable(lenguaje);

	(cargarClientes = () => {
		$("#spinner_tablaClientes").show();
		const url = base_url + "cargar_clientes";
		$.getJSON(url, (result) => {
			$("#spinner_tablaClientes").hide();
			if (result.success) {
				$.each(result.data, (i, o) => {
					tablaCliente.row
						.add([
							o.nombre_cliente,
							o.rut_cliente,
							"+569 " + o.telefono_cliente,
							o.correo_cliente,
							" <button value='" +
								o.rut_cliente +
								"' " +
								" onclick='buscarCliente(this.value)'" +
								" data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
						])
						.draw(false);
				});
			} else {
				console.log("ah ocurrido un error al cargar cliente");
			}
		});
	})();

	(cargarEmpresas = () => {
		$("#spinner_tablaEmpresas").show();
		const url = base_url + "cargar_empresas";
		$.getJSON(url, (result) => {
			$("#spinner_tablaEmpresas").hide();
			if (result.success) {
				$.each(result.data, (i, o) => {
					tablaEmpresa.row
						.add([
							o.nombre_empresa,
							o.rut_empresa,
							o.rol_empresa,
							o.correo_empresa,
							" <button value='" +
								o.rut_empresa +
								"' " +
								" onclick='buscarEmpresa(this.value)'" +
								" data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
						])
						.draw(false);
				});
			} else {
				console.log("ah ocurrido un error al cargar empresa");
			}
		});
	})();

	(cargarConductores = () => {
		$("#spinner_tablaConductores").show();
		const url = base_url + "cargar_conductores";
		$.getJSON(url, (result) => {
			$("#spinner_tablaConductores").hide();
			if (result.success) {
				$.each(result.data, (i, o) => {
					tablaConductor.row
						.add([
							o.nombre_conductor,
							o.rut_conductor,
							o.clase_conductor,
							"+569 " + o.telefono_conductor,
							" <button value='" +
								o.rut_conductor +
								"' " +
								" onclick='buscarConductor(this.value)'" +
								" data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
						])
						.draw(false);
				});
			} else {
				console.log("ah ocurrido un error al cargar conductor");
			}
		});
	})();
});
