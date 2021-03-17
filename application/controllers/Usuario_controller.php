<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_controller extends CI_Controller
{


	public function iniciarSesion()
	{
		$arrayUser = [
			"email_usuario" => $this->input->post("correo"),
			"clave_usuario" => $this->input->post("clave")
		];
		//el login no incluye token
		$client = new \GuzzleHttp\Client();
		$response = $client->request('POST', api_url() . "usuarios/login", [
			'verify' => path_cert(),
			'json' => $arrayUser
		]);
		echo  $response->getBody();
	}



	public function cargarUsuarios()
	{
		echo get_function("usuarios/cargarUsuarios");
	}



	public function registrarUsuario()
	{
		$ArrayData = [
			"nombre_usuario" => $this->input->post("inputNombreUsuario"),
			"estado_usuario" => true,
			"email_usuario" => $this->input->post("inputCorreoUsuario"),
			"clave_usuario" => $this->input->post("inputClaveUsuario"),
			"id_rol" => $this->input->post("inputRolUsuario"),
			"id_sucursal" => $this->input->post("inputSucursalUsuario"),
		];
		echo post_function($ArrayData, "usuarios/registrar");
	}



	public function buscarUsuario()
	{
		$id_usuario = $this->input->post("id_usuario");
		echo find_function($id_usuario, "usuarios/buscarUsuario");
	}



	public function editarUsuario()
	{
		$id_usuario = $this->input->post("inputUsuario");
		$ArrayData = [
			"nombre_usuario" => $this->input->post("inputEditNombreUsuario"),
			"email_usuario" => $this->input->post("inputEditCorreoUsuario"),
			"clave_usuario" => $this->input->post("inputEditClaveUsuario"),
			"id_rol" => $this->input->post("inputEditRolUsuario"),
			"id_sucursal" => $this->input->post("inputEditSucursalUsuario"),
		];
		echo put_function($id_usuario, $ArrayData, "usuarios/editarUsuario");
	}



	public function cambiarEstadoUsuario()
	{
		$id_usuario = $this->input->post("id_usuario");
		$ArrayData = [
			"accion" => $this->input->post("accion")
		];
		echo put_function($id_usuario, $ArrayData, "usuarios/cambiarEstado");
	}
}
