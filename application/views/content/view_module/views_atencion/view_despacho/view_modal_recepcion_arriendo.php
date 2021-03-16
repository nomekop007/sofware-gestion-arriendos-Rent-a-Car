<!-- Modal recepcion de arriendo-->
<div class="modal fade" id="modal_ArriendoFinalizar" data-keyboard="false" tabindex="-1" data-backdrop="static" style="overflow-y: scroll;" aria-labelledby="modal_ArriendoFinalizarLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ArriendoFinalizarLabel">Control de Recepcion Arriendo Nº <span id="numero_arriendo_recepcion">Nº</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formSpinner_finalizar_arriendo">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="body_recepcion_arriendo">
                <input id="id_arriendo_recepcion" type="text" hidden>
                <input id="id_vehiculo_recepcion" type="text" hidden>

                <div class="row">

                    <div class="col-md-6">
                        <br>
                        <div class="container pdf-canvas" id="ventana_fotosDespacho"></div>
                        <br>
                        <div id="ventana_actaEntrega">
                            <button id="prev_recepcion" class=" btn-info">
                                < </button> <button id="next_recepcion" class=" btn-info "> >
                                    </button>
                                    &nbsp; &nbsp;
                                    <span>Pagina: <span id="page_num_recepcion"></span> / <span id="page_count_recepcion"></span></span>
                                    <canvas id="pdf_canvas_recepcion" class="img-fluid rounded pdf-canvas"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <div class="container pdf-canvas" id="carrucel_recepcion"> </div>
                        <br>
                        <div class="form-group col-lg-12">
                            <button type="button" class=" btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFotosVehiculoRecepcion">
                                Tomar Fotos al vehiculo
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" id="limpiarArrayFotosRecepcion"><i class="fas fa-trash-alt"></i> limpiar
                                lista</button>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input_kilometraje_salida">Kilomentraje actual</label>
                                <input oninput="this.value = soloNumeros(this)" maxLength="11" type="number" value="0" class="form-control" id="input_kilometraje_salida" name="input_kilometraje_salida" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPatenteVehiculoRecepcion">Patente</label>
                                <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputPatenteVehiculoRecepcion" name="inputPatenteVehiculoDespacho">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="inputMarcaVehiculoRecepcion">Marca</label>
                                <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputMarcaVehiculoRecepcion" name="inputMarcaVehiculoRecepcion">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputModeloVehiculoRecepcion">Modelo</label>
                                <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputModeloVehiculoRecepcion" name="inputModeloVehiculoRecepcion">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEdadVehiculoRecepcion">Año</label>
                                <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputEdadVehiculoRecepcion" name="inputEdadVehiculoRecepcion">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputColorVehiculoRecepcion">Color</label>
                                <input disabled onblur="mayus(this);" type="text" class="form-control" id="inputColorVehiculoRecepcion" name="inputColorVehiculoRecepcion">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <h6 class="text-center">Combustible actual</h6>
                        <div class="container col-md-12" id="canvasContainer">
                            <div id="output-recepcion" class="text-center">0E</div>
                            <canvas id="canvas-combustible-recepcion" class="img-fluid rounded float-right"></canvas>
                            <img id="imagenBencina" src="<?php echo base_route() ?>assets/images/indicadorBencina.jpg" hidden />
                        </div>
                    </div>
                </div>
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
                                <label class="col-md-7" for="check50">Documentacion</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check50" type="checkbox" name="listA2[]" value="a1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check51">Inscripción</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check51" type="checkbox" name="listA2[]" value="a2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check52">Permiso Circulacion</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check52" type="checkbox" name="listA2[]" value="a3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check53">Rev. Técnica</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check53" type="checkbox" name="listA2[]" value="a4">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check54">Seguro Obligatorio</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check54" type="checkbox" name="listA2[]" value="a5">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check55">Otros</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check55" type="checkbox" name="listA2[]" value="a6">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check56">INTERIOR</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check56" type="checkbox" name="listA2[]" value="a7">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check57">Manual</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check57" type="checkbox" name="listA2[]" value="a8">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check58">Garantía</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check58" type="checkbox" name="listA2[]" value="a9">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check59">Cinturones</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check59" type="checkbox" name="listA2[]" value="a10">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check60">Espejos Interior</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check60" type="checkbox" name="listA2[]" value="a11">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check61">Espejos Exterior</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check61" type="checkbox" name="listA2[]" value="a12">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check62">Parasoles</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check62" type="checkbox" name="listA2[]" value="a13">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check63">Ceniceros</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check63" type="checkbox" name="listA2[]" value="a14">
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
                                <label class="col-md-7" for="check64">Encendedor</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check64" type="checkbox" name="listB2[]" value="b1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check65">Doble juego llaves</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check65" type="checkbox" name="listB2[]" value="b2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check66">Pisos de goma</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check66" type="checkbox" name="listB2[]" value="b3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check67">Tapiz O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check67" type="checkbox" name="listB2[]" value="b4">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check68">Radio O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check68" type="checkbox" name="listB2[]" value="b5">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check69">Tocacintas O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check69" type="checkbox" name="listB2[]" value="b6">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check70">Bocina O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check70" type="checkbox" name="listB2[]" value="b7">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check71">Luces O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check71" type="checkbox" name="listB2[]" value="b8">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check72">Señalizadores O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check72" type="checkbox" name="listB2[]" value="b9">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check73">Luz Emergencia O.K</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check73" type="checkbox" name="listB2[]" value="b10">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check74">Calefacción O.K</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check74" type="checkbox" name="listB2[]" value="b11">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check75">Defroster O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check75" type="checkbox" name="listB2[]" value="b12">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check76">Freno de Mano O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check76" type="checkbox" name="listB2[]" value="b13">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check77">Chaleco reflectante</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check77" type="checkbox" name="listB2[]" value="b14">
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
                                <label class="col-md-7" for="check78">Tapas de rueda ( )</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check78" type="checkbox" name="listC2[]" value="c1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check79">Plumillas ( )</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check79" type="checkbox" name="listC2[]" value="c2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check80">Antena O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check80" type="checkbox" name="listC2[]" value="c3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check81">Micas O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check81" type="checkbox" name="listC2[]" value="c4">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check82">Pintura O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check82" type="checkbox" name="listC2[]" value="c5">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check83">Nivel Aceite O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check83" type="checkbox" name="listC2[]" value="c6">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check84">Tapa Bencina</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check84" type="checkbox" name="listC2[]" value="c7">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check85">R.Repuesto</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check85" type="checkbox" name="listC2[]" value="c8">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check86">Gata/Barrote</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check86" type="checkbox" name="listC2[]" value="c9">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check87">Herramientas</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check87" type="checkbox" name="listC2[]" value="c10">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check88">Parachoques O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check88" type="checkbox" name="listC2[]" value="c11">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check89">Bateria O.K.</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check89" type="checkbox" name="listC2[]" value="c12">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check90">Adhesivo Interior</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check90" type="checkbox" name="listC2[]" value="c13">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-7" for="check91">Placa</label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" id="check91" type="checkbox" name="listC2[]" value="c14">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalRegistrarDaño">Registrar daño</button>
                <button type="button" class="btn btn-primary" id="btn_generar_actaRecepcion">Generar Acta Recepcion
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_generar_actaRecepcion"></span>
                </button>
            </div>
        </div>
    </div>
</div>