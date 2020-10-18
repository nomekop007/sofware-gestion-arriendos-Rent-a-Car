// ruta definitiva al helper_url
var base_url = $("#ruta").val();
var storage = $("#storage").val();

//cargar selects
function cargarSelect(ruta, idSelect) {
	const url = base_url + ruta;
	const select = document.getElementById(idSelect);
	$.getJSON(url, (result) => {
		if (result.success) {
			$.each(result.data, (i, object) => {
				const option = document.createElement("option");
				for (const key in object) {
					if (key.includes("nombre")) {
						option.innerHTML = object[key];
					}
					if (key.includes("id") || key.includes("rut")) {
						option.value = object[key];
					}
				}
				select.appendChild(option);
			});
		} else {
			console.log("ah ocurrido un error al cargar");
		}
	});
}

async function ajax_function(data, dataUrl) {
	return await $.ajax({
		url: base_url + dataUrl,
		type: "post",
		dataType: "json",
		data: data,
		enctype: "multipart/form-data",
		processData: false,
		contentType: false,
		cache: false,
		timeOut: false,
		success: (response) => {
			if (response.success) {
				console.log(dataUrl + " OK!");
			} else {
				Swal.fire({
					icon: "error",
					title: "Error en el servidor : " + dataUrl,
					text: response.msg,
				});
			}
		},
		error: () => {
			Swal.fire({
				icon: "error",
				title: "Error en el cliente : " + dataUrl,
				text: "A ocurrido un Error Contacte a informatica",
			});
		},
	});
}
