$(document).ready(() => {
    var base_route = $("#ruta").val();

    //inicializa datatable
    var tablaVehiculos = $("#tablaVehiculos").DataTable({
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

    //carga vehiculos en datatable
    (() => {
        const url = base_route + "cargar_Vehiculos";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, vehiculo) => {
                    tablaVehiculos.row
                        .add([
                            vehiculo.patente_vehiculo,
                            vehiculo.modelo_vehiculo,
                            vehiculo.año_vehiculo,
                            vehiculo.tipo_vehiculo,
                            vehiculo.sucursale.nombre_sucursal,
                            "<a class='btn' id='btn_ver_vehiculo'><i class='far fa-eye color'></i></a><a class='btn' id='btn_editar_vehiculo'><i class='far fa-edit'></i></a>",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar vehiculos");
            }
        });
    })();

    function cargarUnVehiculo(patente) {
        $.ajax({
            url: base_route + "cargar_UnVehiculo",
            type: "post",
            dataType: "json",
            data: { patente },
            success: (result) => {
                const vehiculo = result.data[0];

                tablaVehiculos.row
                    .add([
                        vehiculo.patente_vehiculo,
                        vehiculo.modelo_vehiculo,
                        vehiculo.año_vehiculo,
                        vehiculo.tipo_vehiculo,
                        vehiculo.sucursale.nombre_sucursal,
                        "<a class='btn' id='btn_ver_vehiculo'><i class='far fa-eye color'></i></a><a class='btn' id='btn_editar_vehiculo'><i class='far fa-edit'></i></a>",
                    ])
                    .draw(false);
            },
            error: () => {
                console.log("error en cargar los vehiculos");
            },
        });
    }

    //Registrar Vehiculo
    $("#btn_registrar_vehiculo").click(() => {
        var patente = $("#inputPatente").val();
        var modelo = $("#inputModelo").val();
        var edad = $("#inputedad").val();
        var tipo = $("#inputTipo").val();
        var color = $("#inputColor").val();
        var sucursal = $("#inputSucursal").val();
        var propietario = $("#inputPropietario").val();
        var compra = $("#inputCompra").val();
        var precio = $("#inputPrecio").val();
        var fechaCompra = $("#inputFechaCompra").val();
        if (
            patente.length != 0 &&
            modelo.length != 0 &&
            edad.length != 0 &&
            color.length != 0 &&
            propietario.length != 0 &&
            compra.length != 0 &&
            precio.length != 0 &&
            fechaCompra.length != 0
        ) {
            $.ajax({
                url: base_route + "registrar_vehiculo",
                type: "post",
                dataType: "json",
                data: {
                    patente,
                    modelo,
                    edad,
                    tipo,
                    color,
                    sucursal,
                    propietario,
                    compra,
                    precio,
                    fechaCompra,
                },
                success: (response) => {
                    console.log(response);
                    if (response.success) {
                        Swal.fire(response.msg);
                        $("#inputPatente").val("");
                        $("#inputModelo").val("");
                        $("#inputedad").val("");
                        $("#inputColor").val("");
                        $("#inputPropietario").val("");
                        $("#inputCompra").val("");
                        $("#inputPrecio").val("");
                        $("#inputFechaCompra").val("");
                        cargarUnVehiculo(patente);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.msg,
                        });
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "A ocurrido un Error al registrar vehiculo!",
                    });
                },
            });
        }
    });
});