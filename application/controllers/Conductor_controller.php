<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Conductor_controller extends CI_Controller
{

	public function cargarConductores()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("conductores/cargarConductores", $tokenUser);
	}
	
	public function buscarConductor()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $rut_conductor = $this->input->post("rut_conductor");
        echo find_function($rut_conductor, "conductores/buscarConductor", $tokenUser);
    }
}