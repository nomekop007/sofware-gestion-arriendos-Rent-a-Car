<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>cargar_panel?panel=2"><span style='font-size: 1.2rem;'> Modulo gestion </span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style='font-size: 1.2rem;'>Usuarios</li>
            </ol>
        </nav>
        <h1 class="h3">Gestion usuarios del sistema</h1>
    </div>
    <div>
        <br>
        <h5>Registrar nuevo usuario</h5>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" id="form_registrar_usuario" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNombreUsuario">Nombre Completo</label>
                            <input onblur="mayus(this);" maxLength="80" type="text" class="form-control" id="inputNombreUsuario" name="inputNombreUsuario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCorreoUsuario">correo</label>
                            <input onblur="mayus(this);" maxLength="80" type="email" class="form-control" id="inputCorreoUsuario" name="inputCorreoUsuario" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputRolUsuario">Rol</label>
                            <select id="inputRolUsuario" name="inputRolUsuario" class="form-control">

                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputSucursalUsuario">Sucursal</label>
                            <select id="inputSucursalUsuario" name="inputSucursalUsuario" class="form-control">
                            </select>
                        </div>
                        <div class=" form-group col-md-4">
                            <label for="inputClaveUsuario">Constraseña</label>
                            <div class="input-group">
                                <input maxLength="50" minlength="9" type="password" class="form-control" id="inputClaveUsuario" name="inputClaveUsuario" required>
                                <div class="input-group-append">
                                    <button class="btn btn-dark show_password" type="button" onclick="mostrarPassword('inputClaveUsuario')"> <span class="fa fa-eye-slash icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-dark" id="btn_registrar_usuario">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_btn_registrar"></span>
                        Registrar Usuario</button>
                </form>
            </div>
        </div>
        <br>
        <br>
        <h5>Usuarios del Sistema</h5>
        <div class="card">
            <div class="card-body">
                <br>
                <div class="scroll">
                    <table id="tablaUsuarios" class="table table-striped table-bordered" style="width:100%">
                        <thead class="btn-dark">
                            <tr>
                                <th>Nombre completo</th>
                                <th>correo Electronico</th>
                                <th>rol</th>
                                <th>sucursal</th>
                                <th>fecha creacion</th>
                                <th>estado</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="btn-dark">
                            <tr>
                                <th>Nombre completo</th>
                                <th>correo Electronico</th>
                                <th>rol</th>
                                <th>sucursal</th>
                                <th>fecha creacion</th>
                                <th>estado</th>
                                <th> </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center" id="spinner_tablaUsuarios">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6>Cargando Datos...</h6>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</main>
</div>
</div>







<!-- importando archivo js usuarios -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_usuarios/js_module_usuarios.js?v=<?php echo version(); ?>">
</script>