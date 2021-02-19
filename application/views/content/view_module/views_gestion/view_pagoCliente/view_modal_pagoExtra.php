<div class="modal fade" id="modal_pagoExtra" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="titulo_modal_pagoExtra"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="formPagoExtra" novalidate>
                <div class="modal-body">
                    <br>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="monto $">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="descripcion">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="PAGO EXTRA" selected> PAGO EXTRA </option>
                                    <option value="DESCUENTO"> DESCUENTO </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button id="btn_pagoExtraCliente" type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="scroll">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center"> Nº </th>
                                    <th scope="col" class="text-center"> monto </th>
                                    <th scope="col" class="text-center"> detalle </th>
                                    <th scope="col" class="text-center"> tipo </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_tabla_pagosExtra">
                                <tr>
                                    <th scope="col" class="text-center"> 1 </th>
                                    <td scope="col" class="text-center"> 20000 </td>
                                    <td scope="col" class="text-center"> combustible </td>
                                    <td scope="col" class="text-center"> pago extra </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            </form>
        </div>
    </div>
</div>