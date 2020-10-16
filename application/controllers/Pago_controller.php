<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Pago_controller extends CI_Controller
{

    public function registrarPago()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $dataArray = [
            "userAt" => $nameUser,
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "neto_pago" => $this->input->post("inputNeto"),
            "iva_pago" => $this->input->post("inputIVA"),
            "descuento_pago" => $this->input->post("inputDescuento"),
            "total_pago" => $this->input->post("inputTotal"),
            "observaciones_pago" => $this->input->post("inputObservaciones"),
            "digitador_pago" => $this->input->post("digitador"),
            "id_modoPago" => $this->input->post("customRadio2"),
            "tipoFacturacion" => $this->input->post("customRadio1"),
            "numFacturacion" => $this->input->post("inputNumFacturacion"),
        ];
        echo post_function($dataArray, "pagos/registrarPago", $tokenUser);
    }
}