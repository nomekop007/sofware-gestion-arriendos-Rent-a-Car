<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Vehiculo_controller extends CI_Controller
{

    public function cargarVehiculos()
    {
        $arrayForm = [
            "id_sucursal" => $this->session->userdata('sucursal'),
            "id_rol" => $this->session->userdata('rol')
        ];
        echo post_function($arrayForm, "vehiculos/cargarVehiculos");
    }

    public function buscarVehiculo()
    {
        $patente = $this->input->post("patente");
        echo find_function($patente, 'vehiculos/buscarVehiculo');
    }


    public function registrarVehiculo()
    {
        $nameUser = $this->session->userdata('nombre');

        $arrayVehiculo = [
            "userAt" => $nameUser,
            "patente_vehiculo" => $this->input->post("inputPatente"),
            "transmision_vehiculo" => $this->input->post("inputTransmision"),
            "modelo_vehiculo" => $this->input->post("inputModelo"),
            "tipo_vehiculo" => $this->input->post("inputTipo"),
            "color_vehiculo" => $this->input->post("inputColor"),
            "rut_propietario" => $this->input->post("inputPropietario"),
            "compra_vehiculo" => $this->input->post("inputCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputFechaCompra"),
            "año_vehiculo" => $this->input->post("inputedad"),
            "id_sucursal" => $this->input->post("inputSucursal"),
            "chasis_vehiculo" => $this->input->post("inputChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputMarca"),
            "estado_vehiculo" => $this->input->post("inputEstado"),
        ];

        echo post_function($arrayVehiculo, "vehiculos/registrarVehiculo");
    }


    public function editarVehiculo()
    {

        $nameUser = $this->session->userdata('nombre');
        $patente = $this->input->post("inputEditarPatente");

        $arrayVehiculo = [
            "userAt" => $nameUser,
            "transmision_vehiculo" => $this->input->post("inputEditarTransmision"),
            "modelo_vehiculo" => $this->input->post("inputEditarModelo"),
            "tipo_vehiculo" => $this->input->post("inputEditarTipo"),
            "color_vehiculo" => $this->input->post("inputEditarColor"),
            "rut_propietario" => $this->input->post("inputEditarPropietario"),
            "compra_vehiculo" => $this->input->post("inputEditarCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputEditarFechaCompra"),
            "año_vehiculo" => $this->input->post("inputEditarEdad"),
            "id_sucursal" => $this->input->post("inputEditarSucursal"),
            "chasis_vehiculo" => $this->input->post("inputEditarChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputEditarNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputEditarMarca"),
            "estado_vehiculo" => $this->input->post("inputEditarEstado")
        ];

        echo put_function($patente, $arrayVehiculo, "vehiculos/editarVehiculo");
    }

    public function cambiarEstadoVehiculo()
    {
        $nameUser = $this->session->userdata('nombre');
        $patente = $this->input->post("inputPatenteVehiculo");
        $ArrayData = [
            "userAt" => $nameUser,
            "estado_vehiculo" => $this->input->post("inputEstado"),
        ];
        echo put_function($patente, $ArrayData, "vehiculos/editarVehiculo");
    }


    public function guardarFotoVehiculo()
    {

        $patente =   $this->input->post("inputPatente");

        $path = $_FILES["inputFoto"]["tmp_name"];
        $name = $_FILES['inputFoto']['name'];
        $file = file_get_contents($path);


        $data = [
            [
                'name'     => 'foto_vehiculo',
                'contents' => $file,
                'filename' => $name
            ],
        ];
        echo file_function($patente, $data, "vehiculos/cargarImagen");
    }
}