//aqui se guarda el base64 del documento seleccionando
let base64_documento = null;


const buscarArriendo = async(id_arriendo, option) => {
    limpiarCampos();
    const data = new FormData();
    data.append("id_arriendo", id_arriendo);
    const response = await ajax_function(data, "buscar_arriendo");
    if (response.success) {
        const arriendo = response.data;
        // si es true carga modal confirmar ; false carga modal editar

        switch (option) {
            case 1:
                mostrarArriendoModalEditar(arriendo);
                break;
            case 2:
                mostrarArriendoModalPago(arriendo);
                break;
            case 3:
                $("#id_arriendo").val(arriendo.id_arriendo);
                $("#estado_arriendo").val(arriendo.estado_arriendo);
                mostrarContratoModalContrato(data);
                break;
        }
    }
    $("#formSpinnerPago").hide();
    $("#formSpinnerEditar").hide();
};

const mostrarArriendoModalEditar = (arriendo) => {
    $("#body_editarArriendo").show();
    $("#inputIdArriendoEditar").val(arriendo.id_arriendo);
    $("#numeroArriendoEditar").text("Nº" + arriendo.id_arriendo);
    $("#inputEditarTipoArriendo").val(arriendo.tipo_arriendo);
    $("#inputEditarEstadoArriendo").val(arriendo.estado_arriendo);
    $("#inputEditarConductorArriendo").val(
        arriendo.conductore.nombre_conductor +
        " " +
        arriendo.conductore.rut_conductor
    );
    $("#inputEditarVehiculoArriendo").val(
        arriendo.vehiculo.patente_vehiculo +
        " " +
        arriendo.vehiculo.modelo_vehiculo +
        "  " +
        arriendo.vehiculo.marca_vehiculo +
        " " +
        arriendo.vehiculo.año_vehiculo
    );
    $("#inputEditarKentradaArriendo").val(arriendo.kilometrosEntrada_arriendo);
    $("#inputEditarKsalidaArriendo").val(arriendo.kilometrosSalida_arriendo);
    $("#inputEditarKmantencionArriendo").val(
        arriendo.kilometrosMantencion_arriendo
    );
    $("#inputEditarFechaInicioArriendo").val(
        formatearFechaHora(arriendo.fechaEntrega_arriendo)
    );
    $("#inputEditarFechaFinArriendo").val(
        formatearFechaHora(arriendo.fechaRecepcion_arriendo)
    );
    $("#inputEditarCiudadEntregaArriendo").val(arriendo.ciudadEntrega_arriendo);
    $("#inputEditarCiudadRecepcionArriendo").val(
        arriendo.ciudadRecepcion_arriendo
    );
    $("#inputEditarDiasArriendo").val(arriendo.numerosDias_arriendo);
    $("#inputEditarUsuarioArriendo").val(arriendo.usuario.nombre_usuario);
    $("#inputEditarSucursal").val(arriendo.sucursale.nombre_sucursal);
    $("#inputEditarRegistroArriendo").val(formatearFechaHora(arriendo.createdAt));

    $("#card_carnet").show();
    $("#card_licencia").show();
    switch (arriendo.tipo_arriendo) {
        case "PARTICULAR":
            $("#card_domicilio").show();
            $("#inputEditarClienteArriendo").val(
                arriendo.cliente.nombre_cliente + " " + arriendo.cliente.rut_cliente
            );
            break;
        case "REMPLAZO":
            $("#card_cartaRemplazo").show();
            $("#card_domicilio").show();
            $("#inputEditarClienteArriendo").val(
                arriendo.remplazo.cliente.nombre_cliente +
                " " +
                arriendo.remplazo.cliente.rut_cliente
            );
            break;
        case "EMPRESA":
            $("#inputEditarClienteArriendo").val(
                arriendo.empresa.nombre_empresa + " " + arriendo.empresa.rut_empresa
            );
            break;
    }

    switch (arriendo.garantia.id_modoPago) {
        case 1:
            //EFECTIVO
            $("#nombre_garantia").html("EFECTIVO");
            $("#card_efectivo").show();
            break;
        case 2:
            //CHEQUE
            $("#nombre_garantia").html("CHEQUE");
            $("#card_cheque").show();
            break;
        case 3:
            //TARJETA
            $("#nombre_garantia").html("TARJETA");
            $("#card_tarjeta").show();
            break;
        default:
            break;
    }

    const url = storage + "documentos/requisitosArriendo/";

    if (arriendo.requisito) {
        if (arriendo.requisito.carnetFrontal_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.carnetFrontal_requisito;
            a.text = "Foto carnet frontal";
            a.target = "_blank";
            a.className = "badge badge-pill badge-info";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.carnetTrasera_requisito) {
            const a = document.createElement("a");
            a.text = "Foto carnet Trasera";
            a.href = url + arriendo.requisito.carnetTrasera_requisito;
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.cartaRemplazo_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.cartaRemplazo_requisito;
            a.text = "Foto carta de remplazo";
            a.target = "_blank";
            a.className = "badge badge-pill badge-info";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.chequeGarantia_requisito) {
            const a = document.createElement("a");
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            a.href = url + arriendo.requisito.chequeGarantia_requisito;
            a.text = "Foto cheque en garantia";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.comprobanteDomicilio_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.comprobanteDomicilio_requisito;
            a.text = "Foto comprobante de domicilio";
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.licenciaConducirFrontal_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.licenciaConducirFrontal_requisito;
            a.text = "Foto licencia de conducir frontal";
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            document.getElementById("card_documentos").append(a);
        }

        if (arriendo.requisito.licenciaConducirTrasera_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.licenciaConducirTrasera_requisito;
            a.text = "Foto licencia de conducir trasera";
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.tarjetaCredito_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.tarjetaCredito_requisito;
            a.text = "Foto tarjeta de credito";
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            document.getElementById("card_documentos").append(a);
        }
        if (arriendo.requisito.boletaEfectivo_requisito) {
            const a = document.createElement("a");
            a.href = url + arriendo.requisito.boletaEfectivo_requisito;
            a.text = "Foto comprobante efectivo";
            a.className = "badge badge-pill badge-info";
            a.target = "_blank";
            document.getElementById("card_documentos").append(a);
        }
        $("#verDocumentos").show();
        $("#ingresarDocumentos").hide();
    } else {
        $("#verDocumentos").hide();
        $("#ingresarDocumentos").show();
    }
};

const mostrarArriendoModalPago = (arriendo) => {
    if (arriendo.pagos == 0) {
        $("#formPagoArriendo").show();
        $("#numeroArriendoConfirmacion").text("Nº" + arriendo.id_arriendo);
        $("#inputIdArriendo").val(arriendo.id_arriendo);
        $("#inputPatenteVehiculo").val(arriendo.vehiculo.patente_vehiculo);
        $("#textTipo").html("Tipo de Arriendo: " + arriendo.tipo_arriendo);
        $("#textTipo").val(arriendo.tipo_arriendo);
        $("#textDias").html("Cantidad de Dias: " + arriendo.numerosDias_arriendo);
        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                $("#textCliente").html(arriendo.cliente.nombre_cliente);
                $("#textVehiculo").html(
                    "Vehiculo : " + arriendo.vehiculo.patente_vehiculo
                );
                break;
            case "REMPLAZO":
                $("#subtotal-copago").show();
                $("#textCliente").html(
                    arriendo.remplazo.cliente.nombre_cliente +
                    " - " +
                    arriendo.remplazo.nombreEmpresa_remplazo
                );
                $("#textVehiculo").html(
                    "Vehiculo : " + arriendo.vehiculo.patente_vehiculo
                );
                break;
            case "EMPRESA":
                $("#textCliente").html(arriendo.empresa.nombre_empresa);
                $("#textVehiculo").html(
                    "Vehiculo : " + arriendo.vehiculo.patente_vehiculo
                );
                break;
        }
        mostrarAccesorios(arriendo);
    }
};

const facturacion = (value) => {
    switch (value) {
        case "PENDIENTE":
            $("#metodo_pago").hide();
            break;
        case "BOLETA":
            $("#metodo_pago").show();
            break;
        case "FACTURA":
            $("#metodo_pago").show();
            break;
    }
};

const mostrarContratoModalContrato = async(data) => {
    const response = await ajax_function(data, "generar_PDFcontrato");
    if (response.success) {
        $("#formContratoArriendo").show();

        mostrarVisorPDF(response.data.base64, [
            "pdf_canvas_contrato",
            "page_count_contrato",
            "page_num_contrato",
            "prev_contrato",
            "next_contrato"
        ]);
        const a = document.getElementById("descargar_contrato");
        a.href = `data:application/pdf;base64,${response.data.base64}`;
        a.download = `contrato.pdf`;


        base64_documento = response.data.base64;

        if (response.data.firma) {
            $("#btn_confirmar_contrato").attr("disabled", false);
        }
    }
    $("#btn_firmar_contrato").attr("disabled", false);
    $("#spinner_btn_firmarContrato").hide();
    $("#formSpinnerContrato").hide();
};

const mostrarAccesorios = (arriendo) => {
    if (arriendo.accesorios.length) {
        $.each(arriendo.accesorios, (i, o) => {
            let precio = 0;
            if (o.precio_accesorio != null) {
                precio = o.precio_accesorio;
            }
            let fila = `
			<div class='input-group col-md-12'>
				<span style='width: 60%;' class='input-group-text form-control'>${o.nombre_accesorio} $</span>
				<input  style='width: 40%;' min='0' id='${o.nombre_accesorio}' maxLength='11' name='accesorios[]' 
				 value='${precio}'  oninput="this.value = soloNumeros(this) ;calcularValores()"
					type='number' class='form-control' required>
			</div>`;
            $("#formAccesorios").append(fila);
        });
    } else {
        let sinAccesorios =
            " <span class=' col-md-12 text-center' id='spanAccesorios'>Sin Accesorios</span>";
        $("#formAccesorios").append(sinAccesorios);
    }
};

const calcularValores = () => {
    //variables
    let valorArriendo = Number($("#inputValorArriendo").val());
    let valorCopago = Number($("#inputValorCopago").val());
    let iva = Number($("#inputIVA").val());
    let descuento = Number($("#inputDescuento").val());
    let total = Number($("#inputTotal").val());
    let TotalNeto = 0;
    //revisa todos los check y guardas sus valores en un array si estan okey
    let ArrayAccesorios = $('[name="accesorios[]"]')
        .map(function() {
            return this.value;
        })
        .get();
    for (let i = 0; i < ArrayAccesorios.length; i++) {
        const precioAccesorio = ArrayAccesorios[i];
        TotalNeto += Number(precioAccesorio);
    }
    TotalNeto = TotalNeto + valorArriendo - descuento - valorCopago;
    iva = TotalNeto * 0.19;
    total = TotalNeto + iva;
    $("#inputNeto").val(TotalNeto);
    $("#inputIVA").val(Math.round(iva));
    $("#inputTotal").val(Math.round(total));
};

const limpiarCampos = () => {
    mostrarCanvasFirma("canvas-firma", "limpiar-firma");

    $("#spinner_btn_subirDocumentos").hide();
    $("#spinner_btn_registrarPago").hide();
    $("#spinner_btn_firmarContrato").hide();
    $("#spinner_btn_confirmarContrato").hide();

    $("#formPagoArriendo").hide();
    $("#formContratoArriendo").hide();
    $("#body_editarArriendo").hide();

    $("#formPagoArriendo")[0].reset();
    $("#formSubirDocumentos")[0].reset();

    $("#numeroArriendoConfirmacion").text("");
    $("#numeroArriendoEditar").text("");
    $("#id_arriendo").val("");
    $("#card_documentos").empty();
    $("#formAccesorios").empty();

    $("#btn_confirmar_contrato").attr("disabled", true);

    $("#nombre_documento").val("");
    $("#subtotal-copago").hide();

    $("#formSpinnerPago").show();
    $("#formSpinnerEditar").show();
    $("#formSpinnerContrato").show();

    $("#card_carnet").hide();
    $("#card_domicilio").hide();
    $("#card_cartaRemplazo").hide();
    $("#card_licencia").hide();
    $("#card_tarjeta").hide();
    $("#card_cheque").hide();
    $("#card_efectivo").hide();

    $("#metodo_pago").hide();
    base64_documento = null;
};









//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {

    "geolocation" in navigator ? console.log("Yeih! habemus geolocalización") : alert("el navegador no soporta la geolocalización");

    const tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);

    $("#nav-arriendos-tab").click(() => refrescarTabla());


    const cargarArriendos = async() => {
        $("#spinner_tablaTotalArriendos").show();
        const response = await ajax_function(null, "cargar_arriendos");
        if (response.success) {
            $.each(response.data, (i, arriendo) => {
                cargarArriendoEnTabla(arriendo);
            });
        }
        $("#spinner_tablaTotalArriendos").hide();
    };

    $("#btn_subirDocumentos").click(() => {
        Swal.fire({
            title: "Estas seguro?",
            text: "estas a punto de guardar los cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async(result) => {
            if (result.isConfirmed) {
                $("#spinner_btn_subirDocumentos").show();
                $("#btn_subirDocumentos").attr("disabled", true);
                const id_arriendo = $("#inputIdArriendoEditar").val();
                const response = await guardarDocumentosRequistos(id_arriendo);
                if (response.success) {
                    refrescarTabla();
                    Swal.fire(
                        "documentos subidos con exito!",
                        "se guardaron los documentos",
                        "success"
                    );
                    $("#modal_editar_arriendo").modal("toggle");
                }
                $("#btn_subirDocumentos").attr("disabled", false);
                $("#spinner_btn_subirDocumentos").hide();
            }
        });
    });

    $("#btn_registrar_pago").click(() => {
        const tipo_arriendo = $("#textTipo").val();
        const tipoPago = $('[name="customRadio1"]:checked').val();
        const numeroFacturacion = $("#inputNumFacturacion").val().length;
        const totalNeto = $("#inputNeto").val();
        const inputFileFacturacion = $("#inputFileFacturacion")[0].files[0];
        if (tipo_arriendo == "PARTICULAR" || tipoPago != "PENDIENTE") {
            if (numeroFacturacion == 0 || $("#inputFileFacturacion").val().length == 0) {
                Swal.fire(
                    "debe ingresar el pago correspondiente",
                    "falta ingresar datos en el formulario",
                    "error"
                );
                return;
            }
        }
        if (totalNeto < 0) {
            Swal.fire(
                "Error en los totales",
                "corriga los totales del arriendo",
                "error"
            );
            return;
        }

        Swal.fire({
            title: "Estas seguro?",
            text: "estas a punto de guardar los cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async(result) => {
            if (result.isConfirmed) {
                $("#spinner_btn_registrarPago").show();
                $("#btn_registrar_pago").attr("disabled", true);

                const form = $("#formPagoArriendo")[0];
                const data = new FormData(form);
                data.append("digitador", $("#inputDigitador").val());

                if (numeroFacturacion > 0 && tipoPago != "PENDIENTE") {
                    const responseFac = await guardarDatosFactura(data);
                    if (responseFac.success) {
                        data.append("inputEstado", "PAGADO");
                        data.append("inputDocumento", inputFileFacturacion);
                        data.append(
                            "id_facturacion",
                            responseFac.facturacion.id_facturacion
                        );
                        await guardarDocumentoFactura(data);
                    }

                } else {
                    data.append("inputEstado", "PENDIENTE");
                }

                const response = await guardarDatosPago(data);
                if (response.success) {
                    data.append("id_pago", response.pago.id_pago);
                    const matrizAccesorios = await capturarAccesorios();
                    if (matrizAccesorios[0].length != 0) {
                        data.append("matrizAccesorios", JSON.stringify(matrizAccesorios));
                        await guardarDatosPagoAccesorios(data);
                    }
                    refrescarTabla();
                    Swal.fire(
                        "datos registrados con exito",
                        "se registraron los datos pertinentes!",
                        "success"
                    );
                }
                $("#btn_registrar_pago").attr("disabled", false);
                $("#spinner_btn_registrarPago").hide();
                $("#modal_pago_arriendo").modal("toggle");
            }
        });
    });

    $("#btn_firmar_contrato").click(() => {
        $("#btn_firmar_contrato").attr("disabled", true);
        $("#spinner_btn_firmarContrato").show();
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
        };
        navigator.geolocation.getCurrentPosition(
            (success = (pos) => {
                console.log(pos);
                const geo =
                    "LAT: " +
                    pos.coords.latitude +
                    " - LOG: " +
                    pos.coords.longitude +
                    " - STAMP: " +
                    pos.timestamp;
                firmarContrato(geo);
            }),
            (error = (err) => {
                console.log(err);
                alert("no se logro obtener la geolocalizacion , active manualmente");
                firmarContrato("no location");
            }),
            options
        );
    });

    $("#btn_confirmar_contrato").click(() => {
        Swal.fire({
            title: "Estas seguro?",
            text: "estas a punto de guardar los cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async(result) => {
            if (result.isConfirmed) {
                $("#spinner_btn_confirmarContrato").show();
                $("#btn_firmar_contrato").attr("disabled", true);
                $("#btn_confirmar_contrato").attr("disabled", true);

                const data = new FormData();
                data.append("id_arriendo", $("#id_arriendo").val());

                await guardarContrato(data);
                await enviarCorreoContrato(data);
                await cambiarEstadoArriendo(data);

                refrescarTabla();
                Swal.fire(
                    "Contrato Firmado!",
                    "contrato firmado y registrado con exito!",
                    "success"
                );
                $("#btn_firmar_contrato").attr("disabled", false);
                $("#btn_confirmar_contrato").attr("disabled", false);
                $("#spinner_btn_confirmarContrato").hide();
                $("#modal_firmar_contrato").modal("toggle");
            }
        });
    });

    const guardarDocumentoFactura = async(data) => {
        return await ajax_function(data, "guardar_documentoFacturacion");
    };

    const firmarContrato = (geo) => {
        const canvas = document.getElementById("canvas-firma");
        const data = new FormData();
        data.append("inputFirmaPNG", canvas.toDataURL("image/png"));
        data.append("geolocalizacion", geo);
        data.append("id_arriendo", $("#id_arriendo").val());
        mostrarContratoModalContrato(data);
    };

    const guardarContrato = async(data) => {
        data.append("base64", base64_documento);
        await ajax_function(data, "registrar_contrato");
    };

    const enviarCorreoContrato = async(data) => {
        await ajax_function(data, "enviar_correoContrato");
    };

    const cambiarEstadoArriendo = async(data) => {
        // si el arriendo es un arriendo extendido , se pasa directamente a arriendos activos
        if ($("#estado_arriendo").val() == "EXTENDIDO") {
            data.append("estado", "ACTIVO");
        } else {
            data.append("estado", "FIRMADO");
        }

        await ajax_function(data, "cambiarEstado_arriendo");
    };

    const guardarDocumentosRequistos = async(idArriendo) => {
        const data = new FormData();
        //ERROR A SUBIR IMAGENES de mas de 3mbs
        data.append("idArriendo", idArriendo);
        data.append("inputCarnetFrontal", $("#inputCarnetFrontal")[0].files[0]);
        data.append("inputCarnetTrasera", $("#inputCarnetTrasera")[0].files[0]);
        data.append("inputlicenciaFrontal", $("#inputlicenciaFrontal")[0].files[0]);
        data.append("inputlicenciaTrasera", $("#inputlicenciaTrasera")[0].files[0]);
        data.append("inputTarjeta", $("#inputTarjeta")[0].files[0]);
        data.append("inputCheque", $("#inputChequeGarantia")[0].files[0]);
        data.append("inputCartaRemplazo", $("#inputCartaRemplazo")[0].files[0]);
        data.append("inputBoletaEfectivo", $("#inputBoletaEfectivo")[0].files[0]);
        data.append(
            "inputComprobante",
            $("#inputComprobanteDomicilio")[0].files[0]
        );
        return await ajax_function(data, "registrar_requisitos");
    };

    const guardarDatosPago = async(data) => {
        return await ajax_function(data, "registrar_pago");
    };

    const guardarDatosPagoAccesorios = async(data) => {
        await ajax_function(data, "registrar_pagoAccesorios");
    };

    const capturarAccesorios = async() => {
        //cacturando los accesorios
        const matrizAccesorios = [];
        const arrayNombreAccesorios = [];
        const arrayValorAccesorios = [];
        const list = $('[name="accesorios[]"]');
        for (let i = 0; i < list.length; i++) {
            let element = list[i];
            arrayNombreAccesorios.push(element.id);
            arrayValorAccesorios.push(element.value);
        }
        matrizAccesorios.push(arrayNombreAccesorios);
        matrizAccesorios.push(arrayValorAccesorios);

        return matrizAccesorios;
    };

    const guardarDatosFactura = async(data) => {
        return await ajax_function(data, "registrar_facturacion");
    };

    const refrescarTabla = () => {
        //limpia la tabla
        tablaTotalArriendos.row().clear().draw(false);
        //carga nuevamente
        cargarArriendos();
    };

    const cargarArriendoEnTabla = (arriendo) => {
        try {
            let cliente = "";
            switch (arriendo.tipo_arriendo) {
                case "PARTICULAR":
                    cliente = `${arriendo.cliente.nombre_cliente}`;
                    break;
                case "REMPLAZO":
                    cliente = `${arriendo.remplazo.cliente.nombre_cliente}`;
                    break;
                case "EMPRESA":
                    cliente = `${arriendo.empresa.nombre_empresa}`;
                    break;
            }
            tablaTotalArriendos.row
                .add([
                    arriendo.id_arriendo,
                    cliente,
                    formatearFechaHora(arriendo.createdAt),
                    arriendo.tipo_arriendo,
                    arriendo.estado_arriendo,
                    arriendo.usuario.nombre_usuario,
                    `
                    <button id='a${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}'  onclick='buscarArriendo(this.value,1)' 
                        data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn-outline-primary'><i class='far fa-eye'></i></button>
                         
                        <button id='b${arriendo.id_arriendo}' value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,2)' 
                            data-toggle='modal' data-target='#modal_pago_arriendo' class='btn btn-outline-success'><i class="fas fa-money-bill-wave"></i></button> 
                     
                            <button id='c${arriendo.id_arriendo}'  value='${arriendo.id_arriendo}' onclick='buscarArriendo(this.value,3)' 
                                data-toggle='modal' data-target='#modal_firmar_contrato' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>  
                                `,
                ])
                .draw(false);

            if (arriendo.requisito) {
                $(`#a${arriendo.id_arriendo}`).removeClass("btn-outline-primary");
                $(`#a${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
            }

            if (!arriendo.requisito) {
                $(`#b${arriendo.id_arriendo}`).attr("disabled", true);
                $(`#b${arriendo.id_arriendo}`).removeClass("btn-outline-info");
                $(`#b${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
            }

            if (arriendo.pagos.length != 0) {
                $(`#b${arriendo.id_arriendo}`).attr("disabled", true);
                $(`#b${arriendo.id_arriendo}`).removeClass("btn-outline-success");
                $(`#b${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
            }

            if (arriendo.pagos.length == 0) {
                $(`#c${arriendo.id_arriendo}`).attr("disabled", true);
            }

            if (arriendo.estado_arriendo != "PENDIENTE" && arriendo.estado_arriendo != "EXTENDIDO") {
                $(`#c${arriendo.id_arriendo}`).attr("disabled", true);
                $(`#c${arriendo.id_arriendo}`).removeClass("btn-outline-info");
                $(`#c${arriendo.id_arriendo}`).addClass("btn-outline-secondary");
            }
        } catch (error) {
            console.log("error al cargar este arriendo: " + error);
        }
    };
});