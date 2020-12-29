<?php

function api_url()
{
    return "http://localhost:3000/rentacar/";
}

function base_route()
{
    return "http://localhost/proyectos/rentacar/";
}

function client_url()
{
    $token = $_SESSION["usertoken"];
    return "http://localhost:4200/#/auth/" . $token;
}

function path_cert()
{
    return false;
}