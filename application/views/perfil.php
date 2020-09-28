<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_route(); ?>cargarPanel?panel=1">Gestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">usuario</li>
            </ol>
        </nav>
        <h1 class="h3">Perfil de usuario</h1>
    </div>

    <div>

        <br><br>

        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNombreUsuario">Nombre Completo</label>
                        <input type="text" class="form-control "
                            value="<?php echo $this->session->userdata('nombre'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCorreoUsuario">correo electronico</label>
                        <input type="email" class="form-control "
                            value="<?php echo $this->session->userdata('email'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRolUsuario">Rol</label>
                        <select value="<?php echo $this->session->userdata('rol'); ?>" id="inputRolUsuario"
                            class="form-control " disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputSucursalUsuario">Sucursal</label>
                        <select value="<?php echo $this->session->userdata('sucursal'); ?>" id="inputSucursalUsuario"
                            class="form-control " disabled>
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>


</div>
</div>

<script>
//cargar sucursales  (ruta,select)
cargarSelect("cargar_Sucursales", "inputSucursalUsuario");
//cargar roles (ruta,select)
cargarSelect("cargar_roles", "inputRolUsuario");
</script>