<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Propietario_controller extends CI_Controller
{

    public function cargarPropietarios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("propietarios/cargarPropietarios", $tokenUser);
    }
}