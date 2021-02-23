


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




const alertQuestion = (func) => {
	Swal.fire({
		title: "Estas seguro?",
		text: "verifique bien los datos antes de continuar.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Si, seguro",
		cancelButtonText: "No, cancelar!",
		reverseButtons: true,
	}).then((result) => {
		if (result.isConfirmed) {
			func();
		}
	});
}





//funcion que tranforma en mayuscula
//onblur="mayus(this);"
const mayus = (e) => {
	e.value = e.value.toUpperCase();
}


const orderByCreatedAt = (array) => {
	return array.sort(function (a, b) {
		const fechaA = new Date(a.createdAt);
		const fechaB = new Date(b.createdAt);
		if (fechaA > fechaB) {
			return 1;
		}
		if (fechaA < fechaB) {
			return -1;
		}
		return 0;
	});
}





//Script para validar limite de numeros
//oninput="this.value = soloNumeros(this)"
const soloNumeros = (evt) => {
	if (evt.value.length > evt.maxLength) {
		return evt.value.slice(0, evt.maxLength);
	} else {
		return evt.value;
	}
}









//redondea el ultimo valor de un numero 
const decimalAdjust = (value, exp) => {
	let type = 'round';
	// Si el exp es indefinido o cero...
	if (typeof exp === 'undefined' || +exp === 0) {
		return Math[type](value);
	}
	value = +value;
	exp = +exp;
	// Si el valor no es un número o el exp no es un entero...
	if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
		return NaN;
	}
	// Cambio
	value = value.toString().split('e');
	value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
	// Volver a cambiar
	value = value.toString().split('e');
	return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}











// Script para cargar año vehiculo
const cargarOlder = (input) => {
	let n = new Date().getFullYear() + 1;
	let select = document.getElementById(input);
	for (let i = n; i >= 1970; i--) {

		select.options.add(new Option(i, i));
	}
}










// funcion para formatear rut
const formateaRut = (rut) => {
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
const formatearFechaHora = (fecha) => {
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
const formatearFecha = (fecha) => {
	let f = new Date(fecha);
	let opciones = {
		year: "numeric",
		month: "numeric",
		day: "numeric",
	};
	return (fecha = f.toLocaleDateString("es-GB", opciones));
}











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




const dataURItoBlob = (dataURI) => {
	// convert base64/URLEncoded data component to raw binary data held in a string
	let byteString;
	if (dataURI.split(',')[0].indexOf('base64') >= 0)
		byteString = atob(dataURI.split(',')[1]);
	else
		byteString = unescape(dataURI.split(',')[1]);

	// separate out the mime component
	let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
	// write the bytes of the string to a typed array
	let ia = new Uint8Array(byteString.length);
	for (let i = 0; i < byteString.length; i++) {
		ia[i] = byteString.charCodeAt(i);
	}
	return new Blob([ia], { type: mimeString });
}





//metodo que busca y devuelve un documento en una pagina nueva
const buscarDocumento = async (documento, tipo) => {
	//  case "contrato":
	//  case "acta":
	//  case "requisito":
	//  case "facturacion":
	//  case "recepcion":
	//  case "fotosDañoVehiculo":
	//  case "fotoVehiculo":
	const data = new FormData();
	data.append("nombreDocumento", documento);
	data.append("tipo", tipo);
	const response = await ajax_function(data, "buscar_documento");
	if (response.success) {

		alert(navigator.userAgent.search("Safari"))

		if (navigator.userAgent.search("Safari") == '104') {
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
		} else {
			window.open(response.data.link);
		}
	}
}

const mobile = {
	Android: function () {
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function () {
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function () {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function () {
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function () {
		return navigator.userAgent.match(/IEMobile/i);
	},
	any: function () {
		return (mobile.Android() || mobile.BlackBerry() || mobile.iOS() || mobile.Opera() || mobile.Windows());
	}
};






//lenguaje de los datatable
let lenguaje = {
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
let lenguajeSelect2 = {
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







// inputs estilos datatime
$(document).ready(() => {
	$.datetimepicker.setLocale('es');
	$('.input_data').datetimepicker({
		timepicker: false,
		format: 'Y/m/d',
	});
	$('.input_datatime').datetimepicker({
		timepicker: false,
		format: 'Y/m/d  h:m',
	});
});








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