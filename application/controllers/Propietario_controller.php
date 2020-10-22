<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Propietario_controller extends CI_Controller
{

    public function cargarPropietarios()
    {

        echo get_function("propietarios/cargarPropietarios");
    }
}