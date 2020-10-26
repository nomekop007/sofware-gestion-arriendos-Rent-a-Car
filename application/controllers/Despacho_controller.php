<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Despacho_controller extends CI_Controller
{

    public function registrarDespacho()
    {

        $nameUser = $this->session->userdata('nombre');

        $ArrayData = [
            "userAt" => $nameUser,
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "id_despacho" => $this->input->post("inputIdArriendo"),
            "observaciones_despacho" => $this->input->post("inputObservacionesDespacho"),
            "nombreRecibidor_despacho" => $this->input->post("inputRecibidorDespacho"),
            "nombreDespachador_despacho" => $this->input->post("inputEntregadorDespacho"),
        ];

        echo post_function($ArrayData, "despachos/registrarDespacho");
    }



    public function enviarCorreoDespacho()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("inputIdArriendo")
        ];
        echo post_function($arrayForm, "despachos/enviarCorreoDespacho");
    }
}