$(document).ready(() => {
    (cargarArriendos = () => {
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
        const form = $("#formContrato")[0];
        const data = new FormData(form);
        generarContrato(data);
    });

    $("#btn_firmar_contrato").click(() => {
        const canvas = document.getElementById("canvas-firma");
        const form = $("#formContrato")[0];
        const data = new FormData(form);
        data.append("inputFirmaPNG", canvas.toDataURL("image/png"));
        generarContrato(data);
    });

    const generarContrato = async(data) => {
        const descuento = $("#inputDescuento").val();
        const valorArriendo = $("#inputValorArriendo").val();
        const valorCopago = $("#inputValorCopago").val();
        const numFacturacion = $("#inputNumFacturacion").val();
        const total = Number($("#inputTotal").val());

        //cacturando los accesorios
        const arrayNombreAccesorios = [];
        const arrayValorAccesorios = [];
        const list = $('[name="accesorios[]"]');
        for (let i = 0; i < list.length; i++) {
            let element = list[i];
            arrayNombreAccesorios.push(element.id);
            arrayValorAccesorios.push(element.value);
        }
        if (arrayNombreAccesorios.length != 0) {
            data.append("arrayNombreAccesorios", arrayNombreAccesorios);
            data.append("arrayValorAccesorios", arrayValorAccesorios);
        }

        if (
            numFacturacion.length != 0 &&
            total >= 0 &&
            descuento.length != 0 &&
            valorArriendo.length != 0 &&
            valorCopago.length != 0
        ) {
            $("#spinner_btn_firmarContrato").show();
            desactivarBotones();

            const response = await ajax_function(data, "generar_PDFcontrato");
            if (response.success) {
                if (response.data) {
                    $("#modal_signature").modal({
                        show: true,
                    });
                    $("#nombre_documento").val(response.data.nombre_documento);
                    $("#body-documento").show();
                    $("#body-firma").show();
                    $("#body-sinContrato").hide();

                    const url = storage + "documentos/contratos/" + response.data.nombre_documento + ".pdf";
                    mostrarPDF(url);

                    if (response.data.firma) {
                        $("#btn_confirmar_contrato").attr("disabled", false);
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.msg,
                    });
                }
            }
        } else {
            Swal.fire({
                icon: "warning",
                title: "campos vacios y/o valores invalidos",
            });
        }
        activarBotones();
    };

    $("#btn_confirmar_contrato").click(() => {
        Swal.fire({
            title: "Estas seguro?",
            text: "estas a punto de guardar los cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async(result) => {
            if (result.isConfirmed) {
                desactivarBotones();
                $("#spinner_btn_confirmarContrato").show();

                const form = $("#formContrato")[0];
                const data = new FormData(form);
                await guardarContrato(data);
                await guardarDatosPago(data);
                await enviarCorreoArriendo(data);
                await cambiarEstadoArriendo(data);

                refrescarTabla();
                Swal.fire(
                    "Contrato Firmado!",
                    "contrato firmado y registrado con exito!",
                    "success"
                );

                $("#modal_signature").modal("toggle");
                $("#modal_confirmar_arriendo").modal("toggle");
            }
        });
    });


    const mostrarPDF = (url) => {
        $("#body-documento").html(
            '<a href="' + url + '"  >Descargar contrato</a><br>' +
            '<iframe width="100%" height="700px" src="' + url + '" target="_parent"></iframe>'
        );
    }

    const guardarContrato = async(data) => {
        data.append("nombre_documento", $("#nombre_documento").val());
        await ajax_function(data, "registrar_contrato");
    };

    const guardarDatosPago = async(data) => {
        data.append("digitador", $("#inputDigitador").val());
        await ajax_function(data, "registrar_pago");
    };

    const enviarCorreoArriendo = async(data) => {
        await ajax_function(data, "enviar_correoArriendo");
    };

    const cambiarEstadoArriendo = async(data) => {
        data.append("estado", "FIRMADO");
        await ajax_function(data, "cambiarEstado_arriendo");
    };

    const refrescarTabla = () => {
        //limpia la tabla
        $("#tablaTotalArriendos").DataTable(lenguaje).row().clear().draw(false);
        //carga nuevamente
        cargarArriendos();
    };

    const desactivarBotones = () => {
        $("#btn_crear_contrato").attr("disabled", true);
        $("#btn_confirmar_contrato").attr("disabled", true);
        $("#btn_firmar_contrato").attr("disabled", true);
        $("#limpiar-firma").attr("disabled", true);
        $("#spinner_btn_crearContrato").show();
    };

    const activarBotones = () => {
        $("#spinner_btn_crearContrato").hide();
        $("#spinner_btn_firmarContrato").hide();
        $("#btn_crear_contrato").attr("disabled", false);
        $("#btn_firmar_contrato").attr("disabled", false);
        $("#limpiar-firma").attr("disabled", false);
    };
});