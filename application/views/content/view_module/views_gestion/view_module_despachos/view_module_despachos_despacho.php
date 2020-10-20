<?php
$nombreUsuario = $this->session->userdata('nombre')
?>
<div class="tab-pane fade show active" id="nav-despachos" role="tabpanel" aria-labelledby="nav-despacho-tab">
    <br><br>
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

<!-- Modal despachar -->
<div class="modal fade" id="modal_despachar_arriendo" data-backdrop="static" style="overflow-y: scroll;"
    data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">despachar arriendo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputMarcaVehiculoDespacho">Vehiculo</label>
                            <input disabled type="text" class="form-control" id="inputMarcaVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputModeloVehiculoDespacho">Modelo</label>
                            <input disabled type="text" class="form-control" id="inputModeloVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEdadVehiculoDespacho">Año</label>
                            <input disabled type="text" class="form-control" id="inputEdadVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputColorVehiculoDespacho">Color</label>
                            <input disabled type="text" class="form-control" id="inputColorVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPatenteVehiculoDespacho">Patente</label>
                            <input disabled type="text" class="form-control" id="inputPatenteVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputKilomentrajeVehiculoDespacho">Kilomentraje</label>
                            <input disabled type="text" class="form-control" id="inputKilomentrajeVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputDestinoDespacho">Destino (venta o arriendo)</label>
                            <input type="text" class="form-control" id="inputDestinoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputProcedenciaDesdeDespacho">Procedencia de</label>
                            <input type="text" class="form-control" id="inputProcedenciaDesdeDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputProcedenciaHaciaDespacho">a</label>
                            <input type="text" class="form-control" id="inputProcedenciaHaciaDespacho">
                        </div>
                    </div>
                    <br><br>
                    <h5>Control de recepción</h5>
                    <div class="card">
                        <div class="card-body form-row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <label>SI/NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Documentacion</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Inscripción</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Permiso Circulacion</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Rev. Técnica</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Seguro Obligatorio</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Otros</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">INTERIOR</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Manual</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Garantía</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Cinturones</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Espejos Interior</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Espejos Exterior</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Parasoles</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Ceniceros</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="a14">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <label>SI/NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Encendedor</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Doble juego llaves</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Pisos de goma</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tapiz O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Radio O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tocacintas O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Bocina O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Luces O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Señalizadores O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Luz Emergencia O.K</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Calefacción O.K</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Defroster O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Freno de Mano O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Chaleco reflectante</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="b14">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <label>SI/NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tapas de rueda ( )</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Plumillas ( )</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Antena O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Micas O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Pintura O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Nivel Aceite O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tapa Bencina</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">R.Repuesto</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Gata/Barrote</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Herramientas</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Parachoques O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Bateria O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Adhesivo Interior</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Placa</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="c14">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputObservacionesDespacho">Observaciones</label>
                                <textarea onblur="mayus(this);" class="form-control" id="inputObservacionesDespacho"
                                    name="inputObservacionesDespacho" rows="3" maxLength="100"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputRecibidorDespacho">Recibido por</label>
                                <input type="text" class="form-control" id="inputRecibidorDespacho">
                            </div>
                            <div class="form-group">
                                <label for="inputEntregadorDespacho">Entregado por</label>
                                <input type="text" value="<?php echo $nombreUsuario ?>" class="form-control"
                                    id="inputEntregadorDespacho">
                            </div>

                            <button type="button" class="form-group col-md-12 btn btn-primary" data-toggle="modal"
                                data-target="#staticBackdrop">
                                Tomar Fotos al vehiculo
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="container col-md-12" id="canvasContainer">
                                    <div id="output" class="text-center">0E</div>
                                    <canvas id="canvas-combustible" class="img-fluid rounded float-right"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_signature">
                        firmar Acta de entrega <i class="fas fa-feather-alt"></i>
                    </button>
                    <button type="submit" id="btn_crear_contrato" class="btn btn-primary">
                        <span hidden class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinner_btn_generarActaEntrega"></span>
                        Generar Acta de entrega</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal fotos auto -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cargar Fotos del vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="file" class="form-control-file" id="inputImagenVehiculo" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="button" id="limpiar-fotoVehiculo" class="btn btn-secondary btn-sm form-control ">
                            limpiar</button>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="color" class=" form-control" id="colorCanvas" oninput="defcolor(this.value)">

                    </div>
                    <div class="form-group col-md-2">
                        <label for="grosor">Grosor de linea</label>
                        <input type="range" id="grosor" class="custom-range" oninput="defgrosor(this.value)" value="0"
                            min="1" max="5">
                    </div>
                    <div class="form-group col-md-3">
                        <button type="button" id="seleccionarFoto" class="btn btn-success btn-sm form-control ">
                            guardar foto</button>
                    </div>


                    <div class="form-group col-md-12">
                        <p><i class="far fa-square"></i> Abolladuras <i class="far fa-circle"></i> Rayaduras <i
                                class="fas fa-times"></i> Piezas rotas </p>
                    </div>
                    <div class="container">
                        <canvas id="canvas-fotoVehiculo" class="img-fluid rounded float-right"
                            style="background:#d9d9d9; display:block;"></canvas>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="owl-carousel owl-theme" id="carruselVehiculos">
                            <div class="item">
                                <img src="https://www.ecured.cu/images/d/d8/Iconos%28informatica%29.png" />
                            </div>
                            <div class="item">
                                <img src="https://www.ecured.cu/images/d/d8/Iconos%28informatica%29.png" />
                            </div>
                            <div class="item">
                                <img src="https://www.ecured.cu/images/d/d8/Iconos%28informatica%29.png" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
            </div>
        </div>
    </div>
</div>





<script>
const buscarArriendo = async (id_arriendo) => {
    const data = new FormData();
    data.append("id_arriendo", id_arriendo);
    const response = await ajax_function(data, "buscar_arriendo");
    if (response.success) {
        const arriendo = response.data;
        console.log(arriendo);
        $("#inputMarcaVehiculoDespacho").val(arriendo.vehiculo.marca_vehiculo);
        $("#inputModeloVehiculoDespacho").val(arriendo.vehiculo.modelo_vehiculo);
        $("#inputEdadVehiculoDespacho").val(arriendo.vehiculo.año_vehiculo);
        $("#inputColorVehiculoDespacho").val(arriendo.vehiculo.color_vehiculo);
        $("#inputPatenteVehiculoDespacho").val(arriendo.vehiculo.patente_vehiculo);
        $("#inputKilomentrajeVehiculoDespacho").val(arriendo.kilometrosEntrada_arriendo);
    }
}
</script>