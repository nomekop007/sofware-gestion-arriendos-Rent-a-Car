<?php




function get_function($url)
{

    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new GuzzleHttp\Client();
    $request = $client->request('GET',  api_url() . $url, [
        'verify' => path_cert(),
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ]
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
        ]
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
        'json' => $data,
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ]
    ]);
    return  $response->getBody();
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
        'json' => $data,
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ]
    ]);
    return  $response->getBody();
}


function file_function($id, $data, $url)
{
    if (isset($_SESSION["usertoken"])) {
        $token = $_SESSION["usertoken"];
        $name = $_SESSION["nombre"];
    }
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', api_url() . $url . "/" . $id, [
        'verify' => path_cert(),
        'multipart' =>   $data,
        'headers' => [
            'usertoken' => $token,
            'userat' => $name,
        ]
    ]);
    return  $response->getBody();
}



function delete_function($id, $url)
{
    //pendiente
}