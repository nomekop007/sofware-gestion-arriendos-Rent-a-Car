<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arriendo_controller extends CI_Controller
{
    public function cargarArriendos()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => $this->input->post("filtro"),
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => $this->input->post("filtro"),
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        }
    }

    public function cargarArriendosDespachos()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => ["FIRMADO"],
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => ["FIRMADO"],
            ];
            echo get_function("arriendos/cargarArriendosActivos", $params);
        }
    }

    public function cargarArriendosActivos()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => ["ACTIVO", "RECEPCIONADO"],
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => ["ACTIVO", "RECEPCIONADO"],
            ];
            echo get_function("arriendos/cargarArriendosActivos", $params);
        }
    }

    public function finalizarArriendosRecepcionados()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => 0,
            ];
            echo get_function("arriendos/finalizarArriendosRecepcionados", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
            ];
            echo get_function("arriendos/finalizarArriendosRecepcionados", $params);
        }
    }

    public function buscarArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "arriendos/buscarArriendo");
    }

    public function registrarArriendo()
    {
        $arrayForm = [
            "estado_arriendo" => "PENDIENTE",
            "tipo_arriendo" => $this->input->post("inputTipo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputCiudadEntrega"),
            "fechaEntrega_arriendo" => $this->input->post("inputFechaEntrega"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputCiudadRecepcion"),
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaRecepcion"),
            "diasActuales_arriendo" => $this->input->post("inputNumeroDias"),
            "diasAcumulados_arriendo" => $this->input->post("inputNumeroDias"),
            "kilometrosEntrada_arriendo" => $this->input->post("inputEntrada"),
            "kilometrosSalida_arriendo" => null,

            //foraneas
            "id_usuario" => $this->session->userdata('id'),
            "patente_vehiculo" => $this->input->post("select_vehiculos"),
            "id_sucursal" => $this->input->post('selectSucursal'),
            "id_remplazo" => $this->input->post("inputIdRemplazo"),
            "rut_cliente" => $this->input->post("inputRutCliente"),
            "rut_empresa" => $this->input->post("inputRutEmpresa"),
            "rut_conductor" => $this->input->post("inputRutConductor"),
            "rut_conductor2" => $this->input->post("inputRutConductor2"),
            "rut_conductor3" => $this->input->post("inputRutConductor3"),
        ];
        echo post_function($arrayForm, "arriendos/registrarArriendo");
    }

    public function cambiarEstadoArriendo()
    {
        $idArriendo = $this->input->post("id_arriendo");
        $salida = $this->input->post("kilometraje_salida");
        $ArrayData = ["estado_arriendo" => $this->input->post("estado")];
        if ($salida) {
            $ArrayData += ["kilometrosSalida_arriendo" => $salida];
        }
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }

    public function editarArriendo()
    {
        $idArriendo = $this->input->post("id_arriendo");
        $ArrayData = [
            "kilometrosEntrada_arriendo" => $this->input->post("inputEditarKentradaArriendo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputEditarCiudadEntregaArriendo"),
            "fechaEntrega_arriendo" => $this->input->post("inputEditarFechaInicioArriendo"),
            "fechaRecepcion_arriendo" => $this->input->post("inputEditarFechaFinArriendo"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputEditarCiudadRecepcionArriendo"),
            "diasActuales_arriendo" => $this->input->post("inputEditarDiasArriendo"),
            "diasAcumulados_arriendo" => $this->input->post("inputEditarDiasArriendo"),
            "patente_vehiculo" => $this->input->post("inputEditarVehiculoArriendo"),
        ];
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }

    public function extenderArriendo()
    {
        $idArriendo = $this->input->post("id_arriendo");
        $ArrayData = [
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaExtender_extenderPlazo"),
            "diasActuales_arriendo" => $this->input->post("diasActuales"),
            "diasAcumulados_arriendo" => $this->input->post("diasAcumulados"),
        ];
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }


    public function enviarCorreoAtraso()
    {
        $params = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "nombre_cliente" => $this->input->post("nombre_cliente"),
            "correo_cliente" => $this->input->post("correo_cliente")
        ];
        echo get_function("arriendos/enviarCorreoAtraso", $params);
    }
}
