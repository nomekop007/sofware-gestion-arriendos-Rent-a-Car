<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Despacho_controller extends CI_Controller
{

    public function registrarDespacho()
    {
        $ArrayData = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "id_despacho" => $this->input->post("inputIdArriendo"),
            "observaciones_despacho" => $this->input->post("inputObservacionesDespacho"),
            "nombreRecibidor_despacho" => $this->input->post("inputRecibidorDespacho"),
            "nombreDespachador_despacho" => $this->input->post("inputEntregadorDespacho"),
        ];

        echo post_function($ArrayData, "despachos/registrarDespacho");
    }

    public function registrarRevision()
    {
        $id_despacho = $this->input->post("id_despacho");
        $ArrayData = [
            "arrayImages" => json_decode($this->input->post("arrayImages"))
        ];

        echo put_function($id_despacho, $ArrayData, "despachos/registrarRevision");
    }
}