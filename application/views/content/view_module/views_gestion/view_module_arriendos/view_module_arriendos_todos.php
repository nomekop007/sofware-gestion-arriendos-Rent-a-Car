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
<div class="modal fade" id="modal_confirmar_arriendo" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle de contrato</h5>
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
                <div class="modal-body">

                    <div class="card">
                        <div class="form-row card-body text-center">
                            <span style="width: 50%;" id="textCliente"
                                class=" text-center input-group-text form-control"></span>
                            <span style="width: 50%;" id="textVehiculo"
                                class="  text-center input-group-text form-control"></span>
                        </div>
                    </div>
                    <br>
                    <h5>Garantia</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="form-group col-md-12">
                                <label for="inputNumeroTargeta">Tarjeta de credito</label>
                                <div class="input-group">
                                    <input style="width: 80%;" type="number" class="form-control"
                                        id="inputNumeroTargeta" min="0" name="inputNumeroTargeta">
                                    <input style="width: 20%;" name="inputFechaTargeta" id="inputFechaTargeta"
                                        type="text" aria-label="Last name" class="form-control" maxLength="5"
                                        placeholder="ej: 10/23">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputCheque">Cheque</label>
                                <input type="text" class="form-control" maxLength="30" id="inputCheque"
                                    name="inputCheque">
                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Abono $</span>
                                </div>
                                <input min="0" value="0" type="number" id="inputAbono" name="inputAbono"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h5>Valor Arriendo</h5>
                    <div class="card">
                        <div class="form-row card-body">
                            <div class="input-group col-md-12">
                                <span style="width: 50%;" id="textTipo" class="input-group-text form-control">Tipo
                                    Arriendo:
                                    Particular</span>
                                <span style="width: 50%;" id="textDias" class="input-group-text form-control">Cantidad
                                    de
                                    dias: X</span>
                            </div>
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Sub total Arriendo
                                    $</span>
                                <input style="width: 40%;" id="inputValorArriendo" name="inputValorArriendo" value="0"
                                    min="0" type="number" class="form-control" oninput="calcularValores()" required>
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
                        </div>
                        <div class="form-row card-body">
                            <div class="input-group col-md-12">
                                <span style="width: 60%;" class="input-group-text form-control">Descuento $</span>
                                <input style="width: 40%;" min="0" step="0" id="inputDescuento" name="inputDescuento"
                                    value="0" type="number" class="form-control" oninput="calcularValores()" required>
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
                                    name="inputDigitador" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputObservaciones">Observaciones</label>
                                <textarea class="form-control" id="inputObservaciones" name="inputObservaciones"
                                    rows="3" maxLength="300"></textarea>
                            </div>


                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_crear_contrato" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_crearContrato"></span>
                        Generar Contrato</button>
                </div>
            </form>
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
                ...
            </div>
        </div>
    </div>
</div>









<script>
$("#formContrato").hide();

function cargarArriendo(id_arriendo) {
    limpiarCampos();
    $.getJSON({
        url: base_url + "buscar_arriendo",
        type: "post",
        dataType: "json",
        data: {
            id_arriendo
        },
        success: (e) => {
            if (e.success) {
                var arriendo = e.data;
                $("#inputIdArriendo").val(arriendo.id_arriendo);
                $("#textTipo").html("Tipo de Arriendo: " + arriendo.tipo_arriendo);
                $("#textDias").html("Cantidad de Dias: " + arriendo.numerosDias_arriendo);
                $("#inputDigitador").val(arriendo.usuario.nombre_usuario);

                switch (arriendo.tipo_arriendo) {
                    case "PARTICULAR":
                        $("#textCliente").html(arriendo.cliente.nombre_cliente);
                        $("#textVehiculo").html("Vehiculo : " + arriendo.vehiculo.patente_vehiculo);
                        break;
                    case "REMPLAZO":
                        $("#textCliente").html(arriendo.cliente.nombre_cliente + " - " +
                            arriendo.empresa.nombre_empresa);
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
            } else {
                Swal.fire({
                    icon: "error",
                    title: e.msg,
                    text: "A ocurrido un Error Contacte a informatica",
                });
                $("#formSpinner").show();
                $("#formContrato").hide();
            }
        },
        error: () => {
            Swal.fire({
                icon: "error",
                title: "no se logro cargar el arriendo",
                text: "A ocurrido un Error Contacte a informatica",
            });
            $("#formSpinner").show();
            $("#formContrato").hide();
        }
    })
}

function mostrarAccesorios(arriendo) {
    if (arriendo.accesorios.length) {
        $.each(arriendo.accesorios, (i, o) => {

            var precio = 0;
            if (o.precio_accesorio != null) {
                precio = o.precio_accesorio
            }

            var fila = " <div class='input-group col-md-12'>";
            fila +=
                " <span style='width: 60%;' class='input-group-text form-control'>" + o
                .nombre_accesorio + " $</span>";
            fila +=
                "<input style='width: 40%;' min='0' id='" + o.nombre_accesorio +
                "' name='accesorios[]'  oninput='calcularValores()' value='" +
                precio +
                "'  type='number' class='form-control'>";
            fila += "  </div>";
            $("#formAccesorios").append(fila);
        })

    } else {
        var sinAccesorios =
            " <span class=' col-md-12 text-center' id='spanAccesorios'>Sin Accesorios</span>";
        $("#formAccesorios").append(sinAccesorios);
    }
}

function calcularValores() {
    //variables
    var valorArriendo = Number($("#inputValorArriendo").val());
    var neto = Number($("#inputNeto").val());
    var iva = Number($("#inputIVA").val());
    var descuento = Number($("#inputDescuento").val());
    var total = Number($("#inputTotal").val());

    var TotalNeto = 0;
    //revisa todos los check y guardas sus valores en un array si estan okey
    var ArrayAccesorios = $('[name="accesorios[]"]')
        .map(function() {
            return this.value;
        })
        .get();

    for (let i = 0; i < ArrayAccesorios.length; i++) {
        const element = ArrayAccesorios[i];
        TotalNeto += Number(element);
    }
    TotalNeto = TotalNeto + valorArriendo - descuento;
    iva = TotalNeto * 0.19;
    total = TotalNeto + iva;

    $("#inputNeto").val(TotalNeto);
    $("#inputIVA").val(Math.round(iva));
    $("#inputTotal").val(Math.round(total));
}

function limpiarCampos() {
    $("#formAccesorios").empty();
    $("#formContrato")[0].reset();
    $("#btn_crear_contrato").attr("disabled", false);
    $("#spinner_btn_crearContrato").hide();
}
</script>