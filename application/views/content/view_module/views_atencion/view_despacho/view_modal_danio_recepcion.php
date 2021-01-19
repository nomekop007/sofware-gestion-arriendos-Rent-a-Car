<!-- Modal registro de daño-->
<div class="modal fade" id="modalRegistrarDaño" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="registrardañoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrardañoLabel">Registrar daño del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>se registrará junto con las fotos sacada al vehículo</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="input_descripcion_danio">Descripcion de los daños</label>
                            <textarea onblur="mayus(this);" class="form-control" id="input_descripcion_danio"
                                name="input_descripcion_danio" rows="3" maxLength="500"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                <button type="button" id="registrar_danio_vehiculo" class="btn btn-warning">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                        id="spinner_btn_registrar_danio"></span>
                    Registrar daño</button>
            </div>
        </div>
    </div>
</div>