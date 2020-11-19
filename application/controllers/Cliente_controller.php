<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_controller extends CI_Controller
{
    public function cargarClientes()
    {
        echo get_function("clientes/cargarClientes");
    }

    public function buscarCliente()
    {

        $rut_cliente = $this->input->post("rut_cliente");
        echo find_function($rut_cliente, "clientes/buscarCliente");
    }

    public function crearCliente()
    {
        $arrayData = [
            "rut_cliente" => $this->input->post("inputRutCliente"),
            "nombre_cliente" => $this->input->post("inputNombreCliente"),
            "direccion_cliente" => $this->input->post("inputDireccionCliente"),
            "ciudad_cliente" => $this->input->post("inputCiudadCliente"),
            "fechaNacimiento_cliente" => $this->input->post("inputFechaNacimiento"),
            "telefono_cliente" => $this->input->post("inputTelefonoCliente"),
            "estadoCivil_cliente" => $this->input->post("inputEstadoCivil"),
            "correo_cliente" => $this->input->post("inputCorreoCliente"),
            "nacionalidad_cliente" => $this->input->post("inputNacionalidadCliente"),
            "comuna_cliente" => $this->input->post("inputComunaCliente"),
        ];

        echo post_function($arrayData, "clientes/registrarCliente");
    }
}
