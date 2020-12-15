<div class="tab-pane fade show active" id="precios_automovil" role="tabpanel" aria-labelledby="precios_automovil-tab">
    <br><br>

    <form>
        <h5>Registrar categoria de vehiculos</h5>
        <br>
        <div class="form-row">
            <div class="form-group col-xl-5">
                <label for="nombre_categoria">nombre categoria</label>
                <input type="text" class="form-control" id="nombre_categoria">
            </div>
            <div class="form-group col-xl-4">
                <label for="modelo_vehiculo">Modelo vehiculos</label>
                <input type="text" class="form-control" id="modelo_vehiculo">
            </div>
            <div class="form-group col-xl-3">
                <label for="anio_vehiculo">año vehiculos </label>
                <select class="form-control" id="anio_vehiculo">
                </select>
            </div>
            <div class="form-group col-xl-3">
                <label for="valor_diario_vehiculo">valor neto diario (1 dia) </label>
                <input type="number" class="form-control" id="valor_diario_vehiculo">
            </div>
            <div class="form-group col-xl-3">
                <label for="valor_semanal_vehiculo">valor neto semanal (7 dias) </label>
                <input type="number" class="form-control" id="valor_semanal_vehiculo">
            </div>
            <div class="form-group col-xl-3">
                <label for="valor_quincenal_vehiculo">valor neto quincenal (15 dias) </label>
                <input type="number" class="form-control" id="valor_quincenal_vehiculo">
            </div>
            <div class="form-group col-xl-3">
                <label for="valor_mensual_vehiculo">valor neto mensual (30 dias) </label>
                <input type="number" class="form-control" id="valor_mensual_vehiculo">
            </div>
        </div>
        <button class="btn btn-success btn-sm">Registrar </button>
    </form>
    <br><br><br>
    <h5>Todas las categorias</h5>
    <table id="tabla_tarifas_vehiculos" class="table display nowrap table-striped cell-border table-bordered"
        style="width:100%;width: 1200px; margin: 0 auto;">
        <thead class="btn-dark">
            <tr>
                <th scope="col">categoria</th>
                <th scope="col">modelo</th>
                <th scope="col">año</th>
                <th scope="col" class="btn-danger">Valor diario</th>
                <th scope="col" class="btn-success">Valor semanal</th>
                <th scope="col" class="btn-primary">valor quincenal</th>
                <th scope="col" class="btn-info">valor mensual</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody style='font-size: 0.7rem;'>
            <tr>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>
                    <button class='btn btn-outline-info'><i class='far fa-edit'></i></button>
                </th>
            </tr>
            <tr style='font-size: 0.7rem;'>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>
                    <button class='btn btn-outline-info'><i class='far fa-edit'></i></button>
                </th>
            </tr>
            <tr style='font-size: 0.7rem;'>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>NETO: $xxxxx - IVA : $xxxxx - TOTAL: $xxxx</th>
                <th>
                    <button class='btn btn-outline-info'><i class='far fa-edit'></i></button>
                </th>
            </tr>
        </tbody>
        <tfoot class="btn-dark">
            <tr>
                <th scope="col">categoria</th>
                <th scope="col">modelo</th>
                <th scope="col">año</th>
                <th scope="col" class="btn-danger">Valor diario</th>
                <th scope="col" class="btn-success">Valor semanal</th>
                <th scope="col" class="btn-primary">valor quincenal</th>
                <th scope="col" class="btn-info">valor mensual</th>
                <th scope="col"></th>
            </tr>
        </tfoot>
    </table>



</div>