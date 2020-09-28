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
                case 1:
                    if ($rol == 1 || $rol == 2) {
                        $this->load->view('content/view_module/views_gestion/view_module_vehiculos');
                    } else {
                        redirect(base_route());
                    }
                    break;
                case 2:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_gestion/view_module_clientes');
                    } else {
                        redirect(base_route());
                    }
                    break;
                case 3:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        //se subdivide por su gran tamaño
                        $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_header');
                        $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_registrar');
                        $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_activos');
                        $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_todos');
                        $this->load->view('content/view_module/views_gestion/view_module_arriendos/view_module_arriendos_footer');
                    } else {
                        redirect(base_route());
                    }
                    break;
                case 4:
                    if ($rol == 1) {
                        $this->load->view('content/view_module/views_gestion/view_module_usuarios');
                    } else {
                        redirect(base_route());
                    }
                    break;
                default:
                    redirect(base_route());
                    break;
            }
            $this->load->view("templates/footer");
        } else {
            redirect(base_route());
        }
    }
}