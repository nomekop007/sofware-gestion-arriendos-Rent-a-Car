<?php

function borrarImagenes($arrayPath)
{
	//deprecado...
	foreach ($arrayPath as $i => $path) {
		unlink($path);
	}
}


function recorrerFicheros($arrayInput)
{
	$arrayData = array();
	foreach ($arrayInput as $i => $name) {
		if (isset($_FILES[$name])) {
			if ($_FILES[$name]["name"] != null) {
				$filename = $_FILES[$name]['name'];
				$file = file_get_contents($_FILES[$name]["tmp_name"]);
				$arrayData[] = [
					'name' => $name,
					'contents' => $file,
					'filename' => $filename,
				];
			}
		}
	}
	return $arrayData;
}


//se cambia cada vez que se actualize los js
function version()
{
	// return time();
	return 81;
}