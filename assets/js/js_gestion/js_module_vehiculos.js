$(document).ready(() => {
    var tablaVehiculos = $("#tablaVehiculos").DataTable(lenguaje);

    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursal");
    cargarSelect("cargar_Sucursales", "inputEditarSucursal");

    //cargar año vehiculo (input)
    cargarOlder("inputedad");
    cargarOlder("inputEditarEdad");

    //carga vehiculos en datatable
    cargarVehiculos();

    function cargarVehiculos() {
        const url = base_route + "cargar_Vehiculos";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, vehiculo) => {
                    cargarVehiculoEnTabla(vehiculo);
                });
            } else {
                console.log("ah ocurrido un error al cargar vehiculos");
            }
        });
    }

    //Registrar Vehiculo
    $("#btn_registrar_vehiculo").click(() => {
        var patente = $("#inputPatente").val();
        var modelo = $("#inputModelo").val();
        var color = $("#inputColor").val();
        var propietario = $("#inputPropietario").val();
        var compra = $("#inputCompra").val();
        var precio = $("#inputPrecio").val();
        var fechaCompra = $("#inputFechaCompra").val();
        var chasis = $("#inputChasis").val();
        var n_motor = $("#inputNumeroMotor").val();
        var marca = $("#inputMarca").val();

        if (
            n_motor.length != 0 &&
            marca.length != 0 &&
            chasis.length != 0 &&
            patente.length != 0 &&
            modelo.length != 0 &&
            color.length != 0 &&
            propietario.length != 0 &&
            compra.length != 0 &&
            precio.length != 0 &&
            fechaCompra.length != 0
        ) {
            $("#btn_registrar_vehiculo").attr("disabled", true);
            $("#spinner_btn_registrar").show();

            var form = $("#form_registrar_vehiculo")[0];
            var data = new FormData(form);
            $.ajax({
                url: base_route + "registrar_vehiculo",
                type: "post",
                dataType: "json",
                data: data,
                enctype: "multipart/form-data",
                processData: false,
                contentType: false,
                cache: false,
                timeOut: false,
                success: (response) => {
                    if (response.success) {
                        cargarVehiculoEnTabla(response.data);

                        //pregunta si hay imagen para subir
                        if ($("#inputFoto").val().length != 0) {
                            guardarImagenVehiculo(response.data.patente_vehiculo);
                        }

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
                        $("#inputFoto").val("");
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

    $("#btn_editar_vehiculo").click(() => {
        $("#btn_editar_vehiculo").attr("disabled", true);
        $("#spinner_btn_editarVehiculo").show();

        var form = $("#formEditarVehiculo")[0];
        var data = new FormData(form);

        $.ajax({
            url: base_route + "editar_vehiculo",
            type: "post",
            dataType: "json",
            data: data,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            timeOut: false,
            success: (response) => {
                if (response.success) {
                    Swal.fire("Exito", response.msg, "success");
                    $("#modal_editar").modal("toggle");
                    refrescarTabla();
                } else {}

                $("#btn_editar_vehiculo").attr("disabled", false);
                $("#spinner_btn_editarVehiculo").hide();
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardo el vehiculo",
                    text: "A ocurrido un Error Contacte a informatica",
                });
                $("#btn_editar_vehiculo").attr("disabled", false);
                $("#spinner_btn_editarVehiculo").hide();
            },
        });
    });

    function guardarImagenVehiculo(patente) {
        var data = new FormData();
        data.append("inputPatente", patente);
        data.append("inputFoto", $("#inputFoto")[0].files[0]);

        var foto = $("#inputFoto")[0].files[0].size;

        if (foto > 21000000) {
            Swal.fire({
                icon: "error",
                title: "la foto es demaciado grande",
                text: "el maximo permitido son 20mb",
            });
            return;
        }

        $.ajax({
            url: base_route + "guardar_fotoVehiculo",
            type: "post",
            dataType: "json",
            data: data,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            timeOut: false,
            success: (response) => {
                console.log(response.success);
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "no se guardo la foto ",
                    text: "A ocurrido un Error Contacte a informatica",
                });
            },
        });
    }

    //BUSCAR MEJOR SOLUCION PARA EVITAR ACTUALIZAR TABLA
    function refrescarTabla() {
        //limpia la tabla
        tablaVehiculos.row().clear().draw(false);

        //carga nuevamente
        cargarVehiculos();
    }

    function cargarVehiculoEnTabla(vehiculo) {
        tablaVehiculos.row
            .add([
                vehiculo.patente_vehiculo,
                vehiculo.modelo_vehiculo,
                vehiculo.año_vehiculo,
                vehiculo.tipo_vehiculo,
                vehiculo.transmision_vehiculo,
                vehiculo.sucursale.nombre_sucursal,
                vehiculo.estado_vehiculo,
                " <button value='" +
                vehiculo.patente_vehiculo +
                "' " +
                " onclick='cargarVehiculo(this.value)'" +
                " data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-info'><i class='far fa-edit'></i></button> ",
            ])
            .draw(false);
    }
});