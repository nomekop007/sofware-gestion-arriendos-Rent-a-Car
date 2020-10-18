<?php

$nombreUsuario = $this->session->userdata('nombre')
?>

<!-- Tab con la tabla de los arriendos activos -->
<div class="tab-pane fade" id="nav-arriendos" role="tabpanel" aria-labelledby="nav-arriendos-tab">
    <br><br>
    <table id="tablaTotalArriendos" class="table table-striped table-bordered" style="width:100%">
        <thead class="btn-dark">
            <tr>
                <th>Nº</th>
                <th>Cliente</th>
                <th>fecha registro</th>
                <th>tipo arriendo</th>
                <th>estado</th>
                <th>vendedor</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot class="btn-dark">
            <tr>
                <th>Nº</th>
                <th>Cliente</th>
                <th>fecha registro</th>
                <th>tipo arriendo</th>
                <th>estado</th>
                <th>vendedor</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <div class="text-center" id="spinner_tablaTotalArriendos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>

</div>




<!-- Modal Confirmacion arriendo -->
<div class="modal fade" id="modal_confirmar_arriendo" style="overflow-y: scroll;" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="formContrato" novalidate>
                <input type="text" name="inputIdArriendo" id="inputIdArriendo" hidden />
                <input type="text" name="inputPatenteVehiculo" id="inputPatenteVehiculo" hidden />

                <div class="modal-body">

                    <div class="card">
                        <div class="form-row card-body text-center">
                            <span style="width: 50%;" id="textCliente"
                                class=" text-center input-group-text form-control"></span>
                            <span style="width: 50%;" id="textVehiculo"
                                class="  text-center input-group-text form-control"></span>
                        </div>
                    </div>
                    <br><br>
                    <h5>Valor Arriendo</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="input-group col-md-12">
                                <span style="width: 50%;" id="textTipo" value=""
                                    class="input-group-text form-control">Tipo
                                    Arriendo:
                                </span>
                                <span style="width: 50%;" id="textDias" class="input-group-text form-control">Cantidad
                                    de
                                    dias: X</span>
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Sub total Arriendo
                                    $</span>
                                <input style="width: 40%;" id="inputValorArriendo" name="inputValorArriendo"
                                    onkeypress="return soloNumeros(event);" maxLength="11" value="0" type="text"
                                    class="form-control" oninput="calcularValores()" required>
                            </div>
                            <div class="input-group col-md-12" id="subtotal-copago">
                                <span style="width: 60%;" class="input-group-text form-control">valor copago
                                    $</span>
                                <input style="width: 40%;" id="inputValorCopago" name="inputValorCopago"
                                    onkeypress="return soloNumeros(event);" maxLength="11" value="0" type="text"
                                    class="form-control" oninput="calcularValores()" required>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h5>Accesorios</h5>
                    <div class="card">
                        <div class="form-row card-body" id="formAccesorios">
                            <!-- se muestran los accesorios del arriendo con precio -->
                            <span class=" col-md-12 text-center" id="spanAccesorios">Sin Accesorios</span>
                        </div>
                    </div>

                    <br><br>
                    <h5>Totales</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="BOLETA" id="radioBoleta" name="customRadio1"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="radioBoleta">Boleta</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="FACTURA" id="radioFactura" name="customRadio1"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="radioFactura">Factura</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input onkeypress="return soloNumeros(event);" maxLength="20" id="inputNumFacturacion"
                                    name="inputNumFacturacion" type="text" class="form-control"
                                    placeholder="Nº Boleta/Factura" required>
                            </div>
                        </div>
                        <div class="form-row card-body">
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Descuento $</span>
                                <input style="width: 40%;" step="0" id="inputDescuento" name="inputDescuento"
                                    onkeypress="return soloNumeros(event);" maxLength="11" value="0" type="text" min=0
                                    class="form-control" oninput="calcularValores()" required>
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Total Neto $</span>
                                <input oninput="calcularValores()" style="width: 40%;" id="inputNeto" name="inputNeto"
                                    min="0" value="0" type="number" class="form-control" required>
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">IVA $</span>
                                <input style="width: 40%;" id="inputIVA" name="inputIVA" min="0" value="0" type="number"
                                    class="form-control" oninput="calcularValores()">
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Total a Pagar $</span>
                                <input style="width: 40%;" value="0" id="inputTotal" name="inputTotal" type="number"
                                    min="0" class="form-control" required oninput="calcularValores()">
                            </div>
                        </div>
                        <div class="form-row card-body">
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="EFECTIVO" id="radioEfectivo" name="customRadio2"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="radioEfectivo">Efectivo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="CHEQUE" id="radioCheque" name="customRadio2"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="radioCheque">Cheque</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ">
                                <input type="radio" value="TARGETA" id="radioTarjeta" name="customRadio2"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="radioTarjeta">Tarjeta</label>
                            </div>
                        </div>

                        <div class="form-row card-body">
                            <div class="form-group col-md-12">
                                <label for="inputDigitador">Digitado por</label>
                                <input disabled type="text" class="form-control" id="inputDigitador"
                                    name="inputDigitador" value="<?php echo $nombreUsuario ?>" required>
                                <div class="form-group col-md-12">
                                    <label for="inputObservaciones">Observaciones</label>
                                    <textarea onblur="mayus(this);" class="form-control" id="inputObservaciones"
                                        name="inputObservaciones" rows="3" maxLength="300"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modal_signature">
                            firmar contrato <i class="fas fa-feather-alt"></i>
                        </button>
                        <button type="submit" id="btn_crear_contrato" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                id="spinner_btn_crearContrato"></span>
                            Generar Contrato</button>
                    </div>
            </form>
        </div>
    </div>

</div>


<!-- Modal signature-->
<div class="modal fade" id="modal_signature" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Firmar Contrato </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="body-sinContrato">
                    <br>
                    <h6 class='text-center'>Sin contrato cargado</h6><br>
                </div>
                <div id="body-documento">
                    <!-- se carga documento en un iframe -->
                </div>
                <div class="container" id="body-firma">
                    <br>
                    <div class="row">
                        <input type="text" id="nombre_documento" hidden>
                        <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                            <canvas id="canvas-firma">
                            </canvas>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="button" id="limpiar-firma" class="btn btn-secondary btn-sm ">
                                limpiar</button>
                            <button type="button" id="btn_firmar_contrato" class="btn btn-success btn-sm ">
                                firmar contrato
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    id="spinner_btn_firmarContrato"></span>
                            </button>
                            <button type="button" id="btn_confirmar_contrato" class="btn btn-primary btn-sm ">
                                guardar cambios
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    id="spinner_btn_confirmarContrato"></span>
                            </button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal editar -->
<div class="modal fade" id="modal_editar_arriendo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">modificar arriendo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>






<script>
const buscarArriendo = async (id_arriendo) => {
    limpiarCampos();
    const data = new FormData();
    data.append("id_arriendo", id_arriendo);
    const response = await ajax_function(data, "buscar_arriendo");
    if (response.success) {
        const arriendo = response.data;
        $("#inputIdArriendo").val(arriendo.id_arriendo);
        $("#inputPatenteVehiculo").val(arriendo.vehiculo.patente_vehiculo)
        $("#textTipo").html("Tipo de Arriendo: " + arriendo.tipo_arriendo);
        $("#textTipo").val(arriendo.tipo_arriendo);
        $("#textDias").html("Cantidad de Dias: " + arriendo.numerosDias_arriendo);

        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                $("#textCliente").html(arriendo.cliente.nombre_cliente);
                $("#textVehiculo").html("Vehiculo : " + arriendo.vehiculo.patente_vehiculo);
                break;
            case "REMPLAZO":
                $("#subtotal-copago").show();
                $("#textCliente").html(arriendo.remplazo.cliente.nombre_cliente + " - " +
                    arriendo.remplazo.nombreEmpresa_remplazo);
                $("#textVehiculo").html("Vehiculo : " + arriendo.vehiculo.patente_vehiculo);
                break;
            case "EMPRESA":
                $("#textCliente").html(arriendo.empresa.nombre_empresa);
                $("#textVehiculo").html("Vehiculo : " + arriendo.vehiculo.patente_vehiculo);
                break;
            default:
                break;
        }
        mostrarAccesorios(arriendo);
        //ocultar y mostrar 
        $("#formSpinner").hide();
        $("#formContrato").show();
    }
}

const mostrarAccesorios = (arriendo) => {
    if (arriendo.accesorios.length) {
        $.each(arriendo.accesorios, (i, o) => {

            let precio = 0;
            if (o.precio_accesorio != null) {
                precio = o.precio_accesorio
            }

            let fila = " <div class='input-group col-md-12'>";
            fila +=
                " <span style='width: 60%;' class='input-group-text form-control'>" + o
                .nombre_accesorio + " $</span>";
            fila +=
                "<input  style='width: 40%;' min='0' id='" + o.nombre_accesorio +
                "'  onkeypress='return soloNumeros(event);' maxLength='11' name='accesorios[]'  oninput='calcularValores()' value='" +
                precio +
                "'  type='text' class='form-control' required>";
            fila += "  </div>";
            $("#formAccesorios").append(fila);
        })

    } else {
        let sinAccesorios =
            " <span class=' col-md-12 text-center' id='spanAccesorios'>Sin Accesorios</span>";
        $("#formAccesorios").append(sinAccesorios);
    }
}

const calcularValores = () => {
    //variables
    let valorArriendo = Number($("#inputValorArriendo").val());
    let valorCopago = Number($("#inputValorCopago").val());
    let neto = Number($("#inputNeto").val());
    let iva = Number($("#inputIVA").val());
    let descuento = Number($("#inputDescuento").val());
    let total = Number($("#inputTotal").val());
    let TotalNeto = 0;
    //revisa todos los check y guardas sus valores en un array si estan okey
    let ArrayAccesorios = $('[name="accesorios[]"]')
        .map(function() {
            return this.value;
        })
        .get();

    for (let i = 0; i < ArrayAccesorios.length; i++) {
        const precioAccesorio = ArrayAccesorios[i];
        TotalNeto += Number(precioAccesorio);
    }
    TotalNeto = TotalNeto + valorArriendo - descuento - valorCopago;
    iva = TotalNeto * 0.19;
    total = TotalNeto + iva;
    $("#inputNeto").val(TotalNeto);
    $("#inputIVA").val(Math.round(iva));
    $("#inputTotal").val(Math.round(total));
}




const limpiarCampos = () => {
    $("#formContrato").hide();
    $("#formAccesorios").empty();
    $("#formContrato")[0].reset();
    $("#btn_crear_contrato").attr("disabled", false);
    $("#spinner_btn_crearContrato").hide();
    $("#spinner_btn_firmarContrato").hide();
    $("#spinner_btn_confirmarContrato").hide();
    $("#btn_confirmar_contrato").attr("disabled", true);
    $("#body-documento").hide();
    $("#body-firma").hide();
    $("#body-sinContrato").show();
    $("#nombre_documento").val("");
    $("#subtotal-copago").hide();
    $("#formSpinner").show();
    $("#formContrato").hide();
    //se limpia el canvas de firma
    dibujar = false;
    ctx.clearRect(0, 0, cw, ch);
    Trazados.length = 0;
    puntos.length = 0;
}
</script>