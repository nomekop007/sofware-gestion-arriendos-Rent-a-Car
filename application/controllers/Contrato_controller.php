<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Contrato_controller extends CI_Controller
{

    public function registrarContrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "documento" => $this->input->post("nombre_documento"),
        ];
        echo post_function($dataArray, "contratos/registrarContrato");
    }

    public function generarPDFcontrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "firmaPNG" => $this->input->post("inputFirmaPNG"),
            "numero_tarjeta" => $this->input->post("inputNumeroTarjeta"),
            "fecha_tarjeta" => $this->input->post("inputFechaTarjeta"),
            "codigo_tarjeta" => $this->input->post("inputCodigoTarjeta"),
            "numero_cheque" => $this->input->post("inputNumeroCheque"),
            "codigo_cheque" => $this->input->post("inputCodigoCheque"),
            "abono" => $this->input->post("inputAbono"),
            "valorArriendo" => $this->input->post("inputValorArriendo"),
            "valorCopago" => $this->input->post("inputValorCopago"),
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
            "geolocalizacion" => $this->input->post("geolocalizacion"),
        ];
        echo post_function($dataArray, "contratos/generarPDFcontrato");
    }

    public function enviarCorreoContrato()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("inputIdArriendo")
        ];
        echo post_function($arrayForm, "contratos/enviarCorreoContrato");
    }
}