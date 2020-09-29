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
            "clase_conductor" => $this->input->post("inputClase"),
            "numero_conductor" => $this->input->post("inputNumero"),
            "vcto_conductor" => $this->input->post("inputVCTO"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidad"),
            "direccion_conductor" => $this->input->post("inputDireccion"),
        ];
        echo post_function($arrayData, "conductores/registrarConductor", $tokenUser);
    }
}