//funcion que tranforma en mayuscula
//onblur="mayus(this);"
function mayus(e) {
	e.value = e.value.toUpperCase();
}

//Script para validar limite de numeros
//oninput="this.value = soloNumeros(this)"
function soloNumeros(evt) {

	if (evt.value.length > evt.maxLength) {
		return evt.value.slice(0, evt.maxLength);
	} else {
		return evt.value;
	}
}




// Script para cargar año vehiculo
function cargarOlder(input) {
	let n = new Date().getFullYear() + 1;
	let select = document.getElementById(input);
	for (let i = n; i >= 1970; i--) {

		select.options.add(new Option(i, i));
	}
}

// Script para validar los campos de un formulario
(() => {
	"use strict";
	window.addEventListener(
		"load",
		function () {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			let forms = document.getElementsByClassName("needs-validation");
			// Loop over them and prevent submission
			let validation = Array.prototype.filter.call(forms, function (form) {
				form.addEventListener(
					"submit",
					function (event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						} else {
							event.preventDefault();
						}
						form.classList.add("was-validated");
					},
					false
				);
			});
		},
		false
	);
})();

// funcion para formatear rut
function formateaRut(rut) {
	//onblur="this.value=formateaRut(this.value)"
	let actual = rut.replace(/^0+/, "");
	if (actual != "" && actual.length > 1) {
		let sinPuntos = actual.replace(/\./g, "");
		let actualLimpio = sinPuntos.replace(/-/g, "");
		let inicio = actualLimpio.substring(0, actualLimpio.length - 1);
		let rutPuntos = "";
		let i = 0;
		let j = 1;
		for (i = inicio.length - 1; i >= 0; i--) {
			let letra = inicio.charAt(i);
			rutPuntos = letra + rutPuntos;
			if (j % 3 == 0 && j <= inicio.length - 1) {
				rutPuntos = "." + rutPuntos;
			}
			j++;
		}
		let dv = actualLimpio.substring(actualLimpio.length - 1);
		rutPuntos = rutPuntos + "-" + dv;
	}
	return rutPuntos;
}

//funcion para formatear fechas
function formatearFechaHora(fecha) {
	let f = new Date(fecha);
	let opciones = {
		weekday: "long",
		year: "numeric",
		month: "numeric",
		day: "numeric",
		hour: "numeric",
		minute: "numeric",
		second: "numeric",
	};
	return (fecha = f.toLocaleDateString("es-GB", opciones));
}

//funcion para formatear fechas
function formatearFecha(fecha) {
	let f = new Date(fecha);
	let opciones = {
		year: "numeric",
		month: "numeric",
		day: "numeric",
	};
	return (fecha = f.toLocaleDateString("es-GB", opciones));
}

//lenguaje de los datatable
var lenguaje = {
	responsive: true,
	destroy: true,
	language: {
		decimal: "",
		emptyTable: "No hay datos",
		info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
		infoEmpty: "Mostrando 0 a 0 de 0 registros",
		infoFiltered: "(Filtro de _MAX_ total registros)",
		infoPostFix: "",
		thousands: ",",
		lengthMenu: "Mostrar _MENU_ registros",
		loadingRecords: "Cargando...",
		processing: "Procesando...",
		search: "Buscar:",
		zeroRecords: "No se encontraron coincidencias",
		paginate: {
			first: "Primero",
			last: "Ultimo",
			next: "Próximo",
			previous: "Anterior",
		},
		aria: {
			sortAscending: ": Activar orden de columna ascendente",
			sortDescending: ": Activar orden de columna desendente",
		},
	},
	"order": [[0, "desc"]]
};
//lenguaje del select 2
var lenguajeSelect2 = {
	placeholder: "Vehiculos disponibles",
	allowClear: true,
	language: {
		noResults: () => {
			return "No hay resultado";
		},
		searching: () => {
			return "Buscando..";
		},
	},
};

// script que oscurece los modal dentro de otro modal
$(document).ready(() => {
	let modal_lv = 0;
	$('.modal').on('shown.bs.modal', function (e) {
		$('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
		$(e.currentTarget).css('zIndex', 1052 + modal_lv);
		modal_lv++
	});

	$('.modal').on('hidden.bs.modal', function (e) {
		modal_lv--
	});
});

//se valida los input files
$(document).on("change", 'input[type="file"]', function () {
	let fileName = this.files[0].name;
	let fileSize = this.files[0].size;
	let ext = fileName.split(".");
	// ahora obtenemos el ultimo valor despues el punto
	// obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
	ext = ext[ext.length - 1];
	switch (ext) {
		case "png":
			$("#tamanoArchivo").text(fileSize + " bytes en " + ext);
			break;
		case "jpeg":
			$("#tamanoArchivo").text(fileSize + " bytes " + ext);
			break;
		case "jpg":
			$("#tamanoArchivo").text(fileSize + " bytes " + ext);
			break;
		case "gif":
			$("#tamanoArchivo").text(fileSize + " bytes " + ext);
			break;
		case "pdf":
			$("#tamanoArchivo").text(fileSize + " bytes " + ext);
			break;
		default:
			alert("El archivo no tiene la extensión adecuada");
			this.value = ""; // reset del valor
			this.files[0].name = "";
			break;
	}
	//fileSize > 1048576  1mb


	if (fileSize > 1048576 * 10) {
		alert("El archivo tiene que pesar menos de 10mb");
		this.value = ""; // reset del valor
		this.files[0].name = "";
	}
});

// redimenciona una imagen en formato base 64 (base64, canvas.width, canvas.height)
//ES ASINCRONO
const resizeBase64Img = (base64, newWidth, newHeight, level) => {
	return new Promise((resolve, reject) => {
		let canvas = document.createElement("canvas");
		canvas.width = newWidth / level;
		canvas.height = newHeight / level;
		let context = canvas.getContext("2d");
		let img = document.createElement("img");
		img.src = base64;
		img.onload = function () {
			context.scale(
				newWidth / level / img.width,
				newHeight / level / img.height
			);
			context.drawImage(img, 0, 0);
			resolve(canvas.toDataURL());
		};
	});
};



const buscarDocumento = async (documento, tipo) => {
	const data = new FormData();
	data.append("nombreDocumento", documento);
	data.append("tipo", tipo);
	const response = await ajax_function(data, "buscar_documento");
	if (response.success) {
		let extencion = "image/png";
		//pregunta si el archivo tiene extencion
		response.data.nombre.includes(".pdf") ? extencion = "application/pdf" : extencion = "image/png";
		let byteCharacters = atob(response.data.base64);
		let byteNumbers = new Array(byteCharacters.length);
		for (let i = 0; i < byteCharacters.length; i++) {
			byteNumbers[i] = byteCharacters.charCodeAt(i);
		}
		let byteArray = new Uint8Array(byteNumbers);
		let file = new Blob([byteArray], { type: `${extencion};base64` });
		let fileURL = URL.createObjectURL(file);
		window.open(fileURL);
	}
}



