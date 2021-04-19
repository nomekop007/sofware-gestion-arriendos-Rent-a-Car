<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <br>
        <ul class="nav flex-column">

            <li class="nav-item" id="l_traslado">
                <br>
                <a id="m_traslado" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=6">
                    <i class="fas fa-car-side"></i>
                        Trasladar Vehiculos
                 </a>
                <br>
            </li>

            <?php if (validarPermiso(5)) { ?>
                <li class="nav-item " id="l_vehiculo">
                    <br>
                    <a id="m_vehiculo" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=1">
                        <i class="fas fa-car"></i>
                        Gestion Vehiculos
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(6)) { ?>
                <li class="nav-item " id="l_danios">
                    <br>
                    <a id="m_danios" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=2">
                        <i class="fas fa-car-crash"></i>
                        Gestion de daños Vehiculo
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(7)) { ?>
                <li class="nav-item " id="l_facturacion">
                    <br>
                    <a id="m_facturacion" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=3">
                        <i class="fas fa-money-bill-wave"></i>
                        PreFacturacion E. Remplazo
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(8)) { ?>
                <li class="nav-item" id="l_pagoCliente">
                    <br>
                    <a id="m_pagoCliente" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=5">
                        <i class="fas fa-money-bill-wave"></i>
                        Facturacion Pago Clientes
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(9)) { ?>
                <li class="nav-item" id="l_usuario">
                    <br>
                    <a id="m_usuario" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=4">
                        <i class="fas fa-users-cog "></i>
                        Gestion Usuarios
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