<main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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

<!-- Modal -->
<div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservaModalLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>


<script
    src="<?php echo base_route() ?>assets/js/js_atencion/js_reservas/js_module_reservas.js?v=<?php echo version(); ?>">
</script>