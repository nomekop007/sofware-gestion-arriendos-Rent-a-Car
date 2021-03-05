<div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAlertLabel">Arriendo Nº <span id="alert_id_arriendo"></span> - <span id="alert_sucursal"></span> <br><span id="alert_estado_atraso"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <br>
                <h4>Datos arriendo</h4>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <span id="alert_fecha_inicio" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <span id="alert_fecha_fin" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-lg-12">
                        <span id="alert_vehiculo" class="input-group-text form-control"></span>
                    </div>
                </div>
                <br>
                <h4>Contacto Cliente</h4>
                <div class="form-row">
                    <div class="form-group col-lg-9">
                        <span id="alert_nombre_cliente" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-lg-3">
                        <span id="alert_rut_cliente" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <span id="alert_telefono_cliente" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <span id="alert_correo_cliente" class="input-group-text form-control"></span>
                    </div>
                </div>
                <br>
                <div class="card ">
                    <br>
                    <div class="form-row">
                        <div class="form-group col-lg-6 text-center">
                            <a class="btn btn-outline-info" id="alert_telefono_input_cliente">Llamar cliente </a>
                        </div>
                        <div class="form-group col-lg-6 text-center">
                            <button type="button" class="btn btn-outline-dark" id="alert_btn_enviar_correo">enviar
                                correo autogenerado sobre vencimiento </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_route() ?>assets/js/modals/modalAlert.js?v=<?php echo version(); ?>"></script>