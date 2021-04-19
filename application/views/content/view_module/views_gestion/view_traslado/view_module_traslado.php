<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <br><br>

    <h5>Modulo de traslados</h5>
    <hr>

    <div class="container">

        <div class="row">
            <div class="col-sm-12 ">

                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Registrar Traslado</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Recepcionar Vehiculo Traslado</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Todos los Traslados</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form>
                            <br>
                            <label for="sucursal_label" class="col-sm-12 col-form-label">
                                <h6>INFORMACION DE VEHICULOS DISPONIBLES</h6>
                            </label>
                            <br> <br>

                            <div class="form-group row">

                                <div class="col-sm-12">

                                    <div class="input-group">
                                        <select class="custom-select" id="Select1">
                                            <option selected="selected">Seleccione sucursal origen</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="BuscarVehiculosPorSucursal" type="button">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div id="DivTablaVehiculosDispSucursal">


                                <hr>
                                <br>

                                <div style="overflow-x:auto;">
                                    <table id="tablaTrasladoDisp" class="table table-striped table-bordered" style="width:100%">
                                        <thead class="btn-dark">
                                            <tr>
                                                <th>N° Patente</th>
                                                <th>Tipo de Vehiculo</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="btn-dark">
                                            <tr>
                                                <th>N° Patente</th>
                                                <th>Tipo de Vehiculo</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>




                            </div>
                            <br><br>
                            <div class="modal fade bd-example-modal-lg " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Registrar traslado</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">N° Patente</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" disabled="disabled" class="form-control" id="Traslado_patente">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" disabled="disabled" class="form-control" id="Traslado_tipo">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Marca</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" disabled="disabled" class="form-control" id="Traslado_marca">
                                                    </div>

                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Modelo</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" disabled="disabled" class="form-control" id="Traslado_modelo">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Origen</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" disabled="disabled" class="form-control" id="Origenview">
                                                    </div>

                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Destino</label>
                                                    <div class="col-sm-4">
                                                        <select class="custom-select" id="Destino2"></select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Conductor</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="NombreConductor_Traslado">
                                                    </div>

                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Rut</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="RutConductor_Traslado">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Observacion</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="ObservacionTraslado" rows="4"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Seleccion imagenes</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group mb-3">
                                                            <input type="file" id="seleccionArchivos" class="form-control">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" id="CargarImagen" type="button">Agregar
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" id="Limpiar_carruselTO" type="button">Limpiar
                                                                    <i class="far fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseExampleT" aria-expanded="false" aria-controls="collapseExample" type="button">Ver
                                                                    <i class="far fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span id="SpanTrasladoOrigen" class="error text-secondary">Cantidad de fotografias: 0 (Max 5) </span>
                                                    </div>

                                                </div>
                                                <div id="divCarruselTraslado" class="form-group row">
                                                    <center>
                                                        <div class="collapse" style="width:90%" id="collapseExampleT">
                                                            <div id="bodyTrasladoCarrusel" style="width:90%" class="card card-body"></div>
                                                        </div>

                                                    </center>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" id="Registar_TO" class="btn btn-success">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div id="DIV-TablaRecepcionTraslado">
                            <br>

                            <div class="row">
                                <div class="col">
                                    <label for="sucursal_label" class="col-sm-auto col-form-label">
                                        <h6>INFORMACION DE TRASLADOS</h6>

                                    </label>
                                    <button type="button" id="ActualizarTablaRecepcion" class="btn btn-secondary btn-sm">Actualizar tabla</button>

                                </div>

                            </div>

                            <br> <br>

                            <div style="overflow-x:auto;">
                                <table id="TablaRecepcionTraslado" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="btn-dark">
                                        <tr>
                                            <th>Patente</th>
                                            <th>Sucursal origen</th>
                                            <th>Sucursal destino</th>
                                            <th>Fecha inicio</th>
                                            <th>Conductor</th>
                                            <th>Rut Conductor</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="btn-dark">
                                        <tr>
                                            <th>Patente</th>
                                            <th>Sucursal origen</th>
                                            <th>Sucursal destino</th>
                                            <th>Fecha inicio</th>
                                            <th>Conductor</th>
                                            <th>Rut Conductor</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>



                        </div>

                    </div>

                    <div class="modal fade bd-example-modal-lg " id="ModalTrasladoRecepcion" tabindex="-1" role="dialog" aria-labelledby="ModalTrasladoRecepcionLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Recepcion de vehiculos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Patente</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="PatenteViewDestino">
                                            </div>

                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="TipoViewDestino">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Marca</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="MarcaViewDestino">
                                            </div>

                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Modelo</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="ModeloViewDestino">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Conductor</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="NombreconductorViewDestino">
                                            </div>

                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Rut Conductor</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="RutconductorViewDestino">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Origen</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="OrigenviewDestino">
                                            </div>

                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Destino</label>
                                            <div class="col-sm-4">
                                                <input type="text" disabled="disabled" class="form-control" id="DestinoViewTraslado"></input>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Kilometraje Actual</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="KilometrajeViewTraslado"></input>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-2 col-form-label">Seleccion imagenes</label>
                                            <div class="col-sm-10">
                                                <div class="input-group mb-3">
                                                    <input type="file" id="seleccionArchivosRecepcion" class="form-control">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" id="CargarImagenViewRecepcion" type="button">Guardar
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" id="Limpiar_carruselTD" type="button">Limpiar
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseExampleTD" aria-expanded="false" aria-controls="collapseExample" type="button">Ver
                                                            <i class="far fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span id="SpanTrasladoDestino" class="error text-secondary">Cantidad de fotografias: 0 (Max 5) </span>
                                            </div>

                                        </div>








                                        <div id="divCarruselTrasladoDestino" class="form-group row">
                                            <center>
                                                <div class="collapse" style="width:90%" id="collapseExampleTD">
                                                    <div id="bodyTrasladoCarruselDestino" style="width:90%" class="card card-body"></div>
                                                </div>

                                            </center>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="Registar_TD" class="btn btn-success">Recepcionar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>

                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                        <div id="Div-AllTraslados">
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="sucursal_label" class="col-sm-auto col-form-label">
                                        <h6>INFORMACION DE TRASLADOS</h6>
                                    </label>
                                    <button type="button" id="ActualizarTablaAllTraslados" class="btn btn-secondary btn-sm">Actualizar tabla</button>

                                </div>
                            </div>
                            <br> <br>

                            <div style="overflow-x:auto;">
                                <table id="TablaAllTraslados" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="btn-dark">
                                        <tr>
                                            <th>Patente</th>
                                            <th>Sucursal origen</th>
                                            <th>Sucursal destino</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha Final</th>
                                            <th>estado</th>
                                            <th>Actas</th>
                                            <th>Imagenes</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="btn-dark">
                                        <tr>
                                            <th>Patente</th>
                                            <th>Sucursal origen</th>
                                            <th>Sucursal destino</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha Final</th>
                                            <th>estado</th>
                                            <th>Actas</th>
                                            <th>Imagenes</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="ModalImagenesOrigenAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Imagenes de sucursal Origen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div id="Div-CarruselAllImagenes" class="form-group row">
                                                <center>
                                                    <div id="bodyTrasladoCarruselAllOrigen" style="width:90%" class="card card-body"></div>
                                                </center>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="ModalImagenesDestinoAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Imagenes de sucursal Destino</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="Div-CarruselAllImagenesDestino" class="form-group row">
                                                <center>
                                                    <div id="bodyTrasladoCarruselAllDestino" style="width:90%" class="card card-body"></div>
                                                </center>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>

</main>
</div>
</div>

<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_traslado/js_module_traslado.js?v=<?php echo version(); ?>"></script>

<script src="<?php echo base_route() ?>assets/js/js_gestion/js_traslado/js_module_traslado_recepcion.js?v=<?php echo version(); ?>"></script>

</script>

<script src="<?php echo base_route() ?>assets/js/js_gestion/js_traslado/js_module_AllTraslado.js?v=<?php echo version(); ?>"></script>

</script>