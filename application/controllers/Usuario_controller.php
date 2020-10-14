<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_controller extends CI_Controller
{

    public function iniciarSesion()
    {
        $tokenUser = "no existe token";
        $arrayUser = [
            "email_usuario" => $this->input->post("correo"),
            "clave_usuario" => $this->input->post("clave")
        ];
        echo post_function($arrayUser, "usuarios/login", $tokenUser);
    }

    public function cargarUsuarios()
    {
        $tokenUser = $this->session->userdata('usertoken');
        echo get_function("usuarios/cargarUsuarios", $tokenUser);
    }

    public function registrarUsuario()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $ArrayData = [
            "userAt" => $nameUser,
            "nombre_usuario" => $this->input->post("nombre"),
            "estado_usuario" => true,
            "email_usuario" => $this->input->post("correo"),
            "clave_usuario" => $this->input->post("clave"),
            "id_rol" => $this->input->post("rol"),
            "id_sucursal" => $this->input->post("sucursal"),
        ];
        echo post_function($ArrayData, "usuarios/registrar", $tokenUser);
    }

    public function buscarUsuario()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $id_usuario = $this->input->post("id_usuario");
        echo find_function($id_usuario, "usuarios/buscarUsuario", $tokenUser);
    }

    public function editarUsuario()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $id_usuario = $this->input->post("id_usuario");
        $ArrayData = [
            "userAt" => $nameUser,
            "nombre_usuario" => $this->input->post("nombre"),
            "email_usuario" => $this->input->post("correo"),
            "clave_usuario" => $this->input->post("clave"),
            "id_rol" => $this->input->post("rol"),
            "id_sucursal" => $this->input->post("sucursal"),
        ];
        echo put_function($id_usuario, $ArrayData, "usuarios/editarUsuario", $tokenUser);
    }

    public function cambiarEstadoUsuario()
    {
        $tokenUser = $this->session->userdata('usertoken');
        $nameUser = $this->session->userdata('nombre');

        $id_usuario = $this->input->post("id_usuario");

        $ArrayData = [
            "userAt" => $nameUser,
            "accion" => $this->input->post("accion")
        ];
        echo put_function($id_usuario, $ArrayData, "usuarios/cambiarEstado", $tokenUser);
    }
}