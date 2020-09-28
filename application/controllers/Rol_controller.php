<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Rol_controller extends CI_Controller
{

	public function cargarRoles()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("roles/cargarRoles", $tokenUser);
    }

}