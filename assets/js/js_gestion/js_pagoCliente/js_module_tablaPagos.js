let arrayClaveER = [];


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

        //solo mostrara los pagos pendientes de los clientes
        let cliente = true;
        arrayClaveER.map((codigo) => {
            if (codigo === pago.deudor_pago) {
                cliente = false;
            }
        })
        if (cliente) {
            try {
                tabla_totalPagos.row
                    .add([
                        pago.pagosArriendo.id_arriendo,
                        pago.deudor_pago,
                        pago.pagosArriendo.arriendo.tipo_arriendo,
                        pago.estado_pago,
                        "$ " + formatter.format(pago.total_pago),
                        pago.pagosArriendo.dias_pagoArriendo,
                        formatearFechaHora(pago.createdAt),
                        ""
                    ])
                    .draw(false);
            } catch (error) {
                console.log("error al cargar este pago")
            }
        }
    }


});