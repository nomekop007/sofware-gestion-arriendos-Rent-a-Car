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
        $arrayData = $this->input->post(); // []
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
