$(document).ready(() => {
    var tablaVehiculos = $("#tablaVehiculos").DataTable(lenguaje);

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
                            " <button data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info' id='btn_ver_vehiculo'><i class='far fa-eye color'></i></button> " +
                            " <button data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-primary' id='btn_editar_vehiculo'><i class='far fa-edit'></i></button> ",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar vehiculos");
            }
        });
    })();

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
        var chasis = $("#inputChasis").val();
        var n_motor = $("#inputNumeroMotor").val();
        var marca = $("#inputMarca").val();
        var transmision = $("#inputTransmision").val();

        if (
            n_motor.length != 0 &&
            marca.length != 0 &&
            chasis.length != 0 &&
            patente.length != 0 &&
            modelo.length != 0 &&
            edad.length != 0 &&
            color.length != 0 &&
            propietario.length != 0 &&
            compra.length != 0 &&
            precio.length != 0 &&
            fechaCompra.length != 0
        ) {
            $("#btn_registrar_vehiculo").attr("disabled", true);
            $("#spinner_btn_registrar").show();
            $.ajax({
                url: base_route + "registrar_vehiculo",
                type: "post",
                dataType: "json",
                data: {
                    chasis,
                    n_motor,
                    marca,
                    patente,
                    modelo,
                    transmision,
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
                    if (response.success) {
                        cargarVehiculoEnTabla(response.data[0]);

                        Swal.fire("Exito", response.msg, "success");
                        $("#btn_registrar_vehiculo").attr("disabled", false);
                        $("#spinner_btn_registrar").hide();

                        $("#inputPatente").val("");
                        $("#inputModelo").val("");
                        $("#inputColor").val("");
                        $("#inputPropietario").val("");
                        $("#inputCompra").val("");
                        $("#inputPrecio").val("");
                        $("#inputFechaCompra").val("");
                        $("#inputMarca").val("");
                        $("#inputNumeroMotor").val("");
                        $("#inputChasis").val("");
                    } else {
                        $("#btn_registrar_vehiculo").attr("disabled", false);
                        $("#spinner_btn_registrar").hide();
                        Swal.fire({
                            icon: "error",
                            title: "error registrar vehiculo",
                            text: response.msg,
                        });
                    }
                },
                error: () => {
                    $("#btn_registrar_vehiculo").attr("disabled", false);
                    $("#spinner_btn_registrar").hide();
                    Swal.fire({
                        icon: "error",
                        title: "no se guardo el vehiculo",
                        text: "A ocurrido un Error Contacte a informatica",
                    });
                },
            });
        }
    });

    function cargarVehiculoEnTabla(vehiculo) {
        tablaVehiculos.row
            .add([
                vehiculo.patente_vehiculo,
                vehiculo.modelo_vehiculo,
                vehiculo.año_vehiculo,
                vehiculo.tipo_vehiculo,
                vehiculo.sucursale.nombre_sucursal,
                "<button data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info' id='btn_ver_vehiculo'><i class='far fa-eye color'></i></button>" +
                "<button data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-primary' id='btn_editar_vehiculo'><i class='far fa-edit'></i></button>",
            ])
            .draw(false);
    }
});