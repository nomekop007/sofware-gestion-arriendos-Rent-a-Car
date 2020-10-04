<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Requisito_controller extends CI_Controller
{

    public function guardarDocumentosRequistosArriendo()
    {

        $tokenUser = $this->session->userdata('usertoken');
        $id_arriendo =   $this->input->post("idArriendo");

        $data = [
            [
                'name'     => 'fotoCarnetFrontal',
                'contents' => file_get_contents($_FILES["inputCarnetFrontal"]["tmp_name"]),
                'filename' => $_FILES['inputCarnetFrontal']['name']
            ],
            [
                'name'     => 'fotoCarnetTrasera',
                'contents' => file_get_contents($_FILES["inputCarnetTrasera"]["tmp_name"]),
                'filename' => $_FILES['inputCarnetTrasera']['name']
            ],
            [
                'name'     => 'fotoTarjetaFrontal',
                'contents' => file_get_contents($_FILES["inputTarjetaFrontal"]["tmp_name"]),
                'filename' => $_FILES['inputTarjetaFrontal']['name']
            ],
            [
                'name'     => 'fotoTarjetaTrasera',
                'contents' => file_get_contents($_FILES["inputTarjetaTrasera"]["tmp_name"]),
                'filename' => $_FILES['inputTarjetaTrasera']['name']
            ],
            [
                'name'     => 'fotoLicencia',
                'contents' => file_get_contents($_FILES["inputLicencia"]["tmp_name"]),
                'filename' => $_FILES['inputLicencia']['name']
            ],
            [
                'name'     => 'fotoCheque',
                'contents' => file_get_contents($_FILES["inputCheque"]["tmp_name"]),
                'filename' => $_FILES['inputCheque']['name']
            ],
            [
                'name'     => 'fotoComprobante',
                'contents' => file_get_contents($_FILES["inputComprobante"]["tmp_name"]),
                'filename' => $_FILES['inputComprobante']['name']
            ]

        ];
        echo file_function($id_arriendo, $data, "requisitos/registrarRequisitoArriendo", $tokenUser);
    }
}