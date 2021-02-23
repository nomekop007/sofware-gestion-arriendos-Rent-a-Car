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

    public function buscarPagoClientes()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "pagos/buscarPagosClientePendiente");
    }

    public function cargarPagosClientes()
    {
        echo get_function("pagos/cargarPagosClientes");
    }

    public function registrarPagoExtra()
    {
        $dataArray = [
            "monto" => $this->input->post("monto_pagoExtra"),
            "descripcion" => $this->input->post("descripcion_pagoExtra"),
            "tipo" => $this->input->post("tipo_pagoExtra"),
            "idArriendo" => $this->input->post("id_arriendo"),
        ];
        echo post_function($dataArray, "pagos/registrarPagoExtra");
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

    public function actualizarPagos()
    {
        $dataArray = [
            "id_facturacion" => $this->input->post("id_facturacion"),
            "estado_pago" => 'PAGADO',
            "arrayPagos" => json_decode($this->input->post("arrayPagos")),
        ];
        echo post_function($dataArray, "pagos/actualizarPagos");
    }




    public function modificarPago()
    {
        $id_pago = $this->input->post("id_pago");
        $dataArray = [
            "pagoArriendo" => [
                "dias_pagoArriendo" => intval($this->input->post("dias_pago")),
                "observaciones_pagoArriendo" => $this->input->post("editar_observaciones_pago"),
                "remplazo_pagoArriendo" => intval($this->input->post("editar_neto_pago")),
                "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            ],
            "pago" => [
                "neto_pago" => intval($this->input->post("editar_neto_pago")),
                "iva_pago" => intval($this->input->post("editar_iva_pago")),
                "total_pago" => intval($this->input->post("editar_bruto_pago")),
            ],
        ];
        echo put_function($id_pago, $dataArray, "pagos/modificarPago");
    }


    public function aplicarDescuentoPago()
    {
        $dataArray = [
            "dias_restantes" => $this->input->post("dias_restantes"),
            "descuento_pago" => $this->input->post("descuento_pago"),
            "extra_pago" => $this->input->post("extra_pago"),
            "observacion_pago" => $this->input->post("inputObservaciones"),
            "arrayPagos" => json_decode($this->input->post("arrayPagos")),
        ];
        echo post_function($dataArray, "pagos/aplicarDescuentoPago");
    }

    public function calcularTotalPagos()
    {
        $dataArray = [
            "arrayPagos" => json_decode($this->input->post("arrayPagos")),
        ];
        echo post_function($dataArray, "pagos/calcularTotalPagos");
    }

    public function buscarPago()
    {
        $id_pago = $this->input->post("id_pago");
        echo find_function($id_pago, "pagos/buscarPago");
    }


    public function actualizarUnPagoAPagado()
    {
        $id_pago = $this->input->post("id_pago");
        $dataArray = [
            "id_facturacion" => $this->input->post("id_facturacion"),
            "estado_pago" => "PAGADO",
        ];
        echo put_function($id_pago, $dataArray, "pagos/actualizarUnPagoAPagado");
    }

    public function actualizarMontoPago()
    {
        $id_pago = $this->input->post("id_pago");
        $dataArray = [
            'nuevo_monto' => $this->input->post("nuevo_monto")
        ];
        echo put_function($id_pago, $dataArray, "pagos/actualizarMontoPago");
    }

    public function cargarPagosExtrasPorArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "pagos/cargarPagosExtrasPorArriendo");
    }
}
