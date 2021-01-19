<!-- Modal fotos auto -->
<div class="modal fade" id="modalFotosVehiculoRecepcion" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cargar Fotos del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <input type="file" class="form-control-file" id="inputImagen_vehiculo_recepcion"
                            accept="image/*">
                        <h4>Maximo 9 fotos </h4>
                    </div>
                    <div class="form-group col-lg-2">
                        <button type="button" id="limpiar_fotoVehiculo_recepcion"
                            class="btn btn-secondary btn-sm form-control ">
                            limpiar pizarra</button>
                    </div>
                    <div class="form-group col-lg-1">
                        <input type="color" class=" form-control" oninput="defcolor(this.value)">
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="grosor">Grosor de linea</label>
                        <input type="range" class="custom-range" oninput="defgrosor(this.value)" value="0" min="1"
                            max="5">
                    </div>
                    <div class="form-group col-lg-3">
                        <button type="button" id="seleccionarFotoRecepcion"
                            class="btn btn-success btn-sm form-control ">
                            añadir foto</button>
                    </div>
                    <div class="form-group col-lg-12 text-center">
                        <br>
                        <p><i class="far fa-square"></i> Abolladuras <i class="far fa-circle"></i> Rayaduras <i
                                class="fas fa-times"></i> Piezas rotas </p>
                        <div class="form-group form-check">
                            <label class="form-check-label" for="dibujar_canvas_recepcion"><input type="checkbox"
                                    class="form-check-input" id="dibujar_canvas_recepcion"
                                    name="dibujar_canvas_recepcion">dibujar en pizarra</label>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="form-group col-lg-12">
                        <div class="vehiculo-canvas" id="cont-canvas">
                            <canvas id="canvas_fotoVehiculo_recepcion" style="background:#d9d9d9"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
            </div>
        </div>
    </div>
</div>