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



        //ENVIAR LA IMAGEN AL SERVIDOR EN base64 SI ES POSIBLE

        /*    $path = $_FILES["inputFoto"]["tmp_name"];
        //se valida que el archivo sea correcto
        if (is_uploaded_file($path) && !empty($_FILES)) {
            //se cactura la url de la foto
            $foto = file_get_contents($path);
        }
         */


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
            "estado_vehiculo" => "DISPONIBLE",
        ];

        echo post_function($arrayVehiculo, "vehiculos/registrarVehiculo", $tokenUser);
    }
}