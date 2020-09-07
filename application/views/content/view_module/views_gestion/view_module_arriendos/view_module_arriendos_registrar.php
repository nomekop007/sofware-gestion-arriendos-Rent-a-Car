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
             <a id="btn-vehiculo" class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseVehiculos"
                 role="button" aria-expanded="false" aria-controls="collapseVehiculos">
                 Seleccion de Vehiculo
             </a>

             <button type="submit" id="btn_crear_arriendo" class="btn btn-success btn-sm">Crear
                 Arriendo</button>
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
                     <div class="form-group col-md-3">
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
                         <input maxLength="12" onblur=" value ? this.value=formateaRut(this.value) : null" type="text"
                             class="form-control" id="inputrutCliente" name="inputrutCliente" required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputNombreCliente">Nombre</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreCliente" name="inputNombreCliente">
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
                     <div class="form-group col-md-4">
                         <label for="inputFechaNacimiento">Fecha Nacimiento </label>
                         <input oninput="mayus(this);" maxLength="30" type="date" class="form-control"
                             id="inputFechaNacimiento" name="inputFechaNacimiento">
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputTelefonoCliente">Telefono </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputTelefonoCliente" name="inputTelefonoCliente">
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputCorreoCliente">Correo </label>
                         <input oninput="mayus(this);" maxLength="30" type="email" class="form-control"
                             id="inputCorreoCliente" name="inputCorreoCliente" required>
                     </div>
                 </div>
                 <br>
                 <h4 id="titulo_empresa">Datos Empresa</h4>
                 <div class="form-row" id="form_empresa">
                     <div class="form-group col-md-3">
                         <label for="inputRutEmpresa">Rut </label>
                         <input maxLength="13" onblur=" value ? this.value=formateaRut(this.value) : null"
                             maxLength="30" type="text" class="form-control" id="inputRutEmpresa" name="inputRutEmpresa"
                             required>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputNombreEmpresa">Nombre </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreEmpresa" name="inputNombreEmpresa">
                     </div>
                     <div class="form-group col-md-3">
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
                         <label for="inputTelefonoEmpresa">Telefono </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputTelefonoEmpresa" name="inputTelefonoEmpresa">
                     </div>
                     <div class="form-group col-md-4">
                         <label for="inputCorreoEmpresa">Correo </label>
                         <input oninput="mayus(this);" maxLength="30" type="email" class="form-control"
                             id="inputCorreoEmpresa" name="inputCorreoEmpresa">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputVigencia">Vigecia</label>
                         <select id="inputVigencia" name="inputVigencia" class="form-control">
                         </select>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputRol">Rol</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" name="inputRol"
                             id="inputRol">
                     </div>
                 </div>

                 <br>
                 <h4>Documentacion correspondiente</h4>
                 <div class="form-row">
                     <div class="form-group col-md-4" id="form_carnet_cliente">
                         <label for="inputDocCarnet">Carnet de identidad o pasaporte</label>
                         <input type="file" class="form-control-file" id="inputDocCarnet" name="inputDocCarnet">
                     </div>
                     <div class="form-group col-md-4" id="form_licencia_conducir">
                         <label for="inputDocConducir">Licencia de conducir</label>
                         <input type="file" class="form-control-file" id="inputDocConducir" name="inputDocConducir">
                     </div>
                     <div class="form-group col-md-4" id="form_comprobante_cliente">
                         <label for="inputDocDomicilio">Comprobante de domicilio</label>
                         <input type="file" class="form-control-file" id="inputDocDomicilio" name="inputDocDomicilio">
                     </div>
                     <div class="form-group col-md-4" id="form_carnet_empresa">
                         <label for="inputDocCarnetEmpresa">Carnet Representante Legal</label>
                         <input type="file" class="form-control-file" id="inputDocCarnetEmpresa"
                             name="inputDocCarnetEmpresa">
                     </div>
                 </div>
             </div>
         </div>

         <div class="collapse" id="collapseConductor">
             <div class="card card-body">
                 <br>
                 <h4>Datos Conductor</h4>
                 <div class="form-row">
                     <div class="form-group col-md-3">
                         <label for="inputRutConductor">Rut</label>
                         <input maxLength="12" onblur=" value ? this.value=formateaRut(this.value) : null" type="text"
                             class="form-control" id="inputRutConductor" name="inputRutConductor" required>
                     </div>
                     <div class="form-group col-md-6">
                         <label for="inputNombreConductor">Nombre completo </label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputNombreConductor" name="inputNombreConductor">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputTelefonoConductor">Telefono</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputTelefonoConductor" name="inputTelefonoConductor">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputClase">Clase</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputClase"
                             name="inputClase">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputNumero">Numero</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control" id="inputNumero"
                             name="inputNumero">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputVCTO">VCTO</label>
                         <input maxLength="30" type="date" class="form-control" id="inputVCTO" name="inputVCTO">
                     </div>
                     <div class="form-group col-md-2">
                         <label for="inputMunicipalidad">Municipalidad</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputMunicipalidad" name="inputMunicipalidad">
                     </div>
                     <div class="form-group col-md-3">
                         <label for="inputDireccion">Direccion</label>
                         <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                             id="inputDireccion" name="inputDireccion">
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
                         <input oninput="mayus(this);" min="0" value="0" type="number" class="form-control"
                             id="inputEntrada" name="inputEntrada">
                     </div>

                 </div>
                 <br>
                 <h4>Accesorios</h4>
                 <div class="form-row">
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_traslado" name="box_traslado">
                         <label class="form-check-label" for="box_traslado">Traslado</label>
                     </div>
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_dedicible" name="box_dedicible">
                         <label class="form-check-label" for="box_dedicible">Deducible</label>
                     </div>
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_bencina" name="box_bencina">
                         <label class="form-check-label" for="box_bencina">Bencina</label>
                     </div>
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_enganche" name="box_enganche">
                         <label class="form-check-label" for="box_enganche">Enganche</label>
                     </div>
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_silla" name="box_silla">
                         <label class="form-check-label" for="box_silla">Silla para bebe</label>
                     </div>
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_pase" name="box_pase">
                         <label class="form-check-label" for="box_pase">Pase diario</label>
                     </div>
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" id="box_rastreo" name="box_rastreo">
                         <label class="form-check-label" for="box_rastreo">Rastreo satelital</label>
                     </div>

                     <div class="form-group col-md-4">
                         <br><br>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text" id="inputOtros">otros</span>
                             </div>
                             <input type="text" name="inputOtros" class="form-control" aria-label="Sizing example input"
                                 aria-describedby="inputOtros">
                         </div>

                     </div>
                 </div>
             </div>
         </div>

     </form>
 </div>