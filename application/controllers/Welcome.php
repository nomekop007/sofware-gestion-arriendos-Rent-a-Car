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
		$arrayUser = [
			"email_usuario" => $this->input->post("correo"),
			"clave_usuario" => $this->input->post("clave")
		];
		$client = new \GuzzleHttp\Client();
		$response = $client->request('POST', 'http://localhost:3000/rentacar/usuarios/login', [
			'json' => $arrayUser
		]);

		echo $response->getBody();
	}

	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		redirect("/");
	}

	public function irPlataforma()
	{


		$opcion = $this->input->post("id_rol");
		$arrayUser = [
			"rol" => $this->input->post("id_rol"),
			"nombre" => $this->input->post("nombre_usuario"),
			"email" => $this->input->post("email_usuario"),
			"usertoken" => $this->input->post("userToken"),
		];

		switch ($opcion) {
			case 1:
				$this->session->set_userdata("administrador", $arrayUser);
				echo json_encode(array("msg" => "OK"));
				break;
			case 2:
				$this->session->set_userdata("Supervisor", $arrayUser);
				echo json_encode(array("msg" => "OK"));
				break;
			case 3:
				$this->session->set_userdata("Vendedor", $arrayUser);
				echo json_encode(array("msg" => "OK"));
				break;

			default:
				echo json_encode(array("msg" => "error"));
				break;
		}
	}


	public function cargaPanelGestion()
	{
		if ($this->session->userdata("administrador")) {
			$this->load->view("templates/header");
			$this->load->view("content/navbars/navbar");
			$this->load->view("content/sidebars/sidebar_gestion");
			$this->load->view("content/view_module/views_gestion/index_gestion");
			$this->load->view("templates/footer");
		} else {
			redirect("/");
		}
	}

	public function cargaPanelAtencion()
	{
		if ($this->session->userdata("administrador")) {
			$this->load->view("templates/header");
			$this->load->view("content/navbars/navbar");
			$this->load->view("content/sidebars/sidebar_atencion");
			$this->load->view("content/view_module/views_atencion/index_atencion");
			$this->load->view("templates/footer");
		} else {
			redirect("/");
		}
	}
	public function cargaPanelAdministrador()
	{

		if ($this->session->userdata("administrador")) {
			$this->load->view("templates/header");
			$this->load->view("content/navbars/navbar");
			$this->load->view("content/sidebars/sidebar_administracion");
			$this->load->view("content/view_module/views_administracion/index_administracion");
			$this->load->view("templates/footer");
		} else {
			redirect("/");
		}
	}
}