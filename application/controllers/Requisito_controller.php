<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requisito_controller extends CI_Controller
{

    public function guardarDocumentosRequistosArriendo()
    {
        $id_arriendo = $this->input->post("idArriendo");
        $arrayInput =[
            "inputlicenciaFrontal",
            "inputlicenciaTrasera",
            "inputCarnetFrontal",
            "inputCarnetTrasera",
            "inputCheque",
            "inputComprobante",
            "inputTarjeta",
            "inputCartaRemplazo",
            "inputBoletaEfectivo",
            "inputEstatuto",
            "inputRol",
            "inputVigencia",
            "inputCarpetaTributaria",
            "inputCartaAutorizacion"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_arriendo, $arrayData, "requisitos/registrarRequisitoArriendo");
    }

    public function buscarRequisitoArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "requisitos/buscarRequisitoArriendo");
    }
}