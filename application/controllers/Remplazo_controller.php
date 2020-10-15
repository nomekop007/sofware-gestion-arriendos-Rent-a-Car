<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Remplazo_controller extends CI_Controller
{


    public function crearRemplazo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $ArrayData = [
            "userAt" => $nameUser,
            "nombreEmpresa_remplazo" => $this->input->post("inputNombreRemplazo"),
            "rut_cliente" => $this->input->post("inputRutCliente"),
        ];
        echo post_function($ArrayData, "remplazos/registrarRemplazo", $tokenUser);
    }
}