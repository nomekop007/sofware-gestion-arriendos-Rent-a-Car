<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Abono_controller extends CI_Controller
{
    public function registrarAbono()
    {

        $arrayData = [
            "id_pago" => $this->input->post("id_pago"),
            "pago_abono" =>  $this->input->post("pago_abono"),
            "facturacione" => [
                "userAt" =>  $this->session->userdata('nombre'),
                "tipo_facturacion" => $this->input->post("tipo_facturacion"),
                "id_modoPago" => $this->input->post("id_modoPago"),
                "numero_facturacion" => $this->input->post("numero_facturacion"),
            ]
        ];

        echo post_function($arrayData, "abonos/registrarAbono");
    }
}
