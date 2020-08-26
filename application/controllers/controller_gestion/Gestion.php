<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gestion extends CI_Controller
{

    //Registrar Vehiculo
    public function registrarVehiculo()
    {
        $modelo = $this->input->post("modelo");
        $patente = $this->input->post("patente");
        $edad = $this->input->post("edad");
        $tipo = $this->input->post("tipo");
        $color = $this->input->post("color");
        $sucursal = $this->input->post("sucursal");
        $propietario = $this->input->post("propietario");
        $compra = $this->input->post("compra");
        $precio = $this->input->post("precio");
        $fechaCompra = $this->input->post("fechaCompra");

        $arrayVehiculo = [$modelo, $patente, $edad, $tipo, $color, $sucursal, $propietario, $compra, $precio, $fechaCompra];


        if (true) {
            echo json_encode(array("msg" =>  $arrayVehiculo));
        } else {
            echo json_encode(array("msg" => "404"));
        }
    }
}