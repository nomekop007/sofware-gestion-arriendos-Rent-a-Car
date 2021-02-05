$("#m_pagoCliente").addClass("active");
$("#l_pagoCliente").addClass("card");

$("#tabla_clienteRemplazo").hide();
$("#tabla_cliente").hide();
$("#btn_pagoExtra").hide();


const formatter = new Intl.NumberFormat("CL");


const buscarPago = async (id_pago) => {
    limpiar();
    const data = new FormData();
    data.append("id_pago", id_pago);
    const response = await ajax_function(data, "buscar_pago");
    if (response.success) {
        const pago = response.data;
        $("#id_pago").val(pago.id_pago);
        $("#titulo_modal").html(`Subir comprobante del arriendo Nº ${$("#id_arriendo").val()}`);
        $("#deuda_pago").val("deuda: $ " + formatter.format(pago.total_pago));
        $("#dias_pago").val("dias: " + pago.pagosArriendo.dias_pagoArriendo);
        $("#fecha_registro").val("registro: " + formatearFechaHora(pago.createdAt));
    }
}



const tipoComprobante = (value) => {
    switch (value) {
        case "1":
            $("#card_un_comprobante").show();
            $("#card_muchos_comprobantes").hide();
            $("#btn_subirComprobantePagoTotal").show();
            $("#btn_subirComprobates").hide();
            break;
        case "2":
            $("#card_un_comprobante").hide();
            $("#card_muchos_comprobantes").show();
            $("#btn_subirComprobantePagoTotal").hide();
            $("#btn_subirComprobates").show();
            break;
    }
};

const cantidadComprobantes = (value) => {
    $("#tbody_tabla_pagos").html('');
    for (let i = 0; i < value; i++) {
        let fila = `
        <tr>
            <td class="text-center">
                <select class="form-control" id="tipoFacturacion${i}">
                    <option value="BOLETA" selected>BOLETA</option>
                    <option value="FACTURA">FACTURA</option>
                </select>
            </td>
            <td class="text-center">
                <select class="form-control" id="tipoModoPago${i}">
                    <option value="1" selected>EFECTIVO</option>
                    <option value="2">CHEQUE</option>
                    <option value="3">TARJETA</option>
                    <option value="4">TRANSFERENCIA</option>
                </select>
            </td>
             <td class="text-center">
                <input maxLength="20" id="abono${i}" placeholder="$" type="number" class="form-control" required>
            </td>
            <td class="text-center">
                <input maxLength="20" id="numeroDoc${i}" placeholder="Nº Boleta/Factura" type="number" class="form-control" required>
            </td>
            <td class="text-center">
               <input id="fileComprobante${i}" accept="image/x-png,image/gif,image/jpeg,image/jpg,application/pdf" type="file" class="form-control-file" required>
            </td>
        </tr>
        `;
        $("#tbody_tabla_pagos").append(fila)
    }
}


const limpiar = () => {
    $("#card_un_comprobante").show();
    $("#card_muchos_comprobantes").hide();
    $("#btn_subirComprobantePagoTotal").show();
    $("#btn_subirComprobates").hide();
    $("#formPagoCliente")[0].reset();
    $("#spinner_btn_registrarPago").hide();
    $("#spinner_btn_registrarPagos").hide();
    $("#tbody_tabla_pagos").html('');
}




$(document).ready(() => {
    const tabla_pagos = $("#tabla_pagosCliente").DataTable(lenguaje);





    (cargarMetodoPagos = async () => {
        //a futuro cargar los modoPago pertienetes
    })();



    $("#btn_buscar_pagos").click(async () => {
        tabla_pagos.row().clear().draw(false);
        $("#tabla_clienteRemplazo").hide();
        $("#tabla_cliente").hide();
        $("#btn_pagoExtra").hide();
        const id_arriendo = $("#txt_id_arriendo").val();
        if (id_arriendo.length > 0) {
            const data = new FormData();
            data.append("id_arriendo", id_arriendo);
            const response = await ajax_function(data, "buscar_pagoCliente");
            if (response.success) {
                $("#id_arriendo").val(id_arriendo);
                $("#inputTipoArriendo").val("TIPO: " + response.data.arriendo.tipo_arriendo);
                $("#nombreCliente").val("CLIENTE: " + response.data.cliente);
                if (response.data.arriendo.tipo_arriendo === "REEMPLAZO") {
                    $("#tabla_clienteRemplazo").show();
                } else {
                    $("#btn_pagoExtra").show();
                    $("#tabla_cliente").show();
                    $.each(response.data.pagos, (i, pago) => {
                        cargarPagosPendientesEnTabla(pago, i + 1);
                    })
                }
            } else {
                $("#inputTipoArriendo").val("");
                $("#nombreCliente").val("")
            }
        }
    });



    $("#btn_subirComprobantePagoTotal").click(() => {
        if ($("#inputNumFacturacion").val().length == 0 ||
            $("#inputFileFacturacion").val().length == 0) {
            Swal.fire("debe ingresar el comprobante de pago", "falta ingresar datos en el formulario", "warning");
            return;
        }
        alertQuestion(async () => {
            $("#spinner_btn_registrarPago").show();
            $("#btn_subirComprobantePagoTotal").attr("disabled", true)
            const form = $("#formPagoCliente")[0];
            const data = new FormData(form);
            const responseFac = await guardarDatosFactura(data);
            console.log(responseFac);
            if (responseFac.success) {
                data.append("inputDocumento", $("#inputFileFacturacion")[0].files[0]);
                data.append("id_facturacion", responseFac.data.id_facturacion);
                data.append("id_pago", $("#id_pago").val());
                await guardarDocumentoFactura(data);
                const response = await actualizarUnPagoAPagado(data);
                if (response.success) {
                    refrescarTabla();
                    Swal.fire("pago actualizado!", "se registraron los datos exitosamente!", "success");
                    $("#modal_pago").modal("toggle");
                }
            }
            $("#spinner_btn_registrarPago").hide();
            $("#btn_subirComprobantePagoTotal").attr("disabled", false)
        })
    })




    $("#btn_subirComprobates").click(() => {


        for (let i = 0; i < $("#inputCantidad").val(); i++) {
            //validar los campos de la tabla
        }


        alertQuestion(async () => {

            for (let i = 0; i < $("#inputCantidad").val(); i++) {

                const tipo_facturacion = $(`#tipoFacturacion${i}`).val();
                const id_modoPago = $(`#tipoModoPago${i}`).val();
                const abono = $(`#abono${i}`).val();
                const n_comprobante = $(`#numeroDoc${i}`).val();
                const file_comprobante = $(`#fileComprobante${i}`)[0].files[0];

                //guardar en cada interaccion
            }

        });

    })


    const guardarDatosFactura = async (data) => {
        return await ajax_function(data, "registrar_facturacion");
    };

    const guardarDocumentoFactura = async (data) => {
        return await ajax_function(data, "guardar_documentoFacturacion");
    };

    const actualizarUnPagoAPagado = async (data) => {
        return await ajax_function(data, "actualizar_pagoAPagado");
    }

    const refrescarTabla = () => {
        tabla_pagos.row().clear().draw(false);
    }



    const cargarPagosPendientesEnTabla = (pago, n) => {
        try {
            tabla_pagos.row
                .add([
                    n,
                    pago.deudor_pago,
                    pago.estado_pago,
                    "$ " + formatter.format(pago.total_pago),
                    pago.pagosArriendo.dias_pagoArriendo,
                    formatearFechaHora(pago.createdAt),
                    ` <button value='${pago.id_pago}' onclick='buscarPago(this.value)' data-toggle='modal' 
                        data-target='#modal_pago' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button>`
                ])
                .draw(false);
        } catch (error) {
            console.log("error al cargar este pago")
        }
    };





});