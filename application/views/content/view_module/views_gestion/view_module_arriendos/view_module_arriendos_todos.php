  <!-- Tab con la tabla de los arriendos activos -->
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-arriendosTotales">
      <br><br>
      <table id="tablaTotalArriendos" class="table table-striped table-bordered" style="width:100%">
          <thead class="btn-dark">
              <tr>
                  <th>Nº Arriendo</th>
                  <th>fecha creacion</th>
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
                  <th>Nº Arriendo</th>
                  <th>fecha creacion</th>
                  <th>tipo arriendo</th>
                  <th>estado</th>
                  <th>vendedor</th>
                  <th></th>
              </tr>
          </tfoot>
      </table>
  </div>



  <!-- Modal Confirmacion arriendo -->
  <div class="modal fade" id="modal_confirmar_arriendo" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Formulario de contrato</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <br>
                  <h5>Garantia</h5>
                  <div class="card">
                      <div class="form-row card-body">
                          <div class="form-group col-md-12">
                              <label for="inputNumeroTargeta">Tarjeta de credito</label>
                              <div class="input-group">
                                  <input style="width: 80%;" type="number" class="form-control" id="inputNumeroTargeta"
                                      name="inputNumeroTargeta">
                                  <input style="width: 20%;" name="inputFechaTargeta" id="inputFechaTargeta" type="text"
                                      aria-label="Last name" class="form-control">
                              </div>
                          </div>
                          <div class="form-group col-md-12">
                              <label for="inputCheque">Cheque</label>
                              <input type="text" class="form-control" id="inputCheque" name="inputCheque">
                          </div>
                          <div class="input-group col-md-12">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Abono $</span>
                              </div>
                              <input min="0" value="0" type="number" id="inputAbono" name="inputAbono"
                                  class="form-control">
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
                              <span style="width: 50%;" id="textDias" class="input-group-text form-control">Cantidad de
                                  dias: X</span>
                          </div>
                          <div class="input-group col-md-12">
                              <span style="width: 60%;" class="input-group-text form-control">Valor Arriendo $</span>
                              <input style="width: 40%;" id="inputValorArriendo" min="0" value="0" type="number"
                                  class="form-control">
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
                              <input type="radio" id="radioBoleta" name="customRadio1" class="custom-control-input"
                                  checked>
                              <label class="custom-control-label" for="radioBoleta">Boleta</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline ">
                              <input type="radio" id="radioFactura" name="customRadio1" class="custom-control-input">
                              <label class="custom-control-label" for="radioFactura">Factura</label>
                          </div>
                      </div>
                      <div class="form-row card-body">
                          <div class="input-group col-md-12">
                              <span style="width: 60%;" class="input-group-text form-control">Sub total Neto $</span>
                              <input style="width: 40%;" id="inputSubTotal" name="inputSubTotal" min="0" value="0"
                                  type="number" class="form-control">
                          </div>
                          <div class="input-group col-md-12">
                              <span style="width: 60%;" class="input-group-text form-control">IVA $</span>
                              <input style="width: 40%;" id="inputIVA" name="inputIVA" min="0" value="0" type="number"
                                  class="form-control">
                          </div>
                          <div class="input-group col-md-12">
                              <span style="width: 60%;" class="input-group-text form-control">Descuento $</span>
                              <input style="width: 40%;" min="0" id="inputDescuento" name="inputDescuento" value="0"
                                  type="number" class="form-control">
                          </div>
                          <div class="input-group col-md-12">
                              <span style="width: 60%;" class="input-group-text form-control">A Pagar $</span>
                              <input style="width: 40%;" min="0" id="inputTotal" name="inputTotal" value="0"
                                  type="number" class="form-control">
                          </div>
                      </div>
                      <div class="form-row card-body">
                          <div class="custom-control custom-radio custom-control-inline ">
                              <input type="radio" id="radioEfectivo" name="customRadio2" class="custom-control-input"
                                  checked>
                              <label class="custom-control-label" for="radioEfectivo">Efectivo</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline ">
                              <input type="radio" id="radioCheque" name="customRadio2" class="custom-control-input">
                              <label class="custom-control-label" for="radioCheque">Cheque</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline ">
                              <input type="radio" id="radioTarjeta" name="customRadio2" class="custom-control-input">
                              <label class="custom-control-label" for="radioTarjeta">Tarjeta</label>
                          </div>
                      </div>

                      <div class="form-row card-body">
                          <div class="form-group col-md-12">
                              <label for="inputDigitador">Digitado por</label>
                              <input type="text" class="form-control" id="inputDigitador">
                          </div>
                          <div class="form-group col-md-12">
                              <label for="inputObservaciones">Observacines</label>
                              <textarea class="form-control" id="inputObservaciones" rows="3"></textarea>
                          </div>


                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary">Guardar Cambios</button>
              </div>
          </div>
      </div>
  </div>





  <!-- Modal bajar documentos -->
  <div class="modal fade" id="modal_bajar_docs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">bajar documentos</h5>
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





  <!-- Modal Editar Arriendo -->
  <div class="modal fade" id="modal_editar_arriendo" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Arriendo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  ...
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary">guardar Cambios</button>
              </div>
          </div>
      </div>
  </div>

  <script>
function confirmacion(id_arriendo) {
    console.log(id_arriendo);
}
  </script>