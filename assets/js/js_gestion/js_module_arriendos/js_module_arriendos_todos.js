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
        if ($("#textTipo").val() == "REMPLAZO") {
            $("#inputNumFacturacion").val("COPAGO");
        }

        if (
            $("#inputNumFacturacion").val().length != 0 &&
            total >= 0 &&
            abono.length != 0 &&
            descuento.length != 0 &&
            valor.length != 0
        ) {
            Swal.fire({
                title: "Estas seguro?",
                text: "Estas a punto de generar un nuevo contrato!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, seguro",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
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
                                $("#modal_signature").modal({
                                    show: true,
                                });

                                $("#body-signature").html(
                                    '<iframe width="100%" height="700px" src="' +
                                    response.url +
                                    '" target="_parent"></iframe>'
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
                }
            });
        } else {
            Swal.fire({
                icon: "warning",
                title: "campos vacios y/o valores invalidos",
            });
        }
    });

    //funcion anonima que escucha los eventos del iframe signature
    (() => {
        window.addEventListener("message", async(e) => {
            // e.data.event       = EVENT_TYPE
            // e.data.documentId  = DOCUMENT_ID
            // e.data.signatureId = SIGNATURE_ID
            if (e.data.event === "completed") {
                //poner spiner
                await guardarContrato(e.data.documentId);
                await guardarDatosPago();
                await guardarDatosGarantia();
                await guardarFacturacion();

                // $('iframe').remove();
            }
        });
    })();

    async function guardarContrato(DOCUMENT_ID) {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        data.append("id_documento", DOCUMENT_ID);
        await funAjaxGuardar(data, "registrar_contrato");
    }

    async function guardarDatosPago() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "registrar_pago");
    }

    async function guardarDatosGarantia() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "registrar_garantia");
    }

    async function guardarFacturacion() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);

        //PENDIENTE
        var facturacion = $("input[name=customRadio1]");
        console.log(facturacion);
        if (condition) {
            await funAjaxGuardar(data, "registrar_boleta");
        } else {
            await funAjaxGuardar(data, "registrar_factura");
        }
    }
});