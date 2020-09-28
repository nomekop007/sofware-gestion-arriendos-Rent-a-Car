<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Sucursal_controller extends CI_Controller
{

	public function cargarSucursales()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo  get_function('sucursales/cargarSucursales', $tokenUser);
	}

	public function cargarVehiculosPorSucursal()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $id_sucursal = $this->input->post("id_sucursal");
        echo find_function($id_sucursal, "sucursales/cargarVehiculos", $tokenUser);
    }
	

}