$("#m_pagoCliente").addClass("active");
$("#l_pagoCliente").addClass("card");

$("#tabla_clienteRemplazo").hide();
$("#tabla_cliente").hide();
$("#btn_pagoExtra").hide();

const array_id_pagosRemplazo = [];
let totalPago_remplazo = 0;
let totalDias_remplazo = 0;

const formatter = new Intl.NumberFormat("CL");




const modalSubirPagoRemplazo = () => {
    limpiar();
    $("#titulo_modal").html(`Subir comprobante del arriendo Nº ${$("#id_arriendo").val()}`);
    $("#deuda_pago").val($("#total_a_pagar").html());
    $("#dias_pago").val($("#dias_totales").html());
    $("#fecha_registro").val("cantidad de pagos: " + array_id_pagosRemplazo.length);
}




const modalSubirPago = async (id_pago) => {
    limpiar();
    const data = new FormData();
    data.append("id_pago", id_pago);
    const response = await ajax_function(data, "buscar_pago");
    if (response.success) {
        const pago = response.data;
        $("#id_pago").val(pago.id_pago);
        $("#titulo_modal").html(`Subir comprobante del arriendo Nº ${$("#id_arriendo").val()}`);
        $("#deuda_real_pago").val(pago.total_pago);
        $("#deuda_pago").val("monto: $ " + formatter.format(pago.total_pago));
        $("#dias_pago").val("dias: " + pago.pagosArriendo.dias_pagoArriendo);
        $("#fecha_registro").val("registro: " + formatearFechaHora(pago.createdAt));
    }
}

const recalcularPagoDescuento = (desc) => {
    let descuento = Number(desc);
    let precioAntiguo = Number(totalPago_remplazo);
    let precioNuevo = precioAntiguo - descuento;
    $("#total_a_pagar").html(`Total pago: ${formatter.format(precioNuevo)} `);
}

const recalcularPagoExtra = (desc) => {
    let cobro = Number(desc);
    let precioAntiguo = Number(totalPago_remplazo);
    let precioNuevo = precioAntiguo + cobro;
    $("#total_a_pagar").html(`Total pago: ${formatter.format(precioNuevo)} `);
}

const recalculaDiasRestantes = (dias_restantes) => {
    let dias = Number(totalDias_remplazo) - Number(dias_restantes);
    $("#dias_totales").html(`dias totales: ${dias}`);
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


const recalcularPagoParcial = () => {
    let totalParcila = 0;
    for (let i = 0; i < $("#inputCantidad").val(); i++) {
        totalParcila += Number($(`#abono${i}`).val());
    }
    $("#pagoTotal_parcial_pago").val("$ " + formatter.format(totalParcila));
}

const cantidadComprobantes = (value) => {
    $("#pagoTotal_parcial_pago").val("0");
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
                <input maxLength="20" oninput="recalcularPagoParcial()" value=0 id="abono${i}" placeholder="$" type="number" class="form-control" required>
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
    $("#spinner_btn_registrarMuchosPagos").hide();
    $("#tbody_tabla_pagos").html('');
    $("#id_pago").val('');
    $("#titulo_modal").html('');
    $("#deuda_pago").val('');
    $("#dias_pago").val('');
    $("#fecha_registro").val('');
    $("#pagoTotal_parcial_pago").val("0");
    $("#deuda_real_pago").val("")
}




$(document).ready(() => {


    const tabla_pagos = $("#tabla_pagosCliente").DataTable(lenguaje);


    (cargarMetodoPagos = async () => {
        //a futuro cargar los modoPago pertienetes
    })();


    $("#btn_buscar_pagos").click(async () => {
        limpiarBuscarPagos();
        const id_arriendo = $("#txt_id_arriendo").val();
        if (id_arriendo.length > 0) {
            const data = new FormData();
            data.append("id_arriendo", id_arriendo);
            const response = await ajax_function(data, "buscar_pagoCliente");
            if (response.success) {
                if (response.data.arriendo.estado_arriendo === "ANULADO" ||
                    response.data.arriendo.estado_arriendo == "PENDIENTE") {
                    Swal.fire({ icon: "error", title: "Este arriendo esta pendiente o anulador!", });
                    return;
                }
                $("#id_arriendo").val(id_arriendo);
                $("#tipo_arriendo").val(response.data.arriendo.tipo_arriendo);
                $("#inputTipoArriendo").val("TIPO: " + response.data.arriendo.tipo_arriendo);
                $("#nombreCliente").val("CLIENTE: " + response.data.cliente);
                if (response.data.arriendo.tipo_arriendo === "REEMPLAZO") {
                    mostrarTablaClienteRemplazo(id_arriendo);
                } else {
                    mostrarTablaCliente(response.data.pagos);
                }
            }
        }
    });


    $("#btn_pagosExtras").click(() => {


    });


    $("#btn_createPagoExtra").click(() => {
        const form = $("#formPagoExtra")[0];


    });



    const mostrarTablaCliente = (pagos) => {
        $("#btn_pagoExtra").show();
        $("#tabla_cliente").show();
        $.each(pagos, (i, pago) => {
            cargarPagosPendientesEnTabla(pago, i + 1);
        })
    }



    const mostrarTablaClienteRemplazo = async (id_arriendo) => {
        const data = new FormData();
        data.append('id_arriendo', id_arriendo);
        const response = await ajax_function(data, "consultar_pagoArriendos");
        if (response.success) {
            const { arrayPago, totalPago, arriendo } = response.data;
            $.each(arrayPago, (i, object) => {
                cargarPagosRemplazoEnTabla(object, i + 1);
            })
            totalPago_remplazo = totalPago;
            totalDias_remplazo = arriendo.diasAcumulados_arriendo;
            $("#total_a_pagar").html(`Total pago: ${formatter.format(totalPago_remplazo)} `);
            $("#dias_totales").html(`dias totales: ${arriendo.diasAcumulados_arriendo}`);
            $("#tabla_clienteRemplazo").show();
        }
    }



    $("#btn_subirComprobantePagoTotal").click(() => {
        // se evalua si es un arriendo de reemplazo o no
        ($("#tipo_arriendo").val() === 'REEMPLAZO') ? guardarComprobanteRemplazo() : guardarComprobante();
    })

    $("#btn_subirComprobates").click(() => {
        // se evalua si es un arriendo de reemplazo o no
        ($("#tipo_arriendo").val() === 'REEMPLAZO') ? guardarMuchosComprobantesRemplazo() : guardarMuchosComprobantes();
    })



    const guardarComprobante = () => {
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
            const responseFac = await ajax_function(data, "registrar_facturacion");
            if (responseFac.success) {
                data.append("inputDocumento", $("#inputFileFacturacion")[0].files[0]);
                data.append("id_facturacion", responseFac.data.id_facturacion);
                data.append("id_pago", $("#id_pago").val());
                await ajax_function(data, "guardar_documentoFacturacion");
                const response = await ajax_function(data, "actualizar_pagoAPagado");
                if (response.success) {
                    limpiarBuscarPagos();
                    Swal.fire("pago actualizado!", "se registraron los datos exitosamente!", "success");
                    $("#modal_pago").modal("toggle");
                }
            }
            $("#spinner_btn_registrarPago").hide();
            $("#btn_subirComprobantePagoTotal").attr("disabled", false)
        })
    }


    const guardarComprobanteRemplazo = () => {
        if ($("#descuento_pago").val() < 0 ||
            $("#extra_pago").val() < 0 ||
            $("#descuento_pago").val().length == 0 ||
            $("#extra_pago").val().length == 0) {
            Swal.fire("campo vacio o invalidos", "rellene los campos erroneos", "warning");
            return;
        }
        if ($("#descuento_pago").val() > 0 &&
            $("#extra_pago").val() > 0) {
            Swal.fire("valores invalidos", "no se puede aplicar un cobro extra y un descuento a la vez! , corriga", "warning");
            return;
        }
        if (totalPago_remplazo != 0 ||
            $("#descuento_pago").val() != 0 ||
            $("#extra_pago").val() != 0) {
            if ($("#inputNumFacturacion").val().length == 0 ||
                $("#inputFileFacturacion").val().length == 0) {
                Swal.fire("faltan datos en el formulario", "debe ingresar el Nº facturacion con su respectivo comprobante", "warning");
                return;
            }
        }
        alertQuestion(async () => {
            $("#spinner_btn_registrarPago").show();
            $("#btn_subirComprobantePagoTotal").attr("disabled", true)
            const form = $("#formPagoCliente")[0];
            const data = new FormData(form);
            data.append("arrayPagos", JSON.stringify(array_id_pagosRemplazo));
            data.append("descuento_pago", $("#descuento_pago").val());
            data.append("extra_pago", $("#extra_pago").val());
            data.append("inputDocumento", $("#inputFileFacturacion")[0].files[0]);
            data.append('dias_restantes', $("#dias_restantes").val());
            data.append("inputObservaciones", `${$("#inputObservaciones").val()} ${$("#inputObservaciones2").val()} `);
            const responseDescuento = await ajax_function(data, "aplicarDescuento_UltimoPago");
            if (responseDescuento.success) {
                if ($("#inputFileFacturacion").val().length != 0) {
                    const responseFactura = await ajax_function(data, "registrar_facturacion");
                    if (responseFactura.success) {
                        data.append("id_facturacion", responseFactura.data.id_facturacion);
                        await ajax_function(data, "guardar_documentoFacturacion");
                    }
                }
                const responsePago = await ajax_function(data, "actualizar_pagos");
                if (responsePago.success) {
                    limpiarBuscarPagos();
                    Swal.fire("pago actualizado!", "se registraron los datos exitosamente!", "success");
                    $("#modal_pago").modal("toggle");
                }
            }
            $("#spinner_btn_registrarPago").hide();
            $("#btn_subirComprobantePagoTotal").attr("disabled", false)
        });
    }



    const guardarMuchosComprobantes = () => {
        let validacion = true;
        let verificarMonto = 0;
        for (let i = 0; i < $("#inputCantidad").val(); i++) {
            verificarMonto += Number($(`#abono${i}`).val());
            if ($(`#abono${i}`).val().length === 0 || $(`#numeroDoc${i}`).val().length === 0 || $(`#fileComprobante${i}`).val().length === 0) {
                Swal.fire("faltan datos", "falta ingresar datos en la tabla", "warning");
                validacion = false;
                return;
            }
        }

        if (verificarMonto !== Number($("#deuda_real_pago").val())) {
            Swal.fire("monto incorrecto", "el monto acumulado no coincide con el monto a pagar", "warning");
            return;
        }

        if (validacion && $("#inputCantidad").val() != 'null') {
            let nuevoMonto = 0;
            alertQuestion(async () => {
                $("#spinner_btn_registrarMuchosPagos").show();
                $("#btn_subirComprobates").attr("disabled", true)
                for (let i = 0; i < $("#inputCantidad").val(); i++) {
                    nuevoMonto += Number($(`#abono${i}`).val());
                    const data = new FormData();
                    data.append('id_pago', $("#id_pago").val());
                    data.append('pago_abono', $(`#abono${i}`).val());
                    data.append('tipo_facturacion', $(`#tipoFacturacion${i}`).val());
                    data.append('id_modoPago', $(`#tipoModoPago${i}`).val());
                    data.append('numero_facturacion', $(`#numeroDoc${i}`).val());
                    const response = await ajax_function(data, "registrar_abono");
                    if (response.success) {
                        data.append('id_facturacion', response.data.id_facturacion);
                        data.append('inputDocumento', $(`#fileComprobante${i}`)[0].files[0]);
                        await ajax_function(data, "guardar_documentoFacturacion");
                    }
                }
                const data = new FormData();
                data.append('id_pago', $("#id_pago").val());
                data.append('nuevo_monto', nuevoMonto);
                await ajax_function(data, "actualizar_montoPago");
                // await ajax_function(data, "actualizar_pagoAPagado");
                $("#spinner_btn_registrarMuchosPagos").hide();
                $("#btn_subirComprobates").attr("disabled", false)
                limpiarBuscarPagos();
                Swal.fire("pago actualizado!", "se registraron los datos exitosamente!", "success");
                $("#modal_pago").modal("toggle");
            });
        }
    }


    const guardarMuchosComprobantesRemplazo = () => {
        let validacion = true;
        for (let i = 0; i < $("#inputCantidad").val(); i++) {
            if ($(`#abono${i}`).val().length === 0 || $(`#numeroDoc${i}`).val().length === 0 || $(`#fileComprobante${i}`).val().length === 0) {
                Swal.fire("faltan datos", "falta ingresar datos en la tabla", "warning");
                validacion = false;
                return;
            }
        }
        if ($("#descuento_pago").val() < 0 ||
            $("#extra_pago").val() < 0 ||
            $("#descuento_pago").val().length == 0 ||
            $("#extra_pago").val().length == 0) {
            Swal.fire("campo vacio o invalidos", "rellene los campos erroneos", "warning");
            return;
        }
        if ($("#descuento_pago").val() > 0 &&
            $("#extra_pago").val() > 0) {
            Swal.fire("valores invalidos", "no se puede aplicar un cobro extra y un descuento a la vez! , corriga", "warning");
            return;
        }
        if (validacion && $("#inputCantidad").val() != 'null') {
            alertQuestion(async () => {
                $("#spinner_btn_registrarMuchosPagos").show();
                $("#btn_subirComprobates").attr("disabled", true)
                const form = $("#formPagoCliente")[0];
                const data = new FormData(form);
                data.append("arrayPagos", JSON.stringify(array_id_pagosRemplazo));
                data.append("descuento_pago", $("#descuento_pago").val());
                data.append("extra_pago", $("#extra_pago").val());
                data.append('dias_restantes', $("#dias_restantes").val());
                data.append("inputObservaciones", `${$("#inputObservaciones").val()} ${$("#inputObservaciones2").val()} `);
                const responseDescuento = await ajax_function(data, "aplicarDescuento_UltimoPago");
                if (responseDescuento.success) {
                    array_id_pagosRemplazo.map(async (id_pago) => {
                        for (let i = 0; i < $("#inputCantidad").val(); i++) {
                            const data = new FormData();
                            data.append('id_pago', id_pago);
                            data.append('pago_abono', $(`#abono${i}`).val());
                            data.append('tipo_facturacion', $(`#tipoFacturacion${i}`).val());
                            data.append('id_modoPago', $(`#tipoModoPago${i}`).val());
                            data.append('numero_facturacion', $(`#numeroDoc${i}`).val());
                            const response = await ajax_function(data, "registrar_abono");
                            if (response.success) {
                                data.append('id_facturacion', response.data.id_facturacion);
                                data.append('inputDocumento', $(`#fileComprobante${i}`)[0].files[0]);
                                await ajax_function(data, "guardar_documentoFacturacion");
                            }
                        }
                        const data = new FormData();
                        data.append('id_pago', id_pago);
                        await ajax_function(data, "actualizar_pagoAPagado");
                    })
                    limpiarBuscarPagos();
                    Swal.fire("pago actualizado!", "se registraron los datos exitosamente!", "success");
                    $("#modal_pago").modal("toggle");
                }
                $("#spinner_btn_registrarMuchosPagos").hide();
                $("#btn_subirComprobates").attr("disabled", false)
            });
        }
    }


    const cargarPagosRemplazoEnTabla = ({ pago, pagoArriendo }, n) => {
        let html = `
        <tr>
            <th scope="row"> ${n} </th>
            <td> ${pago.deudor_pago.replace("@", "")} </td>
            <td> ${pago.estado_pago}</td>
            <td> $ ${formatter.format(pago.total_pago)} </td>
            <td> ${pagoArriendo.dias_pagoArriendo} </td>
            <td> ${formatearFechaHora(pago.createdAt)} </td>
        </tr>`;
        $("#tablaPago").append(html);
        array_id_pagosRemplazo.push(pago.id_pago);
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
                    ` <button value='${pago.id_pago}' onclick='modalSubirPago(this.value)' data-toggle='modal' 
                        data-target='#modal_pago' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> `
                ])
                .draw(false);
        } catch (error) {
            console.log("error al cargar este pago")
        }
    };

    const limpiarBuscarPagos = () => {
        tabla_pagos.row().clear().draw(false);
        array_id_pagosRemplazo.length = 0;
        $("#tablaPago").html('');
        $("#tabla_clienteRemplazo").hide();
        $("#tabla_cliente").hide();
        $("#btn_pagoExtra").hide();
        $("#inputTipoArriendo").val("");
        $("#nombreCliente").val("");
        $("#tipo_arriendo").val("");
    }



});