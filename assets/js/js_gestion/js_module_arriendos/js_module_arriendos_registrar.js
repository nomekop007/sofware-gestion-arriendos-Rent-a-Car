$(document).ready(() => {
    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursal");
    //cargar vigencia Empresa (input)
    cargarOlder("inputVigencia");

    //select2 de los vehiculos
    $("#select_vehiculos").select2(lenguajeSelect2);

    //cargar accesorios
    (() => {
        const url = base_url + "cargar_accesorios";
        $.getJSON(url, (result) => {
            if (result.success) {
                $("#row_accesorios").empty();
                $.each(result.data, (i, o) => {
                    var fila = "<div class='form-check form-check-inline'>";
                    fila +=
                        "<input class='form-check-input' type='checkbox' name='checks[]' value='" +
                        o.id_accesorio +
                        "'>";
                    fila +=
                        "<label class='form-check-label' for='" +
                        o.id_accesorio +
                        "'>" +
                        o.nombre_accesorio +
                        "</label>";
                    fila += "</div>";
                    $("#row_accesorios").append(fila);
                });
            } else {
                console.log("ah ocurrido un error al cargar los accesorios");
            }
        });
    })();

    $("#btn_buscarCliente").click(() => {
        var rut_cliente = $("#inputRutCliente").val();
        if (rut_cliente.length != 0) {
            $("#spinner_cliente").show();
            $.getJSON({
                url: base_url + "buscar_cliente",
                type: "post",
                dataType: "json",
                data: { rut_cliente },
                success: (result) => {
                    $("#spinner_cliente").hide();
                    if (result.success) {
                        var c = result.data;
                        $("#inputNombreCliente").val(c.nombre_cliente);
                        $("#inputDireccionCliente").val(c.direccion_cliente);
                        $("#inputCiudadCliente").val(c.ciudad_cliente);
                        $("#inputFechaNacimiento").val(
                            c.fechaNacimiento_cliente ?
                            c.fechaNacimiento_cliente.substring(0, 10) :
                            null
                        );
                        $("#inputTelefonoCliente").val(c.telefono_cliente);
                        $("#inputEstadoCivil").val(c.estadoCivil_cliente);
                        $("#inputCorreoCliente").val(c.correo_cliente);
                    } else {
                        $("#inputNombreCliente").val("");
                        $("#inputDireccionCliente").val("");
                        $("#inputCiudadCliente").val("");

                        $("#inputTelefonoCliente").val("");
                        $("#inputCorreoCliente").val("");
                    }
                },
                error: () => {
                    $("#spinner_cliente").hide();
                    console.log("error");
                },
            });
        }
    });

    $("#btn_buscarEmpresa").click(() => {
        var rut_empresa = $("#inputRutEmpresa").val();
        if (rut_empresa.length != 0) {
            $("#spinner_empresa").show();
            $.getJSON({
                url: base_url + "buscar_empresa",
                type: "post",
                dataType: "json",
                data: { rut_empresa },
                success: (result) => {
                    $("#spinner_empresa").hide();
                    if (result.success) {
                        var c = result.data;
                        $("#inputNombreEmpresa").val(c.nombre_empresa);
                        $("#inputDireccionEmpresa").val(c.direccion_empresa);
                        $("#inputCiudadEmpresa").val(c.ciudad_empresa);
                        $("#inputTelefonoEmpresa").val(c.telefono_empresa);
                        $("#inputCorreoEmpresa").val(c.correo_empresa);
                        $("#inputVigencia").val(c.vigencia_empresa);
                        $("#inputRol").val(c.rol_empresa);
                    } else {
                        $("#inputNombreEmpresa").val("");
                        $("#inputDireccionEmpresa").val("");
                        $("#inputCiudadEmpresa").val("");
                        $("#inputTelefonoEmpresa").val("");
                        $("#inputCorreoEmpresa").val("");
                        $("#inputRol").val("");
                    }
                },
                error: () => {
                    $("#spinner_empresa").hide();
                    console.log("error");
                },
            });
        }
    });

    $("#btn_buscarConductor").click(() => {
        var rut_conductor = $("#inputRutConductor").val();
        if (rut_conductor.length != 0) {
            $("#spinner_conductor").show();

            $.getJSON({
                url: base_url + "buscar_conductor",
                type: "post",
                dataType: "json",
                data: { rut_conductor },
                success: (result) => {
                    $("#spinner_conductor").hide();
                    if (result.success) {
                        var c = result.data;
                        $("#inputNombreConductor").val(c.nombre_conductor);
                        $("#inputTelefonoConductor").val(c.telefono_conductor);
                        $("#inputClaseConductor").val(c.clase_conductor);
                        $("#inputNumeroConductor").val(c.numero_conductor);
                        $("#inputVCTOConductor").val(
                            c.vcto_conductor ? c.vcto_conductor.substring(0, 10) : null
                        );
                        $("#inputMunicipalidadConductor").val(c.municipalidad_conductor);
                        $("#inputDireccionConductor").val(c.direccion_conductor);
                    } else {
                        $("#inputNombreConductor").val("");
                        $("#inputTelefonoConductor").val("");
                        $("#inputNumero").val("");
                        $("#inputVCTO").val("");
                        $("#inputMunicipalidad").val("");
                        $("#inputDireccion").val("");
                    }
                },
                error: () => {
                    $("#spinner_conductor").hide();
                    console.log("error");
                },
            });
        }
    });

    $("#buscar_vehiculos").click(() => {
        var id_sucursal = $("#inputSucursal").val();
        $.ajax({
            url: base_url + "cargar_VehiculosPorSucursal",
            type: "post",
            dataType: "json",
            data: { id_sucursal },
            success: (result) => {
                $("#select_vehiculos").empty();
                if (result.data) {
                    const select = document.getElementById("select_vehiculos");
                    $.each(result.data.vehiculos, (i, o) => {
                        const option = document.createElement("option");
                        option.innerHTML =
                            "PATENTE: " +
                            o.patente_vehiculo +
                            " - MODELO: " +
                            o.marca_vehiculo +
                            " " +
                            o.modelo_vehiculo +
                            " " +
                            o.año_vehiculo;
                        option.value = o.patente_vehiculo;
                        select.appendChild(option);
                    });

                    $("#select_vehiculos").attr("disabled", false);
                }
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "A ocurrido un Error Contacte a informatica",
                });
            },
        });
    });

    $("#btn_crear_arriendo").click(async() => {
        //AQUI SE VALIDA EL FORMULARIO COMPLETO

        //datos arriendo
        var select_vehiculos = $("#select_vehiculos").val();
        var inputCiudadEntrega = $("#inputCiudadEntrega").val();
        var inputCiudadRecepcion = $("#inputCiudadRecepcion").val();
        var inputFechaRecepcion = $("#inputFechaRecepcion").val();
        var inputFechaEntrega = $("#inputFechaEntrega").val();
        var inputNumeroDias = $("#inputNumeroDias").val();
        var inputEntrada = $("#inputEntrada").val();
        var inputMantencion = $("#inputMantencion").val();

        //datos particular
        var inputRutCliente = $("#inputRutCliente").val();
        var inputNombreCliente = $("#inputNombreCliente").val();
        var inputTelefonoCliente = $("#inputTelefonoCliente").val();
        var inputCorreoCliente = $("#inputCorreoCliente").val();
        var inputDireccionCliente = $("#inputDireccionCliente").val();
        var inputCiudadCliente = $("#inputCiudadCliente").val();
        var inputFechaNacimiento = $("#inputFechaNacimiento").val();

        //datos empresa
        var inputRutEmpresa = $("#inputRutEmpresa").val();
        var inputNombreEmpresa = $("#inputNombreEmpresa").val();
        var inputTelefonoEmpresa = $("#inputTelefonoEmpresa").val();
        var inputCorreoEmpresa = $("#inputCorreoEmpresa").val();
        var inputDireccionEmpresa = $("#inputDireccionEmpresa").val();
        var inputCiudadEmpresa = $("#inputCiudadEmpresa").val();
        var inputRol = $("#inputRol").val();
        var inputVigencia = $("#inputVigencia").val();

        //datos remplazo
        var inputNombreRemplazo = $("#inputNombreRemplazo").val();

        //datos conductor
        var inputRutConductor = $("#inputRutConductor").val();
        var inputNombreConductor = $("#inputNombreConductor").val();
        var inputTelefonoConductor = $("#inputTelefonoConductor").val();
        var inputDireccionConductor = $("#inputDireccionConductor").val();
        var inputVCTOConductor = $("#inputVCTOConductor").val();
        var inputNumeroConductor = $("#inputNumeroConductor").val();
        var inputMunicipalidadConductor = $("#inputMunicipalidadConductor").val();

        //documentos requeridos
        var inputChequeGarantia = $("#inputChequeGarantia").val();
        var inputTarjetaFrontal = $("#inputTarjetaFrontal").val();
        var inputTarjetaTrasera = $("#inputTarjetaTrasera").val();
        var inputCarnetFrontal = $("#inputCarnetFrontal").val();
        var inputCarnetTrasera = $("#inputCarnetTrasera").val();
        var inputLicencia = $("#inputLicencia").val();
        var inputComprobanteDomicilio = $("#inputComprobanteDomicilio").val();
        var inputCartaRemplazo = $("#inputCartaRemplazo").val();

        var inputTipo = $("#inputTipo").val();

        //VALIDACIONES DE LOS DOCUMENTOS REQUERIDOS
        switch (inputTipo) {
            case "PARTICULAR":
                if (
                    inputCarnetFrontal.length == 0 ||
                    inputCarnetTrasera.length == 0 ||
                    inputComprobanteDomicilio.length == 0 ||
                    inputLicencia.length == 0
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "Faltan Documentacion del cliente!",
                    });
                    return;
                }
                break;
            case "REMPLAZO":
                if (
                    inputCarnetFrontal.length == 0 ||
                    inputCarnetTrasera.length == 0 ||
                    inputComprobanteDomicilio.length == 0 ||
                    inputCartaRemplazo.length == 0 ||
                    inputLicencia.length == 0
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "Faltan Documentacion! del cliente!",
                    });
                    return;
                }
                break;
            case "EMPRESA":
                if (
                    inputCarnetFrontal.length == 0 ||
                    inputCarnetTrasera.length == 0 ||
                    inputLicencia.length == 0
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "Faltan Documentacion! de la empresa ",
                    });
                    return;
                }
                break;
        }

        //VALDIACION DE LA GARANTIA
        if (
            inputChequeGarantia.length == 0 &&
            (inputTarjetaFrontal.length == 0 || inputTarjetaTrasera.length == 0)
        ) {
            Swal.fire({
                icon: "warning",
                title: "Es necesario la tarjeta o cheque como garantia! ",
            });
            return;
        }

        //VALIDACION DEL FORMULARIO ARRIENDO
        if (
            inputRutConductor.length != 0 &&
            inputNombreConductor.length != 0 &&
            inputTelefonoConductor.length != 0 &&
            inputDireccionConductor.length != 0 &&
            inputVCTOConductor.length != 0 &&
            inputNumeroConductor.length != 0 &&
            inputMunicipalidadConductor.length != 0 &&
            inputNumeroDias >= 0 &&
            inputCiudadEntrega.length != 0 &&
            inputFechaEntrega.length != 0 &&
            inputCiudadRecepcion.length != 0 &&
            inputFechaRecepcion.length != 0 &&
            inputEntrada.length != 0 &&
            inputMantencion.length != 0 &&
            select_vehiculos != null
        ) {
            $("#btn_crear_arriendo").attr("disabled", true);
            $("#spinner_btn_registrar").show();
            //SE VALIDA EL FORMULARIO POR TIPO DE ARRIENDO
            switch (inputTipo) {
                case "PARTICULAR":
                    if (
                        inputRutCliente.length != 0 &&
                        inputNombreCliente.length != 0 &&
                        inputTelefonoCliente.length != 0 &&
                        inputCorreoCliente.length != 0 &&
                        inputDireccionCliente.length != 0 &&
                        inputCiudadCliente.length != 0 &&
                        inputFechaNacimiento.length != 0
                    ) {
                        await guardarDatosCliente();
                        await guardarDatosConductor();
                        await guardarDatosArriendo();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Faltan datos del cliente en el formulario!",
                        });
                    }
                    break;
                case "REMPLAZO":
                    if (
                        inputRutCliente.length != 0 &&
                        inputNombreCliente.length != 0 &&
                        inputTelefonoCliente.length != 0 &&
                        inputCorreoCliente.length != 0 &&
                        inputDireccionCliente.length != 0 &&
                        inputCiudadCliente.length != 0 &&
                        inputFechaNacimiento.length != 0 &&
                        inputNombreRemplazo.length != 0
                    ) {
                        await guardarDatosCliente();
                        await guardarDatosRemplazo();
                        await guardarDatosConductor();
                        await guardarDatosArriendo();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Faltan datos de la empresa o cliente en el formulario!",
                        });
                    }
                    break;
                case "EMPRESA":
                    if (
                        inputRutEmpresa.length != 0 &&
                        inputNombreEmpresa.length != 0 &&
                        inputTelefonoEmpresa.length != 0 &&
                        inputCorreoEmpresa.length != 0 &&
                        inputDireccionEmpresa.length != 0 &&
                        inputVigencia.length != 0 &&
                        inputCiudadEmpresa.length != 0 &&
                        inputRol.length != 0
                    ) {
                        await guardarDatosEmpresa();
                        await guardarDatosConductor();
                        await guardarDatosArriendo();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Faltan datos de la empresa en el formulario!",
                        });
                    }
                    break;

                default:
                    console.log("algo paso");
                    break;
            }
            $("#btn_crear_arriendo").attr("disabled", false);
            $("#spinner_btn_registrar").hide();
        } else {
            Swal.fire({
                icon: "warning",
                title: "Faltan datos en el formulario!",
            });
        }
    });

    async function guardarDatosCliente() {
        var form = $("#form_registrar_arriendo")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "registrar_cliente");
    }

    async function guardarDatosEmpresa() {
        var form = $("#form_registrar_arriendo")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "registrar_empresa");
    }
    async function guardarDatosConductor() {
        var form = $("#form_registrar_arriendo")[0];
        var data = new FormData(form);
        await funAjaxGuardar(data, "registrar_conductor");
    }

    async function guardarDatosRemplazo() {
        var form = $("#form_registrar_arriendo")[0];
        var data = new FormData(form);
        await $.ajax({
            url: base_url + "registrar_remplazo",
            type: "post",
            dataType: "json",
            data: data,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            timeOut: false,
            success: (response) => {
                console.log("guardado! " + "registrar_remplazo");
                $("#inputIdRemplazo").val(response.id_remplazo);
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardaron algunos componentes en : " + " registrar_remplazo",
                    text: "A ocurrido un Error Contacte a informatica",
                });
            },
        });
    }

    async function guardarDocumentosRequistos(idArriendo) {
        //documentos requeridos
        var data = new FormData();
        data.append("idArriendo", idArriendo);
        data.append("inputCarnetFrontal", $("#inputCarnetFrontal")[0].files[0]);
        data.append("inputCarnetTrasera", $("#inputCarnetTrasera")[0].files[0]);
        data.append("inputTarjetaFrontal", $("#inputTarjetaFrontal")[0].files[0]);
        data.append("inputTarjetaTrasera", $("#inputTarjetaTrasera")[0].files[0]);
        data.append("inputLicencia", $("#inputLicencia")[0].files[0]);
        data.append("inputCheque", $("#inputChequeGarantia")[0].files[0]);
        data.append(
            "inputComprobante",
            $("#inputComprobanteDomicilio")[0].files[0]
        );
        await funAjaxGuardar(data, "registrar_requisitos");
    }

    async function guardarDatosAccesorios(idArriendo) {
        //revisa todos los check y guardas sus valores en un array si estan okey
        var checks = $('[name="checks[]"]:checked')
            .map(function() {
                return this.value;
            })
            .get();

        var data = new FormData();
        data.append("idArriendo", idArriendo);
        data.append("arrayAccesorios", JSON.stringify(checks));
        await funAjaxGuardar(data, "registrar_arriendoAccesorios");
    }

    async function guardarDatosArriendo() {
        var form = $("#form_registrar_arriendo")[0];
        var data = new FormData(form);
        await $.ajax({
            url: base_url + "registrar_arriendo",
            type: "post",
            dataType: "json",
            data: data,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            timeOut: false,
            success: async(response) => {
                if (response) {
                    console.log("guardado! " + "registrar_arriendo");
                    await guardarDocumentosRequistos(response.data.id_arriendo);
                    await guardarDatosAccesorios(response.data.id_arriendo);
                    await cambiarEstadoVehiculo(response.data.patente_vehiculo);
                    cargarArriendoEnTabla(response.data);

                    Swal.fire("Arriendo Registrado", response.msg, "success");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "error registrar arriendo",
                        text: response.msg,
                    });
                }
                limpiarCampos();
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardo el arriendo",
                    text: "A ocurrido un Error Contacte a informatica",
                });
            },
        });
    }

    async function cambiarEstadoVehiculo(patente) {
        var data = new FormData();
        data.append("inputPatenteVehiculo", patente);
        data.append("inputEstado", "RESERVADO");
        await funAjaxGuardar(data, "cambiarEstado_vehiculo");
    }

    function limpiarCampos() {
        $("#btn_crear_arriendo").attr("disabled", false);
        $("#spinner_btn_registrar").hide();
        $("#form_registrar_arriendo")[0].reset();
        $("#select_vehiculos").empty();
    }
});