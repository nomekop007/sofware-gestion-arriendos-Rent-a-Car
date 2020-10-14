<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Empresa_controller extends CI_Controller
{
    public function cargarEmpresas()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("empresas/cargarEmpresas", $tokenUser);
    }


    public function buscarEmpresa()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_empresa = $this->input->post("rut_empresa");
        echo find_function($rut_empresa, "empresas/buscarEmpresa", $tokenUser);
    }

    public function crearEmpresa()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $arrayData = [
            "userAt" => $nameUser,
            "rut_empresa" => $this->input->post("inputRutEmpresa"),
            "nombre_empresa" => $this->input->post("inputNombreEmpresa"),
            "direccion_empresa" => $this->input->post("inputDireccionEmpresa"),
            "ciudad_empresa" => $this->input->post("inputCiudadEmpresa"),
            "telefono_empresa" => $this->input->post("inputTelefonoEmpresa"),
            "correo_empresa" => $this->input->post("inputCorreoEmpresa"),
            "vigencia_empresa" => $this->input->post("inputVigencia"),
            "rol_empresa" => $this->input->post("inputRol"),
        ];
        echo post_function($arrayData, "empresas/registrarEmpresa", $tokenUser);
    }
}