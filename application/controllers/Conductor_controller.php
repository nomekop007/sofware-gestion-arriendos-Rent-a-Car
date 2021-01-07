<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Conductor_controller extends CI_Controller
{

    public function cargarConductores()
    {
        echo get_function("conductores/cargarConductores");
    }

    public function buscarConductor()
    {
        $rut_conductor = $this->input->post("rut_conductor");
        echo find_function($rut_conductor, "conductores/buscarConductor");
    }
    public function crearConductor()
    {
        $arrayData = [
            "rut_conductor" => $this->input->post("inputRutConductor"),
            "nombre_conductor" => $this->input->post("inputNombreConductor"),
            "telefono_conductor" => $this->input->post("inputTelefonoConductor"),
            "clase_conductor" => $this->input->post("inputClaseConductor"),
            "numero_conductor" => $this->input->post("inputNumeroConductor"),
            "vcto_conductor" => $this->input->post("inputVCTOConductor"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidadConductor"),
            "direccion_conductor" => $this->input->post("inputDireccionConductor"),
            "nacionalidad_conductor" => $this->input->post("inputNacionalidadConductor"),
        ];
        echo post_function($arrayData, "conductores/registrarConductor");
    }

    public function modificarConductor()
    {
        $rut_conductor = $this->input->post('inputRutConductor');
        $arrayData = [
            "nombre_conductor" => $this->input->post("inputNombreConductor"),
            "nacionalidad_conductor" => $this->input->post("inputNacionalidadConductor"),
            "telefono_conductor" => $this->input->post("inputTelefonoConductor"),
            "direccion_conductor" => $this->input->post("inputDireccionConductor"),
            "clase_conductor" => $this->input->post("inputClaseConductor"),
            "numero_conductor" => $this->input->post("inputNumeroConductor"),
            "vcto_conductor" => $this->input->post("inputVCTOConductor"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidadConductor"),
        ];
        echo put_function($rut_conductor, $arrayData, "conductores/editarConductor");
    }
}