<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Contrato_controller extends CI_Controller
{

    public function registrarContrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "base64" => $this->input->post("base64"),
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