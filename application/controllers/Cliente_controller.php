<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_controller extends CI_Controller
{
    public function cargarClientes()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("clientes/cargarClientes", $tokenUser);
	}

	public function buscarCliente()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_cliente = $this->input->post("rut_cliente");
        echo find_function($rut_cliente, "clientes/buscarCliente", $tokenUser);
    }

	

}