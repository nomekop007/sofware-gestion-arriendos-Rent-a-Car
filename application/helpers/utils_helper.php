<?php

function borrarImagenes($arrayPath)
{
    foreach ($arrayPath as $i => $path) {
        unlink($path);
    }
}

//se cambia cada vez que se actualize los js
function version()
{
    // return time();
    return 16;
}