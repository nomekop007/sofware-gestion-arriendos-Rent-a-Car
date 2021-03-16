<!-- Modal despachar -->
<div class="modal fade" id="modal_despachar_arriendo" data-backdrop="static" style="overflow-y: scroll;" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Control de Despacho Arriendo Nº <span id="numero_arriendo_despacho">Nº</span></h5>
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
                        <div class="form-group col-lg-3">
                            <label for="inputMarcaVehiculoDespacho">Marca</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputMarcaVehiculoDespacho" name="inputMarcaVehiculoDespacho">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputModeloVehiculoDespacho">Modelo</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputModeloVehiculoDespacho" name="inputModeloVehiculoDespacho">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputEdadVehiculoDespacho">Año</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputEdadVehiculoDespacho" name="inputEdadVehiculoDespacho">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputColorVehiculoDespacho">Color</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputColorVehiculoDespacho" name="inputColorVehiculoDespacho">
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="inputPatenteVehiculoDespacho">Patente</label>
                            <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputPatenteVehiculoDespacho" name="inputPatenteVehiculoDespacho">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputKilomentrajeVehiculoDespacho">Kilomentraje actual</label>
                            <input oninput="this.value = soloNumeros(this)" maxLength="11" type="number" value="0" class="form-control" id="inputKilomentrajeVehiculoDespacho" name="inputKilomentrajeVehiculoDespacho" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputDestinoDespacho">Destino (venta o arriendo)</label>
                            <input onblur="mayus(this);" type="text" class="form-control" id="inputDestinoDespacho" name="inputDestinoDespacho">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputProcedenciaDesdeDespacho">Procedencia de</label>
                            <input onblur="mayus(this);" type="text" class="form-control" id="inputProcedenciaDesdeDespacho" name="inputProcedenciaDesdeDespacho">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="inputProcedenciaHaciaDespacho">a</label>
                            <input onblur="mayus(this);" type="text" class="form-control" id="inputProcedenciaHaciaDespacho" name="inputProcedenciaHaciaDespacho">
                        </div>
                    </div>
                    <br><br>
                    <div class="card">
                        <div class="card-body form-row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <label>SI/NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check1">Documentacion</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check1" type="checkbox" name="listA[]" value="a1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check2">Inscripción</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check2" type="checkbox" name="listA[]" value="a2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check3">Permiso Circulacion</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check3" type="checkbox" name="listA[]" value="a3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check4">Rev. Técnica</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check4" type="checkbox" name="listA[]" value="a4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check5">Seguro Obligatorio</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check5" type="checkbox" name="listA[]" value="a5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check6">Otros</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check6" type="checkbox" name="listA[]" value="a6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check7">INTERIOR</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check7" type="checkbox" name="listA[]" value="a7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check8">Manual</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check8" type="checkbox" name="listA[]" value="a8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check9">Garantía</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check9" type="checkbox" name="listA[]" value="a9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check10">Cinturones</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check10" type="checkbox" name="listA[]" value="a10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check11">Espejos Interior</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check11" type="checkbox" name="listA[]" value="a11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check12">Espejos Exterior</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check12" type="checkbox" name="listA[]" value="a12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check13">Parasoles</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check13" type="checkbox" name="listA[]" value="a13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check14">Ceniceros</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check14" type="checkbox" name="listA[]" value="a14">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <label>SI/NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check15">Encendedor</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check15" type="checkbox" name="listB[]" value="b1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check16">Doble juego llaves</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check16" type="checkbox" name="listB[]" value="b2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check17">Pisos de goma</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check17" type="checkbox" name="listB[]" value="b3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check18">Tapiz O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check18" type="checkbox" name="listB[]" value="b4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check19">Radio O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check19" type="checkbox" name="listB[]" value="b5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check20">Tocacintas O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check20" type="checkbox" name="listB[]" value="b6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check21">Bocina O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check21" type="checkbox" name="listB[]" value="b7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check22">Luces O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check22" type="checkbox" name="listB[]" value="b8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check23">Señalizadores O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check23" type="checkbox" name="listB[]" value="b9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check24">Luz Emergencia O.K</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check24" type="checkbox" name="listB[]" value="b10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check25">Calefacción O.K</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check25" type="checkbox" name="listB[]" value="b11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check26">Defroster O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check26" type="checkbox" name="listB[]" value="b12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check27">Freno de Mano O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check27" type="checkbox" name="listB[]" value="b13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check28">Chaleco reflectante</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check28" type="checkbox" name="listB[]" value="b14">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <label>SI/NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check29">Tapas de rueda ( )</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check29" type="checkbox" name="listC[]" value="c1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check30">Plumillas ( )</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check30" type="checkbox" name="listC[]" value="c2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check31">Antena O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check31" type="checkbox" name="listC[]" value="c3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check32">Micas O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check32" type="checkbox" name="listC[]" value="c4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check33">Pintura O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check33" type="checkbox" name="listC[]" value="c5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check34">Nivel Aceite O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check34" type="checkbox" name="listC[]" value="c6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check35">Tapa Bencina</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check35" type="checkbox" name="listC[]" value="c7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check36">R.Repuesto</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check36" type="checkbox" name="listC[]" value="c8">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check37">Gata/Barrote</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check37" type="checkbox" name="listC[]" value="c9">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check38">Herramientas</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check38" type="checkbox" name="listC[]" value="c10">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check39">Parachoques O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check39" type="checkbox" name="listC[]" value="c11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check40">Bateria O.K.</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check40" type="checkbox" name="listC[]" value="c12">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check41">Adhesivo Interior</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check41" type="checkbox" name="listC[]" value="c13">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-7" for="check42">Placa</label>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" id="check42" type="checkbox" name="listC[]" value="c14">
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
                                <textarea onblur="mayus(this);" class="form-control" id="inputObservacionesDespacho" name="inputObservacionesDespacho" rows="3" maxLength="100"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputRecibidorDespacho">Recibido por</label>
                                <input type="text" class="form-control" id="inputRecibidorDespacho" onblur="mayus(this);" name="inputRecibidorDespacho">
                            </div>
                            <div class="form-group">
                                <label for="inputEntregadorDespacho">Entregado por</label>
                                <input type="text" value="<?php echo $this->session->userdata('nombre') ?>" class="form-control" onblur="mayus(this);" id="inputEntregadorDespacho" name="inputEntregadorDespacho">
                            </div>
                            <button type="button" class="form-group col-md-12 btn btn-primary" data-toggle="modal" data-target="#canvasFotosVehiculo">
                                Tomar Fotos al vehiculo
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="text-center">Combustible actual</h6>
                                <div class="container col-md-12" id="canvasContainer">
                                    <div id="output" class="text-center">0E</div>
                                    <canvas id="canvas-combustible" class="img-fluid rounded float-right"></canvas>
                                    <img id="imagenBencina" src="<?php echo base_route() ?>assets/images/indicadorBencina.jpg" hidden />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_signature">
                        mostrar Acta de entrega <i class="fas fa-feather-alt"></i>
                    </button>
                    <button type="submit" id="btn_crear_ActaEntrega" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_generarActaEntrega"></span>
                        Generar Acta de entrega</button>
                </div>
            </form>
        </div>
    </div>
</div>