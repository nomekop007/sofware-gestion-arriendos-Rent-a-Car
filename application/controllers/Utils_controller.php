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

        $rol = $this->session->userdata("rol");
        if ($rol == 1 || $rol == 2) {
            $dataArray = [
                "documento" => $this->input->post("nombreDocumento"),
                "tipo" => $this->input->post("tipo"),
            ];
            echo post_function($dataArray, "utils/buscarDocumento");
        } else {
            echo json_encode(array("success" => false, "msg" => "no tienes los permisos necesarios para ver archivos"));
        }
    }
}