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
            "arrayImages" => json_decode($this->input->post("arrayImages")),
        ];
        echo put_function($id_despacho, $ArrayData, "despachos/registrarRevision");
    }



    public function registrarBloqueoUsuario()
    {
        $ArrayData = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "tipo" => $this->input->post("tipo")
        ];
        echo post_function($ArrayData, "despachos/registrarBloqueoUsuario");
    }



    public function revisarBloqueoUsuario()
    {
        echo get_function("despachos/revisarBloqueoUsuario");
    }



    public function registrarActaEntrega()
    {
        $dataArray = [
            "id_despacho" => $this->input->post("inputIdDespacho"),
            "base64" => $this->input->post("base64"),
        ];
        echo post_function($dataArray, "despachos/registrarActaEntrega");
    }



    public function buscarActaEntrega()
    {
        $id_despacho = $this->input->post("id_despacho");
        echo find_function($id_despacho, "despachos/buscarActaEntrega");
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
        echo post_function($ArrayData, "despachos/generarPDFactaEntrega");
    }



    public function generarPDFactaRecepcion()
    {
        $ArrayData = [
            "firma1PNG" => $this->input->post("inputFirma1PNG"),
            "firma2PNG" => $this->input->post("inputFirma2PNG"),
            "id_arriendo" => $this->input->post("id_arriendo"),
            "descripcion_danio" => $this->input->post("descripcion_danio"),
            "kilomentraje_salida" => $this->input->post("kilomentraje_salida"),
            "recibidorRecepcion" => $this->input->post("inputUsuarioRecepcion"),
            "entregadorRecepcion" => $this->input->post("inputClienteRecepcion"),
            "matrizRecepcion" => json_decode($this->input->post("matrizRecepcion")),
            "imageCombustible" => $this->input->post("imageCombustible"),
            "geolocalizacion" => $this->input->post("geolocalizacion"),
        ];
        echo post_function($ArrayData, "despachos/generarPDFactaRecepcion");
    }



    public function enviarCorreoActaEntrega()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("inputIdArriendo")
        ];
        echo post_function($arrayForm, "despachos/enviarCorreoActaEntrega");
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
        echo  file_function($id_arriendo, $arrayData, "despachos/guardarFotosVehiculos");
    }



    public function guardarFotoRecepcion()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        $arrayFile = ['inputFotoVehiculo'];
        $arrayData = recorrerFicheros($arrayFile);
        echo  file_function($id_arriendo, $arrayData, "despachos/guardarFotoRecepcion");
    }



    public function eliminarFotosRecepcion()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo delete_function($id_arriendo, "despachos/eliminarFotosRecepcion");
    }



    public function eliminarFotosDespacho()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo delete_function($id_arriendo, "despachos/eliminarFotosDespacho");
    }


    public function confirmarRecepcionArriendo()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "descripcion_danio" => $this->input->post("descripcion_danio"),
            "tieneDanio" => $this->input->post("tieneDanio"),
            "base64" => $this->input->post("base64"),
        ];
        echo post_function($dataArray, "despachos/confirmarRecepcionArriendo");
    }
}
