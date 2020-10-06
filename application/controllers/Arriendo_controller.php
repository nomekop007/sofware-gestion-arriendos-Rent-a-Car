<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Arriendo_controller extends CI_Controller
{


    public function cargarTotalArriendos()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("arriendos/cargarTotalArriendos", $tokenUser);
    }

    public function buscarArriendo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "arriendos/buscarArriendo", $tokenUser);
    }


    public function registrarArriendo()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $arrayForm = [
            "estado_arriendo" => "PENDIENTE",
            "tipo_arriendo" => $this->input->post("inputTipo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputCiudadEntrega"),
            "fechaEntrega_arriendo" => $this->input->post("inputFechaEntrega"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputCiudadRecepcion"),
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaRecepcion"),
            "numerosDias_arriendo" => $this->input->post("inputNumeroDias"),
            "kilometrosEntrada_arriendo" => $this->input->post("inputEntrada"),
            "kilometrosMantencion_arriendo" => $this->input->post("inputMantencion"),
            "inputOtros" => $this->input->post("inputOtros"),

            //foraneas
            "id_usuario" =>  $this->session->userdata('id'),
            "patente_vehiculo" => $this->input->post("select_vehiculos"),
            "id_sucursal" => $this->input->post("selectSucursal"),
            "rut_cliente" => $this->input->post("inputRutCliente"),
            "rut_empresa" => $this->input->post("inputRutEmpresa"),
            "rut_conductor" => $this->input->post("inputRutConductor"),
        ];

        echo post_function($arrayForm, "arriendos/registrarArriendo", $tokenUser);
    }
}