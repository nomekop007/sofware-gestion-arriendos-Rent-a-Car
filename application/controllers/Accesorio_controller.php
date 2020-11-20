<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Accesorio_controller extends CI_Controller
{
    public function cargarAccesorios()
    {
        echo get_function("accesorios/cargarAccesorios");
    }
}
