$("#m_facturacion").addClass("active");
$("#l_facturacion").addClass("card");


$(document).ready(() => {

	const tabla_pago = $("#tabla_pagos").DataTable(lenguaje);

	$("#nav-pagos-tab").click(() => refrescarTabla());



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




	const refrescarTabla = () => {
		//limpia la tabla
		tabla_pago.row().clear().draw(false);
		//carga nuevamente
		cargarPagosPendientes();
	};


	const cargarPagosPendientes = async () => {
		$("#spinner_tabla_pagos").show();
		const response = await ajax_function(null, "cargar_pagosERpendientes");
		if (response.success) {
			$.each(response.data, (i, facturacion) => {
				cargarPagosEnTabla(facturacion);
			});
		}
		$("#spinner_tabla_pagos").hide();
	};


	const cargarPagosEnTabla = (pagosPendientes) => {
		console.log(pagosPendientes)
	};

})
