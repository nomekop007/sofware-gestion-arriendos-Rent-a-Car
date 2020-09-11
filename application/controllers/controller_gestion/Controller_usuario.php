<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Controller_usuario extends CI_Controller
{
    public function cargarUsuarios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("usuarios/cargarUsuarios", $tokenUser);
    }

    public function cargarRoles()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("roles/cargarRoles", $tokenUser);
    }

    public function registrarUsuario()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $ArrayData = [
            "nombre_usuario" => $this->input->post("nombre"),
            "email_usuario" => $this->input->post("correo"),
            "clave_usuario" => $this->input->post("clave"),
            "id_rol" => $this->input->post("rol"),
            "id_sucursal" => $this->input->post("sucursal"),
        ];
        echo post_function($ArrayData, "usuarios/registrar", $tokenUser);
    }
}