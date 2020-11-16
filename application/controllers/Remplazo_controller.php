<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Remplazo_controller extends CI_Controller
{


    public function crearRemplazo()
    {
        $ArrayData = [
            "codigo_empresaRemplazo" => $this->input->post("inputCodigoEmpresaRemplazo"),
            "rut_cliente" => $this->input->post("inputRutCliente"),
        ];
        echo post_function($ArrayData, "remplazos/registrarRemplazo");
    }
}