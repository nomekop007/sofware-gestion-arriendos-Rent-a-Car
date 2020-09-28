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



}