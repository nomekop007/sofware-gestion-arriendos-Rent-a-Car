<main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion Clientes</h1>
    </div>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-clientes-tab" data-toggle="tab" href="#nav-clientes" role="tab"
                    aria-controls="nav-clientes" aria-selected="true">Particulares</a>
                <a class="nav-link" id="nav-empresas-tab" data-toggle="tab" href="#nav-empresas" role="tab"
                    aria-controls="nav-empresas" aria-selected="false">Empresas</a>
                <a class="nav-link" id="nav-conductores-tab" data-toggle="tab" href="#nav-conductores" role="tab"
                    aria-controls="nav-conductores" aria-selected="false">Conductores asignados</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <br>
            <br>
            <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">
                <div class="scroll">
                    <table id="tablaClientes" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaClientes">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
                <div class="scroll">
                    <table id="tablaEmpresas" class="table table-striped table-bordered" style="width:100%">

                        <thead class="btn-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>Rol</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>Rol</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaEmpresas">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-conductores" role="tabpanel" aria-labelledby="nav-conductores-tab">
                <div class="scroll">
                    <table id="tablaConductores" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>Clase</th>
                                <th>telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>Clase</th>
                                <th>telefono</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaConductores">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>


<!-- Modal particulares-->
<div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_header">Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="spinner_cliente">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="form_cliente">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputNombreCliente">Nombre Completo</label>
                                <input disabled type="text" class="form-control" id="inputNombreCliente">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputRutCliente">Rut </label>
                                <input disabled type="text" class="form-control" id="inputRutCliente">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputEstadoCivilCliente">Estado Civil </label>
                                <input disabled type="text" class="form-control" id="inputEstadoCivilCliente">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputNacimientoCliente">Fecha de Nacimiento </label>
                                <input disabled type="text" class="form-control" id="inputNacimientoCliente">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCorreoCliente">Correo electronico </label>
                                <input disabled type="email" class="form-control" id="inputCorreoCliente">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputTelefonoCliente">Numero contacto </label>
                                <input disabled type="text" class="form-control" id="inputTelefonoCliente">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputDireccionCliente">Direccion </label>
                                <input disabled type="text" class="form-control" id="inputDireccionCliente">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCiudadCliente">Ciudad </label>
                                <input disabled type="text" class="form-control" id="inputCiudadCliente">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCreateAtCliente">Registrado el </label>
                                <input disabled type="text" class="form-control" id="inputCreateAtCliente">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="form_empresa">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputNombreEmpresa">Nombre Empresa</label>
                                <input disabled type="text" class="form-control" id="inputNombreEmpresa">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputRutEmpresa">Rut</label>
                                <input disabled type="text" class="form-control" id="inputRutEmpresa">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputRolEmpresa">Rol</label>
                                <input disabled type="text" class="form-control" id="inputRolEmpresa">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="inputVigenciaEmpresa">Vigencia</label>
                                <input disabled type="text" class="form-control" id="inputVigenciaEmpresa">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="inputDireccionEmpresa">Direccion</label>
                                <input disabled type="text" class="form-control" id="inputDireccionEmpresa">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="inputCorreoEmpresa">Correo</label>
                                <input disabled type="text" class="form-control" id="inputCorreoEmpresa">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCiudadEmpresa">Ciudad</label>
                                <input disabled type="text" class="form-control" id="inputCiudadEmpresa">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputTelefonoEmpresa">Numero Contacto</label>
                                <input disabled type="text" class="form-control" id="inputTelefonoEmpresa">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCreateAtEmpresa">Registrado el</label>
                                <input disabled type="text" class="form-control" id="inputCreateAtEmpresa">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="form_conductor">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-5">
                                <label for="inputNombreConductor">Nombre Completo</label>
                                <input disabled type="text" class="form-control" id="inputNombreConductor">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputRutConductor">Rut</label>
                                <input disabled type="text" class="form-control" id="inputRutConductor">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputTelefonoConductor">Numero de contacto</label>
                                <input disabled type="text" class="form-control" id="inputTelefonoConductor">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="inputDireccionConductor">Direccion</label>
                                <input disabled type="text" class="form-control" id="inputDireccionConductor">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputClaseConductor">Clase licencia</label>
                                <input disabled type="text" class="form-control" id="inputClaseConductor">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputNumeroConductor">Numero licencia</label>
                                <input disabled type="text" class="form-control" id="inputNumeroConductor">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputVCTOconductor">VCTO licencia</label>
                                <input disabled type="text" class="form-control" id="inputVCTOconductor">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputMunicipalidadConductor">Municipalidad</label>
                                <input disabled type="text" class="form-control" id="inputMunicipalidadConductor">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="inputCreateAtConductor">Registrado el</label>
                                <input disabled type="text" class="form-control" id="inputCreateAtConductor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
$("#m_cliente").addClass("active");
$("#l_cliente").addClass("card");


const buscarCliente = async (rut_cliente) => {
    limpiarCampos();
    const data = new FormData();
    data.append("rut_cliente", rut_cliente);
    const response = await ajax_function(data, "buscar_cliente");
    if (response.success) {
        const cliente = response.data;
        $("#form_header").text("Cliente particular");
        $("#inputNombreCliente").val(cliente.nombre_cliente);
        $("#inputRutCliente").val(cliente.rut_cliente);
        $("#inputEstadoCivilCliente").val(cliente.estadoCivil_cliente);
        $("#inputNacimientoCliente").val(cliente.fechaNacimiento_cliente ? formatearFecha(
            cliente
            .fechaNacimiento_cliente) : "");
        $("#inputCorreoCliente").val(cliente.correo_cliente);
        $("#inputCiudadCliente").val(cliente.ciudad_cliente);
        $("#inputDireccionCliente").val(cliente.direccion_cliente);
        $("#inputTelefonoCliente").val("+569 " + cliente.telefono_cliente);
        $("#inputCreateAtCliente").val(formatearFechaHora(cliente.createdAt));

        $("#spinner_cliente").hide();
        $("#form_cliente").show();
    }
}


const buscarEmpresa = async (rut_empresa) => {
    limpiarCampos();
    const data = new FormData();
    data.append("rut_empresa", rut_empresa);
    const response = await ajax_function(data, "buscar_empresa");
    if (response.success) {
        const empresa = response.data;
        $("#form_header").text("Cliente Empresa");
        $("#inputCiudadEmpresa").val(empresa.ciudad_empresa);
        $("#inputCorreoEmpresa").val(empresa.correo_empresa);
        $("#inputCreateAtEmpresa").val(formatearFechaHora(empresa.createdAt));
        $("#inputDireccionEmpresa").val(empresa.direccion_empresa);
        $("#inputNombreEmpresa").val(empresa.nombre_empresa);
        $("#inputRolEmpresa").val(empresa.rol_empresa);
        $("#inputRutEmpresa").val(empresa.rut_empresa);
        $("#inputTelefonoEmpresa").val("+569 " + empresa.telefono_empresa);
        $("#inputVigenciaEmpresa").val(empresa.vigencia_empresa);
        $("#spinner_cliente").hide();
        $("#form_empresa").show();
    }
}

const buscarConductor = async (rut_conductor) => {
    limpiarCampos();
    const data = new FormData();
    data.append("rut_conductor", rut_conductor);
    const response = await ajax_function(data, "buscar_conductor");
    if (response.success) {
        const conductor = response.data;
        $("#form_header").text("Conductor");
        $("#inputClaseConductor").val(conductor.clase_conductor);
        $("#inputCreateAtConductor").val(formatearFechaHora(conductor.createdAt));
        $("#inputDireccionConductor").val(conductor.direccion_conductor);
        $("#inputMunicipalidadConductor").val(conductor.municipalidad_conductor);
        $("#inputNombreConductor").val(conductor.nombre_conductor);
        $("#inputNumeroConductor").val(conductor.numero_conductor);
        $("#inputRutConductor").val(conductor.rut_conductor);
        $("#inputTelefonoConductor").val("+569 " + conductor.telefono_conductor);
        $("#inputVCTOconductor").val(conductor.vcto_conductor ? formatearFecha(conductor
            .vcto_conductor) : "");
        $("#spinner_cliente").hide();
        $("#form_conductor").show();
    }
}


const limpiarCampos = () => {
    $("#form_cliente").hide();
    $("#form_empresa").hide();
    $("#form_conductor").hide();
    $("#spinner_cliente").show();
    $("#form_header").text("");

    $("#inputNombreCliente").val("");
    $("#inputRutCliente").val("");
    $("#inputEstadoCivilCliente").val("");
    $("#inputNacimientoCliente").val("");
    $("#inputCorreoCliente").val("");
    $("#inputCiudadCliente").val("");
    $("#inputDireccionCliente").val("");
    $("#inputTelefonoCliente").val("");
    $("#inputCreateAtCliente").val("");

    $("#inputCiudadEmpresa").val("");
    $("#inputCorreoEmpresa").val("");
    $("#inputCreateAtEmpresa").val("");
    $("#inputDireccionEmpresa").val("");
    $("#inputNombreEmpresa").val("");
    $("#inputRolEmpresa").val("");
    $("#inputRutEmpresa").val("");
    $("#inputTelefonoEmpresa").val("");
    $("#inputVigenciaEmpresa").val("");

    $("#inputClaseConductor").val("");
    $("#inputCreateAtConductor").val("");
    $("#inputDireccionConductor").val("");
    $("#inputMunicipalidadConductor").val("");
    $("#inputNombreConductor").val("");
    $("#inputNumeroConductor").val("");
    $("#inputRutConductor").val("");
    $("#inputTelefonoConductor").val("");
    $("#inputVCTOconductor").val("");
}
</script>



<!-- importando archivo js vehiculos -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_clientes.js"></script>