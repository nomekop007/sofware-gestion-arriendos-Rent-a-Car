<?php


defined('BASEPATH') or exit('No direct script access allowed');


class PagoArriendo_controller extends CI_Controller
{

	public function registrarPagoArriendo()
	{
		$dataArray = [
			"id_arriendo" => $this->input->post("inputIdArriendo"),
			"subtotal_pagoArriendo" => $this->input->post("inputValorArriendo"),
			"remplazo_pagoArriendo" => $this->input->post("inputValorCopago"),
			"neto_pagoArriendo" => $this->input->post("inputNeto"),
			"iva_pagoArriendo" => $this->input->post("inputIVA"),
			"descuento_pagoArriendo" => $this->input->post("inputDescuento"),
			"total_pagoArriendo" => $this->input->post("inputTotal"),
			"observaciones_pagoArriendo" => $this->input->post("inputObservaciones"),
			"digitador_pagoArriendo" => $this->input->post("digitador"),
		];
		echo post_function($dataArray, "pagosArriendos/registrarPagoArriendo");
	}
}