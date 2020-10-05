$(document).ready(() => {
	(() => {
		$("#spinner_tablaTotalArriendos").show();
		const url = base_url + "cargar_TotalArriendos";
		$.getJSON(url, (result) => {
			$("#spinner_tablaTotalArriendos").hide();
			if (result.success) {
				$.each(result.data, (i, arriendo) => {
					cargarArriendoEnTabla(arriendo);
				});
			} else {
				console.log("ah ocurrido un error al cargar los arriendos");
			}
		});
	})();

	$("#btn_crear_contrato").click(() => {
		var form = $("#formContrato")[0];
		var data = new FormData(form);

		var abono = $("#inputAbono").val();
		var descuento = $("#inputDescuento").val();
		var valor = $("#inputValorArriendo").val();
		var total = Number($("#inputTotal").val());

		//cacturando los accesorios
		var arrayNombreAccesorios = [];
		var arrayValorAccesorios = [];

		var list = $('[name="accesorios[]"]');
		for (let i = 0; i < list.length; i++) {
			var element = list[i];
			arrayNombreAccesorios.push(element.id);
			arrayValorAccesorios.push(element.value);
		}
		if (arrayNombreAccesorios.length != 0) {
			data.append("arrayNombreAccesorios", arrayNombreAccesorios);
			data.append("arrayValorAccesorios", arrayValorAccesorios);
		}

		if (
			total >= 0 &&
			abono.length != 0 &&
			descuento.length != 0 &&
			valor.length != 0
		) {
			$("#btn_crear_contrato").attr("disabled", true);
			$("#spinner_btn_crearContrato").show();

			$.ajax({
				url: base_url + "generar_PDFcontrato",
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
						console.log(response);

						/* window.location.href =
                            "data:application/octet-stream;base64," + response.data; */
						window.open(
							"data:application/octet-stream;base64," + response.data.url
						);
					} else {
						Swal.fire({
							icon: "error",
							title: response.msg,
						});
					}
					$("#btn_crear_contrato").attr("disabled", false);
					$("#spinner_btn_crearContrato").hide();
				},
				error: () => {
					Swal.fire({
						icon: "error",
						title: "a ocurrido un error al generar el contrato",
						text: "A ocurrido un Error Contacte a informatica",
					});
					$("#btn_crear_contrato").attr("disabled", false);
					$("#spinner_btn_crearContrato").hide();
				},
			});
		} else {
			Swal.fire({
				icon: "warning",
				title: "campos vacios y/o valores invalidos",
			});
		}
	});
});
