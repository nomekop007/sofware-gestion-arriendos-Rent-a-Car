<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargarPanel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Arriendos</li>
            </ol>
        </nav>
        <h1 class="h3">Modulo arriendo</h1>
    </div>
    <div>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link  active" id="nav-registrar-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Registrar Arriendo</a>
                <a class="nav-link" id="nav-arriendosActivos-tab" data-toggle="tab" href="#nav-profile" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Ver Arriendos Activos</a>
                <a class="nav-link" id="nav-arriendosTotales" data-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Ver Todos los Arriendos</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-registrar-tab">
                <br>
                <form class="needs-validation" novalidate>
                    <p>
                        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseCliente" role="button"
                            aria-expanded="false" aria-controls="collapseCliente">
                            Datos cliente
                        </a>
                        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseVehiculos" role="button"
                            aria-expanded="false" aria-controls="collapseVehiculos">
                            Seleccion de Vehiculo
                        </a>
                        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#collapseArriendo" role="button"
                            aria-expanded="false" aria-controls="collapseArriendo">
                            Datos Arriendo
                        </a>
                        <button type="submit" id="btn_crear_arriendo" class="btn btn-success btn-sm">Crear
                            Arriendo</button>
                    </p>
                    <div class="collapse" id="collapseCliente">
                        <div class="card card-body">
                            <br>
                            <h4>Datos Cliente</h4>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputNombreCliente">Nombre </label>
                                    <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                                        id="inputNombreCliente" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDireccionCliente">Direccion </label>
                                    <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                                        id="inputDireccionCliente" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCiudadCliente">Ciudad </label>
                                    <input oninput="mayus(this);" maxLength="30" type="text" class="form-control"
                                        id="inputCiudadCliente" required>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="inputRut">Rut cliente</label>
                                    <input onblur=" value ? this.value=formateaRut(this.value) : null" type="text"
                                        class="form-control" id="inputrut" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="input_carnet">carnet de identidad</label>
                                    <input type="file" class="form-control-file" id="input_carnet">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="input_licencia">Licencia de conducir</label>
                                    <input type="file" class="form-control-file" id="input_licencia">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="input_domicilio">Comprobante de domicilio</label>
                                    <input type="file" class="form-control-file" id="input_domicilio">
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
                                    <select class="custom-select" id="inputSucursal"
                                        aria-label="Example select with button addon">
                                    </select>
                                    <div class="input-group-append">
                                        <bustton class="btn btn-outline-secondary" id="buscar_vehiculos" type="button">
                                            Buscar</button>
                                    </div>
                                </div>
                                <div class="input-group col-md-7" required>
                                    <select disabled class="custom-select form-control" id="select_vehiculos"
                                        style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <br>
                            <h6>Accessorios</h6>
                            <div class="form-row">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_rastreo" value="option1">
                                    <label class="form-check-label" for="box_rastreo">Servicio de rastreo
                                        satelital</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_silla" value="option2">
                                    <label class="form-check-label" for="box_silla">Silla para bebe</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_enganche" value="option2">
                                    <label class="form-check-label" for="box_enganche">Enganche de carro</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_pase" value="option2">
                                    <label class="form-check-label" for="box_pase">Pase diario</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_angostura" value="option2">
                                    <label class="form-check-label" for="box_angostura">Free flow angostura</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_lavado" value="option2">
                                    <label class="form-check-label" for="box_lavado">lavado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="box_combustible"
                                        value="option2">
                                    <label class="form-check-label" for="box_combustible">combustible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseArriendo">
                        <div class="card card-body">
                            <br>
                            <h4>Datos Arriendo</h4>
                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputNumeroDias">Numeros de Dias</label>
                                    <input min="1" value="1" type="number" class="form-control" id="inputNumeroDias"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputFechaInicio">Fecha de inicio</label>
                                    <input type="date" class="form-control" id="inputFechaInicio" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputFechaFin">Fecha fin</label>
                                    <input type="date" class="form-control" id="inputFechaFin" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTipo">Tipo de Arriendo</label>
                                    <select id="inputTipo" class="form-control">
                                        <option value="persona natural" selected>Arriendo persona natural</option>
                                        <option value="empresa remplazo copago" selected>Arriendo empresa remplazo
                                            copago</option>
                                        <option value="solo empresa" selected>Arriendo solo empresa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputValor">Valor Final Arriendo</label>
                                    <input min="0" value="0" type="number" class="form-control" id="inputValor"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-arriendosActivos-tab">
                <br>tabla arriendos activos
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-arriendosTotales">
                <br>tabla todos los arriendos
            </div>
        </div>
        <br><br>
    </div>
</main>


</div>
</div>



<script>
// Script para validar los campos del formulario 
(() => {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

//formatear rut
function formateaRut(rut) {
    //onblur="this.value=formateaRut(this.value)"

    var actual = rut.replace(/^0+/, "");
    if (actual != '' && actual.length > 1) {
        var sinPuntos = actual.replace(/\./g, "");
        var actualLimpio = sinPuntos.replace(/-/g, "");
        var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
        var rutPuntos = "";
        var i = 0;
        var j = 1;
        for (i = inicio.length - 1; i >= 0; i--) {
            var letra = inicio.charAt(i);
            rutPuntos = letra + rutPuntos;
            if (j % 3 == 0 && j <= inicio.length - 1) {
                rutPuntos = "." + rutPuntos;
            }
            j++;
        }
        var dv = actualLimpio.substring(actualLimpio.length - 1);
        rutPuntos = rutPuntos + "-" + dv;
    }
    return rutPuntos;

}
</script>

<!-- importaciones del select2 -->
<script src="<?php echo base_route() ?>/assets/js/select2.min.js"></script>

<!-- importaciones del arriendos -->
<script src="<?php echo base_route() ?>/assets/js/session_gestion/js_module_arriendos.js"></script>