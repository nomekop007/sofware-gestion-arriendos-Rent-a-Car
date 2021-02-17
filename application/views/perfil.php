<?php
if ($this->session->userdata('estado')) {
    $estado = "ACTIVO";
} else {
    $estado = "INACTIVO";
}
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mi perfil</li>
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
                        <input type="text" class="form-control " value="<?php echo  $this->session->userdata('nombre'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputCorreoUsuario">correo electronico</label>
                        <input type="email" class="form-control " value="<?php echo $this->session->userdata('email'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputRolUsuario">Rol</label>
                        <input hidden type="text" class="form-control " id="id_rol" value="<?php echo $this->session->userdata('rol') ?>">
                        <select name="selectRol" id="selectRol" class="form-control" disabled>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputSucursalUsuario">Sucursal</label>
                        <input hidden type="text" class="form-control " id="id_sucursal" value="<?php echo $this->session->userdata('sucursal') ?>">
                        <select name="selectSucursal" id="selectSucursal" class="form-control" disabled>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEstadoUsuario">Estado</label>
                        <input type="text" class="form-control " value="<?php echo $estado ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <img style="width:50%" src="<?php echo base_route() ?>assets/images/logo2.png" />
            </div>
        </div>
    </div>
</main>


</div>
</div>

<script>
    (cargarComponentes = async () => {
        await cargarSelectSucursal("cargar_Sucursales", "selectSucursal");
        await cargarSelect("cargar_roles", "selectRol");
        $("#selectRol").val($("#id_rol").val())
        $("#selectSucursal").val($("#id_sucursal").val())
    })();
</script>