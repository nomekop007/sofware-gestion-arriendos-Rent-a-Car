$(document).ready(() => {
    cargarArriendos();

    $("#btn_crear_contrato").click(() => {
        var form = $("#formContrato")[0];
        var data = new FormData(form);

        generarContrato(data);
    });

    $("#btn_firmar_contrato").click(() => {
        var canvas = document.getElementById("canvas-firma");

        var form = $("#formContrato")[0];
        var data = new FormData(form);
        data.append("inputFirmaPNG", canvas.toDataURL("image/png"));

        generarContrato(data);
    });

    function generarContrato(data) {
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
            $("#spinner_btn_firmarContrato").show();
            desactivarBotones();

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
                        $("#nombre_documento").val(response.nombre_documento);
                        $("#body-documento").show();
                        $("#body-firma").show();
                        $("#body-sinContrato").hide();

                        $("#body-documento").html(
                            '<iframe width="100%" height="700px" src="' +
                            storage +
                            "documentos/contratos/" +
                            response.nombre_documento +
                            ".pdf" +
                            '" target="_parent"></iframe>'
                        );
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: response.msg,
                        });
                    }
                    activarBotones();
                    if (response.firma) {
                        $("#btn_confirmar_contrato").attr("disabled", false);
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "a ocurrido un error al generar el contrato",
                        text: "A ocurrido un Error Contacte a informatica",
                    });

                    activarBotones();
                },
            });
        } else {
            Swal.fire({
                icon: "warning",
                title: "campos vacios y/o valores invalidos",
            });
        }
    }

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

                await guardarContrato();
                await guardarDatosPago();
                await guardarDatosGarantia();
                await enviarCorreoArriendo();
                await cambiarEstadoArriendoVehiculo();

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

    async function guardarContrato() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        data.append("nombre_documento", $("#nombre_documento").val());
        await funAjaxGuardar(data, "registrar_contrato");
    }

    async function guardarDatosPago() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        data.append("digitador", $("#inputDigitador").val());
        await funAjaxGuardar(data, "registrar_pago");
    }

    async function guardarDatosGarantia() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "registrar_garantia");
    }

    async function enviarCorreoArriendo() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "enviar_correoArriendo");
    }

    async function cambiarEstadoArriendoVehiculo() {
        var form = $("#formContrato")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "cambiarEstado_arriendo");
    }

    function refrescarTabla() {
        //limpia la tabla
        $("#tablaTotalArriendos").DataTable(lenguaje).row().clear().draw(false);
        //carga nuevamente
        cargarArriendos();
    }

    function cargarArriendos() {
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
    }

    function desactivarBotones() {
        $("#btn_crear_contrato").attr("disabled", true);
        $("#btn_confirmar_contrato").attr("disabled", true);
        $("#btn_firmar_contrato").attr("disabled", true);
        $("#limpiar-firma").attr("disabled", true);
        $("#spinner_btn_crearContrato").show();
    }

    function activarBotones() {
        $("#spinner_btn_crearContrato").hide();
        $("#spinner_btn_firmarContrato").hide();
        $("#btn_crear_contrato").attr("disabled", false);
        $("#btn_firmar_contrato").attr("disabled", false);
        $("#limpiar-firma").attr("disabled", false);
    }
});