$(document).ready(() => {
    var base_route = $("#ruta").val();

    var lenguaje = {
        responsive: true,
        destroy: true,
        language: {
            decimal: "",
            emptyTable: "No hay datos",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtro de _MAX_ total registros)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No se encontraron coincidencias",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Próximo",
                previous: "Anterior",
            },
            aria: {
                sortAscending: ": Activar orden de columna ascendente",
                sortDescending: ": Activar orden de columna desendente",
            },
        },
    };
    //se inician los datatable
    var tablaArriedosActivos = $("#tablaArriendosActivos").DataTable(lenguaje);
    var tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);

    //select2 de los vehiculos
    $("#select_vehiculos").select2({
        placeholder: "Vehiculos disponibles",
        allowClear: true,
        language: {
            noResults: () => {
                return "No hay resultado";
            },
            searching: () => {
                return "Buscando..";
            },
        },
    });
    //cargar sucursales
    (() => {
        const url = base_route + "cargar_Sucursales";
        const select = document.getElementById("inputSucursal");
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    const option = document.createElement("option");
                    option.innerHTML = o.nombre_sucursal;
                    option.value = o.id_sucursal;
                    select.appendChild(option);
                });
            } else {
                console.log("ah ocurrido un error al cargar las sucursales");
            }
        });
    })();

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
                    $.each(result.data.vehiculos, (i, o) => {
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
        //verificar que llegan todos los valores

        //datos cliente
        var inputNombreCliente = $("#inputNombreCliente").val();
        var inputDireccionCliente = $("#inputDireccionCliente").val();
        var inputCiudadCliente = $("#inputCiudadCliente").val();
        var inputRutCliente = $("#inputRutCliente").val();
        var inputFechaNacimiento = $("#inputFechaNacimiento").val();
        var inputTelefonoCliente = $("#inputTelefonoCliente").val();
        var inputCorreoCliente = $("#inputCorreoCliente").val();

        //datos empresa
        var inputNombreEmpresa = $("#inputNombreEmpresa").val();
        var inputDireccionEmpresa = $("#inputDireccionEmpresa").val();
        var inputCiudadEmpresa = $("#inputCiudadEmpresa").val();
        var inputCiudadEmpresa = $("#inputCiudadEmpresa").val();
        var inputTelefonoEmpresa = $("#inputTelefonoEmpresa").val();
        var inputCorreoEmpresa = $("#inputCorreoEmpresa").val();

        //datos conductor
        var inputNombreConductor = $("#inputNombreConductor").val();
        var inputRutConductor = $("#inputRutConductor").val();
        var inputTelefonoConductor = $("#inputTelefonoConductor").val();
        var inputClase = $("#inputClase").val();
        var inputNumero = $("#inputNumero").val();
        var inputVCTO = $("#inputVCTO").val();
        var inputMunicipalidad = $("#inputMunicipalidad").val();
        var inputDireccion = $("#inputDireccion").val();

        //datos vehiculo
        var select_vehiculos = $("#select_vehiculos").val();
        var inputEntrada = $("#inputEntrada").val();
        var box_traslado = $("#box_traslado").val();
        var box_dedicible = $("#box_dedicible").val();
        var box_bencina = $("#box_bencina").val();
        var box_enganche = $("#box_enganche").val();
        var box_silla = $("#box_silla").val();
        var box_pase = $("#box_pase").val();
        var box_rastreo = $("#box_rastreo").val();
        var inputOtros = $("#inputOtros").val();

        //datos arriendo
        var inputCiudadEntrega = $("#inputCiudadEntrega").val();
        var inputFechaEntrega = $("#inputFechaEntrega").val();
        var inputCiudadRecepcion = $("#inputCiudadRecepcion").val();
        var inputFechaRecepcion = $("#inputFechaRecepcion").val();
        var inputObservaciones = $("#inputObservaciones").val();
        var inputNumeroDias = $("#inputNumeroDias").val();
        var inputTipo = $("#inputTipo").val();
        var inputDocCarnet = $("#inputDocCarnet").val();
        var inputDocConducir = $("#inputDocConducir").val();
        var inputDocDomicilio = $("#inputDocDomicilio").val();
    });
});