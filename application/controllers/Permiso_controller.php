<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Permiso_controller extends CI_Controller
{

    public function cargarRoles()
    {
        echo get_function("permisos/cargarRoles");
    }
}
