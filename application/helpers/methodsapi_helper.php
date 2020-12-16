<?php

function get_function($url, $params = null)
{
    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new GuzzleHttp\Client();
    $request = $client->request('GET', api_url() . $url, [
        'query' => $params,
        'verify' => path_cert(),
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ],
        'timeout' => 10,
        'connect_timeout' => 10,
    ]);
    return $request->getBody();
}

function find_function($id, $url)
{
    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new GuzzleHttp\Client();
    $request = $client->request('GET', api_url() . $url . "/" . $id, [
        'verify' => path_cert(),
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ],
        'timeout' => 10,
        'connect_timeout' => 10,
    ]);
    return $request->getBody();
}

function post_function($data, $url)
{
    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', api_url() . $url, [
        'verify' => path_cert(),
        'json' => $data += ["userAt" => $name],
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ],
        'timeout' => 10,
        'connect_timeout' => 10,
    ]);
    return $response->getBody();
}

function put_function($id, $data, $url)
{
    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new \GuzzleHttp\Client();
    $response = $client->request('PUT', api_url() . $url . "/" . $id, [
        'verify' => path_cert(),
        'json' => $data += ["userAt" => $name],
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ],
        'timeout' => 10,
        'connect_timeout' => 10,
    ]);
    return $response->getBody();
}

function file_function($id, $formData, $url)
{
    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', api_url() . $url . "/" . $id, [
        'verify' => path_cert(),
        'multipart' => $formData,
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ],
        'timeout' => 10,
        'connect_timeout' => 10,
    ]);
    return $response->getBody();
}

function delete_function($id, $url)
{
    //pendiente
}