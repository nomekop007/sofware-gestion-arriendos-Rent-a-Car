<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Accesorio_controller extends CI_Controller
{
    public function cargarAccesorios()
    {
        $id_sucursal = $this->session->userdata('sucursal');
        echo find_function($id_sucursal, "accesorios/cargarAccesoriosPorSucursal");
    }
}