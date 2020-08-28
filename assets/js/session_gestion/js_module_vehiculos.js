$(document).ready(() => {
    var base_url = "http://localhost/proyectos/Rentacar/";

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
        const url = base_url + "cargar_Sucursales";
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
                console.log("ah ocurrido un error al cargar sucursales");
            }
        });
    })();

    //cargar Vehiculos en Datatable
    cargarVehiculos();

    function cargarVehiculos() {
        const url = base_url + "cargar_Vehiculos";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    tablaVehiculos.row
                        .add([
                            o.patente_vehiculo,
                            o.modelo_vehiculo,
                            o.año_vehiculo,
                            o.tipo_vehiculo,
                            o.id_sucursal,
                            "<a class='btn' id='btn_ver_vehiculo'><i class='far fa-eye color'></i></a><a class='btn' id='btn_editar_vehiculo'><i class='far fa-edit'></i></a>",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar sucursales");
            }
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
                url: base_url + "registrar_vehiculo",
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
                success: (e) => {
                    if ((e.msg = "OK")) {
                        Swal.fire("Vehiculo registrado");
                        $("#inputPatente").val("");
                        $("#inputModelo").val("");
                        $("#inputedad").val("");
                        $("#inputColor").val("");
                        $("#inputPropietario").val("");
                        $("#inputCompra").val("");
                        $("#inputPrecio").val("");
                        $("#inputFechaCompra").val("");

                        //corregir problema de actualizacion tabla
                        // cargarVehiculos();
                    } else {
                        Swal.fire("El Vehiculo ya existe");
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