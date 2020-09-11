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
                    //se subdivide por su gran tamaño
                    $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_header');
                    $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_registrar');
                    $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_activos');
                    $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_todos');
                    $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_footer');
                    break;
                case 4:
                    $this->load->view('content/view_module/views_gestion/view_module_usuarios');
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