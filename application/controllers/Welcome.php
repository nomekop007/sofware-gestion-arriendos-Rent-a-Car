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
		# code...
	}

	public function cargaPanelGestion()
	{
		$this->load->view("templates/header");
		$this->load->view("content/navbars/navbar");
		$this->load->view("content/sidebars/sidebar_gestion");
		$this->load->view("content/view_module/views_gestion/index_gestion");
		$this->load->view("templates/footer");
	}

	public function cargaPanelAtencion()
	{
		$this->load->view("templates/header");
		$this->load->view("content/navbars/navbar");
		$this->load->view("content/sidebars/sidebar_atencion");
		$this->load->view("content/view_module/views_atencion/index_atencion");
		$this->load->view("templates/footer");
	}
	public function cargaPanelAdministrador()
	{
		$this->load->view("templates/header");
		$this->load->view("content/navbars/navbar");
		$this->load->view("content/sidebars/sidebar_administracion");
		$this->load->view("content/view_module/views_administracion/index_administracion");
		$this->load->view("templates/footer");
	}
}