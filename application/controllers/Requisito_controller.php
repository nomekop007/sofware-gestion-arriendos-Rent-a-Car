<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Requisito_controller extends CI_Controller
{

    public function guardarDocumentosRequistosArriendo()
    {

        $tokenUser = $this->session->userdata('usertoken');
        $id_arriendo =   $this->input->post("idArriendo");

        //se valdia que se hayan ingresado estos archivos
        $tarjetaFrontal = null;
        $pathTarjetaFrontal = null;
        if (isset($_FILES['inputTarjetaFrontal'])) {
            $pathTarjetaFrontal = file_get_contents($_FILES["inputTarjetaFrontal"]["tmp_name"]);
            $tarjetaFrontal = $_FILES['inputTarjetaFrontal']['name'];
        }
        $tarjetaTrasera = null;
        $pathTarjetaTrasera = null;
        if (isset($_FILES['inputTarjetaTrasera'])) {
            $pathTarjetaTrasera = file_get_contents($_FILES["inputTarjetaTrasera"]["tmp_name"]);
            $tarjetaTrasera = $_FILES['inputTarjetaTrasera']['name'];
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

        $data = [
            [
                'name'     => 'fotoTarjetaFrontal',
                'contents' => $pathTarjetaFrontal,
                'filename' => $tarjetaFrontal
            ],
            [
                'name'     => 'fotoTarjetaTrasera',
                'contents' => $pathTarjetaTrasera,
                'filename' => $tarjetaTrasera
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
                'name'     => 'fotoLicencia',
                'contents' => file_get_contents($_FILES["inputLicencia"]["tmp_name"]),
                'filename' => $_FILES['inputLicencia']['name']
            ],
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
        ];
        echo file_function($id_arriendo, $data, "requisitos/registrarRequisitoArriendo", $tokenUser);
    }
}