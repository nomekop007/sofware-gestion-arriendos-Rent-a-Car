<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl"   role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modulo de ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <div class="accordion " id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <div class="card-body d-flex ">
              <h5 style="color: black;" >1.- ¿ Como registrar y gestionar un arriendo de tipo particular y empresarial ? </h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-chevron-down"></i>
              </button>
            </div>
          </h2>
        </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
            <br >
            <h6>Seleccione en la barra lateral del modulo atencion la opcion <b>Registro y gestion de arriendo</b>, 
            donde se podra generar un nuevo registro una vez que se hayan completado los datos.</h6><br><br>



            <center> <img src="<?php echo base_route() ?>assets/images/registroArriendo.png" alt="registro" class="rounded" height="40%" width="40%" style="border: 3px solid; color: green;"></center>
            <br >
            <h6><center><b> Registro de arriendo</b> </center></h6>

            <br><br>
            
            <h6>Luego vamos a la pestaña <b>ver todos los arriendos</b> se cargan los registros,
            los cuales indican su estado mediante iconos que se habilitan a medida que se realiza el proceso.<br><br> </h6> 
            
            <h6>1 ) <button  data-toggle='modal' class='btn btn-outline-primary'><i class="fas fa-upload"></i></button> 
             Boton de carga de Documentos. </h6> 
            <br>
            <h6>2 ) <button data-toggle='modal' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
            Boton para registrar pagos. </h6> 

            <br >

            <h6>Una vez ingresado los valores en la opcion desplegada por el boton <b>registrar pagos</b>, se debe realizar un cambio de pestaña hacia el 
              <b>modulo de gestion</b> en la opcion <b> Facturacion pago clientes</b>,
            para subir el registro del comprobante de pago en el icono  <button data-toggle='modal' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button>.</h6> 

            <br>

            <h6> En el siguiente paso se procede a cambiar de pestaña al <b>modulo de atencion</b> para poder firmar el contrato en su boton correspondiente, una vez terminado esto se puede proceder a realizar el despacho del vehiculo.
            </h6> <br>

            <h6>3 ) <button data-toggle='modal' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button> 
            Boton para firmar contrato. <h6> 
          <br>

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">

              <div class="card-body d-flex">
              <h5 style="color: black;" >2.- ¿ Como registrar y gestionar un arriendo de tipo reemplazo ? </h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="fas fa-chevron-down"></i>
              </button>
            </div>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">

            <h6> Para registrar un arriendo de tipo remplazo se debe entrar al <b>modulo de atencion</b> y seguir los mismos pasos para el tipo de arriendo <b>Particular/Empresarial</b>,
             con la diferencia de que este proceso recibe el comprobante de pago al finalizar la recepcion, entonces tenemos las siguientes opciones:  </h6>
            <br>
            <h6>1 ) <button  data-toggle='modal' class='btn btn-outline-primary'><i class="fas fa-upload"></i></button> 
            Boton de carga de Documentos. </h6> 
            <br>
            <h6>2 ) <button data-toggle='modal' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
            Boton para registrar pagos. </h6> 
            <br>
            <h6>3 ) <button data-toggle='modal' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>
            Boton para firmar contrato. </h6> <br><br>

            <h6>Una vez firmado el contrato se puede proceder a el despacho del vehiculo</h6>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
  
  
      <div class="card-body d-flex">
              <h5 style="color: black;" >3.- ¿Como se gestiona el despacho y recepcion ?</h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree"><i class="fas fa-chevron-down"></i>
              </button>
            </div>


      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
 
              <br>

          <h6><b>Despacho:</b> Para realizar un despacho vamos a el modulo de atencion, <b>Gestion despacho y recepcion</b>,
          una vez en la opcion seleccionamos el vehiculo y generamos el acta de descapacho en el icono.
          <button data-toggle='modal' class='btn btn-outline-info'><i class='fas fa-concierge-bell'></i></button></h6>
          <br><br >



            <center><img src="<?php echo base_route() ?>assets/images/Despacho.png" alt="registro" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center><br ><br >
             <h6><center><b>Despacho de vehiculos.</b> </center></h6>
            <br><br >



            <h6><b>Recepcion:</b>Para realizar el proceso de recepcion de un vehiculo vamos a el <b>modulo de atencion</b>, en la opcion <b>Gestion despacho y recepcion.</b> 
             En este proceso contamos dos opciones disponibles las cuales son:</h6>
            <br><br >
            
            <h6><button  data-toggle='modal'  class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> Extender tiempo de arriendo.</h6>
             <br>
            <h6><button  data-toggle='modal'  class='btn btn btn-outline-info'><i class="fas fa-external-link-square-alt"></i></button> Generar acta de recepcion</h6>
          
          <br><br >

           <center><img src="<?php echo base_route() ?>assets/images/Recepcion.png" alt="registro" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center><br ><br >
           <h6><center><b>Recepcion de vehiculos.</b> </center></h6>

           <br >

           <h6><b>Nota:</b> Una vez generada el acta de recepcion de un arriendo de tipo reemplazo, el sistema se bloqueara hasta que se suba el comprobante de pago total, ademas se debera especificar si el vehiculo tiene o no daños 
           tras su recepcion. En este seccion el sistema permite aplicar descuentos o pagos extras, pero unicamente se puede elegir una opcion.  </h6>
               <br><br >

               <center><img src="<?php echo base_route() ?>assets/images/Descuento_PagosExtra.png" alt="registro" height="50%" width="50%" class="rounded" style="border: 3px solid; color: green;" ></center><br>
           <h6><center><b>Descuentos y pagos extra por daño.</b></center></h6>
                         
            <br><br >
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">

      <div class="card-body d-flex">
              <h5 style="color: black;" >4.- ¿Como gestionar los vehiculos ?</h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fas fa-chevron-down"></i>
              </button>
            </div>

      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body"><br >
       <h6> Este proceso se encuentra en el <b>modulo de gestion</b> en la opcion <b>Gestion de vehiculos</b> y nos permite registrar vehiculos nuevos, como tambien visualizar los vehiculos en arriendo, los disponibles y la totalidad de estos.</h6>

          <br><br >


          <center><img src="<?php echo base_route() ?>assets/images/RegistrarVehiculo.png" alt="registro" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center><br>
           <h6><center><b>Registrar de vehiculos.</b> </center></h6><br ><br >
           <center><img src="<?php echo base_route() ?>assets/images/VehiculosRegistrados.png" alt="registro" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center><br>
           <h6><center><b>Vehiculos registrados.</b> </center></h6><br ><br >
                       
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFive">
      <h2 class="mb-0">

         <div class="card-body d-flex">
              <h5 style="color: black;" >5.- ¿Como gestionar los vehiculos ?</h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"><i class="fas fa-chevron-down"></i>
              </button>
            </div>

      </h2>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body"><br >
   <h6> Este proceso se encuentra en el <b>modulo de gestion</b> en la opcion <b>Gestion de daños vehiculo</b> y nos permite registrar adjuntar un comprobante de daños del vehiculo.</h6>

          <br><br >


              <center><img src="<?php echo base_route() ?>assets/images/DañosVehiculo.png" alt="registro" class="rounded" height="90%" width="90%" style="border: 3px solid; color: green;" ></center><br>
           <h6><center><b>Registro de daños vehicular.</b> </center></h6><br ><br >

          <h6>Acontinuacion se presentan los iconos de gestion de daño de vehiculos.</h6> <br>
          <h6>1 ) <button data-toggle='modal' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>  Visualizacion de descripcion de daños. </h6>    <br>
          <h6>2 ) <button  class='btn btn-outline-primary'><i class="fas fa-camera-retro"></i></button>  Visualizacion acta de recepcion.  </h6>    <br>
          <h6>3 ) <button  data-toggle='modal' class='btn btn-outline-info'><i class="fas fa-upload"></i></button>  Subir comprobante de pago de daños. </h6>
      </div>
    </div>
  </div>
    <div class="card">
    <div class="card-header" id="headingSix">
      <h2 class="mb-0">
         <div class="card-body d-flex">
              <h5 style="color: black;" >6.- ¿ Donde puedo ver la lista de todos los pagos ?</h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"><i class="fas fa-chevron-down"></i>
              </button>
            </div>
      </h2>
    </div>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
      <div class="card-body">
            <h6> Este proceso se encuentra en el <b>modulo de gestion</b> en al opcion <b>facturacion pago clientes</b> y permite la visualizacion de cada uno de los registros existentes.</h6>
            <br><br >
             <center><img src="<?php echo base_route() ?>assets/images/listaPagos.png" alt="registro" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center>
             <br><br >
            <h6><center><b>Lista de pagos (historico).</b> </center></h6>
      </div>
    </div>
  </div>
</div>


 <div class="card">
    <div class="card-header" id="headingSix">
      <h2 class="mb-0">
         <div class="card-body d-flex">
              <h5 style="color: black;" >7.- ¿ Como editar clientes ya inscritos ?</h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="true" aria-controls="collapse"><i class="fas fa-chevron-down"></i>
              </button>
            </div>
      </h2>
    </div>
    <div id="collapseOcho" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
      <div class="card-body"><br >
            <h6> Este proceso se encuentra en el <b>modulo de atencion</b> en al opcion <b>Gestion de clientes</b>, luego busque al usuario (particular, empresa, conductor) y presionar el icono de observacion 
             <button data-toggle='modal' class='btn btn-outline-info'><i class='far fa-eye color'></i></button> para desplezar la opcion editar. </h6>

            <br><br >
             <center><img src="<?php echo base_route() ?>assets/images/EditarCliente.png" alt="registro" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center>
             <br><br >
            <h6><center><b>Opcion de editar Cliente.</b> </center></h6>
      </div>
    </div>
  </div>


   <div class="card">
    <div class="card-header" id="headingSix">
      <h2 class="mb-0">
         <div class="card-body d-flex">
              <h5 style="color: black;" >8.- ¿ Como editar un arriendo ?</h5>
              <button class="btn btn-outline-secondary ml-auto" type="button" data-toggle="collapse" data-target="#collapseNueve" aria-expanded="true" aria-controls="collapse"><i class="fas fa-chevron-down"></i>
              </button>
            </div>
      </h2>
    </div>
    <div id="collapseNueve" class="collapse" aria-labelledby="headingSnine" data-parent="#accordionExample">
      <div class="card-body"><br >
            <h6> Este proceso se encuentra en el <b>modulo de administracion</b>, en al opcion <b>Modificar arriendos</b>. Esta funcion permite editar el arriendo de un vehiculo
            <b>siempre y cuando el vehiculo no haya sido despachado.</b> Ademas es posible cambiar todos los campos del formulario</h6>
            <br>
            <h6>1 ) <button  data-toggle='modal' class='btn btn-outline-primary'><i class="fas fa-upload"></i></button> 
            Boton encargado de reiniciar los documentos cargados del arriendo </h6> 
            <br>
            <h6>2 ) <button data-toggle='modal' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
            Boton para reiniciar documentos relacionados con el pago. </h6> 
            <br>
            <h6>3 ) <button data-toggle='modal' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>
            Boton para reiniciar firma del contrato en el acta. </h6> 
            <br><br >
             <center><img src="<?php echo base_route() ?>assets/images/editarArriendos.png" alt="editar arriendo" height="90%" width="90%" class="rounded" style="border: 3px solid; color: green;" ></center>
             <br><br >
            <h6><center><b>Opcion de editar Arriendo.</b> </center></h6>
      </div>
    </div>
  </div>
</div>

</div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


