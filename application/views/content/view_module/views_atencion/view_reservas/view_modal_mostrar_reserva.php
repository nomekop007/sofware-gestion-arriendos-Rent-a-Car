<div class="modal fade" id="modal_mostrar_reserva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloReserva"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_mostrar_reserva">
                <input hidden type="text" id="id_reserva" name="id_reserva">
                <div class="modal-body form-row">
                    <div class="form-group col-xl-12">
                        <label for="vehiculo_mostrar">seleccionar vehiculo</label>
                        <select id="vehiculo_mostrar" name="vehiculo_mostrar" class="form-control">
                        </select>
                    </div>
                    <div class="form-group col-xl-12">
                        <label for="cliente_mostrar">Cliente</label>
                        <input type="text" readonly class="form-control " name="cliente_mostrar" id="cliente_mostrar" required />
                    </div>
                    <div class="form-group col-xl-5">
                        <label for="fecha_inicio_mostrar">Fecha inicio</label>
                        <input type="text" readonly class="form-control " name="fecha_inicio_mostrar" id="fecha_inicio_mostrar" required />
                    </div>
                    <div class="form-group col-xl-5">
                        <label for="fecha_fin_mostrar">Fecha fin</label>
                        <input type="text" readonly class="form-control" name="fecha_fin_mostrar" id="fecha_fin_mostrar" required />
                    </div>
                    <div class="form-group col-xl-2">
                        <label for="inputNumeroDias_mostrar">Dias</label>
                        <input min="1" oninput="calcularDias()" type="number" class="form-control" name="inputNumeroDias_mostrar" id="inputNumeroDias_mostrar" required>
                    </div>
                    <div class="form-group col-xl-10">
                        <label for="descripcion_mostrar">Descripcion</label>
                        <textarea required onblur="mayus(this);" class="form-control" id="descripcion_mostrar" name="descripcion_mostrar" rows="3" maxLength="300"></textarea>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="color_reserva_mostrar">color</label>
                        <input type="color" class=" form-control" name="color_reserva_mostrar" id="color_reserva_mostrar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_eliminar_reserva" class="btn btn-danger" class="">Eliminar</button>
                    <button type="button" id="btn_editar_reserva" class="btn btn-success" class="">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>