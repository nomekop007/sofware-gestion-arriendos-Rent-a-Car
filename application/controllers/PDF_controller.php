<?php


defined('BASEPATH') or exit('No direct script access allowed');



class PDF_controller extends CI_Controller
{

    public function generarPDFContratoArriendo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $dataArray = array(
            "id_arriendo" => $this->input->post("id_arriendo"),
            "numero_targeta" => $this->input->post("numerTargeta"),
            "fecha_targeta" => $this->input->post("fechaTargeta"),
            "cheque" => $this->input->post("cheque"),
            "subtotal" => $this->input->post("subTotal"),
        );
        echo post_function($dataArray, "pdf/crearContratoArriendoPDF", $tokenUser);
    }
}