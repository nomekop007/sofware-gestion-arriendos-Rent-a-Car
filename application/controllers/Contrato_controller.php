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

    public function registrarExtencionContrato()
    {
        $dataArray = [
            "id_extencion" => $this->input->post("id_extencion"),
            "base64" => $this->input->post("base64"),
        ];
        echo post_function($dataArray, "contratos/registrarExtencionContrato");
    }


    public function subirContrato()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        $arrayInput = ["inputContrato"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_arriendo, $arrayData, "contratos/subirContrato");
    }

    public function subirExtencionContrato()
    {
        $id_extencion = $this->input->post("id_extencion");
        $arrayInput = ["inputContrato"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_extencion, $arrayData, "contratos/subirExtencionContrato");
    }



    public function generarPDFcontrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "firmaClientePNG" => $this->input->post("inputFirmaClientePNG"),
            "firmaUsuarioPNG" => $this->input->post("inputFirmaUsuarioPNG"),
            "geolocalizacion" => $this->input->post("geolocalizacion"),
            "extension" => $this->input->post("extension"),
        ];
        echo post_function($dataArray, "contratos/generarPDFcontrato");
    }

    public function generarPDFextencionContrato()
    {
        $dataArray = [
            "id_extencion" => $this->input->post("id_extencion"),
            "n_extencion" => $this->input->post("n_extencion"),
            "firmaClientePNG" => $this->input->post("inputFirmaClientePNG"),
            "firmaUsuarioPNG" => $this->input->post("inputFirmaUsuarioPNG"),
            "geolocalizacion" => $this->input->post("geolocalizacion"),
        ];
        echo post_function($dataArray, "contratos/generarPDFextencion");
    }

    public function enviarCorreoContrato()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("id_arriendo"),
        ];
        echo post_function($arrayForm, "contratos/enviarCorreoContrato");
    }

    public function enviarCorreoContratoExtencion()
    {
        $arrayForm = [
            "id_extencion" => $this->input->post("id_extencion"),
        ];
        echo post_function($arrayForm, "contratos/enviarCorreoContratoExtencion");
    }
}
