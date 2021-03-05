


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


    (cargarArriendosPendientesCliente = async () => {
        $("#btn_redirect_pendientePago").hide();
        $("#btn_redirect_pendienteFirma").hide();
        const response = await ajax_function(null, "revisar_recepcionUsuario");
        if (response.data) {
            mostrarCollapsiblesPendiente(response.data);
            try {
                totalPago_remplazo;
            } catch (error) {
                $("#modalArriendoPendiente").modal("show");
            }
            if (!response.data.pagos) {
                $("#btn_redirect_pendientePago").show();
                $("#txt_id_arriendo").val(response.data.id_arriendo);
                $("#btn_buscar_pagos").click();
            }
            if (!response.data.firmas) {
                $("#btn_redirect_pendienteFirma").show();
                try {
                    mostrarArriendoExtender(response.data.id_arriendo);
                } catch (error) { }
                $("#modal_ArriendoExtender").modal("show");
            }
        }
    })();


});