<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Facturacion_controller extends CI_Controller
{

    public function cargarFacturaciones()
    {
        echo get_function("facturaciones/cargarFacturaciones");
    }

    public function registrarFacturacion()
    {
        $dataArray = [
            "tipo_facturacion" => $this->input->post("customRadio1"),
            "numero_facturacion" => $this->input->post("inputNumFacturacion"),
            "id_modoPago" => $this->input->post("customRadio2"),
        ];
        echo post_function($dataArray, "facturaciones/registrarFacturacion");
    }

    public function guardarDocumentoFacturacion()
    {
        $id_facturacion = $this->input->post("id_facturacion");
        $arrayInput = ["inputDocumento"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_facturacion, $arrayData, "facturaciones/guardarDocumentoFacturacion");
    }
}
