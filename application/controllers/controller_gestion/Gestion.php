<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Gestion extends CI_Controller
{


    public function cargarSucursales()
    {
        $client = new GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', 'http://localhost:3000/rentacar/sucursales');
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo $response->getBody();
        });
        $promise->wait();
    }

    public function cargarVehiculos()
    {
        $client = new GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', 'http://localhost:3000/rentacar/vehiculos');
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo $response->getBody();
        });
        $promise->wait();
    }


    public function registrarVehiculo()
    {

        $arrayVehiculo = [
            "patente" => $this->input->post("patente"),
            "modelo" => $this->input->post("modelo"),
            "tipo" => $this->input->post("tipo"),
            "color" => $this->input->post("color"),
            "precio" => $this->input->post("precio"),
            "propietario" => $this->input->post("propietario"),
            "compra" => $this->input->post("compra"),
            "fechaCompra" => $this->input->post("fechaCompra"),
            "edad" => $this->input->post("edad"),
            "sucursal" => $this->input->post("sucursal")
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:3000/rentacar/addVehiculos', [
            'json' => $arrayVehiculo
        ]);
        $reason = $response->getReasonPhrase(); //OK

        echo json_encode(array("msg" =>  $reason));
    }
}