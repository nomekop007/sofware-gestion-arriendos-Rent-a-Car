<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session_gestion extends CI_Controller
{

    public function cargarModulos()
    {
        if ($this->session->userdata("estado")) {
            $this->load->view("templates/header");
            $this->load->view("content/navbars/navbar");
            $this->load->view("content/sidebars/sidebar_gestion");

            $opcion = $_GET["modulo"];
            switch ($opcion) {
                case 1:
                    $this->load->view('content/view_module/views_gestion/view_module_vehiculos');
                    break;
                case 2:
                    $this->load->view('content/view_module/views_gestion/view_module_clientes');
                    break;
                case 3:
                    $this->load->view('content/view_module/views_gestion/view_module_arriendos');
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