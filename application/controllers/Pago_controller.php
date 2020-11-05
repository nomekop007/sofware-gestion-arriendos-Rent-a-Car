<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Pago_controller extends CI_Controller
{

    public function registrarPago()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "neto_pago" => $this->input->post("inputNeto"),
            "iva_pago" => $this->input->post("inputIVA"),
            "descuento_pago" => $this->input->post("inputDescuento"),
            "total_pago" => $this->input->post("inputTotal"),
            "observaciones_pago" => $this->input->post("inputObservaciones"),
            "digitador_pago" => $this->input->post("digitador"),
            "id_modoPago" => $this->input->post("customRadio2"),
            "estado_pago" => $this->input->post("inputEstado"),
        ];
        echo post_function($dataArray, "pagos/registrarPago");
    }
}

// "tipo_facturacion" => $this->input->post("customRadio1"),
//"numero_facturacion" => $this->input->post("inputNumFacturacion"),