<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Accesorio_controller extends CI_Controller
{


    public function cargarAccesorios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("accesorios/cargarAccesorios", $tokenUser);
	}
	
	public function registrarArriendoAccesorios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $ArrayData = [
            "ArrayChecks" =>  json_decode($_POST['array']),
            "id_arriendo" => $this->input->post("idArriendo")
        ];
        echo post_function($ArrayData, "accesorios/registrarArriendoAccesorio", $tokenUser);
    }

}