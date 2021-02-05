//aqui se guarda el base64 del documento seleccionando
let global_base64_documento = null;

const mostrarContratoModalContrato = async (arriendo) => {
	limpiarCamposModalFirma();
	$("#estado_arriendo").val(arriendo.estado_arriendo);
	$("#id_arriendoContrato").val(arriendo.id_arriendo);
	$("#title_contrato").html("Nº " + arriendo.id_arriendo)
	const data = new FormData();
	data.append("id_arriendo", arriendo.id_arriendo);
	await cargarContrato(data);
};

const cargarContrato = async (data) => {
	const response = await ajax_function(data, "generar_PDFcontrato");
	if (response.success) {
		mostrarVisorPDF(response.data.base64, [
			"pdf_canvas_contrato",
			"page_count_contrato",
			"page_num_contrato",
			"prev_contrato",
			"next_contrato"
		]);
		const a = document.getElementById("descargar_contrato");
		a.href = `data:application/pdf;base64,${response.data.base64}`;
		a.download = `contrato.pdf`;
		global_base64_documento = response.data.base64;
		if (response.data.firma) {
			$("#btn_confirmar_contrato").attr("disabled", false);
		}
		$("#formContratoArriendo").show();
	}
	$("#btn_firmar_contrato").attr("disabled", false);
	$("#spinner_btn_firmarContrato").hide();
	$("#formSpinnerContrato").hide();
}


const tipoContrato = (value) => {
	switch (value) {
		case "FIRMAR":
			$("#body-firma").show();
			$("#body-subir-contrato").hide();
			break;
		case "SUBIR":
			$("#body-subir-contrato").show();
			$("#body-firma").hide();
			break;
	}
}

const limpiarCamposModalFirma = () => {
	$("#formContratoArriendo").hide();
	$("#spinner_btn_firmarContrato").hide();
	$("#spinner_btn_confirmarContrato").hide();
	$("#spinner_btn_subirContrato").hide();
	$("#btn_confirmar_contrato").attr("disabled", true);

	mostrarCanvasDosFirmas(
		["canvas_firma_cliente",
			"canvas_firma_usuario",
			"limpiar_firma_cliente",
			"limpiar_firma_usuario"
		]);

	$("#subir_contrato")[0].reset();
	$("#body-firma").show();
	$("#body-subir-contrato").hide();
	$("#id_arriendoContrato").val("");
	$("#formSpinnerContrato").show();
	global_base64_documento = null;
}


//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//


$(document).ready(() => {

	"geolocation" in navigator ? console.log("Yeih! habemus geolocalización") : alert("el navegador no soporta la geolocalización");


	$("#btn_firmar_contrato").click(() => {
		$("#btn_firmar_contrato").attr("disabled", true);
		$("#spinner_btn_firmarContrato").show();
		const options = {
			enableHighAccuracy: true,
			timeout: 5000,
			maximumAge: 0,
		};
		navigator.geolocation.getCurrentPosition(
			(success = (pos) => {
				console.log(pos);
				const geo =
					"LAT: " +
					pos.coords.latitude +
					" - LOG: " +
					pos.coords.longitude +
					" - STAMP: " +
					pos.timestamp;
				firmarContrato(geo);
			}),
			(error = (err) => {
				console.log(err);
				alert("no se logro obtener la geolocalizacion , active manualmente");
				firmarContrato("no location");
			}),
			options
		);
	});


	$("#btn_confirmar_contrato").click(() => {
		alertQuestion(async () => {
			$("#spinner_btn_confirmarContrato").show();
			$("#btn_firmar_contrato").attr("disabled", true);
			$("#btn_confirmar_contrato").attr("disabled", true);
			const data = new FormData();
			data.append("id_arriendo", $("#id_arriendoContrato").val());
			await guardarContrato(data);
			await enviarCorreoContrato(data);
			await cambiarEstadoArriendo($("#estado_arriendo").val(), $("#id_arriendoContrato").val());
			refrescarTabla();
			Swal.fire("Contrato Firmado!", "contrato firmado y registrado con exito!", "success");
			$("#btn_firmar_contrato").attr("disabled", false);
			$("#btn_confirmar_contrato").attr("disabled", false);
			$("#spinner_btn_confirmarContrato").hide();
			$("#modal_firmar_contrato").modal("toggle");
		})
	});


	$("#btn_subir_contrato").click(() => {
		const inputSubirContrato = $("#inputSubirContrato")[0].files[0];
		if ($("#inputSubirContrato").val().length == 0) {
			Swal.fire("Falta subir el archivo", "se debe ingresar el contrato firmado", "warning");
			return;
		}
		alertQuestion(async () => {
			$("#spinner_btn_subirContrato").show();
			$("#btn_subir_contrato").attr("disabled", true);
			const data = new FormData();
			data.append("id_arriendo", $("#id_arriendoContrato").val());
			data.append("inputContrato", inputSubirContrato);
			await subirContrato(data);
			await enviarCorreoContrato(data);
			await cambiarEstadoArriendo($("#estado_arriendo").val(), $("#id_arriendoContrato").val());
			Swal.fire("Contrato subido!", "contrato  registrado con exito!", "success");
			refrescarTabla();
			$("#btn_subir_contrato").attr("disabled", false);
			$("#spinner_btn_subirContrato").hide();
			$("#modal_firmar_contrato").modal("toggle");
		})
	})

	const firmarContrato = (geo) => {
		const canvasCliente = document.getElementById("canvas_firma_cliente");
		const canvasUsuario = document.getElementById("canvas_firma_usuario");
		const data = new FormData();
		data.append("inputFirmaClientePNG", canvasCliente.toDataURL("image/png"));
		data.append("inputFirmaUsuarioPNG", canvasUsuario.toDataURL("image/png"));
		data.append("geolocalizacion", geo);
		data.append("id_arriendo", $("#id_arriendoContrato").val());
		cargarContrato(data);
	};

	const guardarContrato = async (data) => {
		data.append("base64", global_base64_documento);
		await ajax_function(data, "registrar_contrato");
	};

	const subirContrato = async (data) => {
		await ajax_function(data, "subir_contrato");
	};

	const enviarCorreoContrato = async (data) => {
		await ajax_function(data, "enviar_correoContrato");
	};

})