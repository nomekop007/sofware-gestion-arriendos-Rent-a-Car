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
            "nombre_usuario" => $this->input->post("inputNombreUsuario"),
            "estado_usuario" => true,
            "email_usuario" => $this->input->post("inputCorreoUsuario"),
            "clave_usuario" => $this->input->post("inputClaveUsuario"),
            "id_rol" => $this->input->post("inputRolUsuario"),
            "id_sucursal" => $this->input->post("inputSucursalUsuario"),
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

        $id_usuario = $this->input->post("inputUsuario");
        $ArrayData = [
            "userAt" => $nameUser,
            "nombre_usuario" => $this->input->post("inputEditNombreUsuario"),
            "email_usuario" => $this->input->post("inputEditCorreoUsuario"),
            "clave_usuario" => $this->input->post("inputEditClaveUsuario"),
            "id_rol" => $this->input->post("inputEditRolUsuario"),
            "id_sucursal" => $this->input->post("inputEditSucursalUsuario"),
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