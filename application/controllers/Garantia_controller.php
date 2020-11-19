<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Garantia_controller extends CI_Controller
{
    public function registrarGarantia()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "folioTarjeta_garantia" => $this->input->post("inputFolioTarjeta"),
            "bancoCheque_garantia" => $this->input->post("inputBancoCheque"),
            "numeroTarjeta_garantia" => $this->input->post("inputNumeroTarjeta"),
            "fechaTarjeta_garantia" => $this->input->post("inputFechaTarjeta"),
            "codigoTarjeta_garantia" => $this->input->post("inputCodigoTarjeta"),
            "numeroCheque_garantia" => $this->input->post("inputNumeroCheque"),
            "codigoCheque_garantia" => $this->input->post("inputCodigoCheque"),
            "monto_garantia" => $this->input->post("inputAbono"),
            "id_modoPago" => $this->input->post("customRadio0"),
        ];
        echo post_function($dataArray, "garantias/registrarGarantia");
    }
}
