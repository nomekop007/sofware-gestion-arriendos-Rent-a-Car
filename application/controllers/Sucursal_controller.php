<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Sucursal_controller extends CI_Controller
{

    public function cargarSucursales()
    {
        echo  get_function('sucursales/cargarSucursales');
    }

    public function buscarSucursal()
    {
        $id_arriendo = $this->input->post("id_sucursal");
        echo find_function($id_arriendo, "sucursales/buscarSucursal");
    }
}
