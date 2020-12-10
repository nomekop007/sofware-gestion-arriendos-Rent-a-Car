<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PagoDanio_controller extends CI_Controller
{

    public function registrarPagoDanio()
    {
        $dataArray = [
            "precioTotal_pagoDanio" => $this->input->post("input_precio_pagoDanio"),
            "pagador_pagoDanio" => $this->input->post("input_pagador_pagoDanio"),
            "mecanico_pagoDanio" => $this->input->post("input_mecanico_pagoDanio"),
            "id_danioVehiculo" => $this->input->post("id_danioVehiculo"),
            "id_facturacion" => $this->input->post("id_facturacion"),
        ];
        echo post_function($dataArray, "pagosDanios/registrarPagoDanio");
    }

}