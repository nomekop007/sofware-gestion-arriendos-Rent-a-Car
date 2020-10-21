<?php


defined('BASEPATH') or exit('No direct script access allowed');


class ActaEntrega_controller extends CI_Controller
{


    public function generarPDFactaEntrega()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $ArrayData = [
            "userAt" => $nameUser,
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "arrayImages" => json_decode($this->input->post("arrayImages")),
            "arrayRecepcionA" => "",
            "arrayRecepcionB" => "",
            "arrayRecepcionC" => "",
            "imageCombustible" => $this->input->post("imageCombustible"),
            "destinoDespacho" => $this->input->post("inputDestinoDespacho"),
            "procedenciaDesdeDespacho" => $this->input->post("inputProcedenciaDesdeDespacho"),
            "procedenciaHaciaDespacho" => $this->input->post("inputProcedenciaHaciaDespacho"),
            "observacionesDespacho" => $this->input->post("inputObservacionesDespacho"),
            "recibidorDespacho" => $this->input->post("inputRecibidorDespacho"),
            "entregadorDespacho" => $this->input->post("inputEntregadorDespacho"),
        ];

        echo post_function($ArrayData, "actasEntregas/generarPDFactaEntrega", $tokenUser);
    }
}