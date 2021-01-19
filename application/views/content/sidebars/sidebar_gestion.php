<?php
$rol = $this->session->userdata("rol");
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <br>
        <ul class="nav flex-column">
            <br>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_reserva">
                <br>
                <a id="m_reserva" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=4">
                    <i class="fas fa-calendar-alt"></i>
                    Calendario de reservas
                </a>
                <br>
            </li>
            <?php } ?>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_cliente">
                <br>
                <a id="m_cliente" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=1">
                    <i class="fas fa-address-book "></i>
                    Gestion de Clientes
                </a>
                <br>
            </li>
            <?php } ?>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_arriendo">
                <br>
                <a id="m_arriendo" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=2">
                    <i class="fas fa-file-signature"></i>
                    Registro y gestion de Arriendo
                </a>
                <br>
            </li>
            <?php } ?>

            <?php if ($rol == 1 || $rol == 2 || $rol == 3) { ?>
            <li class="nav-item" id="l_despacho">
                <br>
                <a id="m_despacho" class="nav-link" href="<?php echo base_url() ?>modulos_gestion?modulo=3">
                    <i class="fas fa-concierge-bell"></i>
                    Gestion despacho y recepcion
                </a>
                <br>
            </li>
            <?php } ?>


        </ul>
    </div>
</nav>