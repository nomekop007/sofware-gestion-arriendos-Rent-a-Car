 <!-- Tab donde se registran los arriendos -->
 <div class="tab-pane fade show active" id="nav-registrar" role="tabpanel" aria-labelledby="nav-registrar-tab">
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
                         <input onblur="mayus(this);" type="text" class="form-control" name="inputCiudadEntrega"
                             id="inputCiudadEntrega" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputFechaEntrega">Fecha de entrega</label>
                         <input type="datetime-local" class="form-control" name="inputFechaEntrega"
                             id="inputFechaEntrega" required>
                     </div>

                     <div class="form-group col-md-3">
                         <label for="inputCiudadRecepcion">Ciudad de Recepcion</label>
                         <input onblur="mayus(this);" type="text" class="form-control" name="inputCiudadRecepcion"
                             id="inputCiudadRecepcion" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputFechaRecepcion">Fecha de Recepcion</label>
                         <input type="datetime-local" class="form-control" name="inputFechaRecepcion"
                             id="inputFechaRecepcion" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="selectSucursal">Agencia de Arriendo</label>
                         <select class="custom-select" id="selectSucursal" name="selectSucursal">
                         </select>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputTipo">Tipo de Arriendo</label>
                         <select onblur="tipoArriendo();" name="inputTipo" id="inputTipo" class="form-control">
                             <option value="1" selected>Arriendo persona natural</option>
                             <option value="2">Arriendo remplazo copago</option>
                             <option value="3">Arriendo solo empresa</option>
                         </select>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputNumeroDias">Numeros de Dias</label>
                         <input min="1" value="1" type="number" class="form-control" name="inputNumeroDias"
                             id="inputNumeroDias" required>
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
                             <input maxLength="9" onblur=" value ? this.value=formateaRut(this.value) : null"
                                 type="text" class="form-control" id="inputRutCliente" name="inputRutCliente" required>
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
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreCliente" name="inputNombreCliente" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputDireccionCliente">Direccion </label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccionCliente" name="inputDireccionCliente" required>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputCiudadCliente">Ciudad </label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputCiudadCliente" name="inputCiudadCliente" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputFechaNacimiento">Fecha Nacimiento </label>
                         <input onblur="mayus(this);" maxLength="30" type="date" class="form-control"
                             id="inputFechaNacimiento" name="inputFechaNacimiento" required>
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
                             <input onblur="mayus(this);" maxLength="30" type="email" class="form-control"
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
                             <input maxLength="10" onblur=" value ? this.value=formateaRut(this.value) : null"
                                 maxLength="30" type="text" class="form-control" id="inputRutEmpresa"
                                 name="inputRutEmpresa" required>
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
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreEmpresa" name="inputNombreEmpresa" required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputDireccionEmpresa">Direccion comercial</label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccionEmpresa" name="inputDireccionEmpresa" required>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputCiudadEmpresa">Ciudad</label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputCiudadEmpresa" name="inputCiudadEmpresa" required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputCorreoEmpresa">Correo electronico</label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text">@</span>
                             </div>
                             <input onblur="mayus(this);" maxLength="30" type="email" class="form-control"
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
                     <div class="form-group col-md-4">
                         <label for="inputRol">Rol o rubro</label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control" name="inputRol"
                             id="inputRol" required>
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
                             <input type="text" class="form-control" maxLength="9"
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
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreConductor" name="inputNombreConductor" required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputDireccionConductor">Direccion</label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccionConductor" name="inputDireccionConductor" required>
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
                         <label for="inputClaseConductor">Clase</label>
                         <select name="inputClaseConductor" id="inputClaseConductor" class="form-control">
                             <option value="Clase B" selected>Clase B</option>
                             <option value="Clase C">Clase C</option>
                             <option value="Clase D">Clase D</option>
                             <option value="Clase E">Clase E</option>
                             <option value="Clase F">Clase F</option>
                             <option value="Clase A1">Clase A1</option>
                             <option value="Clase A2">Clase A2</option>
                             <option value="Clase A3">Clase A3</option>
                             <option value="Clase A4">Clase A4</option>
                             <option value="Clase A5">Clase A5</option>
                         </select>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputVCTOConductor">VCTO</label>
                         <input type="date" class="form-control" id="inputVCTOConductor" name="inputVCTOConductor"
                             required>
                     </div>

                     <div class="form-group col-md-2">
                         <label for="inputNumeroConductor">Numero serie</label>
                         <input onkeypress="return soloNumeros(event);" maxLength="11" type="text" class="form-control"
                             id="inputNumeroConductor" name="inputNumeroConductor" required>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputMunicipalidadConductor">Municipalidad</label>
                         <input onblur="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputMunicipalidadConductor" name="inputMunicipalidadConductor" required>
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
                     <div class="card bg-light">
                         <br>
                         <div class="row text-center">
                             <br>
                             <div class="form-group col-md-6 ">
                                 <label for="inputCarnetFrontal">(frontal)</label>
                                 <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                     id="inputCarnetFrontal" name="inputCarnetFrontal" required>
                             </div>
                             <div class="form-group col-md-6 ">
                                 <label for="inputCarnetTrasera">(trasera)</label>
                                 <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                     id="inputCarnetTrasera" name="inputCarnetTrasera" required>
                             </div>
                         </div>
                     </div>
                     <br><br>
                     <h6>Tarjeta de credito</h6>
                     <div class="card bg-light">
                         <div class="row text-center">
                             <div class="form-group col-md-6">
                                 <br>
                                 <label for="inputTarjetaFrontal">(frontal)</label>
                                 <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                     id="inputTarjetaFrontal" name="inputTarjetaFrontal" required>
                             </div>
                             <div class="form-group col-md-6">
                                 <br>
                                 <label for="inputTarjetaTrasera">(trasera)</label>
                                 <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                     id="inputTarjetaTrasera" name="inputTarjetaTrasera" required>
                             </div>
                         </div>
                     </div>
                     <br><br>

                     <div class="form-row">
                         <div class="form-group col-md-12 ">
                             <h6 for="inputLicencia">Licencia de conducir</h6>
                             <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                 id="inputLicencia" name="inputLicencia" required>
                             <br>
                         </div>
                         <div class="form-group col-md-12">
                             <h6 for="inputChequeGarantia">Cheque en garantia</h6>
                             <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                 id="inputChequeGarantia" name="inputChequeGarantia" required>
                             <br>
                         </div>

                         <div id="formComprobanteDomicilio" class="form-group col-md-12">
                             <h6 for="inputComprobanteDomicilio">Comprobante de domicilio</h6>
                             <input accept="image/.jpeg,.jpg,.png,.gif, .pdf" type="file" class="form-control-file"
                                 id="inputComprobanteDomicilio" name="inputComprobanteDomicilio" required>
                             <br>
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
                         <select disabled class="custom-select form-control" id="select_vehiculos"
                             name="select_vehiculos" style="width: 100%;">
                         </select>
                     </div>
                 </div>
                 <br>
                 <h4>Kilometros</h4>
                 <div class="form-row">
                     <div class="form-group col-md-3">
                         <label for="inputEntrada">Entrada</label>
                         <input onkeypress="return soloNumeros(event);" value=0 maxLength="11" type="text"
                             class="form-control" id="inputEntrada" name="inputEntrada" required>
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
                             <input type="text" name="inputOtros" onblur="mayus(this);" maxLength="20"
                                 class="form-control" aria-label="Sizing example input" aria-describedby="inputOtros">
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