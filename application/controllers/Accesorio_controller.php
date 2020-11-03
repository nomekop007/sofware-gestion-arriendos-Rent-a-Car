<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Accesorio_controller extends CI_Controller
{
    public function cargarAccesorios()
    {
        echo get_function("accesorios/cargarAccesorios");
    }

    public function registrarArriendoAccesorios()
    {
        $ArrayData = [
            "ArrayChecks" => json_decode($this->input->post("arrayAccesorios")),
            "id_arriendo" => $this->input->post("idArriendo")
        ];
        echo post_function($ArrayData, "accesorios/registrarArriendoAccesorio");
    }
}