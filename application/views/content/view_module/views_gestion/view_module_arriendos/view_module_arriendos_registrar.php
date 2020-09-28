 <!-- Tab donde se registran los arriendos -->
 <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-registrar-tab">
     <br>
     <form class="needs-validation" novalidate id="form_registrar_arriendo" name="formulario">
         <p>
             <a id="btn-arriendo" class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseArriendo"
                 role="button" aria-expanded="false" aria-controls="collapseArriendo">
                 Datos Arriendo
             </a>
             <a id="btn-cliente" class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseCliente"
                 role="button" aria-expanded="false" aria-controls="collapseCliente">
                 Datos cliente
             </a>
             <a id="btn-conductor" class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseConductor"
                 role="button" aria-expanded="false" aria-controls="collapseConductor">
                 Datos Conductor
             </a>
             <a id="btn-documentos" class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseDocumentos"
                 role="button" aria-expanded="false" aria-controls="collapseDocumentos">
                 Documentos requeridos
             </a>
             <a id="btn-vehiculo" class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseVehiculos"
                 role="button" aria-expanded="false" aria-controls="collapseVehiculos">
                 Seleccion de Vehiculo
             </a>

             <button type="submit" id="btn_crear_arriendo" class="btn btn-success btn-sm">
                 <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                     id="spinner_btn_registrar"></span>
                 Crear Arriendo</button>
         </p>


         <div class="collapse" id="collapseArriendo">
             <div class="card card-body">
                 <br>
                 <h4>Datos Arriendo</h4>
                 <br>
                 <div class="form-row">
                     <div class="form-group col-md-3">
                         <label for="inputCiudadEntrega">Ciudad de Entrega</label>
                         <input oninput="mayus(this);" type="text" class="form-control" name="inputCiudadEntrega"
                             id="inputCiudadEntrega" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputFechaEntrega">Fecha de entrega</label>
                         <input type="datetime-local" class="form-control" name="inputFechaEntrega"
                             id="inputFechaEntrega" required>
                     </div>

                     <div class="form-group col-md-3">
                         <label for="inputCiudadRecepcion">Ciudad de Recepcion</label>
                         <input oninput="mayus(this);" type="text" class="form-control" name="inputCiudadRecepcion"
                             id="inputCiudadRecepcion" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputFechaRecepcion">Fecha de Recepcion</label>
                         <input type="datetime-local" class="form-control" name="inputFechaRecepcion"
                             id="inputFechaRecepcion" required>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputNumeroDias">Numeros de Dias</label>
                         <input min="1" value="1" type="number" class="form-control" name="inputNumeroDias"
                             id="inputNumeroDias" required>
                     </div>

                     <div class="form-group col-md-4">
                         <label for="inputTipo">Tipo de Arriendo</label>
                         <select oninput="tipoArriendo();" name="inputTipo" id="inputTipo" class="form-control">
                             <option value="1" selected>Arriendo persona natural</option>
                             <option value="2">Arriendo remplazo copago</option>
                             <option value="3">Arriendo solo empresa</option>
                         </select>
                     </div>

                     <div class="form-group col-md-3">
                         <label for="selectSucursal">Agencia de Arriendo</label>
                         <select class="custom-select" id="selectSucursal" name="selectSucursal">
                         </select>
                     </div>
                 </div>
             </div>
         </div>

         <div class="collapse" id="collapseCliente">
             <div class="card card-body">
                 <br>
                 <h4 id="titulo_cliente">Datos Cliente</h4>
                 <div class="form-row" id="form_cliente">
                     <div class="form-group col-md-3">
                         <label for="inputRutCliente">Rut o Pasaporte</label>
                         <div class="input-group">
                             <input maxLength="12" oninput="mayus(this);"
                                 onblur=" value ? this.value=formateaRut(this.value) : null" type="text"
                                 class="form-control" id="inputRutCliente" name="inputRutCliente" required>
                             <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button" id="btn_buscarCliente">
                                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                         id="spinner_cliente"></span>
                                     Buscar</button>
                             </div>
                         </div>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputNombreCliente">Nombre completo</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreCliente" name="inputNombreCliente" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputDireccionCliente">Direccion </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccionCliente" name="inputDireccionCliente">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputCiudadCliente">Ciudad </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputCiudadCliente" name="inputCiudadCliente">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputFechaNacimiento">Fecha Nacimiento </label>
                         <input oninput="mayus(this);" maxLength="30" type="date" class="form-control"
                             id="inputFechaNacimiento" name="inputFechaNacimiento">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputEstadoCivil">Estado Civil</label>
                         <select name="inputEstadoCivil" id="inputEstadoCivil" class="form-control">
                             <option value="SOLTERO/A" selected>Soltero/a</option>
                             <option value="CASADO/A">Casado/a</option>
                             <option value="VIUDO/A">Viudo/a</option>
                             <option value="DIVORCIADO/A">Divorciado/a</option>
                             <option value="SEPARADO/A">Separado/a</option>
                         </select>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputTelefonoCliente">Telefono </label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text">+569</span>
                             </div>
                             <input onkeypress="return soloNumeros(event);" maxLength="8" type="text"
                                 class="form-control" id="inputTelefonoCliente" name="inputTelefonoCliente" required>
                         </div>

                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputCorreoCliente">Correo electronico </label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text">@</span>
                             </div>
                             <input oninput="mayus(this);" maxLength="30" type="email" class="form-control"
                                 id="inputCorreoCliente" name="inputCorreoCliente" required>
                         </div>
                     </div>
                 </div>
                 <br>
                 <h4 id="titulo_empresa">Datos Empresa</h4>
                 <div class="form-row" id="form_empresa">
                     <div class="form-group col-md-4">
                         <label for="inputRutEmpresa">Rut </label>
                         <div class="input-group">
                             <input maxLength="13" oninput="mayus(this);"
                                 onblur=" value ? this.value=formateaRut(this.value) : null" maxLength="30" type="text"
                                 class="form-control" id="inputRutEmpresa" name="inputRutEmpresa" required>
                             <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button" id="btn_buscarEmpresa">
                                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                         id="spinner_empresa"></span>
                                     Buscar</button>
                             </div>
                         </div>

                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputNombreEmpresa">Nombre </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreEmpresa" name="inputNombreEmpresa" required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputDireccionEmpresa">Direccion</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccionEmpresa" name="inputDireccionEmpresa">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputCiudadEmpresa">Ciudad</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputCiudadEmpresa" name="inputCiudadEmpresa">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputCorreoEmpresa">Correo electronico</label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text">@</span>
                             </div>
                             <input oninput="mayus(this);" maxLength="30" type="email" class="form-control"
                                 id="inputCorreoEmpresa" name="inputCorreoEmpresa" required>
                         </div>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputTelefonoEmpresa">Telefono </label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text">+569</span>
                             </div>
                             <input onkeypress="return soloNumeros(event);" maxLength="8" type="text"
                                 class="form-control" id="inputTelefonoEmpresa" name="inputTelefonoEmpresa" required>
                         </div>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputVigencia">Vigecia</label>
                         <select id="inputVigencia" name="inputVigencia" class="form-control">
                         </select>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputRol">Rol</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" name="inputRol"
                             id="inputRol">
                     </div>
                 </div>
             </div>
         </div>

         <div class="collapse" id="collapseConductor">
             <div class="card card-body">
                 <br>
                 <h4>Datos Conductor asignado</h4>
                 <div class="form-row">
                     <div class="form-group  col-md-4">
                         <label for="inputRutConductor">Rut</label>
                         <div class="input-group">
                             <input type="text" class="form-control" oninput="mayus(this);"
                                 onblur=" value ? this.value=formateaRut(this.value) : null" id="inputRutConductor"
                                 name="inputRutConductor" required>
                             <div class="input-group-append">

                                 <button class="btn btn-outline-secondary" type="button" id="btn_buscarConductor">
                                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                         id="spinner_conductor"></span>
                                     Buscar</button>
                             </div>
                         </div>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputNombreConductor">Nombre completo </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreConductor" name="inputNombreConductor" required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputDireccion">Direccion</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccion" name="inputDireccion">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputTelefonoConductor">Telefono </label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text">+569</span>
                             </div>
                             <input onkeypress="return soloNumeros(event);" maxLength="8" type="text"
                                 class="form-control" id="inputTelefonoConductor" name="inputTelefonoConductor"
                                 required>
                         </div>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputClase">Clase</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputClase"
                             name="inputClase">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputVCTO">VCTO</label>
                         <input maxLength="30" type="date" class="form-control" id="inputVCTO" name="inputVCTO">
                     </div>

                     <div class="form-group col-md-2">
                         <label for="inputNumero">Numero serie</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputNumero"
                             name="inputNumero">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputMunicipalidad">Municipalidad</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputMunicipalidad" name="inputMunicipalidad">
                     </div>
                 </div>
             </div>
         </div>


         <div class="collapse" id="collapseDocumentos">
             <div class="card  card-body">
                 <br>
                 <h4>Documentos requeridos</h4>
                 <br><br><br>

                 <div class="container">
                     <h6>Foto Carnet</h6>
                     <div class="card ">
                         <br>
                         <div class="row text-center">
                             <br>
                             <div class="form-group col-md-6 ">
                                 <label for="inputCarnetFrontal">(frontal)</label>
                                 <input type="file" class="form-control-file" id="inputCarnetFrontal"
                                     name="inputCarnetFrontal" required>
                             </div>
                             <div class="form-group col-md-6 ">
                                 <label for="inputCarnetTrasera">(trasera)</label>
                                 <input type="file" class="form-control-file" id="inputCarnetTrasera"
                                     name="inputCarnetTrasera" required>
                             </div>
                         </div>
                     </div>
                     <br><br>
                     <h6>Licencia de conducir</h6>
                     <div class="card">
                         <div class="row text-center">
                             <div class="form-group col-md-6">
                                 <br>
                                 <label for="inputLicenciaFrontal">(frontal)</label>
                                 <input type="file" class="form-control-file" id="inputLicenciaFrontal"
                                     name="inputLicenciaFrontal" required>
                             </div>
                             <div class="form-group col-md-6">
                                 <br>
                                 <label for="inputLicenciatrasera">(trasera)</label>
                                 <input type="file" class="form-control-file" id="inputLicenciatrasera"
                                     name="inputLicenciatrasera" required>
                             </div>
                         </div>
                     </div>
                     <br><br>

                     <div class="form-row">
                         <div class="form-group col-md-12">
                             <label for="inputTargeta">Targeta de credito</label>
                             <input type="file" class="form-control-file" id="inputTargeta" name="inputTargeta"
                                 required>
                         </div>
                         <div class="form-group col-md-12">
                             <label for="inputChequeGarantia">Cheque en garantia</label>
                             <input type="file" class="form-control-file" id="inputChequeGarantia"
                                 name="inputChequeGarantia" required>
                         </div>

                         <div id="formComprobanteDomicilio" class="form-group col-md-12">
                             <label for="inputComprobanteDomicilio">Comprobante de domicilio</label>
                             <input type="file" class="form-control-file" id="inputComprobanteDomicilio"
                                 name="inputComprobanteDomicilio" required>
                         </div>
                     </div>
                 </div>
             </div>




         </div>
 </div>

 <div class="collapse" id="collapseVehiculos">
     <div class="card card-body">
         <br>
         <h4>Seleccion de Vehiculo</h4>
         <br>
         <div class="form-row">
             <div class="input-group col-md-5">
                 <select class="custom-select" id="inputSucursal" aria-label="Example select with button addon">
                 </select>
                 <div class="input-group-append">
                     <bustton class="btn btn-outline-secondary" id="buscar_vehiculos" type="button">
                         Buscar</button>
                 </div>
             </div>
             <div class="input-group col-md-7" required>
                 <select disabled class="custom-select form-control" id="select_vehiculos" name="select_vehiculos"
                     style="width: 100%;">
                 </select>
             </div>
         </div>
         <br>
         <h4>Kilometros</h4>
         <div class="form-row">
             <div class="form-group col-md-3">
                 <label for="inputEntrada">Entrada</label>
                 <input min="0" value="0" type="number" class="form-control" id="inputEntrada" name="inputEntrada">
             </div>

         </div>
         <br>
         <h4>Accesorios</h4>
         <div class="form-row" id="row_accesorios">

         </div>
         <div class="form-row">
             <div class="form-group col-md-4">
                 <br><br>
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text" id="inputOtros">otros</span>
                     </div>
                     <input type="text" name="inputOtros" oninput="mayus(this);" maxLength="20" class="form-control"
                         aria-label="Sizing example input" aria-describedby="inputOtros">
                 </div>
             </div>
         </div>
     </div>
 </div>

 </form>
 </div>


 <script>
//espiners de los forms cliente , conductor y empresa
$("#spinner_conductor").hide();
$("#spinner_cliente").hide();
$("#spinner_empresa").hide();
$("#spinner_btn_registrar").hide();
$("#spinner_btn_crearContrato").hide();


// Script para cambia el tab cliente de acuerdo al tipo de arriendo
(tipoArriendo = () => {
    var a = $("#inputTipo option:selected").val();
    if (a == 1) {
        $('#titulo_empresa').hide();
        $('#form_empresa').hide();
        $('#form_carnet_empresa').hide();
        $('#titulo_cliente').show();
        $('#form_cliente').show();
        $('#form_comprobante_cliente').show();
        $('#form_licencia_conducir').show();
        $('#form_carnet_cliente').show();
        $('#formComprobanteDomicilio').show();
    } else if (a == 2) {
        $('#titulo_cliente').show();
        $('#form_cliente').show();
        $('#titulo_empresa').show();
        $('#form_empresa').show();
        $('#form_carnet_empresa').show();
        $('#form_comprobante_cliente').show();
        $('#form_licencia_conducir').show();
        $('#form_carnet_cliente').show();
        $('#formComprobanteDomicilio').show();
    } else {
        $('#titulo_cliente').hide();
        $('#form_cliente').hide();
        $('#form_carnet_cliente').hide();
        $('#form_comprobante_cliente').hide();
        $('#titulo_empresa').show();
        $('#form_empresa').show();
        $('#formComprobanteDomicilio').hide();
    }
})();
 </script>