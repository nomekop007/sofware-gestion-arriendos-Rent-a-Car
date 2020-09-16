<?php


defined('BASEPATH') or exit('No direct script access allowed');



class Controller_pdf extends CI_Controller
{

    public function generarPDFContratoArriendo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $dataArray = array(
            "id_arriendo" => $this->input->post("id_arriendo"),
            "numero_targeta" => $this->input->post("num"),
            "fecha_targeta" => $this->input->post("fecha"),
            "cheque" => $this->input->post("cheque"),
            "subtotal" => $this->input->post("subtotal"),
        );
        echo post_function($dataArray, "pdf/crearContratoArriendoPDF", $tokenUser);
    }
}