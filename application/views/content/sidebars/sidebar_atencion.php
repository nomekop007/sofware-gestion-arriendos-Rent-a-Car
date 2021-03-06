<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <br>
        <ul class="nav flex-column">
            <br>
            <?php if (validarPermiso(1)) { ?>
                <li class="nav-item" id="l_reserva">
                    <br>
                    <a id="m_reserva" class="nav-link" href="<?php echo base_url() ?>modulos_atencion?modulo=4">
                        <i class="fas fa-calendar-alt"></i>
                        Calendario de reservas
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(2)) { ?>
                <li class="nav-item" id="l_cliente">
                    <br>
                    <a id="m_cliente" class="nav-link" href="<?php echo base_url() ?>modulos_atencion?modulo=1">
                        <i class="fas fa-address-book "></i>
                        gestion de Clientes
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(3)) { ?>
                <li class="nav-item" id="l_arriendo">
                    <br>
                    <a id="m_arriendo" class="nav-link" href="<?php echo base_url() ?>modulos_atencion?modulo=2">
                        <i class="fas fa-file-signature"></i>
                        Registro y gestion de Arriendo
                    </a>
                    <br>
                </li>
            <?php } ?>

            <?php if (validarPermiso(4)) { ?>
                <li class="nav-item" id="l_despacho">
                    <br>
                    <a id="m_despacho" class="nav-link" href="<?php echo base_url() ?>modulos_atencion?modulo=3">
                        <i class="fas fa-concierge-bell"></i>
                        Gestion despacho y recepcion
                    </a>
                    <br>
                </li>
            <?php } ?>

        


        </ul>

        <div class="row align-items-center" >
            <div class="col-4 align-self-start">     
            </div>
            <div class="col-4 align-self-center">
            </div>
            <div class="col-4 float-right fixed-bottom ">   
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalLong">
                <i class="far fa-question-circle fa-2x "></i>
                </button>
            </div>
        </div>



        
    </div>


    
</nav>