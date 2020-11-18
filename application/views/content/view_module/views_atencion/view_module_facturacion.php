<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Atencion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Facturacion</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de Facturaciones</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-registrar-tab" data-toggle="tab" href="#nav-registrar" role="tab" aria-controls="nav-registrar" aria-selected="true">Registrar Factura</a>
                <a class="nav-link" id="nav-facturaciones-tab" data-toggle="tab" href="#nav-facturaciones" role="tab" aria-controls="nav-facturaciones" aria-selected="false">Facturas registrados</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <!-- Tab Formulario de Registrar facturaciones -->
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel" aria-labelledby="nav-registrar-tab">
                <br><br>
                <form class="needs-validation" novalidate id="form_registrar_factura">
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <label for="input_numero_facturacion">Numero Facturacion</label>
                            <input oninput="this.value = soloNumeros(this)" type="number" maxLength="11" class="form-control" id="input_numero_facturacion" name="input_numero_facturacion" required>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tab con la tabla de los facturaciones -->
            <div class="tab-pane fade" id="nav-facturaciones" role="tabpanel" aria-labelledby="nav-facturaciones-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_facturaciones" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nº</th>
                                <th>Tipo</th>
                                <th>codigo</th>
                                <th>Nº de pagos</th>
                                <th>fecha registro</th>
                                <th>Usuario</th>
                                <th>Documento</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="vehiculos">

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nº</th>
                                <th>Tipo</th>
                                <th>codigo</th>
                                <th>Nº de pagos</th>
                                <th>fecha registro</th>
                                <th>Usuario</th>
                                <th>Documento</th>
                                <th></th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tabla_facturaciones">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
            <br><br><br><br>
        </div>

    </div>


</main>

</div>
</div>


<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_atencion/js_module_facturaciones.js"></script>