<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Gestion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Pagos clientes</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion de Pagos clientes</h1>
    </div>
    <div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" ype="button">Buscar pagos </button>
                    </div>
                    <input type="number" #inputBuscar class="form-control" placeholder="ingrese Nº de Folio del arriendo" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <br>
    <div class="scroll">
        <table id="tabla_pagosCliente" class="table table-striped table-bordered" style="width:100%">
            <thead class="btn-dark">
                <tr>
                    <th>dias</th>
                    <th>estado pago</th>
                    <th>neto</th>
                    <th>iva</th>
                    <th>total</th>
                    <th>fecha registro</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="vehiculos">
                <br>
            </tbody>
            <tfoot class="btn-dark">
                <tr>
                    <th>dias</th>
                    <th>estado pago</th>
                    <th>neto</th>
                    <th>iva</th>
                    <th>total</th>
                    <th>fecha registro</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center" id="spinner_tabla_pagos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>

    <br><br><br><br>
</main>
</div>
</div>







<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_pagoCliente/js_module_pagoCliente.js?v=<?php echo version(); ?>">
</script>