<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Empresa_controller extends CI_Controller
{
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
		$arrayInput = ["inputCarnetFrontalEmpresa","inputCarnetTraseraEmpresa","inputEstatuto","inputDocumentotRol","inputDocumentoVigencia"];
        $arrayData = recorrerFicheros($arrayInput);
		echo file_function($rut_empresa, $arrayData, "empresas/editarArchivos");
	}
}