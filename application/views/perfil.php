<?php


switch ($this->session->userdata('rol')) {
    case '1':
        $rol = "ADMINISTRADOR";
        break;
    case '2':
        $rol = "SUPERVISOR";
        break;
    case '3':
        $rol = "VENDEDOR";
        break;
    default:
        $rol = "DESCONOCIDO";
        break;
}


switch ($this->session->userdata('sucursal')) {
    case '1':
        $sucursal = "TALCA";
        break;
    case '2':
        $sucursal = "LINARES";
        break;
    case '3':
        $sucursal = "CURICO";
        break;
    case '4':
        $sucursal = "CONCEPCION";
        break;
    default:
        $sucursal = "DESCONOCIDO";
        break;
}




if ($this->session->userdata('estado')) {
    $estado = "ACTIVO";
} else {
    $estado = "INACTIVO";
}
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">usuario</li>
            </ol>
        </nav>
        <h1 class="h3">Perfil de usuario</h1>
    </div>

    <div>

        <br><br>

        <div class="row">
            <div class="col-md-4">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputNombreUsuario">Nombre Completo</label>
                        <input type="text" class="form-control "
                            value="<?php echo  $this->session->userdata('nombre'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputCorreoUsuario">correo electronico</label>
                        <input type="email" class="form-control "
                            value="<?php echo $this->session->userdata('email'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputRolUsuario">Rol</label>
                        <input type="text" class="form-control " value="<?php echo $rol ?>" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputSucursalUsuario">Sucursal</label>
                        <input type="text" class="form-control " value="<?php echo $sucursal ?>" disabled>

                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEstadoUsuario">Estado</label>
                        <input type="text" class="form-control " value="<?php echo $estado ?>" disabled>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <img style="width:30%" src="<?php echo base_url() ?>assets/images/logo2.png" />
                <img style="width:30%" src="<?php echo base_url() ?>assets/images/logo3.png" />
            </div>
        </div>
    </div>
</main>


</div>
</div>