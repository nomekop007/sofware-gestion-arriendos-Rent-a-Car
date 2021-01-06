<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modulos de Gestion</h1>
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
        <div hidden class="card  text-success">
            <div class="m-4">
                <h4>Sistema actualizado!</h4>
                <span>Cambios realizados:</span>
                <li>Se modifico la interfaz de la ventana mostrar arriendo</li>
                <li>Se agrego validacion de los archivos requeridos (garantia,documentos) en mostrar arriendo</li>
                <li>Se modifico la interfaz del pago de los arriendos </li>
                <li>se agrego nuevo modulo gestion de daños de vehiculos</li>
            </div>
        </div>
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