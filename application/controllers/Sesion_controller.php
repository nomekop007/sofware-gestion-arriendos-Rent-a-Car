<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sesion_controller extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    public function cerrarSesion()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function crearSesion()
    {
        $arrayUser = [
            "estado" => $this->input->post("estado_usuario"),
            "rol" => $this->input->post("id_rol"),
            "sucursal" => $this->input->post("id_sucursal"),
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

        if ($this->session->userdata("estado") === "true") {
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
                    redirect(base_url());
                    break;
            }
            $this->load->view("templates/footer");
        } else if ($this->session->userdata("estado") === "false") {
            $this->load->view("errors/error_session");
        } else {
            redirect(base_url());
        }
    }

}