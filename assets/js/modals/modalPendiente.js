


const mostrarCollapsiblesPendiente = (info) => {
    const { arriendo, falta } = info;
    $("#containerModalPendiente").append(`
		<div class="card">
            <div class="card-header" id="heading1">
                <h2 class="mb-0">
                    <button class=" text-center btn scroll btn-outline-danger btn-block" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                     Se requieren las siguientes acciones para finalizar el arriendo Nº ${arriendo.id_arriendo} 
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
        mostrarArriendoModalVerPendiente(data.arriendo)
        mostrarCollapsiblesPendiente(data);
        try {
            totalPago_remplazo;
        } catch (error) {
            $("#modalArriendoPendiente").modal("show");
        }
        if (!data.pagos) {
            $("#btn_redirect_pendientePago").show();
            $("#txt_id_arriendo").val(data.arriendo.id_arriendo);
            $("#btn_buscar_pagos").click();
        }
        if (!data.firmas) {
            $("#btn_redirect_pendienteFirma").show();
            try {
                mostrarArriendoExtender(data.arriendo.id_arriendo);
            } catch (error) { }
            $("#modal_ArriendoExtender").modal("show");
        }
    }



    const cargarArriendoPendienteUsuario = (data) => {
        Swal.fire("Registrar arriendo bloqueado!", `terminar procesos del arriendo Nº ${data.arriendo.id_arriendo} para desbloquearlo.`, "info");
        $("#nav-registrar").hide();
        $("#nav-registrar-tab").hide();
        $("#nav-arriendos-tab").click();
    }



    const mostrarArriendoModalVerPendiente = (arriendo) => {
        if (arriendo.despacho) {
            const a = document.createElement("button");
            a.addEventListener("click", () => buscarDocumento(arriendo.despacho.actasEntrega.documento, "acta"));
            a.textContent = "Acta de entrega";
            a.className = "badge badge-pill badge-info m-1";
            document.getElementById("card_documentos_pendientes").append(a);
            if (arriendo.despacho.revision_recepcion) {
                const a = document.createElement("button");
                a.addEventListener("click", () => buscarDocumento(arriendo.despacho.revision_recepcion, "recepcion"));
                a.textContent = "Revision recepcion";
                a.className = "badge badge-pill badge-info m-1";
                document.getElementById("card_documentos_pendientes").append(a);
            }
        }
        if (arriendo.contratos) {
            let numeroContrato = 1;
            arriendo.contratos.map(contrato => {
                const a = document.createElement("button");
                a.addEventListener("click", () => buscarDocumento(contrato.documento, "contrato"));
                a.textContent = `Contrato Nº${numeroContrato}`;
                a.className = "badge badge-pill badge-info m-1";
                document.getElementById("card_documentos_pendientes").append(a);
                numeroContrato++;
            })
        }
    };



});