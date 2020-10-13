<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Despacho_controller extends CI_Controller
{

    public function registrarDespacho()
    {

        $tokenUser = $this->session->userdata('usertoken');
    }
}