<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Controller_cliente extends CI_Controller
{
    public function cargarClientes()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("clientes/cargarClientes", $tokenUser);
    }


    public function cargarConductores()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("conductores/cargarConductores", $tokenUser);
    }


    public function cargarEmpresas()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("empresas/cargarEmpresas", $tokenUser);
    }
}