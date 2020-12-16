<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vehiculo_controller extends CI_Controller
{

    public function cargarVehiculos()
    {
        $params = [
            "sucursal" => $this->session->userdata('sucursal'),
            "rol" => $this->session->userdata('rol'),
        ];
        echo get_function("vehiculos/cargarVehiculos", $params);
    }

    public function buscarVehiculo()
    {
        $patente = $this->input->post("patente");
        echo find_function($patente, 'vehiculos/buscarVehiculo');
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
            "id_region" => $this->input->post("inputRegion"),
            "chasis_vehiculo" => $this->input->post("inputChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputMarca"),
            "estado_vehiculo" => $this->input->post("inputEstado"),
            "Tmantencion_vehiculo" => 10000,
            "kilometraje_vehiculo" => 0,
            "kilometrosMantencion_vehiculo" => 0,

        ];
        echo post_function($arrayVehiculo, "vehiculos/registrarVehiculo");
    }

    public function editarVehiculo()
    {
        $patente = $this->input->post("inputEditarPatente");
        $arrayVehiculo = [
            "transmision_vehiculo" => $this->input->post("inputEditarTransmision"),
            "modelo_vehiculo" => $this->input->post("inputEditarModelo"),
            "tipo_vehiculo" => $this->input->post("inputEditarTipo"),
            "color_vehiculo" => $this->input->post("inputEditarColor"),
            "rut_propietario" => $this->input->post("inputEditarPropietario"),
            "compra_vehiculo" => $this->input->post("inputEditarCompra"),
            "fechaCompra_vehiculo" => $this->input->post("inputEditarFechaCompra"),
            "año_vehiculo" => $this->input->post("inputEditarEdad"),
            "id_region" => $this->input->post("inputEditarRegion"),
            "chasis_vehiculo" => $this->input->post("inputEditarChasis"),
            "numeroMotor_vehiculo" => $this->input->post("inputEditarNumeroMotor"),
            "marca_vehiculo" => $this->input->post("inputEditarMarca"),
            "estado_vehiculo" => $this->input->post("inputEditarEstado"),
            "Tmantencion_vehiculo" => $this->input->post("inputEditarkilomentrosMantencion"),
        ];

        echo put_function($patente, $arrayVehiculo, "vehiculos/editarVehiculo");
    }

    public function cambiarEstadoVehiculo()
    {
        $patente = $this->input->post("inputPatenteVehiculo");
        $ArrayData = [
            "estado_vehiculo" => $this->input->post("inputEstado"),
            "kilometraje_vehiculo" => $this->input->post("kilometraje_vehiculo"),
            "kilometrosMantencion_vehiculo" => $this->input->post("kilometros_mantencion"),
        ];
        echo put_function($patente, $ArrayData, "vehiculos/cambiarEstadoVehiculo");
    }

    public function guardarFotoVehiculo()
    {

        $patente = $this->input->post("inputPatente");

        $file = 'inputFoto';
        $config['upload_path'] = "temp_files/";
        $config['allowed_types'] = "gif|jpg|jpeg|png";

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file)) {
            //*** ocurrio un error
            echo json_encode(array("success" => false, "msg" => $this->upload->display_errors()));
            return;
        }
        $img['uploadSuccess'] = $this->upload->data();

        $datafile = [
            [
                'name' => 'foto_vehiculo',
                'contents' => fopen($img['uploadSuccess']["full_path"], "r"),
                'filename' => $img['uploadSuccess']["file_name"],
            ],
        ];

        echo file_function($patente, $datafile, "vehiculos/cargarImagen");
        unlink($img['uploadSuccess']["full_path"]); //elimina las imagenes
    }
}