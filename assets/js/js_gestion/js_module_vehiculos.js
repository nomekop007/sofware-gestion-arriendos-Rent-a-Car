$("#m_vehiculo").addClass("active");
$("#l_vehiculo").addClass("card");

//sniper de btn registrar
$("#spinner_btn_registrar").hide();

const buscarVehiculo = async(patente) => {
    limpiarCampos();
    const data = new FormData();
    data.append("patente", patente);
    const response = await ajax_function(data, "buscar_vehiculo");
    if (response.success) {
        const vehiculo = response.data;

        //se pregunta si tiene imagen el vehiculo
        if (vehiculo.foto_vehiculo) {
            //se busca la url del storage
            document.getElementById("imagen").src =
                storage + "fotosVehiculos/" + vehiculo.foto_vehiculo;
        } else {
            document.getElementById("imagen").src =
                base_route + "assets/images/imageDefault.png";
        }
        $("#inputEditarPatente").val(vehiculo.patente_vehiculo);
        $("#exampleModalLongTitle").text(
            "Editar Vehiculo " + vehiculo.patente_vehiculo
        );
        $("#inputEditarEstado").val(vehiculo.estado_vehiculo);
        $("#inputEditarMarca").val(vehiculo.marca_vehiculo);
        $("#inputEditarModelo").val(vehiculo.modelo_vehiculo);
        $("#inputEditarEdad").val(vehiculo.año_vehiculo);
        $("#inputEditarTipo").val(vehiculo.tipo_vehiculo);
        $("#inputEditarTransmision").val(vehiculo.transmision_vehiculo);
        $("#inputEditarChasis").val(vehiculo.chasis_vehiculo);
        $("#inputEditarColor").val(vehiculo.color_vehiculo);
        $("#inputEditarNumeroMotor").val(vehiculo.numeroMotor_vehiculo);
        $("#inputEditarSucursal").val(vehiculo.id_sucursal);
        $("#inputEditarCompra").val(vehiculo.compra_vehiculo);
        $("#inputEditarPropietario").val(vehiculo.rut_propietario);
        $("#inputEditarFechaCompra").val(
            vehiculo.fechaCompra_vehiculo ?
            vehiculo.fechaCompra_vehiculo.substring(0, 10) :
            null
        );
        $("#inputCreateAt").val(formatearFechaHora(vehiculo.createdAt));
        $("#modal_vehiculo").show();
    }
    $("#spinner_vehiculo").hide();
};

const limpiarCampos = () => {
    $("#spinner_vehiculo").show();
    $("#spinner_btn_editarVehiculo").hide();
    $("#modal_vehiculo").hide();
    $("#spinner_vehiculo").show();
    $("#formEditarVehiculo")[0].reset();
    document.getElementById("imagen").src = "";
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
    const tablaVehiculos = $("#tablaVehiculos").DataTable(lenguaje);
    const btnVehiculo = document.getElementById("nav-vehiculos-tab");
    btnVehiculo.addEventListener("click", () => {
        refrescarTabla();
    });
    //cargar sucursales  (ruta,select)
    cargarSelect("cargar_Sucursales", "inputSucursal");
    cargarSelect("cargar_Sucursales", "inputEditarSucursal");
    cargarSelect("cargar_propietarios", "inputPropietario");
    cargarSelect("cargar_propietarios", "inputEditarPropietario");

    //cargar año vehiculo (input)
    cargarOlder("inputedad");
    cargarOlder("inputEditarEdad");

    const cargarVehiculos = async() => {
        $("#spinner_tablaVehiculos").show();
        const response = await ajax_function(null, "cargar_Vehiculos");
        if (response.success) {
            $.each(response.data, (i, vehiculo) => {
                cargarVehiculoEnTabla(vehiculo);
            });
        }
        $("#spinner_tablaVehiculos").hide();
    };

    const refrescarTabla = () => {
        //limpia la tabla
        tablaVehiculos.row().clear().draw(false);
        //carga nuevamente
        cargarVehiculos();
    };

    //Registrar Vehiculo
    $("#btn_registrar_vehiculo").click(async() => {
        const patente = $("#inputPatente").val();
        const modelo = $("#inputModelo").val();
        const color = $("#inputColor").val();
        const propietario = $("#inputPropietario").val();
        const compra = $("#inputCompra").val();
        const fechaCompra = $("#inputFechaCompra").val();
        const chasis = $("#inputChasis").val();
        const n_motor = $("#inputNumeroMotor").val();
        const marca = $("#inputMarca").val();

        if (
            n_motor.length != 0 &&
            marca.length != 0 &&
            chasis.length != 0 &&
            patente.length != 0 &&
            modelo.length != 0 &&
            color.length != 0 &&
            propietario.length != 0 &&
            compra.length != 0 &&
            fechaCompra.length != 0
        ) {
            $("#btn_registrar_vehiculo").attr("disabled", true);
            $("#spinner_btn_registrar").show();

            const form = $("#form_registrar_vehiculo")[0];
            const data = new FormData(form);
            const response = await ajax_function(data, "registrar_vehiculo");
            if (response.success) {
                if (response.data) {
                    cargarVehiculoEnTabla(response.data);
                    //pregunta si hay imagen para subir
                    if ($("#inputFoto").val().length != 0) {
                        const file = $("#inputFoto")[0].files[0];
                        const size = $("#inputFoto")[0].files[0].size;
                        const patente = response.data.patente_vehiculo;
                        const responseFoto = await guardarImagenVehiculo(
                            patente,
                            file,
                            size
                        );
                        if (responseFoto.success) {
                            Swal.fire("Exito", responseFoto.msg, "success");
                            $("#form_registrar_vehiculo")[0].reset();
                        }
                    } else {
                        Swal.fire("Exito", response.msg, "success");
                        $("#form_registrar_vehiculo")[0].reset();
                    }
                } else {
                    Swal.fire("algo paso", response.msg, "error");
                }
            }
            $("#btn_registrar_vehiculo").attr("disabled", false);
            $("#spinner_btn_registrar").hide();
        }
    });

    $("#btn_editar_vehiculo").click(async() => {
        $("#btn_editar_vehiculo").attr("disabled", true);
        $("#spinner_btn_editarVehiculo").show();

        const form = $("#formEditarVehiculo")[0];
        const data = new FormData(form);
        const response = await ajax_function(data, "editar_vehiculo");
        if (response.success) {
            //pregunta si hay imagen para subir
            if ($("#inputEditarFoto").val().length != 0) {
                const file = $("#inputEditarFoto")[0].files[0];
                const patente = response.data.patente_vehiculo;
                const responseFoto = await guardarImagenVehiculo(patente, file);
                if (responseFoto.success) {
                    Swal.fire("Exito", responseFoto.msg, "success");
                    $("#modal_editar").modal("toggle");
                }
            } else {
                Swal.fire("Exito", response.msg, "success");
                $("#modal_editar").modal("toggle");
            }
        }
        $("#btn_editar_vehiculo").attr("disabled", false);
        $("#spinner_btn_editarVehiculo").hide();
    });

    //guarda exclusivamente la imagen en el servidor
    const guardarImagenVehiculo = async(patente, file) => {
        const data = new FormData();
        data.append("inputPatente", patente);
        data.append("inputFoto", file);
        return await ajax_function(data, "guardar_fotoVehiculo");
    };

    const cargarVehiculoEnTabla = (vehiculo) => {
        try {
            tablaVehiculos.row
                .add([
                    vehiculo.patente_vehiculo,
                    vehiculo.marca_vehiculo + " " + vehiculo.modelo_vehiculo,
                    vehiculo.año_vehiculo,
                    vehiculo.tipo_vehiculo,
                    vehiculo.transmision_vehiculo,
                    vehiculo.sucursale ? vehiculo.sucursale.nombre_sucursal : "",
                    vehiculo.estado_vehiculo,
                    ` <button value='${vehiculo.patente_vehiculo}' onclick='buscarVehiculo(this.value)'
                       data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-info'><i class='far fa-edit'></i></button> `,
                ])
                .draw(false);
        } catch (error) {}
    };
});