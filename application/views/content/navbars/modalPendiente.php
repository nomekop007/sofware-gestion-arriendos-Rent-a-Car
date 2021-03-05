<div class="modal fade" id="modalArriendoPendiente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalArriendoPendienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArriendoPendienteLabel">Acciones pendientes</h5>
            </div>
            <div class="modal-body">
                <div class="container" id="containerModalPendiente">

                </div>
                <br>
                <a id="btn_redirect_pendientePago" class="btn btn-outline-success" href="<?php echo base_url(); ?>modulos_gestion?modulo=5">
                    <i class="fas fa-money-bill-wave"></i>
                    Ir a modulo subir comprobantes de pago</a>
                <a id="btn_redirect_pendienteFirma" class="btn btn-outline-info" href="<?php echo base_url(); ?>modulos_atencion?modulo=3">
                    <i class='fas fa-feather-alt'></i>
                    Ir a modulo firmar extenciones</a>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_route() ?>assets/js/modals/modalPendiente.js?v=<?php echo version(); ?>"></script>