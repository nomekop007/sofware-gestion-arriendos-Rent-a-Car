<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modulo_controller extends CI_Controller
{

	public function cargarModulosGestion()
	{
		$rol =  $this->session->userdata("rol");

		if ($this->session->userdata("estado") === "true") {
			$this->load->view("templates/header");
			$this->load->view("content/navbars/navbar");
			$this->load->view("content/sidebars/sidebar_gestion");

			$opcion = $_GET["modulo"];
			switch ($opcion) {
				case 0:
					if ($rol == 1 || $rol == 2 || $rol == 3) {
						$this->load->view('perfil');
					} else {
						redirect(base_url());
					}
					break;
				case 1:
					if ($rol == 1 || $rol == 2) {
						$this->load->view('content/view_module/views_gestion/view_module_vehiculos');
					} else {
						redirect(base_url());
					}
					break;
				case 2:
					if ($rol == 1 || $rol == 2 || $rol == 3) {
						$this->load->view('content/view_module/views_gestion/view_module_clientes');
					} else {
						redirect(base_url());
					}
					break;
				case 3:
					if ($rol == 1 || $rol == 2 || $rol == 3) {
						//se subdivide por su gran tamaño
						$this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_header');
						$this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_registrar');
						$this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_todos');
						$this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_footer');
					} else {
						redirect(base_url());
					}
					break;
				case 4:
					if ($rol == 1 || $rol == 2 || $rol == 3) {
						//se subdivide por su gran tamaño
						$this->load->view('content/view_module/views_gestion/view_module_despachos/view_module_despachos_header');
						$this->load->view('content/view_module/views_gestion/view_module_despachos/view_module_despachos_despacho');
						$this->load->view('content/view_module/views_gestion/view_module_despachos/view_module_despachos_activos');
						$this->load->view('content/view_module/views_gestion/view_module_despachos/view_module_despachos_footer');
					} else {
						redirect(base_url());
					}
					break;
				case 5:
					if ($rol == 1) {
						$this->load->view('content/view_module/views_gestion/view_module_usuarios');
					} else {
						redirect(base_url());
					}
					break;
				default:
					redirect(base_url());
					break;
			}
			$this->load->view("templates/footer");
		} else {
			redirect(base_url());
		}
	}

	public function cargarModulosAtencion()
	{
		$rol =  $this->session->userdata("rol");

		if ($this->session->userdata("estado") === "true") {
			$this->load->view("templates/header");
			$this->load->view("content/navbars/navbar");
			$this->load->view("content/sidebars/sidebar_atencion");

			$opcion = $_GET["modulo"];
			switch ($opcion) {
				case 1:
					if ($rol == 1 || $rol == 2) {
						$this->load->view('content/view_module/views_atencion/view_module_facturacion');
					} else {
						redirect(base_url());
					}
					break;
				default:
					redirect(base_url());
					break;
			}
			$this->load->view("templates/footer");
		} else {
			redirect(base_url());
		}
	}
}