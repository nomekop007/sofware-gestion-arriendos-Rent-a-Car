<main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1">Atencion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Calendario de reservas</li>
            </ol>
        </nav>
        <h1 class="h3">Calendario de reservas</h1>
    </div>
    <br>
    <div id="calendario"></div>
    <br><br><br>

</main>
</div>
</div>




<!-- importaciones del select2 -->
<script src="<?php echo base_route() ?>assets/js/select2.min.js"></script>

<script src="<?php echo base_route() ?>assets/js/comunaCiudad.js?v=<?php echo version(); ?>"></script>

<script src="<?php echo base_route() ?>assets/js/js_atencion/js_reservas/js_module_reservas.js?v=<?php echo version(); ?>">
</script>