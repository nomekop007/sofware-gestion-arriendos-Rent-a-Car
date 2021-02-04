$("#m_pagoCliente").addClass("active");
$("#l_pagoCliente").addClass("card");
let arrayClaveER = [];
const formatter = new Intl.NumberFormat("CL");


const buscarPago = (id_pago) => {
    limpiar();
    const id_arriendo = $("#id_arriendo").val();
    $("#id_pago").val(id_pago);
    $("#titulo_modal").html(`Pago Nº ${id_pago} del arriendo Nº ${id_arriendo}`);


}



const limpiar = () => {
    $("#formPagoArriendo")[0].reset();
    $("#spinner_btn_registrarPago").hide();
}







$(document).ready(() => {
    const tabla_pagos = $("#tabla_pagosCliente").DataTable(lenguaje);

    (cargarEmpresasRemplazo = async () => {
        const response = await ajax_function(null, "cargar_empresasRemplazo");
        if (response.success) {
            $.each(response.data, (i, object) => {
                arrayClaveER.push(object["codigo_empresaRemplazo"]);
            });
        }
    })();


    const cargarPagos = async () => {
        const response = await ajax_function(null, "cargar_pagosCliente");
        console.log(response);
    }
    cargarPagos();


    $("#btn_buscar_pagos").click(async () => {
        tabla_pagos.row().clear().draw(false);
        const id_arriendo = $("#txt_id_arriendo").val();
        if (id_arriendo.length > 0) {
            const data = new FormData();
            data.append("id_arriendo", id_arriendo);
            const response = await ajax_function(data, "buscar_pagoCliente");
            if (response.success) {
                $("#id_arriendo").val(id_arriendo);
                $("#inputTipoArriendo").val("TIPO: " + response.data.arriendo.tipo_arriendo);
                $("#nombreCliente").val("CLIENTE: " + response.data.cliente);
                $.each(response.data.pagos, (i, pago) => {
                    cargarPagosEnTabla(pago);
                })
            } else {
                $("#inputTipoArriendo").val("");
                $("#nombreCliente").val("")
            }
        }
    });



    const cargarPagosEnTabla = (pago) => {
        try {
            tabla_pagos.row
                .add([
                    pago.id_pago,
                    pago.pagosArriendo.dias_pagoArriendo,
                    pago.estado_pago,
                    "$ " + formatter.format(pago.total_pago),
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