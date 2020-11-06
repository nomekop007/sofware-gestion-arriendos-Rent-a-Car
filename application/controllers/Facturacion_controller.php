<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Facturacion_controller extends CI_Controller
{

    public function registrarFacturacion()
    {
        $dataArray = [
            "tipo_facturacion" => $this->input->post("customRadio1"),
            "numero_facturacion" => $this->input->post("inputNumFacturacion"),
        ];
        echo post_function($dataArray, "facturaciones/registrarFacturacion");
    }
}