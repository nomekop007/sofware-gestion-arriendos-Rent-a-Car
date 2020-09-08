<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestino de Arriendos</title>
</head>
<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}
</style>
<!-- se envia la url del base_route al js -->
<input id="ruta" value="<?php echo base_route(); ?>" hidden />

<link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>/assets/css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>/assets/css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>/assets/css/signin.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_route(); ?>/assets/bootstrap/css/bootstrap.min.css">

<body>

    <form class="form-signin">
        <img class="mb-4" src="<?php echo base_route(); ?>assets/images/logo.png" alt="" width="100%" height="100%">
        <h1 class="h3 mb-3 font-weight-normal">Plataforma Rentacar</h1>
        <label for="inputEmail" class="sr-only">Correo Electronico</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="correo Electronico" required autofocus>
        <label for="inputclave" class="sr-only">Constraseña</label>
        <input type="password" id="inputclave" class="form-control" placeholder="Costraseña" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recordar
            </label>
        </div>
        <button class="btn btn-dark btn-block btn_login" type="submit">Iniciar Sesion</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>
</body>

<!-- importaciones -->
<script src="<?php echo base_route(); ?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_route(); ?>/assets/js/inicioSesion.js"></script>
<script src="<?php echo base_route(); ?>/assets/js/sweetalert2.all.min.js"></script>


</html>