<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Contrato_controller extends CI_Controller
{
    public function generarPDFcontrato()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "numero_tarjeta" => $this->input->post("inputNumeroTarjeta"),
            "fecha_tarjeta" => $this->input->post("inputFechaTarjeta"),
            "codigo_tarjeta" => $this->input->post("inputCodigoTarjeta"),
            "numero_cheque" => $this->input->post("inputNumeroCheque"),
            "codigo_cheque" => $this->input->post("inputCodigoCheque"),
            "abono" => $this->input->post("inputAbono"),
            "subtotal" => $this->input->post("inputValorArriendo"),
            "arrayNombreAccesorios" => $this->input->post("arrayNombreAccesorios"),
            "arrayValorAccesorios" => $this->input->post("arrayValorAccesorios"),
            "numFacturacion" => $this->input->post("inputNumFacturacion"),
            "tipoPagoGarantia" => $this->input->post("customRadio0"),
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



    public function registrarContrato()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "id_documento" => $this->input->post("id_documento"),
            "id_signature" => $this->input->post("id_signature"),
        ];
        echo post_function($dataArray, "contratos/registrarContrato", $tokenUser);
    }
}