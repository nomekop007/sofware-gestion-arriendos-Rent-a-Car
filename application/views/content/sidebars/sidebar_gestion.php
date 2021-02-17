<?php
$rol = $this->session->userdata("rol");
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <br>
        <ul class="nav flex-column">
            <br>
            <?php if (validarPermiso(5)) { ?>
                <li class="nav-item " id="l_vehiculo">
                    <br>
                    <a id="m_vehiculo" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=1">
                        <i class="fas fa-car "></i>
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
                        Gestion de daños vehiculo
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(7)) { ?>
                <li class="nav-item " id="l_facturacion">
                    <br>
                    <a id="m_facturacion" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=3">
                        <i class="fas fa-money-bill-wave"></i>
                        Facturacion E. Remplazo
                    </a>
                    <br>
                </li>
            <?php } ?>
            <?php if (validarPermiso(8)) { ?>
                <li class="nav-item" id="l_pagoCliente">
                    <br>
                    <a id="m_pagoCliente" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=5">
                        <i class="fas fa-money-bill-wave"></i>
                        Facturacion pago clientes
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
    </div>
</nav>