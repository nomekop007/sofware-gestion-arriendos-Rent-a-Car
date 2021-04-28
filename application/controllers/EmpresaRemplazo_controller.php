<?php


defined('BASEPATH') or exit('No direct script access allowed');

class EmpresaRemplazo_controller extends CI_Controller
{


    public function cargarEmpresasRemplazo()
    {
        echo get_function("empresasRemplazo/cargarEmpresasRemplazo");
    }

    public function crearRemplazo()
    {
        $ArrayData = [
            "codigo_empresaRemplazo" => $this->input->post("inputCodigoEmpresaRemplazo"),
            "rut_cliente" => $this->input->post("inputRutCliente"),
        ];
        echo post_function($ArrayData, "empresasRemplazo/registrarRemplazo");
    }

    public function obtenerTarifasEmpresaSucursal()
    {
        $ArrayData = [
            "EmpresaReemplazo" => $this->input->post("codigoEmpresaReemplazo"),
            "Id_sucursal" => $this->input->post("id_sucursal"),
        ];
        echo post_function($ArrayData, "empresasRemplazo/obtenerTarifasEmpresaSucursal");
    }
}
