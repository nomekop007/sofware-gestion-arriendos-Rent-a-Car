<?php
$rol = $this->session->userdata("rol");
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <br>
        <ul class="nav flex-column">
            <br>
            <?php if ($rol == 1 || $rol == 2) { ?>
            <li class="nav-item " id="l_vehiculo">
                <br>
                <a id="m_vehiculo" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=1">
                    <i class="fas fa-car "></i>
                    Gestion Vehiculos
                </a>
                <br>
            </li>
            <?php } ?>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_cliente">
                <br>
                <a id="m_cliente" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=2">
                    <i class="fas fa-address-book "></i>
                    Gestion Clientes
                </a>
                <br>
            </li>
            <?php } ?>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_arriendo">
                <br>
                <a id="m_arriendo" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=3">
                    <i class="fas fa-file-signature"></i>
                    Gestion Arriendo
                </a>
                <br>
            </li>
            <?php } ?>

            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_despacho">
                <br>
                <a id="m_despacho" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=4">
                    <i class="fas fa-concierge-bell"></i>
                    Gestion despacho
                </a>
                <br>
            </li>
            <?php } ?>

            <?php if ($rol == 1) { ?>
            <li class="nav-item" id="l_usuario">
                <br>
                <a id="m_usuario" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=5">
                    <i class="fas fa-users-cog "></i>
                    Gestion Usuarios
                </a>
                <br>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>