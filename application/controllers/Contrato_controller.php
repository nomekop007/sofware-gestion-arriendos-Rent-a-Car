<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Contrato_controller extends CI_Controller
{

    public function registrarContrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "documento" => $this->input->post("nombre_documento"),
        ];
        echo post_function($dataArray, "contratos/registrarContrato");
    }

    public function generarPDFcontrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "firmaPNG" => $this->input->post("inputFirmaPNG"),
            "geolocalizacion" => $this->input->post("geolocalizacion"),
            "extension" => $this->input->post("extension")
        ];
        echo post_function($dataArray, "contratos/generarPDFcontrato");
    }


    public function enviarCorreoContrato()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("id_arriendo")
        ];
        echo post_function($arrayForm, "contratos/enviarCorreoContrato");
    }
}