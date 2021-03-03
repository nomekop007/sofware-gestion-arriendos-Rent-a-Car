<div class="modal fade" id="modal_infoPago" style="overflow-y: scroll;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="titulo_modal_infoPago"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinnerInfoPago">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form id="formInfoPago" novalidate>
                <div class="modal-body">

                    <div class="row">

                        <div class="form-group col-md-4">
                            <input id="info_rut_cliente" disabled type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <input id="info_tipo_arriendo" disabled type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <input id="info_estado_arriendo" disabled type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea id="info_descripcion_pago" disabled class="form-control" rows=2></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <p>El valor total del arriendo incluye tambien los los pagos extras y pagos por daño del vehiculo si posee.</p>
                        </div>
                        <div class="form-group col-md-6">
                            <input id="info_valor_total_arriendo" disabled type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="info_patente_vehiculo" disabled type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="info_cantidad_contratos" disabled type="text" class="form-control">
                        </div>
                    </div>
                    <br>
                    <h6>Tabla de abonos de este pago</h6>
                    <div class="scroll">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">N° Doc</th>
                                    <th scope="col">Facturacion</th>
                                    <th scope="col">Metodo pago</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha registro</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_comprobantes">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>