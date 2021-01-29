<!-- Modal extender plazo arriendo-->
<div class="modal fade" id="modal_ArriendoExtender" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ArriendoExtenderLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoExtenderLabel">Extender plazo arriendo <span id="numeroArriendo">Nº</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner_extender_arriendo">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="body_extender_arriendo">
                <form class="needs-validation" id="formExtenderArriendo" novalidate>
                    <input id="id_arriendo" name="id_arriendo" type="text" hidden>
                    <input id="dias_arriendo" name="dias_arriendo" type="text" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputFechaRecepcion_extenderPlazo">Fecha de recepcion</label>
                            <input disabled class="form-control" type="text" name="inputFechaRecepcion_extenderPlazo" id="inputFechaRecepcion_extenderPlazo" readonly required />
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputFechaExtender_extenderPlazo">Fecha a extender</label>
                            <input type="text" class="form-control" name="inputFechaExtender_extenderPlazo" id="inputFechaExtender_extenderPlazo" readonly required />
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputNumeroDias_extenderPlazo">Dias</label>
                            <input min="0" oninput="calcularDiasExtencion()" type="number" class="form-control" name="inputNumeroDias_extenderPlazo" id="inputNumeroDias_extenderPlazo" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" id="btn_extenderArriendo" class="btn btn-primary">extender plazo
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_extenderArriendo"></span>
                </button>
            </div>
        </div>
    </div>
</div>