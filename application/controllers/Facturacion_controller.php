<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Facturacion_controller extends CI_Controller
{

	public function cargarFacturaciones()
	{
		echo get_function("facturaciones/cargarFacturaciones");
	}

	public function registrarFacturacion()
	{
		$dataArray = [
			"tipo_facturacion" => $this->input->post("customRadio1"),
			"numero_facturacion" => $this->input->post("inputNumFacturacion"),
			"id_modoPago" => $this->input->post("customRadio2"),
		];
		echo post_function($dataArray, "facturaciones/registrarFacturacion");
	}

	public function guardarDocumentoFacturacion()
	{

		$id_facturacion =   $this->input->post("id_facturacion");

		$file = 'inputDocumento';
		$config['upload_path'] = "temp_files/";
		$config['allowed_types'] = "*";

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($file)) {
			//*** ocurrio un error
			echo json_encode(array("success" => false, "msg" => $this->upload->display_errors()));
			return;
		}
		$img['uploadSuccess'] = $this->upload->data();

		$datafile = [
			[
				'name'     => 'documento_facturacion',
				'contents' => fopen($img['uploadSuccess']["full_path"], "r"),
				'filename' => $img['uploadSuccess']["file_name"]
			],
		];

		echo file_function($id_facturacion, $datafile, "facturaciones/guardarDocumentoFacturacion");
		unlink($img['uploadSuccess']["full_path"]); //elimina el documento
	}
}