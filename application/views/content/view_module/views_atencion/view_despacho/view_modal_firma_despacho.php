<!-- Modal signature-->
<div class="modal fade" id="modal_signature" tabindex="-1" aria-labelledby="signatureModal" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_signature">Firmar Acta de entrega </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="body-sinContrato">
                    <br>
                    <h6 class='text-center'>Sin Acta de entrega cargado</h6><br>
                </div>
                <div id="body-firma">
                    <div class="container ">
                        <a class="row justify-content-md-center btn-success" target="_blank" id="descargar_actaEntrega">
                            <i class="fas fa-download"></i>
                            Descargar Acta de entrega</a>
                        <br>
                        <button id="prev_despacho" class=" btn-info">
                            < </button> <button id="next_despacho" class=" btn-info "> >
                                </button>

                                &nbsp; &nbsp;
                                <span>Pagina: <span id="page_num_despacho"></span> / <span
                                        id="page_count_despacho"></span></span>
                                <canvas id="pdf_canvas_despacho" class="img-fluid rounded pdf-canvas"></canvas>
                    </div>
                    <div class="row" id="body-firma">
                        <div class="container col-md-6">
                            <br>
                            <h6 class="text-center">Recibido por:</h6>
                            <p class="text-center" id="recibido"></p>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                                    <canvas id="canvas-firma1" class="canvas-firma">
                                    </canvas>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="limpiar-firma1" class="btn btn-secondary btn-sm ">
                                        limpiar</button>
                                </div>
                            </div>
                        </div>
                        <div class="container col-md-6">
                            <br>
                            <h6 class="text-center">Entregado por:</h6>
                            <p class="text-center" id="entregado"></p>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                                    <canvas id="canvas-firma2" class="canvas-firma">
                                    </canvas>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="limpiar-firma2" class="btn btn-secondary btn-sm ">
                                        limpiar</button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-12 text-center">
                            <button type="button" id="btn_firmar_actaEntrega" class="btn btn-success btn-sm ">
                                Firmar acta entrega
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    id="spinner_btn_firmarActaEntrega"></span>
                            </button>
                            <button type="button" id="btn_confirmar_actaEntrega" class="btn btn-primary btn-sm ">
                                Guardar cambios
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    id="spinner_btn_confirmarActaEntrega"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>