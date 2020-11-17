<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Contacto_controller extends CI_Controller
{

    public function registrarContacto()
    {
        $arrayData = [
            "nombre_contacto" => $this->input->post("inputNombreContacto"),
            "domicilio_contacto" => $this->input->post("inputDomicilioContacto"),
            "numeroCasa_contacto" => $this->input->post("inputNumeroCasaContacto"),
            "ciudad_contacto" => $this->input->post("inputCiudadContacto"),
            "telefono_contacto" => $this->input->post("inputTelefonoContacto"),
            "id_arriendo" => $this->input->post("inputIdArriendo"),
        ];
        echo post_function($arrayData, "contactos/registrarContacto");
    }
}