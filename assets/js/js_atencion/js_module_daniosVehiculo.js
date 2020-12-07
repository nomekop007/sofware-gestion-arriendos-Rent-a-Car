$("#m_danios").addClass("active");
$("#l_danios").addClass("card");
$("#spinner_tabla_danios").hide();


$(document).ready(() => {

	$("#todos-tab").click(() => refrescar_tabla_danios());

	const danio = {};
	const tabla_todos_danios = $("#tabla_todos_danios").DataTable(lenguaje);


	const refrescar_tabla_danios = () => {
		tabla_todos_danios.row().clear().draw(false);
		cargar_todos_danios();
	};


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


	const cargar_danio_en_tabla = (danio) => {
		console.log(danio);
	}

})
