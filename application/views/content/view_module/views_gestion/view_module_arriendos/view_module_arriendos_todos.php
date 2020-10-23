<?php
$nombreUsuario = $this->session->userdata('nombre')
?>


<!-- Tab con la tabla de los arriendos activos -->
<div class="tab-pane fade" id="nav-arriendos" role="tabpanel" aria-labelledby="nav-arriendos-tab">
    <br><br>
    <div class="scroll">
        <table id="tablaTotalArriendos" class="table table-striped table-bordered " style="width:100%">
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
    </div>
    <div class="text-center" id="spinner_tablaTotalArriendos">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h6>Cargando Datos...</h6>
    </div>

</div>


<!-- Modal editar arriendo -->
<div class="modal fade" id="modal_editar_arriendo" tabindex="-1" aria-labelledby="editarModal"
    style="overflow-y: scroll;" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModal">Detalle arriendo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinnerEditar">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="formEditarArriendo" novalidate>
                <div class="modal-body">
                    <div class=" form-row">
                        <div class="form-group col-md-2">
                            <label for="inputEditarTipoArriendo">Tipo</label>
                            <input disabled type="text" class="form-control" id="inputEditarTipoArriendo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEditarEstadoArriendo">Estado</label>
                            <input disabled type="text" class="form-control" id="inputEditarEstadoArriendo">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEditarClienteArriendo">Cliente</label>
                            <input disabled type="text" class="form-control" id="inputEditarClienteArriendo">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEditarConductorArriendo">Conductor</label>
                            <input disabled type="text" class="form-control" id="inputEditarConductorArriendo">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputEditarVehiculoArriendo">Vehiculo</label>
                            <input disabled type="text" class="form-control" id="inputEditarVehiculoArriendo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEditarKentradaArriendo">kilometros entrada</label>
                            <input disabled type="text" class="form-control" id="inputEditarKentradaArriendo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEditarKsalidaArriendo">kilometros salida</label>
                            <input disabled type="text" class="form-control" id="inputEditarKsalidaArriendo">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEditarKmantencionArriendo">kilometros mantencion</label>
                            <input disabled type="text" class="form-control" id="inputEditarKmantencionArriendo">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEditarFechaInicioArriendo">Fecha Inicio</label>
                            <input disabled type="text" class="form-control" id="inputEditarFechaInicioArriendo">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEditarFechaFinArriendo">Fecha Fin</label>
                            <input disabled type="text" class="form-control" id="inputEditarFechaFinArriendo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEditarDiasArriendo">Dias</label>
                            <input disabled type="text" class="form-control" id="inputEditarDiasArriendo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEditarCiudadEntregaArriendo">Ciudad entrega</label>
                            <input disabled type="text" class="form-control" id="inputEditarCiudadEntregaArriendo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEditarCiudadRecepcionArriendo">Ciudad recepcion</label>
                            <input disabled type="text" class="form-control" id="inputEditarCiudadRecepcionArriendo">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEditarUsuarioArriendo">Vendedor</label>
                            <input disabled type="text" class="form-control" id="inputEditarUsuarioArriendo">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEditarRegistroArriendo">fecha registro</label>
                            <input disabled type="text" class="form-control" id="inputEditarRegistroArriendo">
                        </div>
                    </div>

                    <h5>Documentos adjuntos:</h5>
                    <div class="card">
                        <div class="form-row card-body" id="card_documentos">



                        </div>
                    </div>
                </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button disabled type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmacion arriendo -->
<div class="modal fade" id="modal_confirmar_arriendo" data-backdrop="static" style="overflow-y: scroll;"
    data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">despachar arriendo</h5>
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
<div class="modal fade" id="modal_signature" tabindex="-1" aria-labelledby="signatureModal" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_signature">Firmar Contrato </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="nombre_documento" hidden>
                <div id="body-sinContrato">
                    <br>
                    <h6 class='text-center'>Sin contrato cargado</h6><br>
                </div>
                <div id="body-documento">
                    <!-- se carga el pdf -->
                </div>
                <div class="container" id="body-firma">
                    <br>
                    <div class="row">

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




<!-- <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script> -->
<script>
/* pdfjsLib.getDocument('assets/informe.pdf').then(doc => {
    console.log("this file has " + doc._pdfInfo.numPages + " pages");

    doc.getPage(2).then(page => {
        var myCanvas = document.getElementById("my_canvas");
        var context = myCanvas.getContext("2d");
        var viewport = page.getViewport(1);
        myCanvas.width = viewport.width;
        myCanvas.height = viewport.height;

        page.render({
            canvasContext: context,
            viewport: viewport
        })
    })
})
 */

const buscarArriendo = async (id_arriendo, option) => {
    limpiarCampos();
    const data = new FormData();
    data.append("id_arriendo", id_arriendo);
    const response = await ajax_function(data, "buscar_arriendo");
    if (response.success) {
        const arriendo = response.data;
        // si es true carga modal confirmar ; false carga modal editar
        option ? mostrarArriendoModalConfirmacion(arriendo) : mostrarArriendoModalEditar(arriendo);
        $("#formSpinner").hide();
        $("#formContrato").show();
    }
}


const mostrarArriendoModalConfirmacion = (arriendo) => {
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
    }
    mostrarAccesorios(arriendo);
}

const mostrarArriendoModalEditar = (arriendo) => {
    $("#formSpinnerEditar").hide();
    $("#formEditarArriendo").show();
    $("#inputEditarTipoArriendo").val(arriendo.tipo_arriendo);
    $("#inputEditarEstadoArriendo").val(arriendo.estado_arriendo);
    $("#inputEditarConductorArriendo").val(arriendo.conductore.nombre_conductor + " " + arriendo.conductore
        .rut_conductor);
    $("#inputEditarVehiculoArriendo").val(arriendo.vehiculo.patente_vehiculo + " " + arriendo.vehiculo
        .modelo_vehiculo + "  " + arriendo.vehiculo.marca_vehiculo + " " + arriendo.vehiculo.año_vehiculo);
    $("#inputEditarKentradaArriendo").val(arriendo.kilometrosEntrada_arriendo);
    $("#inputEditarKsalidaArriendo").val(arriendo.kilometrosSalida_arriendo);
    $("#inputEditarKmantencionArriendo").val(arriendo.kilometrosMantencion_arriendo);
    $("#inputEditarFechaInicioArriendo").val(formatearFechaHora(arriendo.fechaEntrega_arriendo));
    $("#inputEditarFechaFinArriendo").val(formatearFechaHora(arriendo.fechaRecepcion_arriendo));
    $("#inputEditarCiudadEntregaArriendo").val(arriendo.ciudadEntrega_arriendo);
    $("#inputEditarCiudadRecepcionArriendo").val(arriendo.ciudadRecepcion_arriendo);
    $("#inputEditarDiasArriendo").val(arriendo.numerosDias_arriendo);
    $("#inputEditarUsuarioArriendo").val(arriendo.usuario.nombre_usuario);
    $("#inputEditarRegistroArriendo").val(formatearFechaHora(arriendo.createdAt));


    switch (arriendo.tipo_arriendo) {
        case "PARTICULAR":
            $("#inputEditarClienteArriendo").val(arriendo.cliente.nombre_cliente + " " + arriendo.cliente
                .rut_cliente);
            break;
        case "REMPLAZO":
            $("#inputEditarClienteArriendo").val(arriendo.remplazo.cliente.nombre_cliente + " " + arriendo.remplazo
                .cliente.rut_cliente);
            break;
        case "EMPRESA":
            $("#inputEditarClienteArriendo").val(arriendo.empresa.nombre_empresa + " " + arriendo.empresa
                .rut_empresa);
            break;
    }
    const url = storage + "documentos/requisitosArriendo/";

    //CORREGIR VISOR
    if (arriendo.requisito.carnetFrontal_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.carnetFrontal_requisito;
        image.className = "img-fluid rounded float-rig2ht col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.carnetTrasera_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.carnetTrasera_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.cartaRemplazo_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.cartaRemplazo_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.chequeGarantia_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.chequeGarantia_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.comprobanteDomicilio_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.comprobanteDomicilio_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.licenciaConducir_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.licenciaConducir_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.tarjetaCreditoFrontal_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.tarjetaCreditoFrontal_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
    }
    if (arriendo.requisito.tarjetaCreditoTrasera_requisito) {
        const image = document.createElement("img");
        image.src = url + arriendo.requisito.tarjetaCreditoTrasera_requisito;
        image.className = "img-fluid rounded float-right col-md-3";
        document.getElementById("card_documentos").append(image)
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
    $("#formEditarArriendo").hide();
    $("#formContrato").hide();
    $("#card_documentos").empty();
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
    $("#formSpinnerEditar").show();
    $("#formContrato").hide();
    //se limpia el canvas de firma
    dibujar = false;
    ctx.clearRect(0, 0, cw, ch);
    Trazados.length = 0;
    puntos.length = 0;
}
</script>