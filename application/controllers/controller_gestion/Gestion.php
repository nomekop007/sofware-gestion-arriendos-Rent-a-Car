<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Gestion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("urls_helper");
    }


    public function cargarSucursales()
    {
        $client = new GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', api_url() . 'sucursales/cargarSucursales');
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo $response->getBody();
        });
        $promise->wait();
    }

    public function cargarVehiculos()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $client = new GuzzleHttp\Client();
        $request = $client->request('GET',  api_url() . 'vehiculos/cargarVehiculos', [
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }

    public function cargarUnVehiculo()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $patente = $this->input->post("patente");

        $client = new GuzzleHttp\Client();
        $request = $client->request('GET', api_url() . 'vehiculos/cargarUnVehiculo/' . $patente, [
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }


    public function registrarVehiculo()
    {
        $tokenUser = $this->session->userdata('usertoken');

        $arrayVehiculo = [
            "patente_vehiculo" => $this->input->post("patente"),
            "modelo_vehiculo" => $this->input->post("modelo"),
            "tipo_vehiculo" => $this->input->post("tipo"),
            "color_vehiculo" => $this->input->post("color"),
            "precio_vehiculo" => $this->input->post("precio"),
            "propietario_vehiculo" => $this->input->post("propietario"),
            "compra_vehiculo" => $this->input->post("compra"),
            "fechaCompra_vehiculo" => $this->input->post("fechaCompra"),
            "año_vehiculo" => $this->input->post("edad"),
            "id_sucursal" => $this->input->post("sucursal")
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', api_url() . 'vehiculos/registrarVehiculo', [
            'json' => $arrayVehiculo,
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);

        echo  $response->getBody();
    }
}