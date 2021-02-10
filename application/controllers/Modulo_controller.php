<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modulo_controller extends CI_Controller
{


    public function cargarModulosAtencion()
    {
        $rol = $this->session->userdata("rol");
        if ($this->session->userdata("estado") === "true") {
            $this->load->view("templates/header");
            $this->load->view("content/navbars/navbar");
            $this->load->view("content/navbars/alert");
            $this->load->view("content/sidebars/sidebar_atencion");
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
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_atencion/view_clientes/view_tablas_clientes');
                        $this->load->view('content/view_module/views_atencion/view_clientes/view_modal_ver_clientes');
                        $this->load->view('content/view_module/views_atencion/view_clientes/view_modal_registrarCliente');
                        $this->load->view('content/view_module/views_atencion/view_clientes/view_modal_registrarEmpresa');
                        $this->load->view('content/view_module/views_atencion/view_clientes/view_modal_registrarConductor');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 2:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_header_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_registrar_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_tabla_arriendos');
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_modal_ver_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_modal_pago_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_modal_firma_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_arriendos/view_footer_arriendo');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 3:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_header_despacho');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_tabla_despacho');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_despachar_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_foto_despacho');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_firmaActa_despacho');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_firmaExtencion_despacho');


                        $this->load->view('content/view_module/views_atencion/view_despacho/view_tabla_recepcion');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_danio_recepcion');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_extender_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_recepcion_arriendo');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_modal_foto_recepcion');
                        $this->load->view('content/view_module/views_atencion/view_despacho/view_footer_despacho');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 4:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_atencion/view_reservas/view_module_reservas');
                        $this->load->view('content/view_module/views_atencion/view_reservas/view_modal_agregar_reserva');
                        $this->load->view('content/view_module/views_atencion/view_reservas/view_modal_mostrar_reserva');
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


    public function cargarModulosGestion()
    {
        $rol = $this->session->userdata("rol");
        if ($this->session->userdata("estado") === "true") {
            $this->load->view("templates/header");
            $this->load->view("content/navbars/navbar");
            $this->load->view("content/navbars/alert");
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
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_gestion/view_vehiculos/view_registrar_vehiculos');
                        $this->load->view('content/view_module/views_gestion/view_vehiculos/view_modal_editar_vehiculo');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 2:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_gestion/view_danioVehiculo/view_module_danioVehiculo');
                        $this->load->view('content/view_module/views_gestion/view_danioVehiculo/view_modal_subirComprobante');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 3:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_gestion/view_facturacion/view_module_facturacion');
                        $this->load->view('content/view_module/views_gestion/view_facturacion/view_modal_editarFactura');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 4:
                    if ($rol == 1) {
                        $this->load->view('content/view_module/views_gestion/view_usuarios/view_module_usuarios');
                        $this->load->view('content/view_module/views_gestion/view_usuarios/view_modal_editarUsuario');
                    } else {
                        redirect(base_url());
                    }
                    break;
                case 5:
                    if ($rol == 1 || $rol == 2 || $rol == 3) {
                        $this->load->view('content/view_module/views_gestion/view_pagoCliente/view_tabla_pagoCliente');
                        $this->load->view('content/view_module/views_gestion/view_pagoCliente/view_modal_pagoCliente');
                        $this->load->view('content/view_module/views_gestion/view_pagoCliente/view_modal_infoPago');
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
