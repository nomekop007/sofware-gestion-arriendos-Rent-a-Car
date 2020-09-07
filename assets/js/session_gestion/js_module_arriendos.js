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
        //prueba
        GuardarArriendo();

        var inputRutConductor = $("#inputRutConductor").val();
        var select_vehiculos = $("#select_vehiculos").val();
        var inputCiudadEntrega = $("#inputCiudadEntrega").val();
        var inputFechaEntrega = $("#inputFechaEntrega").val();
        var inputCiudadRecepcion = $("#inputCiudadRecepcion").val();
        var inputFechaRecepcion = $("#inputFechaRecepcion").val();

        var inputTipo = $("#inputTipo").val();
        var inputRutCliente = $("#inputrutCliente").val();
        var inputCorreoCliente = $("#inputCorreoCliente").val();
        var inputRutEmpresa = $("#inputRutEmpresa").val();

        if (
            inputCiudadEntrega.length != 0 &&
            inputFechaEntrega.length != 0 &&
            inputCiudadRecepcion.length != 0 &&
            inputFechaRecepcion.length != 0 &&
            inputRutConductor.length != 0 &&
            select_vehiculos != null
        ) {
            switch (inputTipo) {
                case "1":
                    if (inputrutCliente.length != 0 && inputCorreoCliente != 0) {
                        GuardarArriendo();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Faltan datos del cliente en el formulario!",
                        });
                    }
                    break;
                case "2":
                    if (
                        inputRutCliente.length != 0 &&
                        inputCorreoCliente != 0 &&
                        inputRutEmpresa.length != 0
                    ) {
                        GuardarArriendo();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Faltan datos de la empresa o cliente en el formulario!",
                        });
                    }
                    break;
                case "3":
                    if (inputRutEmpresa.length != 0) {
                        GuardarArriendo();
                    } else {
                        Swal.fire({
                            icon: "error",
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
                icon: "error",
                title: "Faltan datos en el formulario!",
            });
        }
    });
});

function GuardarArriendo() {
    var form = $("#form_registrar_arriendo")[0];
    var data = new FormData(form);
    base_route = $("#ruta").val();
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
        success: (e) => {
            console.log(e);
        },
        error: () => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "A ocurrido un Error Contacte a informatica",
            });
        },
    });
}