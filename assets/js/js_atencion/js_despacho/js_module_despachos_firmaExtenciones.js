//aqui se guarda el base64 del documento seleccionando
let global_base64_documento = null;

const mostrarExtencionContrato = async (id_extencion, n) => {
    limpiarCamposModalFirma();
    const data = new FormData();
    $("#title_contrato").html("Nº " + n)
    data.append("id_extencion", id_extencion);
    $("#id_extencion").val(id_extencion);
    data.append("n_extencion", n);
    $("#n_extencion").val(n);
    await cargarExtencionContrato(data);
}




const cargarExtencionContrato = async (data) => {
    const response = await ajax_function(data, "generar_PDFextencionContrato");
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
            $("#btn_confirmar_extencion").attr("disabled", false);
        }
        $("#formContratoArriendo").show();
    }
    $("#btn_firmar_extencion").attr("disabled", false);
    $("#spinner_btn_firmarContrato").hide();
    $("#formSpinnerContrato").hide();
}




const tipoContrato = (value) => {
    switch (value) {
        case "FIRMAR":
            $("#body-firma-extencion").show();
            $("#body-subir-extencion").hide();
            break;
        case "SUBIR":
            $("#body-subir-extencion").show();
            $("#body-firma-extencion").hide();
            break;
    }
}





const limpiarCamposModalFirma = () => {
    $("#formContratoArriendo").hide();
    $("#spinner_btn_firmarContrato").hide();
    $("#spinner_btn_confirmarContrato").hide();
    $("#spinner_btn_subirContrato").hide();
    $("#btn_confirmar_extencion").attr("disabled", true);
    mostrarCanvasDosFirmas(
        ["canvas_firma_cliente",
            "canvas_firma_usuario",
            "limpiar_firma_cliente",
            "limpiar_firma_usuario"
        ]);
    $("#subir_contrato")[0].reset();
    $("#body-firma-extencion").show();
    $("#body-subir-extencion").hide();
    $("#id_arriendoContrato").val("");
    $("#formSpinnerContrato").show();
    global_base64_documento = null;
}




$(document).ready(() => {

    "geolocation" in navigator ? console.log("Yeih! habemus geolocalización") : alert("el navegador no soporta la geolocalización");


    $("#btn_firmar_extencion").click(() => {
        $("#btn_firmar_extencion").attr("disabled", true);
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





    $("#btn_confirmar_extencion").click(() => {
        alertQuestion(async () => {
            $("#spinner_btn_confirmarContrato").show();
            $("#btn_firmar_extencion").attr("disabled", true);
            $("#btn_confirmar_extencion").attr("disabled", true);
            const data = new FormData();
            data.append("id_extencion", $("#id_extencion").val());
            data.append("base64", global_base64_documento);
            const response = await ajax_function(data, "registrar_extencionContrato");
            if (response.success) {
                await ajax_function(data, "enviar_correoExtencion");
                await mostrarArriendoExtender($("#id_arriendo_extencion").val());
                Swal.fire("Extencion Firmada!", "Extencion firmada y registrada con exito!", "success");
                $("#modal_firmar_contrato").modal("toggle");
            }
            $("#btn_firmar_extencion").attr("disabled", false);
            $("#btn_confirmar_extencion").attr("disabled", false);
            $("#spinner_btn_confirmarContrato").hide();
        })
    });



    $("#btn_subir_extencion").click(() => {
        const inputSubirExtencion = $("#inputSubirExtencion")[0].files[0];
        if ($("#inputSubirExtencion").val().length == 0) {
            Swal.fire("Falta subir el archivo", "se debe ingresar la extencion firmada", "warning");
            return;
        }
        alertQuestion(async () => {
            $("#spinner_btn_subirContrato").show();
            $("#btn_subir_extencion").attr("disabled", true);
            const data = new FormData();
            data.append("id_extencion", $("#id_extencion").val());
            data.append("inputContrato", inputSubirExtencion);
            const response = await ajax_function(data, "subir_extencionContrato");
            if (response.success) {
                await ajax_function(data, "enviar_correoExtencion");
                await mostrarArriendoExtender($("#id_arriendo_extencion").val());
                Swal.fire("Contrato subido!", "contrato  registrado con exito!", "success");
                $("#modal_firmar_contrato").modal("toggle");
            }
            $("#btn_subir_extencion").attr("disabled", false);
            $("#spinner_btn_subirContrato").hide();
        })
    })





    const firmarContrato = (geo) => {
        const canvasCliente = document.getElementById("canvas_firma_cliente");
        const canvasUsuario = document.getElementById("canvas_firma_usuario");
        const data = new FormData();
        data.append("inputFirmaClientePNG", canvasCliente.toDataURL("image/png"));
        data.append("inputFirmaUsuarioPNG", canvasUsuario.toDataURL("image/png"));
        data.append("geolocalizacion", geo);
        data.append("id_extencion", $("#id_extencion").val());
        data.append("n_extencion", $("#n_extencion").val());
        cargarExtencionContrato(data);
    };

})