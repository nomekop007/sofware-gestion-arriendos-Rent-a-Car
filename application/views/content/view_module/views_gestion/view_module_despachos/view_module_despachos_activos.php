<div class="tab-pane fade show " id="nav-activos" role="tabpanel" aria-labelledby="nav-activos-tab">
    <br><br>
    <div class="scroll">
        <table id="tablaArriendosActivos" class=" table table-striped table-bordered " style="width:100%">
            <thead class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>Cliente</th>
                    <th>Vehiculo</th>
                    <th>tipo arriendo</th>
                    <th>Fecha Recepcion</th>
                    <th>tiempo restante</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>Cliente</th>
                    <th>Vehiculo</th>
                    <th>tipo arriendo</th>
                    <th>Fecha Recepcion</th>
                    <th>tiempo restante</th>
                    <th> </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center" id="spinner_tablaArriendoActivos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>
</div>

<!-- Modal extender plazo arriendo-->
<div class="modal fade" id="modal_ArriendoExtender" data-keyboard="false" tabindex="-1"
    aria-labelledby="modal_ArriendoExtenderLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoExtenderLabel">Extender plazo arriendo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="formExtenderArriendo" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputFechaRecepcion_extenderPlazo">Fecha de recepcion</label>
                            <input oninput="calcularDiasExtencion()" type="datetime-local" class="form-control"
                                name="inputFechaRecepcion_extenderPlazo" id="inputFechaRecepcion_extenderPlazo"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputFechaExtender_extenderPlazo">Fecha a extender</label>
                            <input oninput="calcularDiasExtencion()" type="datetime-local" class="form-control"
                                name="inputFechaExtender_extenderPlazo" id="inputFechaExtender_extenderPlazo" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputNumeroDias_extenderPlazo">Numeros de Dias</label>
                            <input min="0" oninput="calcularDiasExtencion()" type="number" class="form-control"
                                name="inputNumeroDias_extenderPlazo" id="inputNumeroDias_extenderPlazo" required>
                        </div>
                        <div class="form-group col-md-4"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-success">firmar contrato</button>
                <button type="button" class="btn btn-primary">extender plazo</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal recepcion de arriendo-->
<div class="modal fade" id="modal_ArriendoFinalizar" data-keyboard="false" tabindex="-1"
    aria-labelledby="modal_ArriendoFinalizarLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoFinalizarLabel">Recepcion de arriendo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>