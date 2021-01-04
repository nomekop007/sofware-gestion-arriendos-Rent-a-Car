<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TarifaVehiculo_controller extends CI_Controller
{

    public function buscarTarifasVehiculo()
    {
        $params = [
            "patente" => $this->input->post("patente_vehiculo"),
            "dias" => $this->input->post("dias_arriendo"),
        ];
        echo get_function("tarifasVehiculos/buscarTarifaVehiculoPorDias", $params);
    }

}