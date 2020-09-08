<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Controller_cliente extends CI_Controller
{
    public function cargarClientes()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $client = new GuzzleHttp\Client();
        $request = $client->request('GET',  api_url() . 'clientes/cargarClientes', [
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }


    public function cargarConductores()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $client = new GuzzleHttp\Client();
        $request = $client->request('GET',  api_url() . 'conductores/cargarConductores', [
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }


    public function cargarEmpresas()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $client = new GuzzleHttp\Client();
        $request = $client->request('GET',  api_url() . 'empresas/cargarEmpresas', [
            'headers' => [
                'usertoken' => $tokenUser
            ]
        ]);
        echo $request->getBody();
    }
}