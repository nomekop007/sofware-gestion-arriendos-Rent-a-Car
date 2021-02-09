<!-- Modal signature-->
<div class="modal fade" id="modal_firmar_contrato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_firmar_contrato">Firmar Extencion  <span id=title_contrato></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinnerContrato">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="formContratoArriendo">
                <input type="text" id="id_arriendoContrato" hidden>
                <input type="text" id="estado_arriendo" hidden>
                <div class="container ">
                    <a class="row justify-content-md-center btn-success" id="descargar_contrato">
                        <i class="fas fa-download"></i>
                        Descargar contrato</a>
                    <br>
                    <button id="prev_contrato" class=" btn-info">
                        < </button> <button id="next_contrato" class=" btn-info "> >
                            </button>
                            &nbsp; &nbsp;
                            <span>Pagina: <span id="page_num_contrato"></span> / <span id="page_count_contrato"></span></span>
                            <canvas id="pdf_canvas_contrato" class="img-fluid rounded pdf-canvas"></canvas>
                </div>
                <form id="subir_contrato">
                    <div class="form-row card-body">
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input onclick="tipoContrato(this.value);" type="radio" value="FIRMAR" name="customRadio5" class="custom-control-input" id="radioFirma" checked>
                            <label class="custom-control-label" for="radioFirma">Firmar contrato</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input onclick="tipoContrato(this.value);" type="radio" value="SUBIR" name="customRadio5" class="custom-control-input" id="radioSubir">
                            <label class="custom-control-label" for="radioSubir">Subir contrato firmado</label>
                        </div>
                    </div>
                    <div class="row" id="body-firma">
                        <div class="container col-md-6">
                            <br>
                            <h6 class="text-center">Firma arrendatario/a:</h6>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                                    <canvas id="canvas_firma_cliente" class="canvas-firma">
                                    </canvas>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="limpiar_firma_cliente" class="btn btn-secondary btn-sm ">
                                        limpiar</button>
                                </div>
                            </div>
                        </div>
                        <div class="container col-md-6">
                            <br>
                            <h6 class="text-center">Firma Rent A Car:</h6>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                                    <canvas id="canvas_firma_usuario" class="canvas-firma">
                                    </canvas>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="limpiar_firma_usuario" class="btn btn-secondary btn-sm ">
                                        limpiar</button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-12 text-center">
                            <button type="button" id="btn_firmar_contrato" class="btn btn-success btn-sm ">
                                firmar contrato
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_firmarContrato"></span>
                            </button>
                            <button type="button" id="btn_confirmar_contrato" class="btn btn-primary btn-sm ">
                                Guardar cambios
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_confirmarContrato"></span>
                            </button>
                        </div>
                    </div>
                    <div class="row" id="body-subir-contrato">
                        <div class="container col-md-12">
                            <br><br><br><br>
                            <div class="row justify-content-md-center">
                                <input type="file" id="inputSubirContrato" name="inputSubirContrato">
                            </div>
                        </div>
                        <div class="container col-md-12 text-center">
                            <br><br><br><br><br>
                            <button type="button" id="btn_subir_contrato" class="btn btn-primary  ">
                                Subir contrato firmado
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_subirContrato"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>