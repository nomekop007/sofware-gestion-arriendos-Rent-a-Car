<body>

    <!-- esto es el navbar del dashboard  -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#" style="  background-color: #909497; ">
            <img src="<?php echo base_route() ?>assets/images/logo.png" alt="" width="145" height="40"></a>
        <div class="dropdown w-100 px-3">
            <button class="btn btn-dark dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                modulos
            </button>
            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo base_url(); ?>cargar_panel?panel=1">Modulos Atencion</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cargar_panel?panel=2"> Modulos Gestion</a>
                <a class="dropdown-item" href="<?php echo client_url() ?>">
                    Modulos
                    Administracion
                </a>
            </div>
        </div>


        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="dropdown px-3">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span> <?php echo $this->session->userdata('nombre'); ?> </span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo base_url(); ?>modulos_gestion?modulo=0">Mi perfil</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cerrar_sesion">Cerrar Sesion</a>
            </div>
        </div>

    </nav>

    <!-- abajo se muestra el drawer de acuerdo a la opcion que se eliga  -->
    <div class="container-fluid ">
        <div class="row ">