$(document).ready(() => {
    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "selectSucursal");
    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursal");

    //select2 de los vehiculos
    $("#select_vehiculos").select2(lenguajeSelect2);

    //cargar accesorios
    (() => {
        const url = base_route + "cargar_accesorios";
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
                url: base_route + "buscar_cliente",
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
                        $("#inputCorreoCliente").val(c.correo_cliente);
                    } else {
                        $("#inputNombreCliente").val("");
                        $("#inputDireccionCliente").val("");
                        $("#inputCiudadCliente").val("");
                        $("#inputFechaNacimiento").val("");
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
                url: base_route + "buscar_empresa",
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
                        $("#inputVigencia").val("");
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
                url: base_route + "buscar_conductor",
                type: "post",
                dataType: "json",
                data: { rut_conductor },
                success: (result) => {
                    $("#spinner_conductor").hide();
                    if (result.success) {
                        var c = result.data;
                        $("#inputNombreConductor").val(c.nombre_conductor);
                        $("#inputTelefonoConductor").val(c.telefono_conductor);
                        $("#inputClase").val(c.clase_conductor);
                        $("#inputNumero").val(c.numero_conductor);
                        $("#inputVCTO").val(
                            c.vcto_conductor ? c.vcto_conductor.substring(0, 10) : null
                        );
                        $("#inputMunicipalidad").val(c.municipalidad_conductor);
                        $("#inputDireccion").val(c.direccion_conductor);
                    } else {
                        $("#inputNombreConductor").val("");
                        $("#inputTelefonoConductor").val("");
                        $("#inputClase").val("");
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
            url: base_route + "cargar_VehiculosPorSucursal",
            type: "post",
            dataType: "json",
            data: { id_sucursal },
            success: (result) => {
                if (result.success) {
                    $("#select_vehiculos").empty();
                    const select = document.getElementById("select_vehiculos");
                    $.each(result.data, (i, o) => {
                        const option = document.createElement("option");
                        option.innerHTML =
                            "PATENTE: " +
                            o.patente_vehiculo +
                            " - MODELO: " +
                            o.modelo_vehiculo +
                            "  -  " +
                            o.año_vehiculo;
                        option.value = o.patente_vehiculo;
                        select.appendChild(option);
                    });

                    $("#select_vehiculos").attr("disabled", false);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: result.msg,
                    });
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

    $("#btn_crear_arriendo").click(() => {
        var inputRutConductor = $("#inputRutConductor").val();
        var inputRutCliente = $("#inputRutCliente").val();
        var inputRutEmpresa = $("#inputRutEmpresa").val();
        var inputNombreCliente = $("#inputNombreCliente").val();
        var inputNombreEmpresa = $("#inputNombreEmpresa").val();
        var inputNombreConductor = $("#inputNombreConductor").val();
        var inputCorreoCliente = $("#inputCorreoCliente").val();
        var select_vehiculos = $("#select_vehiculos").val();
        var inputCiudadEntrega = $("#inputCiudadEntrega").val();
        var inputFechaEntrega = $("#inputFechaEntrega").val();
        var inputCiudadRecepcion = $("#inputCiudadRecepcion").val();
        var inputFechaRecepcion = $("#inputFechaRecepcion").val();
        var inputTipo = $("#inputTipo").val();

        if (
            inputRutConductor.length != 0 &&
            inputNombreConductor.length != 0 &&
            inputCiudadEntrega.length != 0 &&
            inputFechaEntrega.length != 0 &&
            inputCiudadRecepcion.length != 0 &&
            inputFechaRecepcion.length != 0 &&
            select_vehiculos != null
        ) {
            switch (inputTipo) {
                case "1":
                    if (
                        inputRutCliente.length != 0 &&
                        inputNombreCliente.length != 0 &&
                        inputCorreoCliente != 0
                    ) {
                        guardarDatosArriendo();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Faltan datos del cliente en el formulario!",
                        });
                    }
                    break;
                case "2":
                    if (
                        inputRutCliente.length != 0 &&
                        inputCorreoCliente != 0 &&
                        inputRutEmpresa.length != 0 &&
                        inputNombreEmpresa.length != 0 &&
                        inputNombreCliente.length
                    ) {
                        guardarDatosArriendo();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Faltan datos de la empresa o cliente en el formulario!",
                        });
                    }
                    break;
                case "3":
                    if (inputRutEmpresa.length != 0 && inputNombreEmpresa.length != 0) {
                        guardarDatosArriendo();
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
        } else {
            Swal.fire({
                icon: "warning",
                title: "Faltan datos en el formulario!",
            });
        }
    });

    function guardarDatosArriendo() {
        $("#btn_crear_arriendo").attr("disabled", true);
        $("#spinner_btn_registrar").show();

        var form = $("#form_registrar_arriendo")[0];
        var data = new FormData(form);
        $.ajax({
            url: base_route + "registrar_arriendo",
            type: "post",
            dataType: "json",
            data: data,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            timeOut: false,
            success: (response) => {
                if (response) {
                    guardarDatosAccesorios(response.data.id_arriendo);
                    cargarArriendoEnTabla(response.data);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "error registrar arriendo",
                        text: response.msg,
                    });
                    $("#btn_crear_arriendo").attr("disabled", false);
                    $("#spinner_btn_registrar").hide();
                }
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardo el arriendo",
                    text: "A ocurrido un Error Contacte a informatica",
                });
                $("#btn_crear_arriendo").attr("disabled", false);
                $("#spinner_btn_registrar").hide();
            },
        });
    }

    function guardarDatosAccesorios(idArriendo) {
        //revisa todos los check y guardas sus valores en un array si estan okey
        var checks = $('[name="checks[]"]:checked')
            .map(function() {
                return this.value;
            })
            .get();
        $.ajax({
            url: base_route + "registrar_arriendoAccesorios",
            type: "post",
            dataType: "json",
            data: { idArriendo, array: JSON.stringify(checks) },
            success: (response) => {
                Swal.fire("Exito", response.msg, "success");
                $("#btn_crear_arriendo").attr("disabled", false);
                $("#spinner_btn_registrar").hide();
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardaron los accesorios",
                    text: "A ocurrido un Error Contacte a informatica",
                });
                $("#btn_crear_arriendo").attr("disabled", false);
                $("#spinner_btn_registrar").hide();
            },
        });
    }


});