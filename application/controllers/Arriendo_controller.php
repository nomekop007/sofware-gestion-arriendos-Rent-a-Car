<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arriendo_controller extends CI_Controller
{
    public function cargarArriendos()
    {
        $params = [
            "sucursal" => $this->session->userdata('sucursal'),
            "rol" => $this->session->userdata('rol'),
            "estado" => $this->input->post("filtro"),
        ];
        echo get_function("arriendos/cargarArriendos", $params);
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
            "id_sucursal" => $this->session->userdata('sucursal'),
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
        $ArrayData = [
            "estado_arriendo" => $this->input->post("estado"),
            "kilometrosSalida_arriendo" => $this->input->post("kilometraje_salida"),
        ];
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }

    public function extenderArriendo()
    {
        // se validac que el usuario sea un admin o supervisor
        $rol = $this->session->userdata("rol");
        if ($rol == 1 || $rol == 2) {
            $idArriendo = $this->input->post("id_arriendo");
            $ArrayData = [
                "estado_arriendo" => "EXTENDIDO",
                "fechaRecepcion_arriendo" => $this->input->post("inputFechaExtender_extenderPlazo"),
                "diasActuales_arriendo" => $this->input->post("diasActuales"),
                "diasAcumulados_arriendo" => $this->input->post("diasAcumulados"),

            ];
            echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
        } else {
            echo json_encode(array("success" => false, "msg" => "no tienes los permisos necesarios para extender contrato"));
        }
    }
}