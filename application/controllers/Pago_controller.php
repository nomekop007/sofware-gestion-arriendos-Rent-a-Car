<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pago_controller extends CI_Controller
{

    public function cargarPagosERpendientes()
    {
        echo get_function("pagos/cargarPagosERpendientes");
    }

    public function buscarPagoERpendientes()
    {
        $clave_empresaRemplazo = $this->input->post("clave_empresaRemplazo");
        echo find_function($clave_empresaRemplazo, "pagos/buscarPagoERpendientes");
    }

    public function registrarPago()
    {
        $dataArray = [
            "neto_pago" => $this->input->post("inputNeto"),
            "iva_pago" => $this->input->post("inputIVA"),
            "total_pago" => $this->input->post("inputTotal"),
            "estado_pago" => $this->input->post("inputEstado"),
            "deudor_pago" => $this->input->post("inputDeudor"),
            "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            "id_facturacion" => $this->input->post("id_facturacion"),
        ];
        echo post_function($dataArray, "pagos/registrarPago");
    }

    public function actualizarPago()
    {
        $dataArray = [
            "id_facturacion" => $this->input->post("id_facturacion"),
            "estado_pago" => $this->input->post("inputEstado"),
            "arrayPagos" => json_decode($this->input->post("arrayPagos")),
        ];
        echo post_function($dataArray, "pagos/actualizarPago");
    }

    public function aplicarDescuentoPago()
    {
        $dataArray = [
            "descuento_pago" => $this->input->post("descuento_pago"),
            "observacion_pago" => $this->input->post("inputObservaciones"),
            "arrayPagos" => json_decode($this->input->post("arrayPagos")),
        ];
        echo post_function($dataArray, "pagos/aplicarDescuentoPago");
    }
}