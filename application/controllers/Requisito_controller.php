<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Requisito_controller extends CI_Controller
{

    public function guardarDocumentosRequistosArriendo()
    {
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
        $licencia = null;
        $pathLicencia = null;
        if (isset($_FILES['inputLicencia'])) {
            $pathLicencia = file_get_contents($_FILES["inputLicencia"]["tmp_name"]);
            $licencia = $_FILES['inputLicencia']['name'];
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
                'contents' => $pathLicencia,
                'filename' => $licencia
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
    }
}