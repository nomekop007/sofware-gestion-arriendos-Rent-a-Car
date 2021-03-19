<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pago_controller extends CI_Controller
{


    public function cargarPagosERpendientes()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => 0,
            ];
            echo get_function("pagos/cargarPagosERpendientes", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
            ];
            echo get_function("pagos/cargarPagosERpendientes", $params);
        }
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
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => 0,
            ];
            echo get_function("pagos/cargarPagosClientes", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
            ];
            echo get_function("pagos/cargarPagosClientes", $params);
        }
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



    public function eliminarPagoExtra()
    {
        $id_pagoExtra = $this->input->post("id_pagoExtra");
        echo delete_function($id_pagoExtra, "pagos/eliminarPagoExtra");
    }



    public function actualizarPagoExtra()
    {
        $dataArray = [
            "id_facturacion" => $this->input->post("id_facturacion"),
            "arrayPagosExtra" => json_decode($this->input->post("arrayPagosExtra")),
        ];
        echo post_function($dataArray, "pagos/actualizarPagosExtras");
    }



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
        echo post_function($arrayData, "pagos/registrarAbono");
    }



    public function cargarFacturaciones()
    {
        echo get_function("pagos/cargarFacturaciones");
    }



    public function registrarFacturacion()
    {
        $dataArray = [
            "tipo_facturacion" => $this->input->post("customRadio1"),
            "numero_facturacion" => $this->input->post("inputNumFacturacion"),
            "id_modoPago" => $this->input->post("customRadio2"),
        ];
        echo post_function($dataArray, "pagos/registrarFacturacion");
    }



    public function guardarDocumentoFacturacion()
    {
        $id_facturacion = $this->input->post("id_facturacion");
        $arrayInput = ["inputDocumento"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_facturacion, $arrayData, "pagos/guardarDocumentoFacturacion");
    }



    public function registrarPagosAccesorios()
    {
        $dataArray = [
            "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            "matrizAccesorios" => json_decode($this->input->post("matrizAccesorios")),
        ];
        echo post_function($dataArray, "pagos/registrarPagosAccesorios");
    }



    public function registrarPagoArriendo()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "subtotal_pagoArriendo" => $this->input->post("inputSubTotalArriendo"),
            "remplazo_pagoArriendo" => $this->input->post("inputPagoEmpresa"),
            "valorCopago_pagoArriendo" => $this->input->post("inputValorCopago"),
            "neto_pagoArriendo" => $this->input->post("inputNeto"),
            "iva_pagoArriendo" => $this->input->post("inputIVA"),
            "descuento_pagoArriendo" => $this->input->post("inputDescuento"),
            "total_pagoArriendo" => $this->input->post("inputTotal"),
            "observaciones_pagoArriendo" => $this->input->post("inputObservaciones"),
            "digitador_pagoArriendo" => $this->input->post("digitador"),
        ];
        echo post_function($dataArray, "pagos/registrarPagoArriendo");
    }



    public function consultarTotalPagosArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "pagos/consultarTotalPagosArriendo");
    }



    public function consultarPagosArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "pagos/consultarPagosArriendo");
    }



    public function registrarPagoDanio()
    {
        $dataArray = [
            "precioTotal_pagoDanio" => $this->input->post("input_precio_pagoDanio"),
            "pagador_pagoDanio" => $this->input->post("input_pagador_pagoDanio"),
            "mecanico_pagoDanio" => $this->input->post("input_mecanico_pagoDanio"),
            "id_danioVehiculo" => $this->input->post("id_danioVehiculo"),
            "id_facturacion" => $this->input->post("id_facturacion"),
        ];
        echo post_function($dataArray, "pagos/registrarPagoDanio");
    }
}
