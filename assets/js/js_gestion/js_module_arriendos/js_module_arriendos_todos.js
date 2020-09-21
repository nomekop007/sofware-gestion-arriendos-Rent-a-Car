$(document).ready(() => {
    (() => {
        const url = base_route + "cargar_TotalArriendos";
        $.getJSON(url, (result) => {
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

        var digitador = $("#inputDigitador").val();
        var abono = $("#inputAbono").val();
        var descuento = $("#inputDescuento").val();
        var valor = $("#inputValorArriendo").val();
        var total = Number($("#inputTotal").val());

        if (
            total >= 0 &&
            digitador.length != 0 &&
            abono.length != 0 &&
            descuento.length != 0 &&
            valor.length != 0
        ) {
            $("#btn_crear_contrato").attr("disabled", true);
            $("#spinner_btn_crearContrato").show();

            $.ajax({
                url: base_route + "registrar_pagoArriendo",
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
                        generarPDFContrato(response.data);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "ah ocurrido un error al guardar",
                        });
                        $("#btn_crear_contrato").attr("disabled", false);
                        $("#spinner_btn_crearContrato").hide();
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "no se guardo el contrato",
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
            $("#btn_crear_contrato").attr("disabled", false);
            $("#spinner_btn_crearContrato").hide();
        }
    });

    function generarPDFContrato(id_arriendo) {
        var numerTargeta = Number($("#inputNumeroTargeta").val());
        var fechaTargeta = $("#inputFechaTargeta").val();
        var cheque = $("#inputCheque").val();
        var subTotal = Number($("#inputValorArriendo").val());

        $.ajax({
            url: base_route + "generar_pdfContratoArriendo",
            type: "post",
            dataType: "json",
            data: {
                id_arriendo,
                numerTargeta,
                fechaTargeta,
                cheque,
                subTotal,
            },
            success: (response) => {
                $("#btn_crear_contrato").attr("disabled", false);
                $("#spinner_btn_crearContrato").hide();
                if (response.success) {
                    window.location.href =
                        "data:application/octet-stream;base64," + response.data;
                    //		window.open(response.data, "_blank");
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: response.msg,
                    });
                }
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardo el contrato",
                    text: "A ocurrido un Error Contacte a informatica",
                });
                $("#btn_crear_contrato").attr("disabled", false);
                $("#spinner_btn_crearContrato").hide();
            },
        });
    }
});