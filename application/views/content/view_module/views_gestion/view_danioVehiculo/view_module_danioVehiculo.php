<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2"> <span style='font-size: 1.2rem;'> Modulo gestion </span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style='font-size: 1.2rem;'>Daños vehiculo</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de daño vehiculo</h1>
    </div>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes de cotizar</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="todos-tab" data-toggle="tab" href="#todos" role="tab" aria-controls="todos" aria-selected="false">Todos los daños registrados</a>
            </li>

             <div class="card-body d-flex">
                <button id="NuevodanioVehicular" class="btn btn-secondary btn-xl ml-auto" data-toggle="modal" data-target="#exampleModalCenter" >Agregar nuevo daño vehicular</button>
            </div>



        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_pendientes_danios" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>Sucursal</th>
                                <th>Evidencia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>Sucursal</th>
                                <th>Evidencia</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tabla_danios_pendientes">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
            <div class="tab-pane fade" id="todos" role="tabpanel" aria-labelledby="todos-tab">
                <br><br>
                <div class="scroll">
                    <table id="tabla_todos_danios" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>estado</th>
                                <th>Sucursal</th>
                                <th>Evidencia</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="btn-dark" style='font-size: 0.7rem;'>
                            <tr>
                                <th>Nº arriendo</th>
                                <th>Vehiculo</th>
                                <th>Cliente involucrado </th>
                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>estado</th>
                                <th>Sucursal</th>
                                <th>Evidencia</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tabla_danios">
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



<!-- Modal descripcion -->
<div class="modal fade" id="modal_mostrar_descripcion" tabindex="-1" aria-labelledby="modal_mostrar_descripcionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_mostrar_descripcionLabel">Descripcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="descripcion_danio"></p>
            </div>
        </div>
    </div>
</div>


<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_danioVehiculo/js_module_daniosVehiculo.js?v=<?php echo version(); ?>">

</script>