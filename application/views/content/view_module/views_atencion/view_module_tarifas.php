<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Atencion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">tarifas arriendo</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de tarifas</h1>
    </div>
    <div>
        <div class="nav justify-content-end">
            <li class="nav-item " role="presentation">
                <label for="inputSucursal">Sucursales</label>
                <select id="inputSucursal" name="inputSucursal" class="form-control ">
                </select>
            </li>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="precios_automovil-tab" data-toggle="tab" href="#precios_automovil"
                    role="tab" aria-controls="precios_automovil" aria-selected="true">Precios automoviles</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="precios_accesorios-tab" data-toggle="tab" href="#precios_accesorios" role="tab"
                    aria-controls="precios_accesorios" aria-selected="false">Precio accesorios</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="precios_E_remplazos-tab" data-toggle="tab" href="#precios_E_remplazos"
                    role="tab" aria-controls="precios_E_remplazos" aria-selected="false">Precios E.remplazos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="precios_promociones-tab" data-toggle="tab" href="#precios_promociones"
                    role="tab" aria-controls="precios_promociones" aria-selected="false">Promociones</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="precios_automovil" role="tabpanel"
                aria-labelledby="precios_automovil-tab"> modulo precios automoviles</div>
            <div class="tab-pane fade" id="precios_accesorios" role="tabpanel" aria-labelledby="precios_accesorios-tab">
                <br><br>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card"><br><br><br><br></div>
                    </div>
                    <div class="col-md-7">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre accesorio</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="precios_E_remplazos" role="tabpanel"
                aria-labelledby="precios_E_remplazos-tab"> modulo precios E. remplazos</div>
            <div class="tab-pane fade" id="precios_promociones" role="tabpanel"
                aria-labelledby="precios_promociones-tab">promociones..</div>
        </div>

    </div>


</main>

</div>
</div>


<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_atencion/js_module_tarifas.js"></script>