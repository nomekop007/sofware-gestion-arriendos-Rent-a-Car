<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arriendo_controller extends CI_Controller
{
    public function cargarArriendos()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => $this->input->post("filtro"),
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => $this->input->post("filtro"),
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        }
    }

    public function cargarArriendosEnProceso()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => $this->input->post("filtro"),
            ];
            echo get_function("arriendos/cargarArriendosEnproceso", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => $this->input->post("filtro"),
            ];
            echo get_function("arriendos/cargarArriendosEnproceso", $params);
        }
    }


    public function cargarArriendosDespachos()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => ["FIRMADO"],
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => ["FIRMADO"],
            ];
            echo get_function("arriendos/cargarArriendosActivos", $params);
        }
    }



    public function cargarArriendosActivos()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => null,
                "estado" => ["ACTIVO", "RECEPCIONADO"],
            ];
            echo get_function("arriendos/cargarArriendos", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
                "estado" => ["ACTIVO", "RECEPCIONADO"],
            ];
            echo get_function("arriendos/cargarArriendosActivos", $params);
        }
    }



    public function finalizarArriendosRecepcionados()
    {
        if (validarPermiso(10)) {
            $params = [
                "sucursal" => 0,
            ];
            echo get_function("arriendos/finalizarArriendosRecepcionados", $params);
        } else {
            $params = [
                "sucursal" => $this->session->userdata('sucursal'),
            ];
            echo get_function("arriendos/finalizarArriendosRecepcionados", $params);
        }
    }



    public function buscarArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "arriendos/buscarArriendo");
    }



    public function registrarArriendo()
    {
        $arrayForm = [
            "estado_arriendo" => "PENDIENTE",
            "tipo_arriendo" => $this->input->post("inputTipo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputCiudadEntrega"),
            "fechaEntrega_arriendo" => $this->input->post("inputFechaEntrega"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputCiudadRecepcion"),
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaRecepcion"),
            "diasActuales_arriendo" => $this->input->post("inputNumeroDias"),
            "diasAcumulados_arriendo" => $this->input->post("inputNumeroDias"),
            "kilometrosEntrada_arriendo" => $this->input->post("inputEntrada"),
            "kilometrosSalida_arriendo" => null,
            //foraneas
            "id_usuario" => $this->session->userdata('id'),
            "patente_vehiculo" => $this->input->post("select_vehiculos"),
            "id_sucursal" => $this->input->post('selectSucursal'),
            "id_remplazo" => $this->input->post("inputIdRemplazo"),
            "rut_cliente" => $this->input->post("inputRutCliente"),
            "rut_empresa" => $this->input->post("inputRutEmpresa"),
            "rut_conductor" => $this->input->post("inputRutConductor"),
            "rut_conductor2" => $this->input->post("inputRutConductor2"),
            "rut_conductor3" => $this->input->post("inputRutConductor3"),
        ];
        echo post_function($arrayForm, "arriendos/registrarArriendo");
    }



    public function cambiarEstadoArriendo()
    {
        $idArriendo = $this->input->post("id_arriendo");
        $salida = $this->input->post("kilometraje_salida");
        $ArrayData = ["estado_arriendo" => $this->input->post("estado")];
        if ($salida) {
            $ArrayData += ["kilometrosSalida_arriendo" => $salida];
        }
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }



    public function editarArriendo()
    {
        $idArriendo = $this->input->post("id_arriendo");
        $ArrayData = [
            "kilometrosEntrada_arriendo" => $this->input->post("inputEditarKentradaArriendo"),
            "ciudadEntrega_arriendo" => $this->input->post("inputEditarCiudadEntregaArriendo"),
            "fechaEntrega_arriendo" => $this->input->post("inputEditarFechaInicioArriendo"),
            "fechaRecepcion_arriendo" => $this->input->post("inputEditarFechaFinArriendo"),
            "ciudadRecepcion_arriendo" => $this->input->post("inputEditarCiudadRecepcionArriendo"),
            "diasActuales_arriendo" => $this->input->post("inputEditarDiasArriendo"),
            "diasAcumulados_arriendo" => $this->input->post("inputEditarDiasArriendo"),
            "patente_vehiculo" => $this->input->post("inputEditarVehiculoArriendo"),
        ];
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }



    public function extenderArriendo()
    {
        $idArriendo = $this->input->post("id_arriendo");
        $ArrayData = [
            "fechaRecepcion_arriendo" => $this->input->post("inputFechaExtender_extenderPlazo"),
            "diasActuales_arriendo" => $this->input->post("diasActuales"),
            "diasAcumulados_arriendo" => $this->input->post("diasAcumulados"),
        ];
        echo put_function($idArriendo, $ArrayData, "arriendos/cambiarEstadoArriendo");
    }



    public function enviarCorreoAtraso()
    {
        $params = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "nombre_cliente" => $this->input->post("nombre_cliente"),
            "correo_cliente" => $this->input->post("correo_cliente")
        ];
        echo get_function("arriendos/enviarCorreoAtraso", $params);
    }



    public function anularArriendo()
    {
        $ArrayData = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "motivo" => $this->input->post("motivo"),
        ];
        echo post_function($ArrayData, "arriendos/anularArriendo");
    }



    public function registrarContacto()
    {
        $arrayData = [
            "nombre_contacto" => $this->input->post("inputNombreContacto"),
            "domicilio_contacto" => $this->input->post("inputDomicilioContacto"),
            "numeroCasa_contacto" => $this->input->post("inputNumeroCasaContacto"),
            "ciudad_contacto" => $this->input->post("inputCiudadContacto"),
            "telefono_contacto" => $this->input->post("inputTelefonoContacto"),
            "id_arriendo" => $this->input->post("inputIdArriendo"),
        ];
        echo post_function($arrayData, "arriendos/registrarContacto");
    }



    public function registrarContrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "base64" => $this->input->post("base64"),
        ];
        echo post_function($dataArray, "arriendos/registrarContrato");
    }



    public function registrarExtencionContrato()
    {
        $dataArray = [
            "id_extencion" => $this->input->post("id_extencion"),
            "base64" => $this->input->post("base64"),
        ];
        echo post_function($dataArray, "arriendos/registrarExtencionContrato");
    }



    public function subirContrato()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        $arrayInput = ["inputContrato"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_arriendo, $arrayData, "arriendos/subirContrato");
    }



    public function subirExtencionContrato()
    {
        $id_extencion = $this->input->post("id_extencion");
        $arrayInput = ["inputContrato"];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_extencion, $arrayData, "arriendos/subirExtencionContrato");
    }



    public function generarPDFcontrato()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("id_arriendo"),
            "firmaClientePNG" => $this->input->post("inputFirmaClientePNG"),
            "firmaUsuarioPNG" => $this->input->post("inputFirmaUsuarioPNG"),
            "geolocalizacion" => $this->input->post("geolocalizacion"),
            "extension" => $this->input->post("extension"),
        ];
        echo post_function($dataArray, "arriendos/generarPDFcontrato");
    }



    public function generarPDFextencionContrato()
    {
        $dataArray = [
            "id_extencion" => $this->input->post("id_extencion"),
            "n_extencion" => $this->input->post("n_extencion"),
            "firmaClientePNG" => $this->input->post("inputFirmaClientePNG"),
            "firmaUsuarioPNG" => $this->input->post("inputFirmaUsuarioPNG"),
            "geolocalizacion" => $this->input->post("geolocalizacion"),
        ];
        echo post_function($dataArray, "arriendos/generarPDFextencion");
    }



    public function enviarCorreoContrato()
    {
        $arrayForm = [
            "id_arriendo" => $this->input->post("id_arriendo"),
        ];
        echo post_function($arrayForm, "arriendos/enviarCorreoContrato");
    }



    public function enviarCorreoContratoExtencion()
    {
        $arrayForm = [
            "id_extencion" => $this->input->post("id_extencion"),
        ];
        echo post_function($arrayForm, "arriendos/enviarCorreoContratoExtencion");
    }



    public function registrarExtencion()
    {
        $arrayData = [
            "patente_vehiculo" => $this->input->post("patente_vehiculo"),
            "id_arriendo" => $this->input->post("id_arriendo"),
            "id_pagoArriendo" => $this->input->post("id_pagoArriendo"),
            "dias_extencion" => $this->input->post("diasActuales"),
            "fechaInicio_extencion" => $this->input->post("fechaInicio"),
            "fechaFin_extencion" => $this->input->post("fechaFin"),
            "estado_extencion" => "SIN FIRMA"
        ];
        echo post_function($arrayData, "arriendos/registrarExtencion");
    }



    public function cargarExtenciones()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "arriendos/buscarExtencionesPorArriendo");
    }



    public function registrarGarantia()
    {
        $dataArray = [
            "id_arriendo" => $this->input->post("inputIdArriendo"),
            "folioTarjeta_garantia" => $this->input->post("inputFolioTarjeta"),
            "bancoCheque_garantia" => $this->input->post("inputBancoCheque"),
            "numeroTarjeta_garantia" => $this->input->post("inputNumeroTarjeta"),
            "fechaTarjeta_garantia" => $this->input->post("inputFechaTarjeta"),
            "codigoTarjeta_garantia" => $this->input->post("inputCodigoTarjeta"),
            "numeroCheque_garantia" => $this->input->post("inputNumeroCheque"),
            "codigoCheque_garantia" => $this->input->post("inputCodigoCheque"),
            "monto_garantia" => $this->input->post("inputAbono"),
            "id_modoPago" => $this->input->post("customRadio0"),
        ];
        echo post_function($dataArray, "arriendos/registrarGarantia");
    }



    public function guardarDocumentosRequistosArriendo()
    {
        $id_arriendo = $this->input->post("idArriendo");
        $arrayInput = [
            "inputlicenciaFrontal",
            "inputlicenciaTrasera",
            "inputCarnetFrontal",
            "inputCarnetTrasera",
            "inputCheque",
            "inputComprobante",
            "inputTarjeta",
            "inputCartaRemplazo",
            "inputBoletaEfectivo",
            "inputEstatuto",
            "inputRol",
            "inputVigencia",
            "inputCarpetaTributaria",
            "inputCartaAutorizacion"
        ];
        $arrayData = recorrerFicheros($arrayInput);
        echo file_function($id_arriendo, $arrayData, "arriendos/registrarRequisitoArriendo");
    }



    public function buscarRequisitoArriendo()
    {
        $id_arriendo = $this->input->post("id_arriendo");
        echo find_function($id_arriendo, "arriendos/buscarRequisitoArriendo");
    }
}
