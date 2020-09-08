<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargarPanel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
        <h1 class="h3">Modulo Cliente</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-clientes-tab" data-toggle="tab" href="#nav-clientes" role="tab"
                    aria-controls="nav-clientes" aria-selected="true">Clientes particulares</a>
                <a class="nav-link" id="nav-empresas-tab" data-toggle="tab" href="#nav-empresas" role="tab"
                    aria-controls="nav-empresas" aria-selected="false">Empresas</a>
                <a class="nav-link" id="nav-conductores-tab" data-toggle="tab" href="#nav-conductores" role="tab"
                    aria-controls="nav-conductores" aria-selected="false">Conductores asignados</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <br>
            <br>
            <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">

                <table id="tablaClientes" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>telefono</th>
                            <th>Correo</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>telefono</th>
                            <th>Correo</th>
                            <th>Accion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
                <table id="tablaEmpresas" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Correo</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Correo</th>
                            <th>Accion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-conductores" role="tabpanel" aria-labelledby="nav-conductores-tab">
                <table id="tablaConductores" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Clase</th>
                            <th>telefono</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Clase</th>
                            <th>telefono</th>
                            <th>Accion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>
</div>
</div>


<!-- Modal ver  (PENDIENTE)-->
<div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Mostrar Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                En Construccion...
            </div>
        </div>
    </div>
</div>



<!-- importando archivo js vehiculos -->
<script src="<?php echo base_route() ?>assets/js/session_gestion/js_module_clientes.js"></script>