<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modulos de Atencion</h1>
    </div>
    <div>
        <h5>Bienvenido <?php echo $this->session->userdata('nombre'); ?> </h5>
        <div class="row">
            <div class="col-md-12">
                <br>
                <img style="width:10%" src="<?php echo base_route() ?>assets/images/logo3.png" />
                <img style="width:30%;margin: 40px" src="<?php echo base_route() ?>assets/images/logo.png" />
            </div>
        </div>
        <div class="card  text-success">
            <div class="m-4">
                <h2>SISTEMA ACTUALIZADO!</h2>
                <span>Cambios realizados:</span>
                <li>Se agrego nueva funcionalidad "Modificar arriendos" en el modulo administracion.</li>
                <li>Se agregaron notificaciones push de los arriendos expirados.</li>
                <li>Se agregaron una funcionalidad para llamar a los clientes con arriendo atrasados.</li>
                <li>Se agregaron una funcionalidad para enviar correo autogenerado a los clientes con arriendo
                    atrasados.
                </li>



            </div>
        </div>
        <br><br><br><br><br>
        <div id="card_alertas"></div>
    </div>
    </div>
    <br><br>

</main>


</div>
</div>




<!-- importaciones del arriendos -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_index_gestion.js?v=<?php echo version(); ?>">
</script>