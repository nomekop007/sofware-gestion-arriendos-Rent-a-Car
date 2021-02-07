// ruta definitiva al helper_url
const base_url = $("#url").val();
const base_route = $("#route").val();


//cargar selects
function cargarSelect(ruta, idSelect) {
	const url = base_url + ruta;
	const select = document.getElementById(idSelect);
	$.getJSON(url, (response) => {
		if (response.success) {
			$.each(response.data, (i, object) => {
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
			console.log("ah ocurrido un error al cargar" + ruta);
		}
	});
}

function cargarSelectSucursal(ruta, idSelect) {
	const url = base_url + ruta;
	const select = document.getElementById(idSelect);
	$.getJSON(url, (response) => {
		if (response.success) {
			$.each(response.data, (i, object) => {
				const option = document.createElement("option");
				for (const key in object) {
					if (key.includes("nombre")) {
						option.innerHTML = object[key];
					}
					if (key.includes("id_sucursal")) {
						option.value = object[key];
					}
				}
				select.appendChild(option);
			});
		} else {
			console.log("ah ocurrido un error al cargar" + ruta);
		}
	});
}


async function ajax_function(data, dataUrl) {

	try {
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
				if (response.sinToken) {
					setTimeout(() => {
						window.location = base_url;
					}, 4000);
				}
				if (response.success) {
					console.log(dataUrl + " SUCCESS!");
				} else {
					console.log(dataUrl + " ERROR SERVER!");
					Swal.fire({
						icon: "error",
						title: response.msg,
						text: "Error en el servidor : " + dataUrl,
					});
				}
			},
			error: (error) => {
				console.log(dataUrl + " ERROR CLIENT!");
				//crear end poit que cacture errores del lado del cliente
				Swal.fire({
					icon: "error",
					title: "contacte con informatica",
					text: "Error en el cliente : " + dataUrl,
				});
			},
		});
	} catch (error) {
		return { success: false, msg: error };
	}
}
