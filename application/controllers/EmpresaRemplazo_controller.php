<?php


defined('BASEPATH') or exit('No direct script access allowed');

class EmpresaRemplazo_controller extends CI_Controller
{
    public function cargarEmpresasRemplazo()
    {
        echo get_function("empresasRemplazo/cargarEmpresasRemplazo");
    }
}