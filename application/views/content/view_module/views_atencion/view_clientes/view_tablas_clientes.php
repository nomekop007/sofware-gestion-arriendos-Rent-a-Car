<main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1"> <span> Modulo atencion </span></a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion Clientes</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-clientes-tab" data-toggle="tab" href="#nav-clientes" role="tab" aria-controls="nav-clientes" aria-selected="true">Particulares</a>
                <a class="nav-link" id="nav-empresas-tab" data-toggle="tab" href="#nav-empresas" role="tab" aria-controls="nav-empresas" aria-selected="false">Empresas</a>
                <a class="nav-link" id="nav-conductores-tab" data-toggle="tab" href="#nav-conductores" role="tab" aria-controls="nav-conductores" aria-selected="false">Conductores asignados</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <br>
            <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">

                <?php if (validarPermiso(12)) { ?>
                    <button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_registrar_cliente">
                        Registrar Cliente particular
                    </button>
                <?php } ?>
                <br><br>
                <div class="scroll">
                    <table id="tablaClientes" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaClientes">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
                <br><br>
            </div>
            <div class="tab-pane fade" id="nav-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
                <?php if (validarPermiso(13)) { ?>
                    <button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_registrar_empresa">
                        Registrar cliente Empresa
                    </button>
                <?php } ?>
                <br><br>
                <div class="scroll">
                    <table id="tablaEmpresas" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaEmpresas">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
                <br><br>
            </div>
            <div class="tab-pane fade" id="nav-conductores" role="tabpanel" aria-labelledby="nav-conductores-tab">
                <?php if (validarPermiso(14)) { ?>
                    <button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_registrar_conductor">
                        Registrar Conductor
                    </button>
                <?php } ?>
                <br><br>
                <div class="scroll">
                    <table id="tablaConductores" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>Clase</th>
                                <th>telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>Clase</th>
                                <th>telefono</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaConductores">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</main>
</div>
</div>


<!-- importando archivo js vehiculos -->
<script src="<?php echo base_route() ?>assets/js/js_atencion/js_clientes/js_module_clientes.js?v=<?php echo version(); ?>">
</script>