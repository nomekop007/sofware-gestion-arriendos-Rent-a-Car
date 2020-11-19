<?php

function borrarImagenes($arrayPath)
{
    foreach ($arrayPath as $i => $path) {
        unlink($path);
    }
}
