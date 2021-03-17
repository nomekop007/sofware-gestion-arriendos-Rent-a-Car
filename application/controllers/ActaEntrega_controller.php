<?php


defined('BASEPATH') or exit('No direct script access allowed');


class ActaEntrega_controller extends CI_Controller
{

    public function registrarActaEntrega()
    {
        $dataArray = [
            "id_despacho" => $this->input->post("inputIdDespacho"),
            "base64" => $this->input->post("base64"),
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


    public function generarPDFactaRecepcion()
    {

        //logica
    }

    public function guardarFotosVehiculo()
    {
        $id_arriendo = $this->input->post("inputIdArriendo");
        $arrayFile = [
            "file0",
            "file1", "file2", "file3", "file4", "file5",
            "file6", "file7", "file8", "file9", "file10"
        ];
        $arrayData = recorrerFicheros($arrayFile);
        echo  file_function($id_arriendo, $arrayData, "actasEntregas/guardarFotosVehiculos");
    }


    public function enviarCorreoActaEntrega()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("inputIdArriendo")
        ];
        echo post_function($arrayForm, "actasEntregas/enviarCorreoActaEntrega");
    }
}
