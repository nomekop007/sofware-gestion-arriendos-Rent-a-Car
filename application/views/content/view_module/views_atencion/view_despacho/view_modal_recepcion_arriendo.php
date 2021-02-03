<!-- Modal recepcion de arriendo-->
<div class="modal fade" id="modal_ArriendoFinalizar" data-keyboard="false" tabindex="-1" data-backdrop="static" style="overflow-y: scroll;" aria-labelledby="modal_ArriendoFinalizarLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoFinalizarLabel">Recepcion de arriendo <span id="numero_arriendo_recepcion">Nº</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner_finalizar_arriendo">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="body_recepcion_arriendo">
                <input id="id_arriendo_recepcion" type="text" hidden>
                <input id="id_vehiculo_recepcion" type="text" hidden>

                <div class="row">
                    <div class="col-md-6">
                        <br>
                        <div class="container pdf-canvas" id="ventana_fotosDespacho"></div>
                        <br>
                        <div id="ventana_actaEntrega">
                            <button id="prev_recepcion" class=" btn-info">
                                < </button> <button id="next_recepcion" class=" btn-info "> >
                                    </button>
                                    &nbsp; &nbsp;
                                    <span>Pagina: <span id="page_num_recepcion"></span> / <span id="page_count_recepcion"></span></span>
                                    <canvas id="pdf_canvas_recepcion" class="img-fluid rounded pdf-canvas"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <div class="container pdf-canvas" id="carrucel_recepcion"> </div>
                        <br>
                        <div class="form-group col-lg-12">
                            <button type="button" class=" btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFotosVehiculoRecepcion">
                                Tomar Fotos al vehiculo
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" id="limpiarArrayFotosRecepcion"><i class="fas fa-trash-alt"></i> limpiar
                                lista</button>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="input_kilometraje_salida">Kilomentraje recepcion del vehiculo</label>
                            <input oninput="this.value = soloNumeros(this)" maxLength="11" type="number" value="0" class="form-control" id="input_kilometraje_salida" name="input_kilometraje_salida" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalRegistrarDaño">Registrar daño</button>
                <button type="button" class="btn btn-primary" id="btn_finalizar_arriendo">Finalizar Arriendo
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_finalizar_contrato"></span>
                </button>
            </div>
        </div>
    </div>
</div>