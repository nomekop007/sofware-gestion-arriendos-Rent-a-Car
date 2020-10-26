<?php


defined('BASEPATH') or exit('No direct script access allowed');


class ActaEntrega_controller extends CI_Controller
{


    public function generarPDFactaEntrega()
    {

        $nameUser = $this->session->userdata('nombre');

        $ArrayData = [
            "userAt" => $nameUser,
            "firma1PNG" => $this->input->post("inputFirma1PNG"),
            "firma2PNG" => $this->input->post("inputFirma2PNG"),
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "arrayImages" => json_decode($this->input->post("arrayImages")),
            "matrizRecepcion" => json_decode($this->input->post("matrizRecepcion")),
            "imageCombustible" => $this->input->post("imageCombustible"),
            "destinoDespacho" => $this->input->post("inputDestinoDespacho"),
            "procedenciaDesdeDespacho" => $this->input->post("inputProcedenciaDesdeDespacho"),
            "procedenciaHaciaDespacho" => $this->input->post("inputProcedenciaHaciaDespacho"),
            "observacionesDespacho" => $this->input->post("inputObservacionesDespacho"),
            "recibidorDespacho" => $this->input->post("inputRecibidorDespacho"),
            "entregadorDespacho" => $this->input->post("inputEntregadorDespacho"),
        ];

        echo post_function($ArrayData, "actasEntregas/generarPDFactaEntrega");
    }


    public function registrarActaEntrega()
    {
        $nameUser = $this->session->userdata('nombre');

        $dataArray = [
            "userAt" => $nameUser,
            "id_despacho" => $this->input->post("inputIdDespacho"),
            "documento" => $this->input->post("nombre_documento"),
        ];
        echo post_function($dataArray, "actasEntregas/registrarActaEntrega");
    }
}