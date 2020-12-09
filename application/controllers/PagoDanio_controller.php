<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PagoDanio_controller extends CI_Controller
{

    public function registrarPagoDanio()
    {
        $dataArray = [
            "precioTotal_pagoDanio" => $this->input->post("precio"),
            "id_danioVehiculo" => $this->input->post("id_danio"),
        ];
        echo post_function($dataArray, "pagosDanios/registrarPagoDanio");
    }

    public function subirComprobantePagoDanio()
    {
        $id_pagoDanio = $this->input->post("id_pagoDanio");
        $file = 'comprobante';
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
                'name' => 'documento_facturacion',
                'contents' => fopen($img['uploadSuccess']["full_path"], "r"),
                'filename' => $img['uploadSuccess']["file_name"],
            ],
        ];
        echo file_function($id_pagoDanio, $datafile, "pagosDanios/guardarComprobantePagoDanio");
        unlink($img['uploadSuccess']["full_path"]); //elimina el documento
    }

}