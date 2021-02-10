<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Extencion_controller extends CI_Controller
{
    public function registrarExtencion()
    {
        $arrayData = [
            "patente_vehiculo" => $this->input->post("patente_vehiculo"),
            "id_arriendo" => $this->input->post("id_arriendo"),
            "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            "dias_extencion" => $this->input->post("diasActuales"),
            "fechaInicio_extencion" => $this->input->post("fechaInicio"),
            "fechaFin_extencion" => $this->input->post("fechaFin"),
            "estado_extencion" => "SIN FIRMA"
        ];
        echo post_function($arrayData, "extenciones/registrarExtencion");
    }

    public function cargarExtenciones()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "extenciones/buscarExtencionesPorArriendo");
    }
}
