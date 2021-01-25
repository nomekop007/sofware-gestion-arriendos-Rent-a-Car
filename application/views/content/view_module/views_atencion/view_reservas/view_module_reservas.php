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

<div class="modal fade" id="modal_add_reserva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloAgregarReserva">Agregar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5>Datos del cliente particular</h5>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="inputRutCliente">Rut o Pasaporte (ejemplo: 12.345.678-9)</label>
                                <div class="input-group">
                                    <input maxLength="12" type="text" class="form-control" id="inputRutCliente"
                                        name="inputRutCliente" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btn_buscarCliente">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true" id="spinner_cliente"></span>
                                            Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="inputNombreCliente">Nombre completo</label>
                                <input onblur="mayus(this);" maxLength="60" type="text" class="form-control"
                                    id="inputNombreCliente" name="inputNombreCliente" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="inputComunaCliente">Comuna / region </label>
                                <select class="form-control" id="inputComunaCliente" name="inputComunaCliente">
                                </select>
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="inputCiudadCliente">Ciudad / pueblo </label>
                                <select class="form-control" id="inputCiudadCliente" name="inputCiudadCliente">
                                </select>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="inputTelefonoCliente">Telefono </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+569</span>
                                    </div>
                                    <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number"
                                        class="form-control" id="inputTelefonoCliente" name="inputTelefonoCliente"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="inputCorreoCliente">Correo electronico </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input onblur="mayus(this);" maxLength="50" type="email" class="form-control"
                                        id="inputCorreoCliente" name="inputCorreoCliente" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <h5>Datos de la reserva</h5>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="titulo_reserva">titulo de la reserva</label>
                                <input type="text" class="form-control " name="titulo_reserva" id="titulo_reserva"
                                    required />
                            </div>
                            <div class="input-group col-xl-6">
                                <label for="select_vehiculos">seleccione el vehiculo</label>
                                <select class="custom-select " id="select_vehiculos" name="select_vehiculos"
                                    style="width: 100%;" aria-label="Example select with button addon">
                                    <option value="null" selected="selected">Seleccione un vehiculo</option>
                                </select>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="fecha_inicio">fecha inicio</label>
                                <input type="text" class="form-control " name="fecha_inicio" id="fecha_inicio"
                                    required />
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="fecha_fin">fecha fin</label>
                                <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" required />
                            </div>
                            <div class="form-group col-xl-12">
                                <label for="descripcion">descripcion</label>
                                <textarea onblur="mayus(this);" class="form-control" id="descripcion" name="descripcion"
                                    rows="3" maxLength="300"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" class="">guardar reserva</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_mostrar_reserva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloReserva"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="descripcionEvento"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" class="">guardar</button>
            </div>
        </div>
    </div>
</div>


<script
    src="<?php echo base_route() ?>assets/js/js_atencion/js_reservas/js_module_reservas.js?v=<?php echo version(); ?>">
</script>