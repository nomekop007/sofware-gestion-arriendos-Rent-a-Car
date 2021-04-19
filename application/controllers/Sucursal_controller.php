<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Sucursal_controller extends CI_Controller
{

    public function cargarSucursales()
    {
        echo  get_function('sucursales/cargarSucursales');
    }



    public function buscarSucursal()
    {
        $id_arriendo = $this->input->post("id_sucursal");
        echo find_function($id_arriendo, "sucursales/buscarSucursal");
    }



    public function cargarRegiones()
    {
        echo get_function("sucursales/cargarRegiones");
    }

    public function generar_ActaTraslado()
    {

        $array=[
            "patente_vehiculo" => $this->input->post("patente_vehiculo"),
            "id_sucursal" => $this->input->post("id_sucursal"),
            "nombreSucursalOrigen" => $this->input->post("nombreSucursalOrigen"),
            "sucursalDestino" => $this->input->post("sucursalDestino"),
            "nombreSucursalDestino" => $this->input->post("nombreSucursalDestino"),
            "observacion" => $this->input->post("observacion"),
            "conductor" => $this->input->post("conductor"),
            "rutConductor" => $this->input->post("rutConductor"),
            "estado" => $this->input->post("estado"), 
            "arrayimagenesOrigen" => $this->input->post("arrayimagenesOrigen"),
            "arrayimagenesDestino" =>$this->input->post("arrayimagenesDestino"),
            "actaTrasladoOrigen" => $this->input->post("actaTrasladoOrigen"),
            "actaTrasladoDestino" => $this->input->post("actaTrasladoDestino"),
            "fechaTrasladoOrigen" => $this->input->post("fechaTrasladoOrigen"),
            "fechaTrasladoDestino" => $this->input->post("fechaTrasladoDestino"),
        
        ];
        
        echo post_function($array,"sucursales/registrarTrasladoOrigen");
    }

    public function eliminarTraslado(){
        $ID = $this->input->post("id_traslado");
        echo delete_function($ID, "sucursales/eliminarTraslado");

    }

    public function obtenerTodosTraslados(){
        echo get_function("sucursales/cargarTraslados");
        
    }

    public function obtenerTraslado(){
        
        $id_traslado = $this->input->post("id_traslado");
        echo find_function($id_traslado, "sucursales/obtenerTraslado");

    }

    public function guardarFotosTrasladoOrigen(){
        
        $id_traslado = $this->input->post("id_traslado");
        $arrayFile = ["file0","file1","file2","file3","file4"];
        $arrayData = recorrerFicheros($arrayFile);
        echo file_function($id_traslado,$arrayData, "sucursales/guardarFotosTrasladoOrigen");

    }

    public function guardarFotosTrasladoDestino(){
        
        $id_traslado = $this->input->post("id_traslado");
        $arrayFile = ["file0","file1","file2","file3","file4"];
        $arrayData = recorrerFicheros($arrayFile);
        echo file_function($id_traslado,$arrayData, "sucursales/guardarFotosTrasladoDestino");

    }

    public function actualizarTrasladoEstado(){
        $id_traslado = $this->input->post("id_traslado");
        $array=[
            "estado" => $this->input->post("estado"),
            "kilometraje_vehiculo" => $this->input->post("kilometraje_vehiculo"),
            "arrayimagenDestino" => $this->input->post("arrayimagenDestino"),
        ];

        echo put_function($id_traslado, $array, "sucursales/editarTrasladoEstado");

    }
}



