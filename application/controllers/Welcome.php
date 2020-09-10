<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Welcome extends CI_Controller
{



	public function index()
	{
		$this->load->view('inicio');
	}

	public function iniciarSesion()
	{
		$token = "no existe token";
		$arrayUser = [
			"email_usuario" => $this->input->post("correo"),
			"clave_usuario" => $this->input->post("clave")
		];
		echo post_function($arrayUser, "usuarios/login", $token);
	}

	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		redirect("/");
	}


	public function irPlataforma()
	{

		$arrayUser = [
			"estado" => true,
			"rol" => $this->input->post("id_rol"),
			"id" => $this->input->post("id_usuario"),
			"nombre" => $this->input->post("nombre_usuario"),
			"email" => $this->input->post("email_usuario"),
			"usertoken" => $this->input->post("userToken"),
		];

		$this->session->set_userdata($arrayUser);

		echo json_encode(array("msg" => "OK"));
	}

	//carga los paneles correspondientes
	public function cargarPanel()
	{
		if ($this->session->userdata("estado")) {
			$this->load->view("templates/header");
			$this->load->view("content/navbars/navbar");

			$opcion = $_GET["panel"];

			switch ($opcion) {
				case 1:
					$this->load->view("content/sidebars/sidebar_gestion");
					$this->load->view("content/view_module/views_gestion/index_gestion");
					break;
				case 2:
					$this->load->view("content/sidebars/sidebar_atencion");
					$this->load->view("content/view_module/views_atencion/index_atencion");
					break;
				case 3:
					$this->load->view("content/sidebars/sidebar_administracion");
					$this->load->view("content/view_module/views_administracion/index_administracion");
					break;

				default:
					redirect("/");
					break;
			}
			$this->load->view("templates/footer");
		} else {
			redirect("/");
		}
	}
}