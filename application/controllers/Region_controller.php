<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Region_controller extends CI_Controller
{

    public function cargarRegiones()
    {
        echo get_function("regiones/cargarRegiones");
    }
}