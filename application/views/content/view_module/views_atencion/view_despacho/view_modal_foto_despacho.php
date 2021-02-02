<!-- Modal fotos auto -->
<div class="modal fade" id="canvasFotosVehiculo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="staticBackdropLabel">Capturar Fotos del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <button aria-hidden="true" type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group col-lg-12">
                            <input type="file" class="form-control-file" id="inputImagenVehiculo" accept="image/*">
                        </div>
                        <br><br>
                        <div class="form-group col-12">
                            <button type="button" id="seleccionarFoto" class="btn btn-success btn-sm form-control ">
                                <i class="fas fa-plus-circle"></i>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_seleccionar"></span> Agregar foto </button>
                        </div>
                        <div class="form-group row m-3">
                            <button type="button" id="limpiar-fotoVehiculo" class="btn btn-secondary btn-sm form-control  col-lg-6 ">
                                <i class="fas fa-broom"></i> </button>
                            <input type="color" id="colorCanvas" oninput="defcolor(this.value)" class=" form-control  col-lg-6 ">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="range" id="grosor" class="custom-range" oninput="defgrosor(this.value)" value="0" min="1" max="5">
                        </div>
                        <br>
                        <div class="form-group col-lg-12">
                            <br>
                            <div class="container" id="carrucel">
                            </div>
                            <br> <br>
                            <button type="button" class="btn btn-danger btn-sm form-control " id="limpiarArrayFotos"> <i class="fas fa-trash-alt"></i> limpiar
                                lista</button>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="form-group col-lg-12 text-center">
                            <p><i class="far fa-square"></i> Abolladuras <i class="far fa-circle"></i> Rayaduras <i class="fas fa-times"></i> Piezas rotas </p>
                            <div class="form-group form-check">
                                <label class="form-check-label" for="dibujarCanvas"><input type="checkbox" class="form-check-input" id="dibujarCanvas" name="dibujarCanvas">dibujar en
                                    pizarra</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="vehiculo-canvas" id="cont-canvas">
                                <canvas id="canvas-fotoVehiculo" style="background:#d9d9d9"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>