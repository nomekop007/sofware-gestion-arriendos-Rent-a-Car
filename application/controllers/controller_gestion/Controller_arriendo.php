<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Controller_arriendo extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("urls_helper");
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
}