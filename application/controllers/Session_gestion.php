<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session_gestion extends CI_Controller
{

    public function cargarModuloVehiculo()
    {
        $this->load->view("templates/header");
        $this->load->view("content/navbars/navbar");
        $this->load->view("content/sidebars/sidebar_gestion");
        $this->load->view('content/view_module/views_gestion/view_module_vehiculos');
        $this->load->view("templates/footer");
    }

    public function cargarModuloCliente()
    {
        $this->load->view("templates/header");
        $this->load->view("content/navbars/navbar");
        $this->load->view("content/sidebars/sidebar_gestion");
        $this->load->view('content/view_module/views_gestion/view_module_clientes');
        $this->load->view("templates/footer");
    }

    public function cargarModuloArriendo()
    {
        $this->load->view("templates/header");
        $this->load->view("content/navbars/navbar");
        $this->load->view("content/sidebars/sidebar_gestion");
        $this->load->view('content/view_module/views_gestion/view_module_arriendos');
        $this->load->view("templates/footer");
    }
}