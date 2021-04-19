<?php

function api_url()
{
    return "http://localhost:3000/rentacar/";
}

function path_url()
{
    return "http://localhost:3000/";
}


function base_route()
{
    return "http://localhost/proyectos/rentacar/";
}

function client_url()
{
    return "http://localhost:4200/#/auth/" . $_SESSION["usertoken"];
}

function path_cert()
{
    return false;
}
