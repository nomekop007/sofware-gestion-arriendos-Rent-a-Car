<main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Despacho</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion Despachos</h1>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-despacho-tab" data-toggle="tab" href="#nav-despacho" role="tab"
                aria-controls="nav-despacho" aria-selected="true">Control de despacho </a>
            <a class="nav-link" id="nav-activos-tab" data-toggle="tab" href="#nav-activos" role="tab"
                aria-controls="nav-activos" aria-selected="false">Arriendos activos</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <br>
        <br>
        <div class="tab-pane fade show active" id="nav-despacho" role="tabpanel" aria-labelledby="nav-despacho-tab">
            <table id="tablaControldespacho" class="table table-striped table-bordered" style="width:100%">
                <thead class="btn-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Cliente</th>
                        <th>Vehiculo</th>
                        <th>Fecha Entrega</th>
                        <th>Fecha Recepecion</th>
                        <th>tipo arriendo</th>
                        <th>estado</th>
                        <th>Vendedor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot class="btn-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Cliente</th>
                        <th>Vehiculo</th>
                        <th>Fecha Entrega</th>
                        <th>Fecha Recepecion</th>
                        <th>tipo arriendo</th>
                        <th>estado</th>
                        <th>Vendedor</th>

                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center" id="spinner_tablaDespacho">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h6>Cargando Datos...</h6>
            </div>

        </div>

        <div class="tab-pane fade show " id="nav-activos" role="tabpanel" aria-labelledby="nav-activos-tab">
            <br>
            <br>
            <h5>Arriendos activos</h5>
        </div>





</main>

<script>
$("#m_despacho").addClass("active");
$("#l_despacho").addClass("card");
</script>

<!-- importando archivo js usuarios -->
<script src="<?php echo base_url() ?>assets/js/js_gestion/js_module_despacho.js"></script>