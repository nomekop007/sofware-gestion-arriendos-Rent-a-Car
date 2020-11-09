//espiners de los forms cliente , conductor y empresa
$("#spinner_conductor").hide();
$("#spinner_cliente").hide();
$("#spinner_empresa").hide();
$("#spinner_btn_registrar").hide();
$("#spinner_btn_crearContrato").hide();
$("#card-tarjeta").hide();
$("#card-cheque").hide();

const tipoGarantia = (value) => {
    switch (value) {
        case "CHEQUE":
            $("#card-cheque").show();
            $("#foto_cheque").show();
            $("#card-tarjeta").hide();
            $("#card-abono").hide();
            break;
        case "TARJETA":
            $("#card-tarjeta").show();
            $("#card-abono").show();
            $("#foto_tarjeta").show();
            $("#card-cheque").hide();
            break;
        case "EFECTIVO":
            $("#card-abono").show();
            $("#card-cheque").hide();
            $("#card-tarjeta").hide();
            $("#card-cheque").hide();
            break;
    }
};

// Script para cambia el tab cliente de acuerdo al tipo de arriendo
(tipoArriendo = () => {
    const tipo = $("#inputTipo option:selected").val();
    switch (tipo) {
        case "PARTICULAR":
            $("#titulo_cliente").show();
            $("#form_cliente").show();
            $("#titulo_remplazo").hide();
            $("#form_remplazo").hide();
            $("#titulo_empresa").hide();
            $("#form_empresa").hide();
            $("#inputRutEmpresa").val("");
            break;
        case "REMPLAZO":
            $("#titulo_cliente").show();
            $("#form_cliente").show();
            $("#titulo_remplazo").show();
            $("#form_remplazo").show();
            $("#titulo_empresa").hide();
            $("#form_empresa").hide();
            $("#inputRutEmpresa").val("");
            break;
        case "EMPRESA":
            $("#titulo_empresa").show();
            $("#form_empresa").show();
            $("#titulo_remplazo").hide();
            $("#form_remplazo").hide();
            $("#titulo_cliente").hide();
            $("#form_cliente").hide();
            $("#inputRutCliente").val("");
            break;
    }
})();

const calcularDias = () => {
    let fechaEntrega = $("#inputFechaEntrega").val();
    let fechaRecepcion = $("#inputFechaRecepcion").val();

    let fechaini = new Date(fechaEntrega);
    let fechafin = new Date(fechaRecepcion);
    let diasdif = fechafin.getTime() - fechaini.getTime();
    let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
    $("#inputNumeroDias").val(dias);
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursal");
    //cargar vigencia Empresa (input)
    cargarOlder("inputVigencia");

    //select2 de los vehiculos
    $("#select_vehiculos").select2(lenguajeSelect2);

    //cargar accesorios
    (cargarAccesorios = async() => {
        const response = await ajax_function(null, "cargar_accesorios");
        if (response.success) {
            $("#row_accesorios").empty();
            $.each(response.data, (i, o) => {
                let fila = `
                <div class='form-check form-check-inline'>
                <input class='form-check-input' type='checkbox' name='checks[]' value='${o.id_accesorio}'>
                <label class='form-check-label' for='${o.id_accesorio}'>
                    ${o.nombre_accesorio}
                </label>
                </div>`;
                $("#row_accesorios").append(fila);
            });
        }
    })();

    $("#btn_buscarCliente").click(async() => {
        const data = new FormData();
        const rut_cliente = $("#inputRutCliente").val();
        data.append("rut_cliente", rut_cliente);
        if (rut_cliente.length != 0) {
            $("#spinner_cliente").show();
            const response = await ajax_function(data, "buscar_cliente");
            if (response.success) {
                if (response.data) {
                    const c = response.data;
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
            }
            $("#spinner_cliente").hide();
        }
    });

    $("#btn_buscarEmpresa").click(async() => {
        const data = new FormData();
        const rut_empresa = $("#inputRutEmpresa").val();
        data.append("rut_empresa", rut_empresa);
        if (rut_empresa.length != 0) {
            $("#spinner_empresa").show();
            const response = await ajax_function(data, "buscar_empresa");
            if (response.success) {
                if (response.data) {
                    const c = response.data;
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
            }
            $("#spinner_empresa").hide();
        }
    });

    $("#btn_buscarConductor").click(async() => {
        const data = new FormData();
        const rut_conductor = $("#inputRutConductor").val();
        data.append("rut_conductor", rut_conductor);
        if (rut_conductor.length != 0) {
            $("#spinner_conductor").show();
            const response = await ajax_function(data, "buscar_conductor");
            if (response.success) {
                if (response.data) {
                    const c = response.data;
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
                    $("#inputNumeroConductor").val("");
                    $("#inputVCTOConductor").val("");
                    $("#inputMunicipalidadConductor").val("");
                    $("#inputDireccionConductor").val("");
                }
            }
            $("#spinner_conductor").hide();
        }
    });

    $("#buscar_vehiculos").click(async() => {
        const data = new FormData();
        data.append("inputSucursal", $("#inputSucursal").val());
        const response = await ajax_function(data, "cargar_VehiculosPorSucursal");
        if (response.success) {
            $("#select_vehiculos").empty();
            if (response.data) {
                const select = document.getElementById("select_vehiculos");
                $.each(response.data.vehiculos, (i, o) => {
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
        }
    });

    $("#btn_crear_arriendo").click(async() => {
        //AQUI SE VALIDAN TODOS LOS CAMPOS
        //datos arriendo
        const select_vehiculos = $("#select_vehiculos").val();
        const inputCiudadEntrega = $("#inputCiudadEntrega").val();
        const inputCiudadRecepcion = $("#inputCiudadRecepcion").val();
        const inputFechaRecepcion = $("#inputFechaRecepcion").val();
        const inputFechaEntrega = $("#inputFechaEntrega").val();
        const inputNumeroDias = $("#inputNumeroDias").val();
        const inputEntrada = $("#inputEntrada").val();
        const inputMantencion = $("#inputMantencion").val();

        //datos particular
        const inputRutCliente = $("#inputRutCliente").val();
        const inputNombreCliente = $("#inputNombreCliente").val();
        const inputTelefonoCliente = $("#inputTelefonoCliente").val();
        const inputCorreoCliente = $("#inputCorreoCliente").val();
        const inputDireccionCliente = $("#inputDireccionCliente").val();
        const inputCiudadCliente = $("#inputCiudadCliente").val();
        const inputFechaNacimiento = $("#inputFechaNacimiento").val();

        //datos empresa
        const inputRutEmpresa = $("#inputRutEmpresa").val();
        const inputNombreEmpresa = $("#inputNombreEmpresa").val();
        const inputTelefonoEmpresa = $("#inputTelefonoEmpresa").val();
        const inputCorreoEmpresa = $("#inputCorreoEmpresa").val();
        const inputDireccionEmpresa = $("#inputDireccionEmpresa").val();
        const inputCiudadEmpresa = $("#inputCiudadEmpresa").val();
        const inputRol = $("#inputRol").val();
        const inputVigencia = $("#inputVigencia").val();

        //datos remplazo
        const inputNombreRemplazo = $("#inputNombreRemplazo").val();

        //datos conductor
        const inputRutConductor = $("#inputRutConductor").val();
        const inputNombreConductor = $("#inputNombreConductor").val();
        const inputTelefonoConductor = $("#inputTelefonoConductor").val();
        const inputDireccionConductor = $("#inputDireccionConductor").val();
        const inputVCTOConductor = $("#inputVCTOConductor").val();
        const inputNumeroConductor = $("#inputNumeroConductor").val();
        const inputMunicipalidadConductor = $("#inputMunicipalidadConductor").val();

        //datos garantia
        const inputNumeroCheque = $("#inputNumeroCheque").val();
        const inputCodigoCheque = $("#inputCodigoCheque").val();
        const inputNumeroTarjeta = $("#inputNumeroTarjeta").val();
        const inputFechaTarjeta = $("#inputFechaTarjeta").val();
        const inputCodigoTarjeta = $("#inputCodigoTarjeta").val();
        const inputAbono = $("#inputAbono").val();

        const inputTipoGarantia = $("input:radio[name=customRadio0]:checked").val();
        const inputTipoArriendo = $("#inputTipo").val();

        //VALIDACION DE LA GARANTIA
        switch (inputTipoGarantia) {
            case "CHEQUE":
                if (inputNumeroCheque.length == 0 || inputCodigoCheque.length == 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "Faltan datos de cheque en garantia ",
                    });
                    return;
                }
                break;
            case "TARJETA":
                if (
                    inputNumeroTarjeta.length == 0 ||
                    inputFechaTarjeta.length == 0 ||
                    inputCodigoTarjeta.length == 0 ||
                    inputAbono.length == 0
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "Faltan datos de tarjeta en garantia ",
                    });
                    return;
                }
                break;
            case "EFECTIVO":
                if (inputAbono.length == 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "Faltan datos de Abono en garantia ",
                    });
                    return;
                }
                break;
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
            switch (inputTipoArriendo) {
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
                        let response = await guardarDatosCliente();
                        if (response.success) {
                            response = await guardarDatosConductor();
                            if (response.success) {
                                await guardarDatosArriendo(null);
                            }
                        }
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
                        let response = await guardarDatosCliente();
                        if (response.success) {
                            response = await guardarDatosConductor();
                            if (response.success) {
                                response = await guardarDatosRemplazo();
                                if (response.success) {
                                    const id_remplazo = response.data.id_remplazo;
                                    await guardarDatosArriendo(id_remplazo);
                                }
                            }
                        }
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
                        let response = await guardarDatosEmpresa();
                        if (response.success) {
                            response = await guardarDatosConductor();
                            if (response.success) {
                                await guardarDatosArriendo(null);
                            }
                        }
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Faltan datos de la empresa en el formulario!",
                        });
                    }
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

    const guardarDatosCliente = async() => {
        const data = new FormData();
        data.append("inputRutCliente", $("#inputRutCliente").val());
        data.append("inputNombreCliente", $("#inputNombreCliente").val());
        data.append("inputDireccionCliente", $("#inputDireccionCliente").val());
        data.append("inputCiudadCliente", $("#inputCiudadCliente").val());
        data.append("inputFechaNacimiento", $("#inputFechaNacimiento").val());
        data.append("inputTelefonoCliente", $("#inputTelefonoCliente").val());
        data.append("inputEstadoCivil", $("#inputEstadoCivil").val());
        data.append("inputCorreoCliente", $("#inputCorreoCliente").val());
        return await ajax_function(data, "registrar_cliente");
    };

    const guardarDatosEmpresa = async() => {
        const data = new FormData();
        data.append("inputRutEmpresa", $("#inputRutEmpresa").val());
        data.append("inputNombreEmpresa", $("#inputNombreEmpresa").val());
        data.append("inputDireccionEmpresa", $("#inputDireccionEmpresa").val());
        data.append("inputCiudadEmpresa", $("#inputCiudadEmpresa").val());
        data.append("inputTelefonoEmpresa", $("#inputTelefonoEmpresa").val());
        data.append("inputCorreoEmpresa", $("#inputCorreoEmpresa").val());
        data.append("inputVigencia", $("#inputVigencia").val());
        data.append("inputRol", $("#inputRol").val());
        return await ajax_function(data, "registrar_empresa");
    };
    const guardarDatosConductor = async() => {
        const data = new FormData();
        data.append("inputRutConductor", $("#inputRutConductor").val());
        data.append("inputNombreConductor", $("#inputNombreConductor").val());
        data.append("inputTelefonoConductor", $("#inputTelefonoConductor").val());
        data.append("inputClaseConductor", $("#inputClaseConductor").val());
        data.append("inputNumeroConductor", $("#inputNumeroConductor").val());
        data.append("inputVCTOConductor", $("#inputVCTOConductor").val());
        data.append(
            "inputMunicipalidadConductor",
            $("#inputMunicipalidadConductor").val()
        );
        data.append("inputDireccionConductor", $("#inputDireccionConductor").val());
        return await ajax_function(data, "registrar_conductor");
    };

    const guardarDatosRemplazo = async() => {
        const data = new FormData();
        data.append("inputNombreRemplazo", $("#inputNombreRemplazo").val());
        data.append("inputRutCliente", $("#inputRutCliente").val());
        return await ajax_function(data, "registrar_remplazo");
    };

    const guardarDatosArriendo = async(id_remplazo) => {
        const data = new FormData();
        data.append("inputTipo", $("#inputTipo").val());
        data.append("inputCiudadEntrega", $("#inputCiudadEntrega").val());
        data.append("inputFechaEntrega", $("#inputFechaEntrega").val());
        data.append("inputCiudadRecepcion", $("#inputCiudadRecepcion").val());
        data.append("inputFechaRecepcion", $("#inputFechaRecepcion").val());
        data.append("inputNumeroDias", $("#inputNumeroDias").val());
        data.append("inputEntrada", $("#inputEntrada").val());
        data.append("inputMantencion", $("#inputMantencion").val());
        data.append("inputOtros", $("#inputOtros").val());
        data.append("select_vehiculos", $("#select_vehiculos").val());
        data.append("inputIdRemplazo", id_remplazo);
        data.append("inputRutCliente", $("#inputRutCliente").val());
        data.append("inputRutEmpresa", $("#inputRutEmpresa").val());
        data.append("inputRutConductor", $("#inputRutConductor").val());

        const response = await ajax_function(data, "registrar_arriendo");

        if (response.success) {
            await guardarDatosAccesorios(response.data.id_arriendo);
            await guardarDatosGarantia(response.data.id_arriendo);
            await cambiarEstadoVehiculo(response.data.patente_vehiculo);
            Swal.fire("Arriendo Registrado", response.msg, "success");
            limpiarCampos();
        }
    };

    const guardarDatosAccesorios = async(idArriendo) => {
        //revisa todos los check y guardas sus valores en un array si estan okey
        const checks = $('[name="checks[]"]:checked')
            .map(function() {
                return this.value;
            })
            .get();

        const data = new FormData();
        data.append("idArriendo", idArriendo);
        data.append("arrayAccesorios", JSON.stringify(checks));
        await ajax_function(data, "registrar_arriendoAccesorios");
    };

    const guardarDatosGarantia = async(idArriendo) => {
        const data = new FormData();
        data.append("inputIdArriendo", idArriendo);
        data.append("inputNumeroTarjeta", $("#inputNumeroTarjeta").val());
        data.append("inputFechaTarjeta", $("#inputFechaTarjeta").val());
        data.append("inputCodigoTarjeta", $("#inputCodigoTarjeta").val());
        data.append("inputNumeroCheque", $("#inputNumeroCheque").val());
        data.append("inputCodigoCheque", $("#inputCodigoCheque").val());
        data.append("inputAbono", $("#inputAbono").val());
        data.append("customRadio0", $('[name="customRadio0"]:checked').val());
        await ajax_function(data, "registrar_garantia");
    };

    const cambiarEstadoVehiculo = async(patente) => {
        const data = new FormData();
        data.append("inputPatenteVehiculo", patente);
        data.append("inputEstado", "RESERVADO");
        data.append("kilometraje_vehiculo", $("#inputEntrada").val());
        await ajax_function(data, "cambiarEstado_vehiculo");
    };

    const limpiarCampos = () => {
        $("#btn_crear_arriendo").attr("disabled", false);
        $("#spinner_btn_registrar").hide();
        $("#form_registrar_arriendo")[0].reset();
        $("#select_vehiculos").empty();
        $("#card-tarjeta").hide();
        $("#card-cheque").hide();
    };
});