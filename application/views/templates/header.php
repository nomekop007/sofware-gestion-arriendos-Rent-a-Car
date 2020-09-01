<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="sofware de arriendo">
    <meta name="author" content="nomekop007">

    <title>Dashboard Rentacar</title>

    <!-- Helper que contiene variables de entorno INPORTANTE!! -->
    <?php $this->load->helper("urls_helper"); ?>
    <input id="ruta" value="<?php echo base_route(); ?>" hidden />

    <!-- importacion de icons -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- Datatable core CSS -->
    <link rel=" stylesheet" type="text/css" href="<?php echo base_route() ?>/assets/css/datatables.min.css" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_route() ?>/assets/bootstrap/css/bootstrap.min.css">

    <!-- sweetalert2 core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_route() ?>/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_route() ?>/assets/css/animate.min.css" />

    <!-- dashboard core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_route() ?>/assets/css/dashboard.css" rel="stylesheet">


    <!-- importaciones del jquery -->
    <script src="<?php echo base_route() ?>/assets/js/jquery-3.3.1.min.js"></script>

</head>