<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reserva_controller extends CI_Controller
{
    public function cargarReservas()
    {
        echo get_function('reservas/cargarReservas');
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
        $arrayData = $this->input->post(); // []
        echo put_function($id_reserva, $arrayData, "reservas/editarReserva");
    }

    public function eliminarReserva()
    {
        $id_reserva = $this->input->post('id_reserva');
        echo delete_function($id_reserva, "reservas/eliminarReserva");
    }
}
