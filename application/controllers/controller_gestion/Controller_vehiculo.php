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


    public function registrarVehiculo()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $arrayVehiculo = [
            "patente_vehiculo" => $this->input->post("patente"),
            "transmision_vehiculo" => $this->input->post("transmision"),
            "modelo_vehiculo" => $this->input->post("modelo"),
            "tipo_vehiculo" => $this->input->post("tipo"),
            "color_vehiculo" => $this->input->post("color"),
            "precio_vehiculo" => $this->input->post("precio"),
            "propietario_vehiculo" => $this->input->post("propietario"),
            "compra_vehiculo" => $this->input->post("compra"),
            "fechaCompra_vehiculo" => $this->input->post("fechaCompra"),
            "año_vehiculo" => $this->input->post("edad"),
            "id_sucursal" => $this->input->post("sucursal"),
            "chasis_vehiculo" => $this->input->post("chasis"),
            "numeroMotor_vehiculo" => $this->input->post("n_motor"),
            "marca_vehiculo" => $this->input->post("marca"),
            "estado_vehiculo" => "DISPONIBLE",
        ];

        echo post_function($arrayVehiculo, "vehiculos/registrarVehiculo", $tokenUser);
    }
}