<?php


defined('BASEPATH') or exit('No direct script access allowed');


class PagoAccesorio_controller extends CI_Controller
{

    public function registrarPagosAccesorios()
    {
        $dataArray = [
            "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            "matrizAccesorios" => json_decode($this->input->post("matrizAccesorios")),

        ];
        echo post_function($dataArray, "pagosAccesorios/registrarPagosAccesorios");
    }
}