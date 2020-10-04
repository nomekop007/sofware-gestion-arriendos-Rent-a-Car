<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Conductor_controller extends CI_Controller
{

    public function cargarConductores()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("conductores/cargarConductores", $tokenUser);
    }

    public function buscarConductor()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_conductor = $this->input->post("rut_conductor");
        echo find_function($rut_conductor, "conductores/buscarConductor", $tokenUser);
    }
    public function crearConductor()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $arrayData = [
            "rut_conductor" => $this->input->post("inputRutConductor"),
            "nombre_conductor" => $this->input->post("inputNombreConductor"),
            "telefono_conductor" => $this->input->post("inputTelefonoConductor"),
            "clase_conductor" => $this->input->post("inputClaseConductor"),
            "numero_conductor" => $this->input->post("inputNumeroConductor"),
            "vcto_conductor" => $this->input->post("inputVCTOConductor"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidadConductor"),
            "direccion_conductor" => $this->input->post("inputDireccionConductor"),
        ];
        echo post_function($arrayData, "conductores/registrarConductor", $tokenUser);
    }
}