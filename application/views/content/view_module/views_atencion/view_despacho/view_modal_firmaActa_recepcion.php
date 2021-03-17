<!-- Modal signature-->
<div class="modal fade" id="modal_signature_actaRecepcion" tabindex="-1" aria-labelledby="signatureModal" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Firmar Acta de Recepcion </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="body-sinContrato-actaRecepcion">
                    <br>
                    <h6 class='text-center'>Sin Acta de recepcion cargado</h6><br>
                </div>
                <div id="body-firma-actaRecepcion">
                    <div class="container">
                        <a class="row justify-content-md-center btn-success" id="descargar_actaRecepcion">
                            <i class="fas fa-download"></i>
                            Descargar Acta de recepcion</a>
                        <br>
                        <button id="prev_actaRecepcion" class=" btn-info">
                            < </button> <button id="next_actaRecepcion" class=" btn-info "> >
                                </button>

                                &nbsp; &nbsp;
                                <span>Pagina: <span id="page_num_actaRecepcion"></span> / <span id="page_count_actaRecepcion"></span></span>
                                <canvas id="pdf_canvas_actaRecepcion" class="img-fluid rounded pdf-canvas"></canvas>
                    </div>
                    <div class="row" id="body-firma-actaRecepcion">
                        <div class="container col-md-6">
                            <br>
                            <h6 class="text-center">Recepcionado por:</h6>
                            <p class="text-center" id="recibido_actaRecepcion"></p>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" id="cont-canvas-actaRecepcion">
                                    <canvas id="canvas-firma1-actaRecepcion" class="canvas-firma">
                                    </canvas>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="limpiar-firma1-actaRecepcion" class="btn btn-secondary btn-sm ">
                                        limpiar</button>
                                </div>
                            </div>
                        </div>
                        <div class="container col-md-6">
                            <br>
                            <h6 class="text-center">Entregado por:</h6>
                            <p class="text-center" id="entregado_actaRecepcion"></p>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" id="cont-canvas-actaRecepcion">
                                    <canvas id="canvas-firma2-actaRecepcion" class="canvas-firma">
                                    </canvas>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="limpiar-firma2-actaRecepcion" class="btn btn-secondary btn-sm ">
                                        limpiar</button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-12 text-center">
                            <button type="button" id="btn_firmar_actaRecepcion" class="btn btn-success btn-sm ">
                                Firmar acta entrega
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_firmarActaRecepcion"></span>
                            </button>
                            <button type="button" id="btn_confirmar_actaRecepcion" class="btn btn-primary btn-sm ">
                                Guardar cambios
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_confirmarActaRecepcion"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>