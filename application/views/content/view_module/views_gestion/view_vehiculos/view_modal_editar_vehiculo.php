<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="spinner_vehiculo">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="formEditarVehiculo" novalidate>
                <div class="modal-body" id="modal_vehiculo">
                    <input type="text" id="inputEditarId" name="inputEditarId" hidden />
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarPatente">Patente del Vehiculo</label>
                                            <input onblur="mayus(this);" maxLength="10" type="text" class="form-control" id="inputEditarPatente" name="inputEditarPatente" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarTipo">Tipo de Vehiculo</label>
                                            <select id="inputEditarTipo" name="inputEditarTipo" class="form-control">
                                                <option value="AUTOMOVIL" selected>Automovil</option>
                                                <option value="CAMIONETA">Camioneta</option>
                                                <option value="FURGON">Furgón</option>
                                                <option value="CONVERTIBLE">Convertible</option>
                                                <option value="DOBLE CABINA">Doble Cabina</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarMarca">Marca del Vehiculo</label>
                                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="inputEditarMarca" name="inputEditarMarca" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarModelo">Modelo del Vehiculo</label>
                                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="inputEditarModelo" name="inputEditarModelo" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarEdad">Año del Vehiculo</label>
                                            <select id="inputEditarEdad" name="inputEditarEdad" class="form-control">
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarTransmision">Transmision del Vehiculo</label>
                                            <select id="inputEditarTransmision" name="inputEditarTransmision" class="form-control">
                                                <option value="AUTOMATICO" selected>Automatico</option>
                                                <option value="MANUAL">Manual</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarChasis">Chasis de Vehiculo</label>
                                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="inputEditarChasis" name="inputEditarChasis" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarNumeroMotor">Nº Motor del Vehiculo</label>
                                            <input type="text" maxLength="40" class="form-control" id="inputEditarNumeroMotor" name="inputEditarNumeroMotor" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarNumeroGps">Nº GPS del vehiculo</label>
                                            <input type="text" maxLength="40" class="form-control" id="inputEditarNumeroGps" name="inputEditarNumeroGps" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarNumeroTab">Nº Tab del Vehiculo</label>
                                            <input type="text" maxLength="40" class="form-control" id="inputEditarNumeroTab" name="inputEditarNumeroTab" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarColor">Color del Vehiculo</label>
                                            <input onblur="mayus(this);" maxLength="40" type="text" class="form-control" id="inputEditarColor" name="inputEditarColor" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarkilomentrosMantencion">kilometros de ultima
                                                mantencion</label>
                                            <input type="number" oninput="this.value = soloNumeros(this)" maxLength="6" class="form-control" id="inputEditarkilomentrosMantencion" name="inputEditarkilomentrosMantencion" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarEstado">Editar estado</label>
                                            <select id="inputEditarEstado" name="inputEditarEstado" class="form-control">
                                                <option value="DISPONIBLE" selected>DISPONIBLE</option>
                                                <option value="EN REPARACION">EN REPARACION</option>
                                                <option value="ARRENDADO">ARRENDADO</option>
                                                <option value="SINIESTRADO">SINIESTRADO</option>
                                                <option value="VENDIDO">VENDIDO</option>
                                                <option value="EN LICITACION">EN LICITACION</option>
                                                <option value="EN MANTENCION">EN MANTENCION</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarSucursal">Sucursal Actual</label>
                                            <select id="inputEditarSucursal" name="inputEditarSucursal" class="form-control">
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarCompra">Donde se compro</label>
                                            <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="inputEditarCompra" name="inputEditarCompra" required>
                                        </div>
                                        <div class="form-group col-xl-6">
                                            <label for="inputEditarFechaCompra">Fecha de compra</label>
                                            <input type="text" class="form-control input_data" name="inputEditarFechaCompra" readonly id="inputEditarFechaCompra" required />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarPropietario">Propietario</label>
                                            <select id="inputEditarPropietario" name="inputEditarPropietario" class="form-control">
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputCreateAt">Registrado El:</label>
                                            <input disabled type="text" class="form-control" id="inputCreateAt" name="inputCreateAt">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <img id="imagen" class="img-fluid rounded float-right" alt="">
                                    <label for="inputEditarFoto">Cambiar foto</label>
                                    <input accept="image/*" type="file" class="form-control-file" id="inputEditarFoto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <?php if (validarPermiso(18)) { ?>
                        <button type="submit" id="btn_editar_vehiculo" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_editarVehiculo"></span>
                            Guardar cambios</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>