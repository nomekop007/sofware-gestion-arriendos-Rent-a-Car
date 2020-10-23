<?php
$nombreUsuario = $this->session->userdata('nombre')
?>
<div class="tab-pane fade show active" id="nav-despachos" role="tabpanel" aria-labelledby="nav-despacho-tab">
    <br><br>
    <div class="scroll">
        <table id="tablaControldespacho" class=" table table-striped table-bordered " style="width:100%">
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
    </div>
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
            <div class="modal-body" id="formSpinner">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <form class="needs-validation" id="formActaEntrega" novalidate>
                <input hidden type="text" id="inputIdArriendo" name="inputIdArriendo">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputMarcaVehiculoDespacho">Vehiculo</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control"
                                id="inputMarcaVehiculoDespacho" name="inputMarcaVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputModeloVehiculoDespacho">Modelo</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control"
                                id="inputModeloVehiculoDespacho" name="inputModeloVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEdadVehiculoDespacho">Año</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control"
                                id="inputEdadVehiculoDespacho" name="inputEdadVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputColorVehiculoDespacho">Color</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control"
                                id="inputColorVehiculoDespacho" name="inputColorVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPatenteVehiculoDespacho">Patente</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control"
                                id="inputPatenteVehiculoDespacho" name="inputPatenteVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputKilomentrajeVehiculoDespacho">Kilomentraje</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control"
                                id="inputKilomentrajeVehiculoDespacho" name="inputKilomentrajeVehiculoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputDestinoDespacho">Destino (venta o arriendo)</label>
                            <input onblur="mayus(this);" type="text" class="form-control" id="inputDestinoDespacho"
                                name="inputDestinoDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputProcedenciaDesdeDespacho">Procedencia de</label>
                            <input onblur="mayus(this);" type="text" class="form-control"
                                id="inputProcedenciaDesdeDespacho" name="inputProcedenciaDesdeDespacho">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputProcedenciaHaciaDespacho">a</label>
                            <input onblur="mayus(this);" type="text" class="form-control"
                                id="inputProcedenciaHaciaDespacho" name="inputProcedenciaHaciaDespacho">
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
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Inscripción</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Permiso Circulacion</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Rev. Técnica</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Seguro Obligatorio</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Otros</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">INTERIOR</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Manual</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Garantía</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Cinturones</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Espejos Interior</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Espejos Exterior</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Parasoles</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Ceniceros</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listA[]" value="a14">
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
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Doble juego llaves</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Pisos de goma</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tapiz O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Radio O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tocacintas O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Bocina O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Luces O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Señalizadores O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Luz Emergencia O.K</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Calefacción O.K</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Defroster O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Freno de Mano O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Chaleco reflectante</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listB[]" value="b14">
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
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Plumillas ( )</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Antena O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Micas O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Pintura O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Nivel Aceite O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Tapa Bencina</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">R.Repuesto</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Gata/Barrote</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Herramientas</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Parachoques O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Bateria O.K.</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Adhesivo Interior</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7">Placa</div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="listC[]" value="c14">
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
                                <input type="text" class="form-control" id="inputRecibidorDespacho"
                                    onblur="mayus(this);" name="inputRecibidorDespacho">
                            </div>
                            <div class="form-group">
                                <label for="inputEntregadorDespacho">Entregado por</label>
                                <input type="text" value="<?php echo $nombreUsuario ?>" class="form-control"
                                    onblur="mayus(this);" id="inputEntregadorDespacho" name="inputEntregadorDespacho">
                            </div>
                            <button type="button" class="form-group col-md-12 btn btn-primary" data-toggle="modal"
                                data-target="#staticBackdrop">
                                Tomar Fotos al vehiculo
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="text-center">Combustible actual</h6>
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
                    <button type="submit" id="btn_crear_ActaEntrega" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
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
                        <h6>Maximo 5 fotos </h6>
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
                    <div class="form-group col-md-12 text-center">
                        <br>
                        <p><i class="far fa-square"></i> Abolladuras <i class="far fa-circle"></i> Rayaduras <i
                                class="fas fa-times"></i> Piezas rotas </p>
                    </div>
                    <div class="container">
                        <div class="col-md-12 d-flex justify-content-center" id="cont-canvas">
                            <canvas id="canvas-fotoVehiculo" style="background:#d9d9d9"></canvas>
                        </div>
                        <br>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="container" id="carrucel">

                        </div>
                        <br>
                        <button type="button" class="btn btn-danger btn-sm" id="limpiarArrayFotos">limpiar
                            lista</button>
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


<!-- Modal signature-->
<div class="modal fade" id="modal_signature" tabindex="-1" aria-labelledby="signatureModal" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_signature">Firmar Acta de entrega </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="nombre_documento" hidden>
                <div id="body-sinContrato">
                    <br>
                    <h6 class='text-center'>Sin Acta de entrega cargado</h6><br>
                </div>
                <div id="body-documento">
                    <!-- se carga el pdf -->
                </div>
                <div class="container" id="body-firma">
                    <!-- firmas  -->
                </div>
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
        $("#inputMarcaVehiculoDespacho").val(arriendo.vehiculo.marca_vehiculo);
        $("#inputModeloVehiculoDespacho").val(arriendo.vehiculo.modelo_vehiculo);
        $("#inputEdadVehiculoDespacho").val(arriendo.vehiculo.año_vehiculo);
        $("#inputColorVehiculoDespacho").val(arriendo.vehiculo.color_vehiculo);
        $("#inputPatenteVehiculoDespacho").val(arriendo.vehiculo.patente_vehiculo);
        $("#inputKilomentrajeVehiculoDespacho").val(arriendo.vehiculo.kilometraje_vehiculo);
        $("#formSpinner").hide();
        $("#formActaEntrega").show();
    }

}

const limpiarCampos = () => {
    $("#body-documento").hide();
    $("#body-firma").hide();
    $("#body-sinContrato").show();
    $("#nombre_documento").val("");
    $("#subtotal-copago").hide();
    $("#spinner_btn_generarActaEntrega").hide();
    $("#formActaEntrega")[0].reset();
    $("#formSpinner").show();
    $("#formActaEntrega").hide();
}
</script>