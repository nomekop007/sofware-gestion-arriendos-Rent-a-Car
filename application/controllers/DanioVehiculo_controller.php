<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DanioVehiculo_controller extends CI_Controller
{
    public function cargarDanios()
    {
        echo get_function("danioVehiculos/cargarDaniosVehiculos");
    }

    public function registrarDanioVehiculo()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "descripcion_danio" => $this->input->post("descripcion_danio"),
            "arrayImages" => json_decode($this->input->post("arrayImagenes")),
        ];

        echo post_function($dataArray, "danioVehiculos/registrarDanioVehiculos");
    }

    public function revisarDanioVehiculo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "danioVehiculos/revisarDanioVehiculo");
    }

    public function cambiarEstadoDanio()
    {
        $idDanioVehiculo = $this->input->post("id_danioVehiculo");
        $ArrayData = [
            "estado_danioVehiculo" => "PAGADO",
        ];
        echo put_function($idDanioVehiculo, $ArrayData, "danioVehiculos/actualizarDanioVehiculo");
    }

}