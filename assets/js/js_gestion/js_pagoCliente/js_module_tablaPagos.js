let arrayClaveER = [];


const buscarInfoPago = async (id_pago) => {
    $("#formInfoPago")[0].reset();
    const arrayComprobantes = [];
    const data = new FormData();
    data.append('id_pago', id_pago);
    const response = await ajax_function(data, "buscar_pago");
    const pago = response.data;
    console.log(pago)
    $("#titulo_modal_infoPago").html(`Arriendo N° ${pago.pagosArriendo.id_arriendo} -  monto: ${"$ " + formatter.format(pago.total_pago)}`)
    $("#info_rut_cliente").val('cliente: ' + pago.deudor_pago)
    $("#info_tipo_arriendo").val('tipo arriendo: ' + pago.pagosArriendo.arriendo.tipo_arriendo)
    $("#info_estado_arriendo").val('estado pago: ' + pago.estado_pago);
    $("#info_descripcion_pago").val(pago.pagosArriendo.observaciones_pagoArriendo);

    if (pago.facturacione) {
        arrayComprobantes.push({
            numDoc: pago.facturacione.numero_facturacion,
            facturacion: pago.facturacione.tipo_facturacion,
            modoPago: pago.facturacione.modosPago.nombre_modoPago,
            monto: "$ " + formatter.format(pago.total_pago),
            fecha: formatearFechaHora(pago.facturacione.createdAt),
            documento: pago.facturacione.documento_facturacion
        })
    }
    pago.abonos.map((abono) => {
        arrayComprobantes.push({
            numDoc: abono.facturacione.numero_facturacion,
            facturacion: abono.facturacione.tipo_facturacion,
            modoPago: abono.facturacione.modosPago.nombre_modoPago,
            monto: "$ " + formatter.format(abono.pago_abono),
            fecha: formatearFechaHora(abono.facturacione.createdAt),
            documento: abono.facturacione.documento_facturacion
        })
    });
    cargarTablaInfoPago(arrayComprobantes);
}


const cargarTablaInfoPago = (arrayComprobantes) => {
    $("#tbody_comprobantes").html('');
    arrayComprobantes.map(({ fecha, monto, modoPago, facturacion, numDoc, documento }) => {
        let fila = `
        <tr>
            <td> ${numDoc} </td>
            <td> ${facturacion} </td>
            <td> ${modoPago} </td>
            <td> ${monto} </td>
            <td> ${fecha} </td>
            <td>
            <button class="btn btn-primary btn-sm" type="button" onClick="buscarDocumento('${documento}','facturacion')"> <i class="fas fa-upload"></i> </button>
            </td>
        </tr>`;
        $("#tbody_comprobantes").append(fila)
    });

}


$(document).ready(() => {

    $("#nav-pagostotal-tab").click(() => refrescarTablatotal());
    const tabla_totalPagos = $("#tabla_totalPagos").DataTable(lenguaje);



    (cargarEmpresasRemplazo = async () => {
        const response = await ajax_function(null, "cargar_empresasRemplazo");
        if (response.success) {
            $.each(response.data, (i, object) => {
                arrayClaveER.push(object["codigo_empresaRemplazo"]);
            });
        }
    })();


    const cargarTodosLosPagos = async () => {
        $("#spinner_tabla_pagos").show()
        const response = await ajax_function(null, "cargar_pagosCliente");
        $.each(response.data, (i, pago) => {
            cargarTablaTotalPagos(pago);
        })
        $("#spinner_tabla_pagos").hide();
    }


    const refrescarTablatotal = () => {
        tabla_totalPagos.row().clear().draw(false);
        cargarTodosLosPagos();
    }



    const cargarTablaTotalPagos = (pago) => {
        try {
            //solo mostrara los pagos pendientes de los clientes
            let cliente = true;
            let estado = '';
            let btnInfo = '';
            arrayClaveER.map((codigo) => {
                if (codigo === pago.deudor_pago) {
                    cliente = false;
                }
            })
            if (!cliente) return;
            if (pago.pagosArriendo.arriendo.estado_arriendo === "ANULADO") return;

            if (pago.abonos.length > 0 || pago.estado_pago == 'PAGADO') {
                btnInfo = ` <button value='${pago.id_pago}' onclick='buscarInfoPago(this.value)' data-toggle='modal' 
                data-target='#modal_infoPago' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>`;
            }
            if (pago.estado_pago == 'PAGADO') {
                estado = `<p class='text-success'> ${pago.estado_pago} </p>`
            } else {
                estado = `<p class='text-danger'>  ${pago.estado_pago} </p>`
            }
            if (pago.pagosArriendo.arriendo.tipo_arriendo === "REEMPLAZO") {
                if (pago.estado_pago == 'PENDIENTE') estado = `<p class='text-warning'> VIGENTE </p>`;
            }
            tabla_totalPagos.row
                .add([
                    pago.pagosArriendo.id_arriendo,
                    pago.deudor_pago,
                    pago.pagosArriendo.arriendo.tipo_arriendo,
                    estado,
                    "$ " + formatter.format(pago.total_pago),
                    pago.pagosArriendo.dias_pagoArriendo,
                    formatearFechaHora(pago.createdAt),
                    btnInfo
                ])
                .draw(false);
        } catch (error) {
            console.log("error al cargar este pago")
        }
    }


});