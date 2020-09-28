<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_route(); ?>cargarPanel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vehiculos</li>
            </ol>
        </nav>
        <h1 class="h3">Modulo Vehiculos</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-registrar-tab" data-toggle="tab" href="#nav-registrar" role="tab"
                    aria-controls="nav-registrar" aria-selected="true">Registrar nuevo vehiculo</a>
                <a class="nav-link" id="nav-vehiculos-tab" data-toggle="tab" href="#nav-vehiculos" role="tab"
                    aria-controls="nav-vehiculos" aria-selected="false">Mostrar todos los vehiculos</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <!-- Tab Formulario de Registrar vehiculos -->
            <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel"
                aria-labelledby="nav-registrar-tab">
                <br><br>
                <form class="needs-validation" novalidate id="form_registrar_vehiculo">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputPatente">Patente</label>
                            <input oninput="mayus(this);" maxLength="10" type="text" class="form-control"
                                id="inputPatente" name="inputPatente" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputMarca">Marca</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputMarca" name="inputMarca" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputModelo">Modelo</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputModelo" name="inputModelo" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputedad">Año</label>
                            <select id="inputedad" name="inputedad" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputTipo">Tipo</label>
                            <select id="inputTipo" name="inputTipo" class="form-control">
                                <option value="AUTOMOVIL" selected>Automovil</option>
                                <option value="CAMIONETA">Camioneta</option>
                                <option value="FURGON">Furgón</option>
                                <option value="CONVERTIBLE">Convertible</option>
                                <option value="DOBLE CABINA">Doble Cabina</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputTransmision">Transmision</label>
                            <select id="inputTransmision" name="inputTransmision" class="form-control">
                                <option value="AUTOMATICO" selected>Automatico</option>
                                <option value="MANUAL">Manual</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputChasis">Chasis de Vehiculo</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputChasis" name="inputChasis" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputColor">Color</label>
                            <input oninput="mayus(this);" maxLength="15" type="text" class="form-control"
                                id="inputColor" name="inputColor" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputNumeroMotor">Nº Motor</label>
                            <input type="text" maxLength="30" class="form-control" id="inputNumeroMotor"
                                name="inputNumeroMotor" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPrecio">Precio</label>
                            <input min="0" type="number" name="inputPrecio" class="form-control" id="inputPrecio"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPropietario">Propietario</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputPropietario" name="inputPropietario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCompra">Donde se compro</label>
                            <input oninput="mayus(this);" maxLength="50" type="text" class="form-control"
                                id="inputCompra" name="inputCompra" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputSucursal">Sucursal</label>
                            <select id="inputSucursal" name="inputSucursal" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEstado">Estado</label>
                            <select id="inputEstado" name="inputEstado" class="form-control">
                                <option value="DISPONIBLE" selected>Disponible</option>
                                <option value="INACTIVO">Inactivo</option>
                                <option value="ARRENDADO">Arrendado</option>
                                <option value="SINIESTRADO">Siniestrado</option>
                                <option value="MANTENCION">En mantencion</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputFechaCompra">Fecha de compra</label>
                            <input type="date" class="form-control" id="inputFechaCompra" name="inputFechaCompra"
                                required>
                        </div>
                        <div class="form-group col-md-4">

                            <label for="inputFoto">Foto (opcional)</label>
                            <input accept="image/.jpeg,.jpg,.png,.gif," type="file" class="form-control-file"
                                id="inputFoto" name="inputFoto">
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-dark" id="btn_registrar_vehiculo">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_registrar"></span>
                        Registrar Vehiculo</button>
                </form>
            </div>

            <!-- Tab con la tabla de los vehiculos -->
            <div class="tab-pane fade" id="nav-vehiculos" role="tabpanel" aria-labelledby="nav-vehiculos-tab">
                <br><br>
                <table id="tablaVehiculos" class="table table-striped table-bordered" style="width:100%">
                    <thead class="btn-dark">
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>año</th>
                            <th>Tipo</th>
                            <th>transmision</th>
                            <th>Sucursal</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="vehiculos">

                    </tbody>
                    <tfoot class="btn-dark">
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>año</th>
                            <th>Tipo</th>
                            <th>transmision</th>
                            <th>Sucursal</th>
                            <th>Estado</th>
                            <th></th>

                        </tr>
                    </tfoot>
                </table>
                <div class="text-center" id="spinner_tablaVehiculos">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>

        </div>
        <br><br>
    </div>


</main>

</div>
</div>


<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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
                    <input type="text" id="inputEditarPatente" name="inputEditarPatente" hidden />
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarMarca">Marca del Vehiculo</label>
                                            <input oninput="mayus(this);" maxLength="50" type="text"
                                                class="form-control" id="inputEditarMarca" name="inputEditarMarca"
                                                required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarModelo">Modelo del Vehiculo</label>
                                            <input oninput="mayus(this);" maxLength="50" type="text"
                                                class="form-control" id="inputEditarModelo" name="inputEditarModelo"
                                                required>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarEdad">Año del Vehiculo</label>
                                            <select id="inputEditarEdad" name="inputEditarEdad" class="form-control">
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarTipo">Tipo de Vehiculo</label>
                                            <select id="inputEditarTipo" name="inputEditarTipo" class="form-control">
                                                <option value="AUTOMOVIL" selected>Automovil</option>
                                                <option value="CAMIONETA">Camioneta</option>
                                                <option value="FURGON">Furgón</option>
                                                <option value="CONVERTIBLE">Convertible</option>
                                                <option value="DOBLE CABINA">Doble Cabina</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarTransmision">Transmision del Vehiculo</label>
                                            <select id="inputEditarTransmision" name="inputEditarTransmision"
                                                class="form-control">
                                                <option value="AUTOMATICO" selected>Automatico</option>
                                                <option value="MANUAL">Manual</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarChasis">Chasis de Vehiculo</label>
                                            <input oninput="mayus(this);" maxLength="50" type="text"
                                                class="form-control" id="inputEditarChasis" name="inputEditarChasis"
                                                required>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarColor">Color del Vehiculo</label>
                                            <input oninput="mayus(this);" maxLength="15" type="text"
                                                class="form-control" id="inputEditarColor" name="inputEditarColor"
                                                required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarNumeroMotor">Nº Motor del Vehiculo</label>
                                            <input type="text" maxLength="30" class="form-control"
                                                id="inputEditarNumeroMotor" name="inputEditarNumeroMotor" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarPrecio">Precio del Vehiculo</label>
                                            <input min="0" type="number" name="inputEditarPrecio" class="form-control"
                                                id="inputEditarPrecio" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarSucursal">Sucursal</label>
                                            <select id="inputEditarSucursal" name="inputEditarSucursal"
                                                class="form-control">
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarEstado">Editar estado</label>
                                            <select id="inputEditarEstado" name="inputEditarEstado"
                                                class="form-control">
                                                <option value="DISPONIBLE" selected>Disponible</option>
                                                <option value="INACTIVO">Inactivo</option>
                                                <option value="ARRENDADO">Arrendado</option>
                                                <option value="SINIESTRADO">Siniestrado</option>
                                                <option value="MANTENCION">En mantencion</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-8">
                                            <label for="inputEditarPropietario">Propietario del Vehiculo</label>
                                            <input oninput="mayus(this);" maxLength="50" type="text"
                                                class="form-control" id="inputEditarPropietario"
                                                name="inputEditarPropietario" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputEditarCompra">Donde se compro</label>
                                            <input oninput="mayus(this);" maxLength="50" type="text"
                                                class="form-control" id="inputEditarCompra" name="inputEditarCompra"
                                                required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="inputEditarFechaCompra">Fecha de compra</label>
                                            <input type="date" class="form-control" id="inputEditarFechaCompra"
                                                name="inputEditarFechaCompra" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="inputCreateAt">Registrado El:</label>
                                            <input disabled type="text" class="form-control" id="inputCreateAt"
                                                name="inputCreateAt">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="imagen" class="img-fluid rounded float-right" alt="">

                                    <label for="inputEditarFoto">Cambiar foto</label>
                                    <input accept="image/.jpeg,.jpg,.png,.gif," type="file" class="form-control-file"
                                        id="inputEditarFoto" name="inputEditarFoto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_editar_vehiculo" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_editarVehiculo"></span>
                        Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script>
$("#m_vehiculo").addClass("active");
$("#l_vehiculo").addClass("card");


//sniper de btn registrar
$("#spinner_btn_registrar").hide();

function cargarVehiculo(patente) {
    limpiarCampos();
    $.getJSON({
        url: base_route + "buscar_vehiculo",
        type: "post",
        dataType: "json",
        data: {
            patente
        },
        success: (response) => {
            if (response.success) {
                const vehiculo = response.data;

                //se pregunta si tiene imagen el vehiculo
                if (vehiculo.foto_vehiculo) {
                    //se busca la url del storage
                    document.getElementById("imagen").src = storage + "fotosVehiculos/" +
                        vehiculo
                        .foto_vehiculo;
                } else {
                    document.getElementById("imagen").src = base_route + "assets/images/imageDefault.png";
                }

                $("#inputEditarPatente").val(vehiculo.patente_vehiculo);
                $("#exampleModalLongTitle").text("Editar Vehiculo " + vehiculo.patente_vehiculo);

                $("#inputEditarEstado").val(vehiculo.estado_vehiculo);
                $("#inputEditarMarca").val(vehiculo.marca_vehiculo);
                $("#inputEditarModelo").val(vehiculo.modelo_vehiculo);
                $("#inputEditarEdad").val(vehiculo.año_vehiculo);
                $("#inputEditarTipo").val(vehiculo.tipo_vehiculo);
                $("#inputEditarTransmision").val(vehiculo.transmision_vehiculo);
                $("#inputEditarChasis").val(vehiculo.chasis_vehiculo);
                $("#inputEditarColor").val(vehiculo.color_vehiculo);
                $("#inputEditarNumeroMotor").val(vehiculo.numeroMotor_vehiculo);
                $("#inputEditarPrecio").val(vehiculo.precio_vehiculo);
                $("#inputEditarSucursal").val(vehiculo.id_sucursal);
                $("#inputEditarCompra").val(vehiculo.compra_vehiculo);
                $("#inputEditarPropietario").val(vehiculo.propietario_vehiculo);
                $("#inputEditarFechaCompra").val(
                    vehiculo.fechaCompra_vehiculo ?
                    vehiculo.fechaCompra_vehiculo.substring(0, 10) :
                    null);
                $("#inputCreateAt").val(formatearFechaHora(vehiculo.createdAt));

                $("#modal_vehiculo").show();
                $("#spinner_vehiculo").hide();


            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Usuario no encontrado",
                });
                $("#modal_vehiculo").show();
                $("#spinner_vehiculo").hide();
            }
        },
        error: () => {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "A ocurrido un Error Contacte a informatica",
            });

        },
    });
}



function limpiarCampos() {
    $("#spinner_vehiculo").show();
    $("#spinner_btn_editarVehiculo").hide();
    $("#modal_vehiculo").hide();
    $("#spinner_vehiculo").show();


    $("#inputVehiculo").val("");
    $("#exampleModalLongTitle").text("");

    $("#inputEditarMarca").val("");
    $("#inputEditarModelo").val("");
    $("#inputEditarEdad").val("");
    $("#inputEditarTipo").val("");
    $("#inputEditarTransmision").val("");
    $("#inputEditarChasis").val("");
    $("#inputEditarColor").val("");
    $("#inputEditarNumeroMotor").val("");
    $("#inputEditarPrecio").val("");
    $("#inputEditarSucursal").val("");
    $("#inputEditarCompra").val("");
    $("#inputEditarPropietario").val("");
    $("#inputEditarFechaCompra").val("");
    $("#inputCreateAt").val("");
    $("#inputEditarEstado").val("");
    $("#inputEditarFoto").val("");
    document.getElementById("imagen").src = "";
}
</script>


<!-- importando archivo js vehiculos -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_vehiculos.js"></script>