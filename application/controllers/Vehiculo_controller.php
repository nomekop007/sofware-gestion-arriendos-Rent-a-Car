<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vehiculo_controller extends CI_Controller
{


    public function cargarVehiculos()
    {
        echo get_function("vehiculos/cargarVehiculos");
    }



    public function buscarVehiculo()
    {
        $patente = $this->input->post("patente");
        echo find_function($patente, 'vehiculos/buscarVehiculo');
    }



    public function cargarVehiculosDisponiblesPorSucursal()
    {
        $id_sucursal = $this->input->post('id_sucursal');
        echo find_function($id_sucursal, 'vehiculos/cargarVehiculosDisponiblesPorSucursal');
    }



    public function cargarVehiculosArrendadosPorSucursal()
    {
        $id_sucursal = $this->input->post('id_sucursal');
        echo find_function($id_sucursal, 'vehiculos/cargarVehiculosArrendadosPorSucursal');
    }



    public function cargarVehiculosDisponibles()
    {
        echo get_function('vehiculos/cargarVehiculosDisponibles');
    }



    public function registrarVehiculo()
    {
        $arrayVehiculo = [
            "patente_vehiculo" => $this->input->post("inputPatente"),
            "transmision_vehiculo" => $this->input->post("inputTransmision"),
            "modelo_vehiculo" => $this->input->post("inputModelo"),
            "tipo_vehiculo" => $this->input->post("inputTipo"),
            "color_vehiculo" => $this->input->post("inputColor"),
            "rut_propietario" => $this->input->post("inputPropietario"),
            "compra_vehiculo" => $this->input->post("inputCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputFechaCompra"),
            "año_vehiculo" => $this->input->post("inputedad"),
            "id_region" => 1,
            "id_sucursal" => $this->input->post("inputSucursal"),
            "chasis_vehiculo" => $this->input->post("inputChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputNumeroMotor"),
            "numero_gps_vehiculo" => $this->input->post("inputNumeroGps"),
            "numero_tab_vehiculo" => $this->input->post("inputNumeroTab"),
            "marca_vehiculo" => $this->input->post("inputMarca"),
            "estado_vehiculo" => $this->input->post("inputEstado"),
            "Tmantencion_vehiculo" => 0,
            "kilometraje_vehiculo" => 0,
            "kilometrosMantencion_vehiculo" => 0,
        ];
        echo post_function($arrayVehiculo, "vehiculos/registrarVehiculo");
    }



    public function editarVehiculo()
    {
        $id = $this->input->post("inputEditarId");
        $arrayVehiculo = [
            "patente_vehiculo" => $this->input->post("inputEditarPatente"),
            "transmision_vehiculo" => $this->input->post("inputEditarTransmision"),
            "modelo_vehiculo" => $this->input->post("inputEditarModelo"),
            "tipo_vehiculo" => $this->input->post("inputEditarTipo"),
            "color_vehiculo" => $this->input->post("inputEditarColor"),
            "rut_propietario" => $this->input->post("inputEditarPropietario"),
            "compra_vehiculo" => $this->input->post("inputEditarCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputEditarFechaCompra"),
            "año_vehiculo" => $this->input->post("inputEditarEdad"),
            "id_region" => 1,
            "id_sucursal" => $this->input->post("inputEditarSucursal"),
            "chasis_vehiculo" => $this->input->post("inputEditarChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputEditarNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputEditarMarca"),
            "estado_vehiculo" => $this->input->post("inputEditarEstado"),
            "numero_gps_vehiculo" => $this->input->post("inputEditarNumeroGps"),
            "numero_tab_vehiculo" => $this->input->post("inputEditarNumeroTab"),
            "Tmantencion_vehiculo" => $this->input->post("inputEditarkilomentrosMantencion"),
        ];
        echo put_function($id, $arrayVehiculo, "vehiculos/editarVehiculo");
    }



    public function cambiarEstadoVehiculo()
    {
        $patente = $this->input->post("inputPatenteVehiculo");
        $ArrayData = [
            "estado_vehiculo" => $this->input->post("inputEstado"),
            "kilometraje_vehiculo" => $this->input->post("kilometraje_vehiculo"),
            "kilometrosMantencion_vehiculo" => $this->input->post("kilometros_mantencion"),
        ];
        if ($this->input->post("selectSucursal")) {
            $ArrayData += ["id_sucursal" => $this->input->post('selectSucursal')];
        } else {
            $ArrayData += ["id_sucursal" => $this->session->userdata('sucursal')];
        }
        echo put_function($patente, $ArrayData, "vehiculos/cambiarEstadoVehiculo");
    }



    public function guardarFotoVehiculo()
    {
        $patente = $this->input->post("inputPatente");
        $arrayInput = ["inputFoto"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($patente, $arrayData, "vehiculos/cargarImagen");
    }



    public function vehiculosArrendados()
    {
        echo get_function("vehiculos/cargarVehiculosArrendados");
    }



    public function buscarTarifasVehiculo()
    {
        $params = [
            "patente" => $this->input->post("patente_vehiculo"),
            "dias" => $this->input->post("dias_arriendo"),
        ];
        echo get_function("tarifasVehiculos/buscarTarifaVehiculoPorDias", $params);
    }



    public function cargarDanios()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => 0
            ];
            echo get_function("danioVehiculos/cargarDaniosVehiculos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
            ];
            echo get_function("danioVehiculos/cargarDaniosVehiculos", $params);
        }
    }



    public function registrarDanioVehiculo()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "descripcion_danio" => $this->input->post("descripcion_danio"),
            "arrayImages" => json_decode($this->input->post("arrayImagenes")),
        ];
        echo post_function($dataArray, "danioVehiculos/registrarDanioVehiculos");
    }



    public function revisarDanioVehiculo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "danioVehiculos/revisarDanioVehiculo");
    }



    public function cambiarEstadoDanio()
    {
        $idDanioVehiculo = $this->input->post("id_danioVehiculo");
        $ArrayData = [
            "estado_danioVehiculo" => "PAGADO",
        ];
        echo put_function($idDanioVehiculo, $ArrayData, "danioVehiculos/actualizarDanioVehiculo");
    }
}
