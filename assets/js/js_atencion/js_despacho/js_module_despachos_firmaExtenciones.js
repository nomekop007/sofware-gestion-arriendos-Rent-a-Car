const mostrarExtencionContrato = async (id_extencion,n) => {
    limpiarCamposModalFirma();
    const data = new FormData();
    $("#title_contrato").html("Nº " + n)
    data.append("id_extencion", id_extencion);
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



$(document).ready(() => {





})