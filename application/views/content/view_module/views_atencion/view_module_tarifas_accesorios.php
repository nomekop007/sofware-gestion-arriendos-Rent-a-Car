<div class="tab-pane fade" id="precios_accesorios" role="tabpanel" aria-labelledby="precios_accesorios-tab">
    <br><br>
    <div class="row">
        <div class="col-xl-4">
            <form>
                <div class="form-group">
                    <label for="nombre_accesorio">nombre Accesorio</label>
                    <input type="text" class="form-control" id="nombre_accesorio">
                </div>
                <div class="form-group">
                    <label for="precio_accesorio">Precio accesorio</label>
                    <input type="number" class="form-control" id="precio_accesorio">
                </div>
                <button class="btn btn-success btn-sm">Registrar </button>
                <button class="btn btn-warning btn-sm">Editar </button>
                <button class="btn btn-danger btn-sm">Eliminar </button>

            </form>
        </div>
        <div class="col-xl-8">
            <br>
            <table id="tabla_tarifas_accesorios" class="table table-striped table-bordered" style="width:100%">
                <thead class="btn-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre accesorio</th>
                        <th scope="col" class="btn-danger">valor diario</th>
                        <th scope="col" class="btn-success">valor diario (mas de 3 dias)</th>
                    </tr>
                </thead>
                <tbody style='font-size: 0.7rem;'>
                    <tr>
                        <th>x</th>
                        <th>xxxxxxxxxxxxxx</th>
                        <th>NETO: xxxx - IVA: xxxxx - TOTAL: XXXX</th>
                        <th>NETO: xxxx - IVA: xxxxx - TOTAL: XXXX</th>
                    </tr>
                    <tr>
                        <th>x</th>
                        <th>xxxxxxxxxxxxxx</th>
                        <th>NETO: xxxx - IVA: xxxxx - TOTAL: XXXX</th>
                        <th>NETO: xxxx - IVA: xxxxx - TOTAL: XXXX</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>