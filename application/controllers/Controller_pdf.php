<?php

use function GuzzleHttp\json_decode;

defined('BASEPATH') or exit('No direct script access allowed');



class Controller_pdf extends CI_Controller
{

    public function generarPDFContratoArriendo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $id_arriendo = $this->input->get("id_arriendo");
        $arriendo =  find_function($id_arriendo, "arriendos/buscarArriendo", $tokenUser);

        $ArrayArriendo = json_decode($arriendo, true);

        //SOLUCIONAR !!!
        /*   foreach ($ArrayArriendo as $clave => $valor) {
            print_r("{$clave} => {$valor} ");
        } */

        $data = array(
            "arriendo" => $arriendo,
            "numero_targeta" => $this->input->get("num"),
            "fecha_targeta" => $this->input->get("fecha"),
            "cheque" => $this->input->get("cheque"),
            "subtotal" => $this->input->get("subtotal"),
        );

        $html = $this->load->view("pdfs/contrato_arriendo", $data, TRUE);


        // definamos un numero para el archivo. No es necesario agregar la extension .pdf
        $filename = 'contrato_Nº' . $id_arriendo . '';
        // generamos el PDF. Pasemos por encima de la configuración general y definamos otro tipo de papel
        generate($html, $filename, TRUE, 'Letter', 'portrait', 1);
    }
}