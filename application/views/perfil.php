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
            <div class="col-md-2">
                <!-- Button trigger modal -->
                <button id="edit_usuario" type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_editar_usuario">
                    Editar Datos <i class="far fa-edit" aria-hidden="true"></i>
                </button>

            </div>
        </div>
    </div>
</main>

<form class="needs-validation" id="form_editar_usuario" novalidate>
    <!-- Modal -->
    <div class="modal fade" id="modal_editar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="text" id="inputUsuario" name="inputUsuario" value="<?php echo $this->session->userdata('id') ?>" hidden />
                                    <label for="inputEditNombreUsuario">Nombre Completo</label>
                                    <input onblur="mayus(this);" maxlength="80" type="text" class="form-control" id="inputEditNombreUsuario" name="inputEditNombreUsuario" value="<?php echo  $this->session->userdata('nombre'); ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEditCorreoUsuario">correo</label>
                                    <input onblur="mayus(this);" maxlength="80" type="email" class="form-control" id="inputEditCorreoUsuario" name="inputEditCorreoUsuario" value="<?php echo $this->session->userdata('email'); ?>">
                                </div>
                                <div class=" form-group col-md-12">
                                    <label for="inputEditClaveUsuario">Constraseña nueva</label>
                                    <div class="input-group">
                                        <input maxlength="50" minlength="8" type="password" class="form-control" id="inputEditClaveUsuario" name="inputEditClaveUsuario">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark show_password" type="button" onclick="mostrarPasswordClaveActual('inputEditClaveUsuario')"> <span class="fa fa-eye-slash icon" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_editar_usuario" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_editarUsuario" style="display:none"></span>
                        Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    (cargarComponentes = async () => {
        await cargarSelectSucursal("cargar_Sucursales", "selectSucursal");
        await cargarSelect("cargar_roles", "selectRol");
        $("#selectRol").val($("#id_rol").val())
        $("#selectSucursal").val($("#id_sucursal").val())
    })();
</script>



<script>
    (cargarComponentes = async () => {
        await cargarSelectSucursal("cargar_Sucursales", "inputEditSucursalUsuario");
        await cargarSelect("cargar_roles", "inputEditRolUsuario");
        $("#inputEditRolUsuario").val($("#id_rol1").val())
        $("#inputEditSucursalUsuario").val($("#id_sucursal1").val())
    })();
</script>
<script src="<?php echo base_route(); ?>assets/js/utils/perfil.js?v=<?php echo version(); ?>"></script>