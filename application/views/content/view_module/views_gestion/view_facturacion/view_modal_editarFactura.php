<!-- Modal -->
<div class="modal fade" id="modal_pagoArriendo" tabindex="-1" aria-labelledby="modal_pagoArriendoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_pagoArriendoLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="spinner_editar_factura">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="form_editar_factura" novalidate>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group col-md-12">
                                <label for="deudor_pago">empresa de remplazo</label>
                                <input disabled type="text" class="form-control" id="deudor_pago" name="deudor_pago"
                                    required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="dias_pago">dias correspondientes</label>
                                <input disabled type="number" class="form-control" id="dias_pago" name="dias_pago"
                                    required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="editar_neto_pago">Valor neto</label>
                                <input oninput="calcularIvaPagoERemplazo()" type="number" class="form-control"
                                    id="editar_neto_pago" name="editar_neto_pago" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="editar_iva_pago">Valor iva</label>
                                <input oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()"
                                    type="number" class="form-control" id="editar_iva_pago" name="editar_iva_pago"
                                    required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="editar_bruto_pago">Valor total bruto</label>
                                <input oninput="this.value = soloNumeros(this) ;calcularIvaPagoERemplazo()"
                                    type="number" class="form-control" id="editar_bruto_pago" name="editar_bruto_pago"
                                    required>
                            </div>
                            <div class="form-group col-xl-12">
                                <label for="editar_observaciones_pago">añadir razon de modificacion</label>
                                <textarea onblur="mayus(this);" class="form-control" id="editar_observaciones_pago"
                                    name="editar_observaciones_pago" rows="3" maxLength="300"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                    <button type="button" class="btn btn-success">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>