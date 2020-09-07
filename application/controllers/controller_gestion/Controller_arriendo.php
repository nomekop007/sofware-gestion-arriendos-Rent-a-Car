<?php

use function GuzzleHttp\json_encode;

defined('BASEPATH') or exit('No direct script access allowed');

class Controller_arriendo extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $config['upload_path'] = "uploads/";
        $config['allowed_types'] = "*";
        $config['max_size'] = "5000";
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
    }


    public function cargarVehiculosPorSucursal()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $id_sucursal = $this->input->post("id_sucursal");

        $client = new GuzzleHttp\Client();
        $request = $client->request('POST', api_url() . 'sucursales/cargarVehiculos' . $id_sucursal, [
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }


    public function registrarArriendo()
    {

        $arrayForm = [

            //inputs arriendo
            "tipo_arriendo" => $this->input->post("inputTipo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputCiudadEntrega"),
            "fechaEntrega_arriendo" => $this->input->post("inputFechaEntrega"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputCiudadRecepcion"),
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaRecepcion"),
            "numerosDias_arriendo" => $this->input->post("inputNumeroDias"),

            //inputs cliente
            "rut_cliente" => $this->input->post("inputrutCliente"),
            "nombre_cliente" => $this->input->post("inputNombreCliente"),
            "direccion_cliente" => $this->input->post("inputDireccionCliente"),
            "ciudad_cliente" => $this->input->post("inputCiudadCliente"),
            "fechaNacimiento_cliente" => $this->input->post("inputFechaNacimiento"),
            "telefono_cliente" => $this->input->post("inputTelefonoCliente"),
            "correo_cliente" => $this->input->post("inputCorreoCliente"),

            // inputs empresa
            "rut_empresa" => $this->input->post("inputRutEmpresa"),
            "nombre_empresa" => $this->input->post("inputNombreEmpresa"),
            "direccion_empresa" => $this->input->post("inputDireccionEmpresa"),
            "ciudad_empresa" => $this->input->post("inputCiudadEmpresa"),
            "telefono_empresa" => $this->input->post("inputTelefonoEmpresa"),
            "correo_empresa" => $this->input->post("inputCorreoEmpresa"),
            "vigencia_empresa" => $this->input->post("inputVigencia"),
            "rol_empresa" => $this->input->post("inputRol"),

            //inputs coductor
            "rut_conductor" => $this->input->post("inputRutConductor"),
            "nombre_conductor" => $this->input->post("inputNombreConductor"),
            "telefono_conductor" => $this->input->post("inputTelefonoConductor"),
            "clase_conductor" => $this->input->post("inputClase"),
            "numero_conductor" => $this->input->post("inputNumero"),
            "vcto_conductor" => $this->input->post("inputVCTO"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidad"),
            "direccion_conductor" => $this->input->post("inputDireccion"),

            //inputs vehiculo
            "patente_vehiculo" => $this->input->post("select_vehiculos"),
            "kilometrosEntrada_arriendo" => $this->input->post("inputEntrada"),
            "box_traslado" => $this->input->post("box_traslado"),
            "box_dedicible" => $this->input->post("box_dedicible"),
            "box_bencina" => $this->input->post("box_bencina"),
            "box_enganche" => $this->input->post("box_enganche"),
            "box_silla" => $this->input->post("box_silla"),
            "box_pase" => $this->input->post("box_pase"),
            "box_rastreo" => $this->input->post("box_rastreo"),
            "inputOtros" => $this->input->post("inputOtros"),
        ];


        $ArrayData = ["inputDocCarnet", "inputDocConducir", "inputDocDomicilio", "inputDocCarnetEmpresa"];
        foreach ($ArrayData as $value) {
            if (!$this->upload->do_upload($value)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
            }
            //$data = array('upload_data' => $this->upload->data());
        }


        $tokenUser = $this->session->userdata('usertoken');

        $client = new GuzzleHttp\Client();
        $request = $client->request('POST', api_url() . 'arriendos/registrarArriendo', [
            'json' => $arrayForm,
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }
}