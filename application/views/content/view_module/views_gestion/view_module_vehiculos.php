<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modulo Vehiculos</h1>
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
                <form method="post" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputModelo">Modelo del Vehiculo</label>
                            <input maxLength="50" type="text" class="form-control" id="inputModelo" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputPatente">Patente del Vehiculo</label>
                            <input maxLength="10" type="text" class="form-control" id="inputPatente" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputedad">Año del Vehiculo</label>
                            <input type="number" class="form-control" id="inputedad" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputTipo">Tipo de Vehiculo</label>
                            <select id="inputTipo" class="form-control">
                                <option selected>Automovil</option>
                                <option>Camioneta</option>
                                <option>Furgon</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputColor">Color del Vehiculo</label>
                            <input maxLength="15" type="text" class="form-control" id="inputColor" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputSucursal">Sucursal actual</label>
                            <select id="inputSucursal" class="form-control">
                                <option selected>Talca</option>
                                <option>Linares</option>
                                <option>Curico</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputPropietario">Propietario del Vehiculo</label>
                            <input maxLength="30" type="text" class="form-control" id="inputPropietario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCompra">Donde se compro</label>
                            <input maxLength="30" type="text" class="form-control" id="inputCompra" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPrecio">Precio del Vehiculo</label>
                            <input type="number" class="form-control" id="inputPrecio" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputFechaCompra">Fecha de compra</label>
                            <input type="date" class="form-control" id="inputFechaCompra" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputFoto">Foto del vehiculo (opcional)</label>
                            <input type="file" class="form-control-file" id="inputFoto">
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-dark">Registrar Vehiculo</button>
                </form>

            </div>

            <!-- Tab con la tabla de los vehiculos -->
            <div class="tab-pane fade" id="nav-vehiculos" role="tabpanel" aria-labelledby="nav-vehiculos-tab">
                <br><br>


                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>año</th>
                            <th>Tipo</th>
                            <th>Sucursal</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>554-v45</td>
                            <td>Toyota Tercel</td>
                            <td>1997</td>
                            <td>automovil</td>
                            <td>Talca</td>
                            <td>X</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>año</th>
                            <th>Tipo</th>
                            <th>Sucursal</th>
                            <th>Accion</th>

                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
</main>

</div>
</div>

<!-- importando archivo js vehiculos -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/session_gestion/js_module_vehiculos.js"></script>

<!-- importaciones de datatable -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
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
</script>