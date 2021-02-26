<!-- Tab con la tabla de los arriendos activos -->
<div class="tab-pane fade" id="nav-arriendos" role="tabpanel" aria-labelledby="nav-arriendos-tab">
    <br><br>
    <div class="scroll">
        <table id="tablaTotalArriendos" class="table table-striped table-bordered " style="width:100%">
            <thead class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>fecha registro</th>
                    <th>Cliente</th>
                    <th>vehiculo</th>
                    <th>tipo arriendo</th>
                    <th>estado</th>
                    <th>sucursal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style='font-size: 0.7rem;'>
            </tbody>
            <tfoot class="btn-dark">
                <tr>
                    <th>Nº</th>
                    <th>fecha registro</th>
                    <th>Cliente</th>
                    <th>vehiculo</th>
                    <th>tipo arriendo</th>
                    <th>estado</th>
                    <th>sucursal</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center" id="spinner_tablaTotalArriendos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>
</div>