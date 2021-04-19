
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registrar daño vehicular</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


  <!-- Formulario agregar daño - Esteban Mallea -->

    <nav class="navbar navbar-light bg-light">
      <form class="form-inline">
        <input class="form-control mr-sm-2 input-number" type="number"   value="" required id="buscar_button" placeholder="Buscar arriendo" aria-label="Search">
        <button class="btn btn-outline-secondary my-2 my-sm-0 "  id="buscar-Arriendo" type="button">Buscar arriendo</button>
      </form>
    </nav>
    <br><br>


    <form >
      <div class="form-row">
        <div class="form-group col-md-6">

          <h6><span class="label label-default">Nombre Cliente</span></h6>
          <input type="text" disabled class="form-control" id="nombre" placeholder="Nombre Completo">
        </div>
        <div class="form-group col-md-6">
        <h6><span class="label label-default">Rut</span></h6>
          <input type="text" disabled class="form-control" id="rut" placeholder="Cedula de Identidad">
        </div>
        <div class="form-group col-md-6">
          <h6><span class="label label-default">Email Cliente</span></h6>
          <input type="email" disabled class="form-control" id="email" placeholder="Correo Electronico">
        </div>
        <div class="form-group col-md-6">
        <h6><span class="label label-default">Telefono</span></h6>
          <input type="text" disabled class="form-control" id="telefono" placeholder="Numero Telefonico">
       </div>
      </div>
      <div class="form-group">
      <h6><span class="label label-default">Direccion</span></h6>
        <input type="text" disabled class="form-control" id="direccion" placeholder="Direccion Personal">
      </div>

      <div class="form-group " id="div_observacion" >
        <h6><span class="label label-default">Observacion</span></h6>
        <textarea class="form-control" id="textareaObservacion" rows="4"></textarea>
      </div>

 
    <br>

      <div id="fotografia_recepcion_daño" >

        <h6 class="title">Fotografias de Recepción</h6>
        <br>


        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

          <div class="carousel-inner" id="contenedorImagenes"></div>

          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <br>
      </div>
    </form>

  
      <center><div class="alert alert-danger" id="Alerta_arriendo" style="width: 90%;" role="alert">
        <h6>El arriendo seleccionado no tiene el estado de "RECEPCIONADO", porfavor seleccione otro.</h6>
      </div></center>
      
      <center><div class="alert alert-success" id="Alerta_arriendo_success" style="width: 90%;" role="alert">
        <h6>Arriendo registrado exitosamente.</h6>
      </div></center>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="cerrar_agregarDaño" data-dismiss="modal">Cerrar</button>
        <button type="button" id="registar_danio_vehicular"  class="btn btn-success">Guardar Registro</button>
      </div>

    </div>
  </div>
</div>


