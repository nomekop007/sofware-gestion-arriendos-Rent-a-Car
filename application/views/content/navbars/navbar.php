<body>

    <!-- esto es el navbar del dashboard  -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
            <img src="<?php echo base_url() ?>assets/images/logo.png" alt="" width="170" height="40"></a>

        <div class="dropdown w-100 px-3">
            <button class="btn btn-dark dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
            </button>
            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo base_url(); ?>cargarPanel?panel=1">Gestion</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cargarPanel?panel=2">Atencion</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cargarPanel?panel=3">Administracion</a>
            </div>
        </div>


        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="dropdown px-3">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span> <?php echo $this->session->userdata('email'); ?> </span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo base_url(); ?>cerrarSesion">cerrar Session</a>
            </div>
        </div>



    </nav>

    <!-- abajo se muestra el drawer de acuerdo a la opcion que se eliga  -->
    <div class="container-fluid">
        <div class="row">