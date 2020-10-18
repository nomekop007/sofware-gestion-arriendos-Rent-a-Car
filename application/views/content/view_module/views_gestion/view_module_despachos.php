<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>

<main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Despacho</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion Despachos</h1>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-despacho-tab" data-toggle="tab" href="#nav-despacho" role="tab"
                aria-controls="nav-despacho" aria-selected="true">Control de despacho </a>
            <a class="nav-link" id="nav-activos-tab" data-toggle="tab" href="#nav-activos" role="tab"
                aria-controls="nav-activos" aria-selected="false">Arriendos activos</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <br>
        <br>
        <div class="tab-pane fade show active" id="nav-despacho" role="tabpanel" aria-labelledby="nav-despacho-tab">
            <table id="tablaControldespacho" class="table table-striped table-bordered" style="width:100%">
                <thead class="btn-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Cliente</th>
                        <th>Vehiculo</th>
                        <th>Fecha Entrega</th>
                        <th>Fecha Recepecion</th>
                        <th>tipo arriendo</th>
                        <th>estado</th>
                        <th>Vendedor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot class="btn-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Cliente</th>
                        <th>Vehiculo</th>
                        <th>Fecha Entrega</th>
                        <th>Fecha Recepecion</th>
                        <th>tipo arriendo</th>
                        <th>estado</th>
                        <th>Vendedor</th>

                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center" id="spinner_tablaDespacho">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h6>Cargando Datos...</h6>
            </div>

        </div>

        <div class="tab-pane fade show " id="nav-activos" role="tabpanel" aria-labelledby="nav-activos-tab">
            <br>
            <br>
            <h5>Arriendos activos</h5>
        </div>

</main>




<!-- Modal despachar -->
<div class="modal fade" id="modal_despachar_arriendo" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">despachar arriendo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="form-row">

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal fotos -->
<div class="modal fade" id="modal_fotos_despacho" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar fotos del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input id="inputFotos" name="input-b3[]" type="file" class="file" multiple
                                    data-show-upload="false" data-show-caption="true"
                                    data-msg-placeholder="Select {files} for upload...">
                            </div>

                            <button type="submit" id="btn_guardar_fotoDespacho" class="btn btn-success col-md-12">
                                Guardar Fotos</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>





<script>
$("#m_despacho").addClass("active");
$("#l_despacho").addClass("card");
$("#inputFotos").fileinput();


const buscarArriendo = (id_arriendo) => {
    $.getJSON({
        url: base_url + "buscar_arriendo",
        type: "post",
        dataType: "json",
        data: {
            id_arriendo
        },
        success: (e) => {
            console.log(e);
        },
        error: () => {},
    });

}
</script>

<!-- importando archivo js usuarios -->
<script src="<?php echo base_url() ?>assets/js/js_gestion/js_module_despacho.js"></script>