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

    public function crearCliente()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $arrayData = [
            "rut_cliente" => $this->input->post("inputRutCliente"),
            "nombre_cliente" => $this->input->post("inputNombreCliente"),
            "direccion_cliente" => $this->input->post("inputDireccionCliente"),
            "ciudad_cliente" => $this->input->post("inputCiudadCliente"),
            "fechaNacimiento_cliente" => $this->input->post("inputFechaNacimiento"),
            "telefono_cliente" => $this->input->post("inputTelefonoCliente"),
            "estado_civil" => $this->input->post("inputEstadoCivil"),
            "correo_cliente" => $this->input->post("inputCorreoCliente"),
        ];

        echo post_function($arrayData, "clientes/registrarCliente", $tokenUser);
    }
}