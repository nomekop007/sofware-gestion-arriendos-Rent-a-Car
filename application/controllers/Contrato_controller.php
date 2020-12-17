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

    public function subirContrato()
    {
        $id_arriendo = $this->input->post("id_arriendo");

        $file = 'inputContrato';
        $config['upload_path'] = "temp_files/";
        $config['allowed_types'] = "*";

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file)) {
            //*** ocurrio un error
            echo json_encode(array("success" => false, "msg" => $this->upload->display_errors()));
            return;
        }
        $img['uploadSuccess'] = $this->upload->data();

        $datafile = [
            [
                'name' => 'documento_contrato',
                'contents' => fopen($img['uploadSuccess']["full_path"], "r"),
                'filename' => $img['uploadSuccess']["file_name"],
            ],
        ];

        echo file_function($id_arriendo, $datafile, "contratos/subirContrato");
        unlink($img['uploadSuccess']["full_path"]); //elimina el documento
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

    public function enviarCorreoContrato()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("id_arriendo"),
        ];
        echo post_function($arrayForm, "contratos/enviarCorreoContrato");
    }
}