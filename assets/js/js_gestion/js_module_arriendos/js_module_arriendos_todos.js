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

        if (total >= 0 && digitador.length != 0 && abono.length != 0 && descuento.length != 0 && valor.length != 0) {
            $.ajax({
                url: base_route + "crear_contrato",
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
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "no se guardo el contrato",
                        text: "A ocurrido un Error Contacte a informatica",
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



    function generarPDFContrato(arriendo) {
        var numerTargeta = $("#inputNumeroTargeta").val();
        var fechaTargeta = $("#inputFechaTargeta").val();
        var cheque = $("#inputCheque").val();
        var subTotal = $("#inputValorArriendo").val();
        console.log(numerTargeta + " " + fechaTargeta + " " + cheque + " " + subTotal);
        console.log(arriendo);
    }

});