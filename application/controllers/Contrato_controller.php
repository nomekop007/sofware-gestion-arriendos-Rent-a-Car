<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Contrato_controller extends CI_Controller
{
    public function generarPDFcontrato()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "numero_targeta" => $this->input->post("inputNumeroTargeta"),
            "fecha_targeta" => $this->input->post("inputFechaTargeta"),
            "cheque" => $this->input->post("inputCheque"),
            "abono" => $this->input->post("inputAbono"),
            "subtotal" => $this->input->post("inputValorArriendo"),
			"arrayNombreAccesorios" => $this->input->post("arrayNombreAccesorios"),
            "arrayValorAccesorios" => $this->input->post("arrayValorAccesorios"),
            "tipoFacturacion" => $this->input->post("customRadio1"),
            "tipoPago" => $this->input->post("customRadio2"),
            "neto" => $this->input->post("inputNeto"),
            "iva" => $this->input->post("inputIVA"),
            "descuento" => $this->input->post("inputDescuento"),
            "total" => $this->input->post("inputTotal"),
            "observaciones" => $this->input->post("inputObservaciones"),
        ];
        echo post_function($dataArray, "contratos/generarPDFcontrato", $tokenUser);
    }
}