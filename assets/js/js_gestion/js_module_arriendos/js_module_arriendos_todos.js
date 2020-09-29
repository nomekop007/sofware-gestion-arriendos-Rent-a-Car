$(document).ready(() => {
    (() => {
        $("#spinner_tablaTotalArriendos").show();
        const url = base_route + "cargar_TotalArriendos";
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

        if (
            total >= 0 &&
            abono.length != 0 &&
            descuento.length != 0 &&
            valor.length != 0
        ) {
            $("#btn_crear_contrato").attr("disabled", true);
            $("#spinner_btn_crearContrato").show();

            $.ajax({
                url: base_route + "generar_PDFcontrato",
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
                            "data:application/octet-stream;base64," + response.data
                        );
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "ah ocurrido un error al generar el contrato",
                        });
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "a ocurridov un error al generar el contrato",
                        text: "A ocurrido un Error Contacte a informatica",
                    });
                },
            });
            $("#btn_crear_contrato").attr("disabled", false);
            $("#spinner_btn_crearContrato").hide();
        } else {
            Swal.fire({
                icon: "warning",
                title: "campos vacios y/o valores invalidos",
            });
        }
    });
});