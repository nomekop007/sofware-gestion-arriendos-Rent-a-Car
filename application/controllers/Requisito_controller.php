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
                'name'     => 'fotoLicenciaFrontal',
                'contents' => file_get_contents($_FILES["inputLicenciaFrontal"]["tmp_name"]),
                'filename' => $_FILES['inputLicenciaFrontal']['name']
            ],
            [
                'name'     => 'fotoLicenciaTrasera',
                'contents' => file_get_contents($_FILES["inputLicenciatrasera"]["tmp_name"]),
                'filename' => $_FILES['inputLicenciatrasera']['name']
            ],
            [
                'name'     => 'fotoTargeta',
                'contents' => file_get_contents($_FILES["inputTargeta"]["tmp_name"]),
                'filename' => $_FILES['inputTargeta']['name']
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