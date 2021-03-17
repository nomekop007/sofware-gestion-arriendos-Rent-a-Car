<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reserva_controller extends CI_Controller
{
    public function cargarReservas()
    {
        $params = [
            "sucursal" => $this->session->userdata('sucursal'),
        ];
        echo get_function('reservas/cargarReservas', $params);
    }



    public function buscarReserva()
    {
        $id_reserva = $this->input->post('id_reserva');
        echo find_function($id_reserva, "reservas/buscarReserva");
    }



    public function registrarReserva()
    {
        $arrayData = [
            "id_sucursal" => $this->session->userdata('sucursal'),
            "titulo_reserva" =>  $this->input->post("titulo_reserva"),
            "descripcion_reserva" =>  $this->input->post("descripcion"),
            "inicio_reserva" =>  $this->input->post("fecha_inicio"),
            "color_reserva" => $this->input->post("color_reserva"),
            "fin_reserva" =>  $this->input->post("fecha_fin"),
            "patente_vehiculo" =>  $this->input->post("vehiculo"),
        ];
        if ($this->input->post("rut_cliente_reserva"))  $arrayData += ["reservasCliente" => [
            "rut_cliente" => $this->input->post("rut_cliente_reserva")
        ]];
        if ($this->input->post("rut_empresa_reserva"))  $arrayData += ["reservasEmpresa" => [
            "rut_empresa" => $this->input->post("rut_empresa_reserva")
        ]];
        echo post_function($arrayData, "reservas/registrarReserva");
    }



    public function editarReserva()
    {
        $id_reserva = $this->input->post("id_reserva");
        $arrayData = [];
        if ($this->input->post("vehiculo_mostrar")) $arrayData +=  ["patente_vehiculo" =>  $this->input->post("vehiculo_mostrar")];
        if ($this->input->post("fecha_inicio_mostrar")) $arrayData +=  ["inicio_reserva" =>  $this->input->post("fecha_inicio_mostrar")];
        if ($this->input->post("fecha_fin_mostrar")) $arrayData +=  ["fin_reserva" =>  $this->input->post("fecha_fin_mostrar")];
        if ($this->input->post("color_reserva_mostrar")) $arrayData +=  ["color_reserva" =>  $this->input->post("color_reserva_mostrar")];
        if ($this->input->post("descripcion_mostrar")) $arrayData +=  ["descripcion_reserva" =>  $this->input->post("descripcion_mostrar")];
        echo put_function($id_reserva, $arrayData, "reservas/editarReserva");
    }



    public function eliminarReserva()
    {
        $id_reserva = $this->input->post('id_reserva');
        echo delete_function($id_reserva, "reservas/eliminarReserva");
    }
}
