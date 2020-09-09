<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Controller_arriendo extends CI_Controller
{

    public function cargarVehiculosPorSucursal()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $id_sucursal = $this->input->post("id_sucursal");
        echo find_function($id_sucursal, "sucursales/cargarVehiculos", $tokenUser);
    }


    public function cargarAccesorios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("accesorios/cargarAccesorios", $tokenUser);
    }

    public function cargarUnaEmpresa()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_empresa = $this->input->post("rut_empresa");
        echo find_function($rut_empresa, "empresas/cargarUnaEmpresa", $tokenUser);
    }


    public function cargarUnCliente()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_cliente = $this->input->post("rut_cliente");
        echo find_function($rut_cliente, "clientes/cargarUnCliente", $tokenUser);
    }


    public function cargarUnConductor()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_conductor = $this->input->post("rut_conductor");
        echo find_function($rut_conductor, "conductores/cargarUnConductor", $tokenUser);
    }


    public function registrarArriendo()
    {

        $tokenUser = $this->session->userdata('usertoken');
        $id_usuario = $this->session->userdata('id');

        $arrayForm = [
            //usuario auntenticado
            "id_usuario" => $id_usuario,

            //inputs arriendo
            "tipo_arriendo" => $this->input->post("inputTipo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputCiudadEntrega"),
            "fechaEntrega_arriendo" => $this->input->post("inputFechaEntrega"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputCiudadRecepcion"),
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaRecepcion"),
            "numerosDias_arriendo" => $this->input->post("inputNumeroDias"),

            //inputs cliente
            "rut_cliente" => $this->input->post("inputRutCliente"),
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

            //inputs conductor
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
            "inputOtros" => $this->input->post("inputOtros"),
        ];

        echo post_function($arrayForm, "arriendos/registrarArriendo", $tokenUser);

        //registrar documentos PENDIENTE
        /* 
        $config['upload_path'] = "uploads/";
        $config['allowed_types'] = "*";
        $config['max_size'] = "5000";
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        
        $ArrayData = ["inputDocCarnet", "inputDocConducir", "inputDocDomicilio", "inputDocCarnetEmpresa"];
        foreach ($ArrayData as $value) {
            if (!$this->upload->do_upload($value)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
            }
            //$data = array('upload_data' => $this->upload->data());
        }
         */
    }

    public function registrarArriendoAccesorios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $ArrayData = [
            "ArrayChecks" =>  json_decode($_POST['array']),
            "id_arriendo" => $this->input->post("idArriendo")
        ];
        echo post_function($ArrayData, "arriendos/registrarArriendoAccesorio", $tokenUser);
    }
}