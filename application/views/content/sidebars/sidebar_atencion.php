<?php
$rol = $this->session->userdata("rol");
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <br>
        <ul class="nav flex-column">
            <br>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) {?>
            <li class="nav-item " id="l_facturacion">
                <br>
                <a id="m_facturacion" class="nav-link" href="<?php echo base_url() ?>modulos_atencion?modulo=1">
                    <i class="fas fa-money-bill-wave"></i>
                    Facturacion E. Remplazo
                </a>
                <br>
            </li>
            <?php }?>
            <?php if ($rol == 1 || $rol == 2 || $rol == 3) {?>
            <li class="nav-item " id="l_danios">
                <br>
                <a id="m_danios" class="nav-link" href="<?php echo base_url() ?>modulos_atencion?modulo=2">
                    <i class="fas fa-car-crash"></i>
                    Gestion de daños vehiculo
                </a>
                <br>
            </li>
            <?php }?>
        </ul>
    </div>
</nav>