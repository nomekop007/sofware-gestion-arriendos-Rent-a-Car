<?php

function get_function($url, $tokenUser)
{
    $client = new GuzzleHttp\Client();
    $request = $client->request('GET',  api_url() . $url, [
        'headers' => [
            'usertoken' => $tokenUser
        ]
    ]);
    return $request->getBody();
}

function find_function($id, $url, $tokenUser)
{
    $client = new GuzzleHttp\Client();
    $request = $client->request('GET', api_url() . $url . "/" . $id, [
        'headers' => [
            'usertoken' => $tokenUser
        ]
    ]);
    return $request->getBody();
}


function post_function($data, $url, $tokenUser)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', api_url() . $url, [
        'json' => $data,
        'headers' => [
            'usertoken' => $tokenUser
        ]
    ]);
    return  $response->getBody();
}

function put_function($id, $url, $tokenUser)
{
    //pendiente
}

function delete_function($id, $url, $tokenUser)
{
    //pendiente
}