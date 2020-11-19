<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Requisito_controller extends CI_Controller
{

    public function guardarDocumentosRequistosArriendo()
    {
        $config['upload_path'] = "temp_files/";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10000";
        $this->load->library('upload', $config);


        $arrayInput = array();
        $arrayFile = array();
        $arrayPath = array();


        $id_arriendo = $this->input->post("idArriendo");

        if (isset($_FILES["inputlicenciaFrontal"])) {
            $arrayInput[] = 'inputlicenciaFrontal';
        }
        if (isset($_FILES["inputlicenciaTrasera"])) {
            $arrayInput[] = 'inputlicenciaTrasera';
        }
        if (isset($_FILES["inputCarnetFrontal"])) {
            $arrayInput[] = 'inputCarnetFrontal';
        }
        if (isset($_FILES["inputCarnetTrasera"])) {
            $arrayInput[] = 'inputCarnetTrasera';
        }
        if (isset($_FILES["inputCheque"])) {
            $arrayInput[] = 'inputCheque';
        }
        if (isset($_FILES["inputComprobante"])) {
            $arrayInput[] = 'inputComprobante';
        }
        if (isset($_FILES["inputTarjeta"])) {
            $arrayInput[] = 'inputTarjeta';
        }
        if (isset($_FILES["inputCartaRemplazo"])) {
            $arrayInput[] = 'inputCartaRemplazo';
        }
        if (isset($_FILES["inputBoletaEfectivo"])) {
            $arrayInput[] = 'inputBoletaEfectivo';
        }

        foreach ($arrayInput as $i => $name) {
            if (!$this->upload->do_upload($name)) {
                //*** ocurrio un error
                echo json_encode(array("success" => false, "msg" => $this->upload->display_errors()));
                borrarImagenes($arrayPath);
                return;
            }
            $data['uploadSuccess'] = $this->upload->data();
            $arrayPath[] = $data['uploadSuccess']["full_path"];
            $arrayFile[] = [
                'name'     => $name,
                'contents' => fopen($data['uploadSuccess']["full_path"], "r"),
                'filename' => $data['uploadSuccess']["file_name"]
            ];
        }
        echo file_function($id_arriendo, $arrayFile, "requisitos/registrarRequisitoArriendo");
        borrarImagenes($arrayPath);
    }


    public function buscarRequisitoArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "requisitos/buscarRequisitoArriendo");
    }
}
