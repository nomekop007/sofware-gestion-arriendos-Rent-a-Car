<?php


defined('BASEPATH') or exit('No direct script access allowed');


class ActaEntrega_controller extends CI_Controller
{

    public function registrarActaEntrega()
    {
        $dataArray = [
            "id_despacho" => $this->input->post("inputIdDespacho"),
            "documento" => $this->input->post("nombre_documento"),
        ];
        echo post_function($dataArray, "actasEntregas/registrarActaEntrega");
    }

    public function buscarActaEntrega()
    {
        $id_despacho = $this->input->post("id_despacho");
        echo find_function($id_despacho, "actasEntregas/buscarActaEntrega");
    }

    public function generarPDFactaEntrega()
    {
        $ArrayData = [
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
            "geolocalizacion" => $this->input->post("geolocalizacion"),
        ];

        echo post_function($ArrayData, "actasEntregas/generarPDFactaEntrega");
    }

    public function enviarCorreoActaEntrega()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("inputIdArriendo")
        ];
        echo post_function($arrayForm, "actasEntregas/enviarCorreoActaEntrega");
    }
}