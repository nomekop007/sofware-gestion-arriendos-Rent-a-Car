<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Requisito_controller extends CI_Controller
{

    public function guardarDocumentosRequistosArriendo()
    {
        $id_arriendo =   $this->input->post("idArriendo");
        /*
        //se valdia que se hayan ingresado estos archivos
        $licenciaFrontal = null;
        $pathlicenciaFrontal = null;
        if (isset($_FILES['inputlicenciaFrontal'])) {
            $pathlicenciaFrontal = file_get_contents($_FILES["inputlicenciaFrontal"]["tmp_name"]);
            $licenciaFrontal = $_FILES['inputlicenciaFrontal']['name'];
        }
        $licenciaTrasera = null;
        $pathlicenciaTrasera = null;
        if (isset($_FILES['inputlicenciaTrasera'])) {
            $pathlicenciaTrasera = file_get_contents($_FILES["inputlicenciaTrasera"]["tmp_name"]);
            $licenciaTrasera = $_FILES['inputlicenciaTrasera']['name'];
        }
        $cheque = null;
        $pathCheque = null;
        if (isset($_FILES['inputCheque'])) {
            $pathCheque = file_get_contents($_FILES["inputCheque"]["tmp_name"]);
            $cheque = $_FILES['inputCheque']['name'];
        }
        $comprobante = null;
        $pathComprobante = null;
        if (isset($_FILES['inputComprobante'])) {
            $pathComprobante = file_get_contents($_FILES["inputComprobante"]["tmp_name"]);
            $comprobante = $_FILES['inputComprobante']['name'];
        }
        $tarjeta = null;
        $pathtarjeta = null;
        if (isset($_FILES['inputTarjeta'])) {
            $pathtarjeta = file_get_contents($_FILES["inputTarjeta"]["tmp_name"]);
            $tarjeta = $_FILES['inputTarjeta']['name'];
        }
        $carnetFrontal = null;
        $pathCarnetFrontal = null;
        if (isset($_FILES['inputCarnetFrontal'])) {
            $pathCarnetFrontal = file_get_contents($_FILES["inputCarnetFrontal"]["tmp_name"]);
            $carnetFrontal = $_FILES['inputCarnetFrontal']['name'];
        }
        $carnetTrasera = null;
        $pathCarnetTrasera = null;
        if (isset($_FILES['inputCarnetTrasera'])) {
            $pathCarnetTrasera = file_get_contents($_FILES["inputCarnetTrasera"]["tmp_name"]);
            $carnetTrasera = $_FILES['inputCarnetTrasera']['name'];
        }
        $cartaRemplazo = null;
        $pathCartaRemplazo = null;
        if (isset($_FILES['inputCartaRemplazo'])) {
            $pathCartaRemplazo = file_get_contents($_FILES["inputCartaRemplazo"]["tmp_name"]);
            $cartaRemplazo = $_FILES['inputCartaRemplazo']['name'];
        }

        $boletaEfectivo = null;
        $pathBoletaEfectivo = null;
        if (isset($_FILES['inputBoletaEfectivo'])) {
            $pathBoletaEfectivo = file_get_contents($_FILES["inputBoletaEfectivo"]["tmp_name"]);
            $boletaEfectivo = $_FILES['inputBoletaEfectivo']['name'];
        }

        $data = [
            [
                'name'     => 'fotoLicenciaFrontal',
                'contents' => $pathlicenciaFrontal,
                'filename' => $licenciaFrontal
            ],
            [
                'name'     => 'fotoLicenciaTrasera',
                'contents' => $pathlicenciaTrasera,
                'filename' => $licenciaTrasera
            ],
            [
                'name'     => 'fotoCheque',
                'contents' => $pathCheque,
                'filename' => $cheque
            ],
            [
                'name'     => 'fotoComprobante',
                'contents' => $pathComprobante,
                'filename' => $comprobante
            ],
            [
                'name'     => 'fotoTarjeta',
                'contents' => $pathtarjeta,
                'filename' => $tarjeta
            ],
            [
                'name'     => 'fotoCarnetFrontal',
                'contents' => $pathCarnetFrontal,
                'filename' => $carnetFrontal
            ],
            [
                'name'     => 'fotoCarnetTrasera',
                'contents' => $pathCarnetTrasera,
                'filename' => $carnetTrasera
            ],
            [
                'name'     => 'fotoCartaRemplazo',
                'contents' => $pathCartaRemplazo,
                'filename' => $cartaRemplazo
            ],
            [
                'name'     => 'fotoBoletaEfectivo',
                'contents' => $pathBoletaEfectivo,
                'filename' => $boletaEfectivo
            ],
        ];
        echo file_function($id_arriendo, $data, "requisitos/registrarRequisitoArriendo"); 
        */


        /*  $carnetFrontal = null;
        $pathCarnetFrontal = null;
        if (isset($_FILES['inputCarnetFrontal'])) {
            $pathCarnetFrontal = file_get_contents($_FILES["inputCarnetFrontal"]["tmp_name"]);
            $carnetFrontal = $_FILES['inputCarnetFrontal']['name'];
        }

        $data = [
            [
                'name'     => 'fotoCarnetFrontal',
                'contents' => $pathCarnetFrontal,
                'filename' => $carnetFrontal
            ],
        ];

        echo file_function($id_arriendo, $data, "requisitos/registrarRequisitoArriendo"); */



        $mi_archivo = 'inputCarnetFrontal';
        $config['file_name'] = "fotoCarnetFrontal";
        $config['upload_path'] = "temp_files/";
        $config['allowed_types'] = "*";


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            echo $this->upload->display_errors();
            return;
        }
        $data['uploadSuccess'] = $this->upload->data();

        //  var_dump($data['uploadSuccess']);

        $datafile = [
            [
                'name'     => 'fotoCarnetFrontal',
                'contents' => fopen($data['uploadSuccess']["full_path"], "r"),
                'filename' => $data['uploadSuccess']["file_name"]
            ],
        ];

        echo file_function($id_arriendo, $datafile, "requisitos/registrarRequisitoArriendo");
        unlink($data['uploadSuccess']["full_path"]);
    }
}