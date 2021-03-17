<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_controller extends CI_Controller
{


    public function cargarClientes()
    {
        echo get_function("clientes/cargarClientes");
    }



    public function buscarCliente()
    {
        $rut_cliente = $this->input->post("rut_cliente");
        echo find_function($rut_cliente, "clientes/buscarCliente");
    }



    public function crearCliente()
    {
        $arrayData = [
            "rut_cliente" => $this->input->post("inputRutCliente"),
            "nombre_cliente" => $this->input->post("inputNombreCliente"),
            "direccion_cliente" => $this->input->post("inputDireccionCliente"),
            "ciudad_cliente" => $this->input->post("inputCiudadCliente"),
            "fechaNacimiento_cliente" => $this->input->post("inputFechaNacimiento"),
            "telefono_cliente" => $this->input->post("inputTelefonoCliente"),
            "estadoCivil_cliente" => $this->input->post("inputEstadoCivil"),
            "correo_cliente" => $this->input->post("inputCorreoCliente"),
            "nacionalidad_cliente" => $this->input->post("inputNacionalidadCliente"),
            "comuna_cliente" => $this->input->post("inputComunaCliente"),
        ];
        echo post_function($arrayData, "clientes/registrarCliente");
    }



    public function modificarCliente()
    {
        $rut_cliente = $this->input->post("inputRutCliente");
        $arrayData = [
            "nombre_cliente" => $this->input->post("inputNombreCliente"),
            "estadoCivil_cliente" => $this->input->post("inputEstadoCivilCliente"),
            "nacionalidad_cliente" => $this->input->post("inputNacionalidadCliente"),
            "fechaNacimiento_cliente" => $this->input->post("inputNacimientoCliente"),
            "correo_cliente" => $this->input->post("inputCorreoCliente"),
            "telefono_cliente" => $this->input->post("inputTelefonoCliente"),
            "direccion_cliente" => $this->input->post("inputDireccionCliente"),
            "comuna_cliente" => $this->input->post("inputComunaCliente"),
            "ciudad_cliente" => $this->input->post("inputCiudadCliente"),
        ];
        echo put_function($rut_cliente, $arrayData, "clientes/editarCliente");
    }



    public function editarArchivosCliente()
    {
        $rut_cliente = $this->input->post("inputRutCliente");
        $arrayInput = ["inputCarnetTraseraCliente", "inputCarnetFrontalCliente"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($rut_cliente, $arrayData, "clientes/editarArchivos");
    }



    public function cargarConductores()
    {
        echo get_function("conductores/cargarConductores");
    }



    public function buscarConductor()
    {
        $rut_conductor = $this->input->post("rut_conductor");
        echo find_function($rut_conductor, "conductores/buscarConductor");
    }



    public function crearConductor()
    {
        $arrayData = [
            "rut_conductor" => $this->input->post("inputRutConductor"),
            "nombre_conductor" => $this->input->post("inputNombreConductor"),
            "telefono_conductor" => $this->input->post("inputTelefonoConductor"),
            "clase_conductor" => $this->input->post("inputClaseConductor"),
            "numero_conductor" => $this->input->post("inputNumeroConductor"),
            "vcto_conductor" => $this->input->post("inputVCTOConductor"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidadConductor"),
            "direccion_conductor" => $this->input->post("inputDireccionConductor"),
            "nacionalidad_conductor" => $this->input->post("inputNacionalidadConductor"),
        ];
        echo post_function($arrayData, "conductores/registrarConductor");
    }



    public function modificarConductor()
    {
        $rut_conductor = $this->input->post('inputRutConductor');
        $arrayData = [
            "nombre_conductor" => $this->input->post("inputNombreConductor"),
            "nacionalidad_conductor" => $this->input->post("inputNacionalidadConductor"),
            "telefono_conductor" => $this->input->post("inputTelefonoConductor"),
            "direccion_conductor" => $this->input->post("inputDireccionConductor"),
            "clase_conductor" => $this->input->post("inputClaseConductor"),
            "numero_conductor" => $this->input->post("inputNumeroConductor"),
            "vcto_conductor" => $this->input->post("inputVCTOConductor"),
            "municipalidad_conductor" => $this->input->post("inputMunicipalidadConductor"),
        ];
        echo put_function($rut_conductor, $arrayData, "conductores/editarConductor");
    }



    public function editarArchivosConductor()
    {
        $rut_conductor = $this->input->post('inputRutConductor');
        $arrayInput = ["inputlicenciaFrontalConductor", "inputlicenciaTraseraConductor"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($rut_conductor, $arrayData, "conductores/editarArchivos");
    }



    public function cargarEmpresas()
    {
        echo get_function("empresas/cargarEmpresas");
    }



    public function buscarEmpresa()
    {
        $rut_empresa = $this->input->post("rut_empresa");
        echo find_function($rut_empresa, "empresas/buscarEmpresa");
    }



    public function crearEmpresa()
    {
        $arrayData = [
            "rut_empresa" => $this->input->post("inputRutEmpresa"),
            "nombre_empresa" => $this->input->post("inputNombreEmpresa"),
            "direccion_empresa" => $this->input->post("inputDireccionEmpresa"),
            "ciudad_empresa" => $this->input->post("inputCiudadEmpresa"),
            "telefono_empresa" => $this->input->post("inputTelefonoEmpresa"),
            "correo_empresa" => $this->input->post("inputCorreoEmpresa"),
            "vigencia_empresa" => $this->input->post("inputVigencia"),
            "rol_empresa" => $this->input->post("inputRol"),
            "comuna_empresa" => $this->input->post("inputComunaEmpresa"),
        ];
        echo post_function($arrayData, "empresas/registrarEmpresa");
    }



    public function modificarEmpresa()
    {
        $rut_empresa = $this->input->post("inputRutEmpresa");
        $arrayData = [
            "nombre_empresa" => $this->input->post("inputNombreEmpresa"),
            "rol_empresa" => $this->input->post("inputRolEmpresa"),
            "vigencia_empresa" => $this->input->post("inputVigenciaEmpresa"),
            "direccion_empresa" => $this->input->post("inputDireccionEmpresa"),
            "correo_empresa" => $this->input->post("inputCorreoEmpresa"),
            "comuna_empresa" => $this->input->post("inputComunaEmpresa"),
            "ciudad_empresa" => $this->input->post("inputCiudadEmpresa"),
            "telefono_empresa" => $this->input->post("inputTelefonoEmpresa"),
        ];
        echo put_function($rut_empresa, $arrayData, "empresas/editarEmpresa");
    }



    public function editarArchivosEmpresa()
    {
        $rut_empresa = $this->input->post("inputRutEmpresa");
        $arrayInput = ["inputCarnetFrontalEmpresa", "inputCarnetTraseraEmpresa", "inputEstatuto", "inputDocumentotRol", "inputDocumentoVigencia"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($rut_empresa, $arrayData, "empresas/editarArchivos");
    }
}
