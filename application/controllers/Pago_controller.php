<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Pago_controller extends CI_Controller
{

    public function registrarPago()
    {
        $dataArray = [
            "neto_pago" => $this->input->post("inputNeto"),
            "iva_pago" => $this->input->post("inputIVA"),
            "total_pago" => $this->input->post("inputTotal"),
            "estado_pago" => $this->input->post("inputEstado"),
            "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            "id_facturacion" => $this->input->post("id_facturacion"),
        ];
        echo post_function($dataArray, "pagos/registrarPago");
    }
}