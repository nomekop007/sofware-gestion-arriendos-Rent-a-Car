<?php
switch ($this->session->userdata('sucursal')) {
    case '1':
        $sucursal = "TALCA";
        break;
    case '2':
        $sucursal = "LINARES";
        break;
    case '3':
        $sucursal = "CURICO";
        break;
    case '4':
        $sucursal = "CONCEPCION";
        break;
    default:
        $sucursal = "DESCONOCIDO";
        break;
}
?>

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
                <form class="needs-validation" novalidate id="form_reserva">
                    <input hidden type="text" id="selectSucursal" name="selectSucursal" value="<?php echo $sucursal ?>" disabled>
                    <div class="form-row card-body">
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input onclick="tipoCliente(this.value);" type="radio" value="PARTICULAR" id="radioParticular" name="customRadio0" class="custom-control-input" checked>
                            <label class="custom-control-label" for="radioParticular">Cliente natural</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input onclick="tipoCliente(this.value);" type="radio" value="EMPRESA" id="radioEmpresa" name="customRadio0" class="custom-control-input">
                            <label class="custom-control-label" for="radioEmpresa">Cliente empresa</label>
                        </div>
                    </div>
                    <div class="card" id="option_natural">
                        <div class="card-body">
                            <h5>Datos del cliente particular</h5>
                            <div class="form-row">
                                <div class="form-group col-xl-6">
                                    <label for="inputRutCliente">Rut o Pasaporte (ejemplo: 12.345.678-9)</label>
                                    <div class="input-group">
                                        <input maxLength="12" type="text" class="form-control" id="inputRutCliente" name="inputRutCliente" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="btn_buscarCliente">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_cliente"></span>
                                                Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNacionalidadCliente">Nacionalidad</label>
                                    <select name="inputNacionalidadCliente" id="inputNacionalidadCliente" class="form-control">
                                        <option value="CHILENO/A" selected>Chileno/a</option>
                                        <option value="EXTRANJERO/A">Extranjero/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNombreCliente">Nombre completo</label>
                                    <input onblur="mayus(this);" maxLength="60" type="text" class="form-control" id="inputNombreCliente" name="inputNombreCliente" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputDireccionCliente">Direccion </label>
                                    <input onblur="mayus(this);" maxLength="60" type="text" class="form-control" id="inputDireccionCliente" name="inputDireccionCliente" required>
                                </div>


                                <div class="form-group col-xl-6">
                                    <label for="inputFechaNacimiento">Fecha Nacimiento</label>
                                    <input type="text" class="form-control input_data" readonly name="inputFechaNacimiento" id="inputFechaNacimiento" required />
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="inputEstadoCivil">Estado Civil</label>
                                    <select name="inputEstadoCivil" id="inputEstadoCivil" class="form-control">
                                        <option value="SOLTERO/A" selected>Soltero/a</option>
                                        <option value="CASADO/A">Casado/a</option>
                                        <option value="VIUDO/A">Viudo/a</option>
                                        <option value="DIVORCIADO/A">Divorciado/a</option>
                                        <option value="SEPARADO/A">Separado/a</option>
                                    </select>
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
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" id="inputTelefonoCliente" name="inputTelefonoCliente" required>
                                    </div>

                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCorreoCliente">Correo electronico </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input onblur="mayus(this);" maxLength="50" type="email" class="form-control" id="inputCorreoCliente" name="inputCorreoCliente" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="option_empresa">
                        <div class="card-body">
                            <h5>Datos Empresa</h5>
                            <div class="form-row">
                                <div class="form-group col-xl-6">
                                    <label for="inputRutEmpresa">Rut (ejemplo: 12.345.678-9) </label>
                                    <div class="input-group">
                                        <input maxLength="12" type="text" type="text" class="form-control" id="inputRutEmpresa" name="inputRutEmpresa" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="btn_buscarEmpresa">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_empresa"></span>
                                                Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputNombreEmpresa">Nombre </label>
                                    <input onblur="mayus(this);" maxLength="60" type="text" class="form-control" id="inputNombreEmpresa" name="inputNombreEmpresa" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCorreoEmpresa">Correo electronico</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input onblur="mayus(this);" maxLength="60" type="email" class="form-control" id="inputCorreoEmpresa" name="inputCorreoEmpresa" required>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputDireccionEmpresa">Direccion comercial</label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" id="inputDireccionEmpresa" name="inputDireccionEmpresa" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputComunaEmpresa">Comuna / region </label>
                                    <select class="form-control" id="inputComunaEmpresa" name="inputComunaEmpresa">
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputCiudadEmpresa">Ciudad / pueblo </label>
                                    <select class="form-control" id="inputCiudadEmpresa" name="inputCiudadEmpresa">
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputTelefonoEmpresa">Telefono </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+569</span>
                                        </div>
                                        <input oninput="this.value = soloNumeros(this)" maxLength="8" type="number" class="form-control" id="inputTelefonoEmpresa" name="inputTelefonoEmpresa" required>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputVigencia">Vigencia</label>
                                    <select id="inputVigencia" name="inputVigencia" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="inputRol">Rol o rubro</label>
                                    <input onblur="mayus(this);" maxLength="50" type="text" class="form-control" name="inputRol" id="inputRol" required>
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
                                    <input type="text" class="form-control " name="titulo_reserva" id="titulo_reserva" required />
                                </div>

                                <div class="form-group col-xl-6">
                                    <label for="vehiculo">seleccionar vehiculo</label>
                                    <select id="vehiculo" name="vehiculo" class="form-control">
                                        <option value="null" selected="selected">Seleccione un vehiculo</option>
                                    </select>

                                </div>

                                <div class="form-group col-xl-5">
                                    <label for="fecha_inicio">fecha inicio</label>
                                    <input type="text" readonly class="form-control " name="fecha_inicio" id="fecha_inicio" required />
                                </div>
                                <div class="form-group col-xl-5">
                                    <label for="fecha_fin">fecha fin</label>
                                    <input type="text" readonly class="form-control" name="fecha_fin" id="fecha_fin" required />
                                </div>
                                <div class="form-group col-xl-2">
                                    <label for="inputNumeroDias">Numeros de Dias</label>
                                    <input min="1" oninput="calcularDias()" type="number" class="form-control" name="inputNumeroDias" id="inputNumeroDias" required>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="descripcion">descripcion</label>
                                    <textarea required onblur="mayus(this);" class="form-control" id="descripcion" name="descripcion" rows="3" maxLength="300"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btn_guardarReserva" class="btn btn-success" class="">guardar reserva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>