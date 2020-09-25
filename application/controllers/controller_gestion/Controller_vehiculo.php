<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Controller_vehiculo extends CI_Controller
{

    public function cargarSucursales()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo  get_function('sucursales/cargarSucursales', $tokenUser);
    }

    public function cargarVehiculos()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("vehiculos/cargarVehiculos", $tokenUser);
    }

    public function buscarVehiculo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $patente = $this->input->post("patente");
        echo find_function($patente, 'vehiculos/buscarVehiculo', $tokenUser);
    }


    public function registrarVehiculo()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $arrayVehiculo = [
            "patente_vehiculo" => $this->input->post("inputPatente"),
            "transmision_vehiculo" => $this->input->post("inputTransmision"),
            "modelo_vehiculo" => $this->input->post("inputModelo"),
            "tipo_vehiculo" => $this->input->post("inputTipo"),
            "color_vehiculo" => $this->input->post("inputColor"),
            "precio_vehiculo" => $this->input->post("inputPrecio"),
            "propietario_vehiculo" => $this->input->post("inputPropietario"),
            "compra_vehiculo" => $this->input->post("inputCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputFechaCompra"),
            "año_vehiculo" => $this->input->post("inputedad"),
            "id_sucursal" => $this->input->post("inputSucursal"),
            "chasis_vehiculo" => $this->input->post("inputChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputMarca"),
            "estado_vehiculo" => $this->input->post("inputEstado"),
        ];

        echo post_function($arrayVehiculo, "vehiculos/registrarVehiculo", $tokenUser);
    }




    public function editarVehiculo()
    {

        $tokenUser = $this->session->userdata('usertoken');
        $patente = $this->input->post("inputEditarPatente");

        $arrayVehiculo = [
            "transmision_vehiculo" => $this->input->post("inputEditarTransmision"),
            "modelo_vehiculo" => $this->input->post("inputEditarModelo"),
            "tipo_vehiculo" => $this->input->post("inputEditarTipo"),
            "color_vehiculo" => $this->input->post("inputEditarColor"),
            "precio_vehiculo" => $this->input->post("inputEditarPrecio"),
            "propietario_vehiculo" => $this->input->post("inputEditarPropietario"),
            "compra_vehiculo" => $this->input->post("inputEditarCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputEditarFechaCompra"),
            "año_vehiculo" => $this->input->post("inputEditarEdad"),
            "id_sucursal" => $this->input->post("inputEditarSucursal"),
            "chasis_vehiculo" => $this->input->post("inputEditarChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputEditarNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputEditarMarca"),
            "estado_vehiculo" => $this->input->post("inputEditarEstado")
        ];

        echo put_function($patente, $arrayVehiculo, "vehiculos/editarVehiculo", $tokenUser);
    }


    public function guardarFotoVehiculo()
    {

        $tokenUser = $this->session->userdata('usertoken');
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
        echo file_function($patente, $data, "vehiculos/cargarImagen", $tokenUser);
    }
}