<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Utils_controller extends CI_Controller
{
    public function buscarDocumento()
    {

        //  case "contrato":
        //  case "acta":
        //  case "requisito":
        //  case "facturacion":
        //  case "recepcion":
        //  case "fotosDañoVehiculo":
        //  case "fotoVehiculo":
        $dataArray = [
            "documento" => $this->input->post("nombreDocumento"),
            "tipo" => $this->input->post("tipo"),
        ];
        echo post_function($dataArray, "utils/buscarDocumento");
    }
}
