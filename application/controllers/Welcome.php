<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("urls_helper");
	}

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
		$response = $client->request('POST', api_url() . 'usuarios/login', [
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
				break;
			case 2:
				$this->session->set_userdata("Supervisor", $arrayUser);
				break;
			case 3:
				$this->session->set_userdata("Vendedor", $arrayUser);
				break;

			default:
				echo json_encode(array("msg" => "error"));
				break;
		}
		echo json_encode(array("msg" => "OK"));
	}

	//carga los paneles correspondientes
	public function cargarPanel()
	{
		if ($this->session->userdata("administrador")) {
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