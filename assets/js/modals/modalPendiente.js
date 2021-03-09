


const mostrarCollapsiblesPendiente = (info) => {
    const { id_arriendo, falta } = info;
    $("#containerModalPendiente").append(`
		<div class="card">
            <div class="card-header" id="heading1">
                <h2 class="mb-0">
                    <button class=" text-center btn scroll btn-outline-danger btn-block" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                     Se requieren las siguientes acciones para finalizar el arriendo Nº ${id_arriendo} 
                    </button>
                </h2>
            </div>
            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#containerModalPendiente">
                <div class="card-body text-center">
					${falta.map(({ msg }) => (`<br><i class="far text-danger fa-check-square"></i> ${msg} <br>`))}
				</div>
            </div>
        </div>`);
}


$(document).ready(() => {


    (cargarArriendosPendientesDelUsuario = async () => {
        $("#btn_redirect_pendientePago").hide();
        $("#btn_redirect_pendienteFirma").hide();
        const response = await ajax_function(null, "revisar_bloqueoUsuario");
        console.log(response.data)
        if (response.data) {
            switch (response.data.tipo) {
                case 'RECEPCION':
                    cargarRecepcionPendienteUsuario(response.data);
                    break;
                case 'PROCESO':
                    cargarArriendoPendienteUsuario(response.data);
                    break;
                default:
                    break;
            }
        }
    })();


    const cargarRecepcionPendienteUsuario = (data) => {
        mostrarCollapsiblesPendiente(data);
        try {
            totalPago_remplazo;
        } catch (error) {
            $("#modalArriendoPendiente").modal("show");
        }
        if (!data.pagos) {
            $("#btn_redirect_pendientePago").show();
            $("#txt_id_arriendo").val(data.id_arriendo);
            $("#btn_buscar_pagos").click();
        }
        if (!data.firmas) {
            $("#btn_redirect_pendienteFirma").show();
            try {
                mostrarArriendoExtender(data.id_arriendo);
            } catch (error) { }
            $("#modal_ArriendoExtender").modal("show");
        }
    }

    const cargarArriendoPendienteUsuario = (data) => {
        Swal.fire("Registrar arriendo bloqueado!", `terminar procesos del arriendo Nº ${data.id_arriendo} para desbloquearlo.`, "info");
        $("#nav-registrar").hide();
        $("#nav-registrar-tab").hide();
        $("#nav-arriendos-tab").click();
    }

});