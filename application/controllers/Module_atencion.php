<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module_atencion extends CI_Controller
{


    public function index()
    {
        $this->load->view('inicio');
    }
}