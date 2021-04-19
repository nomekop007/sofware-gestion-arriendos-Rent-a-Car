let config = lenguaje;
config.paging = false;
const dataTrasladoOrigen = new FormData();
const $seleccionArchivos = document.querySelector("#seleccionArchivos");
const $seleccionArchivos2 = document.querySelector("#seleccionArchivos");
let imagenesTrasladoOrigen = [];
let imagenesTrasladoOrigenSEND = [];
let SucursalsName = [];
let SucursalsId = [];
let nombreOrigen = "";
let nombreDestino = "";
let cantidad_fotos_carrusel = "";
let items = "";
let items2 = "";
$("#DivTablaVehiculosDispSucursal").hide();

const LimpiarTablaOrigen = (TablaVehiculosDip) => {
    //limpia la tabla
    TablaVehiculosDip
        .row()
        .clear()
        .draw(false);
};

const Sucursales_ = async () => {
    let responseSucursales = await ajax_function(null, "cargar_Sucursales");
    if (responseSucursales.success) {
        const sucursales = responseSucursales.data;
        return sucursales;
    }
}

const GuardarImagenes = async (imagenesTrasladoOrigenSEND,id) => {

    const data = new FormData();

    data.append("id_traslado",id);
    for (let i = 0; i < imagenesTrasladoOrigenSEND.length; i++) {
        data.append(`file${i}`,imagenesTrasladoOrigenSEND[i]);
    }
    const ActualizarFotosTraslado = await ajax_function(data, "ActualizarFotosTraslado");
    

    imagenesTrasladoOrigenSEND=[];

}

const Vehiculos_Disponibles = async () => {

    let responseVehiculos = await ajax_function(
        null,
        "cargar_VehiculosDisponibles"
    );
    if (responseVehiculos.success) {
        const vehiculos = responseVehiculos.data;
        return vehiculos;
    }
}

const ActualizarTrasladoOrigen = async () => {

    const TablaVehiculosDip = $('#tablaTrasladoDisp').DataTable(config);
    LimpiarTablaOrigen(TablaVehiculosDip);
    let input1;
    input1 = $("#Select1");
    let SelectOrigen = $(input1).val();
    Vehiculos_Disponibles()
        .then(function (response) {

            for (let i = 0; i < response.length; i++) {

                if (response[i].id_sucursal == SelectOrigen) {

                    TablaVehiculosDip
                        .row
                        .add([
                            response[i].patente_vehiculo,
                            response[i].tipo_vehiculo,
                            response[i].marca_vehiculo,
                            response[i].modelo_vehiculo,
                            `<center><button type="button" onClick="RegistrarTraslado('${response[i]
                                .patente_vehiculo}',
                        '${response[i]
                                .tipo_vehiculo}','${response[i]
                                .marca_vehiculo}',
                        '${response[i]
                                .modelo_vehiculo}','${SelectOrigen}')"
                        data-toggle="modal" data-target="#exampleModal" 
                        class="btn btn-success"><i class="fas fa-exchange-alt"></i></button></center>`
                        ])
                        .draw(true);

                }
            }

            $("#tablaTrasladoDisp").show();
            $("#DivTablaVehiculosDispSucursal").show();

        })
        .catch(function (error) {});
}

const RegistrarTraslado = async (patente, tipo, marca, modelo, origen) => {

    imagenesTrasladoOrigen = [];
    imagenesTrasladoOrigenSEND=[];
    $("#SpanTrasladoOrigen").text(
        `Cantidad de fotografias: ${imagenesTrasladoOrigen.length} (Max 5)`
    );

    var SelectDestino2 = document.getElementById("Destino2");
    $("#Destino2").empty();

    $("#divCarruselTraslado").hide();
    $("#desplegar_preiew_carrusel").hide();
    $("#divBoton_carrusel").hide();

    $("#Traslado_patente").val('');
    $("#Traslado_tipo").val('');
    $("#NombreConductor_Traslado").val('');
    $("#RutConductor_Traslado").val('');
    $("#Traslado_marca").val('');
    $("#Traslado_modelo").val('');
    $("#Origenview").val('');
    $("#ObservacionTraslado").val('');

    for (let i = 0; i < SucursalsId.length; i++) {

        var option = document.createElement("option");

        if (SucursalsId[i] == origen) {
            nombreOrigen = SucursalsName[i];
        }

        if (SucursalsId[i] != origen) {
            option.text = SucursalsName[i];
            option.value = SucursalsId[i];
            SelectDestino2.add(option);
        }
    }
    // Inicializacion de campos

    $("#Traslado_patente").prop({'value': patente});
    $("#Traslado_tipo").prop({'value': tipo});
    $("#Traslado_marca").prop({'value': marca});
    $("#Traslado_modelo").prop({'value': modelo});
    $("#Origenview").prop({'value': nombreOrigen});

    let NombreOrigen = $("#Origenview").val();

    dataTrasladoOrigen.append("patente_vehiculo", patente);
    dataTrasladoOrigen.append("id_sucursal", parseInt(origen));
    dataTrasladoOrigen.append("nombreSucursalOrigen", NombreOrigen);

}

$(document).ready(function () {

    (Inializacion_Sucursales = async () => {

        var SelectOrigen = document.getElementById("Select1");

        Sucursales_()
            .then(function (response) {

                for (let i = 0; i < response.length; i++) {

                    var option = document.createElement("option");

                    option.text = response[i].nombre_sucursal;
                    option.value = response[i].id_sucursal;
                    SelectOrigen.add(option);

                    SucursalsName.push(response[i].nombre_sucursal);
                    SucursalsId.push(response[i].id_sucursal);

                }

            })
            .catch(function (error) {});
    })();

    $("#Limpiar_carruselTO").click(async () => {

        $("#bodyTrasladoCarrusel").empty();
        imagenesTrasladoOrigen = [];
        imagenesTrasladoOrigenSEND=[];
        $("#SpanTrasladoOrigen").text(
            `Cantidad de fotografias: ${imagenesTrasladoOrigen.length} (Max 5)`
        );
    });

    $("#Registar_TO").click(async () => {

        let nombre_,destino_id_,observacion_,rut_ = ""; //datos de conductor
        nombre_ = $("#NombreConductor_Traslado");
        rut_ = $("#RutConductor_Traslado");
        observacion_ = $("#ObservacionTraslado");
        destino_id_ = $("#Destino2");

        let NameDest = "";
        let nombre = $(nombre_).val();
        let destino_id = $(destino_id_).val();
        let observacion = $(observacion_).val();
        let rut = $(rut_).val();
        var fecha = new Date();
        var estado = "EN TRASLADO";

        if (nombre.length == 0 || rut.length == 0 || imagenesTrasladoOrigen.length == 0) {
            Swal.fire(
                "Ops... faltan algunos datos",
                "faltan datos en el formulario, por favor complete",
                "warning"
            );
            return;
        }

        for (let i = 0; i < SucursalsId.length; i++) {

            if (SucursalsId[i] == destino_id) {
                NameDest = SucursalsName[i];
            }
        }

        dataTrasladoOrigen.append("sucursalDestino", destino_id);
        dataTrasladoOrigen.append("nombreSucursalDestino", NameDest);
        dataTrasladoOrigen.append("observacion", observacion);
        dataTrasladoOrigen.append("conductor", nombre);
        dataTrasladoOrigen.append("rutConductor", rut);
        dataTrasladoOrigen.append("estado", estado);
        dataTrasladoOrigen.append("arrayimagenesOrigen", null);
        dataTrasladoOrigen.append("arrayimagenesDestino", null);
        dataTrasladoOrigen.append("actaTrasladoOrigen", null);
        dataTrasladoOrigen.append("actaTrasladoDestino", null);
        dataTrasladoOrigen.append("fechaTrasladoOrigen", fecha);
        dataTrasladoOrigen.append("fechaTrasladoDestino", null);

        const response = await ajax_function(dataTrasladoOrigen, "generar_actaOrigen");
        if (response.success) {

            var id= response.data.id_traslado;
            console.log(id);
            GuardarImagenes(imagenesTrasladoOrigenSEND,id);
            ActualizarTrasladoOrigen();

            Swal.fire(
                "Se ha registrado el traslado",
                "el registro se guardado exitosamente",
                "success"
            )
        } else {
            Swal.fire(
                "Error creando el traslado",
                "el registro no se ha guardado",
                "warning"
            )
        }

    });

    $("#BuscarVehiculosPorSucursal").click(async () => {
        ActualizarTrasladoOrigen();
    });

    $("#CargarImagen").click(async () => {

        if (imagenesTrasladoOrigen.length === 5) {

            Swal.fire(
                "Alcanzo el limite maximo de imagenes",
                "Continue con el proceso",
                "warning"
            )

            return;

        }

        // Los archivos seleccionados, pueden ser muchos o uno
        let items1 = "";
        let archivos = $seleccionArchivos.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            console.log("estavacio");
            return;
        } else {

            const primerArchivo = archivos[0];

            imagenesTrasladoOrigenSEND.push(primerArchivo);

            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            imagenesTrasladoOrigen.push(objectURL);
            seleccionArchivos.value = "";
            archivos = "";

            if (imagenesTrasladoOrigen.length === 1) {

                items1 += `<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner" id="contenidoCarruselTrasladoOrigen">`;

                items1 += `<div class="carousel-item active">`;
                items1 += ` <img class="d-block w-100" src="${imagenesTrasladoOrigen[0]}" alt="Slide"></div>`;

                items1 += ` </div> 
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;
            }
            if (imagenesTrasladoOrigen.length > 1) {

                items1 += `<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" id="contenidoCarruselTrasladoOrigen">`;

                items1 += `<div class="carousel-item active">`;
                items1 += ` <img class="d-block w-100" src="${imagenesTrasladoOrigen[0]}" alt="Slide"></div>`;

                for (var i = 1; i < imagenesTrasladoOrigen.length; i++) {

                    items1 += `<div class="carousel-item">`;
                    items1 += ` <img class="d-block w-100" src="${imagenesTrasladoOrigen[i]}" alt="Slide"></div>`;
                }

                items1 += ` </div> 
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;

            }

            $("#SpanTrasladoOrigen").text(
                `Cantidad de fotografias: ${imagenesTrasladoOrigen.length} (Max 5)`
            );
            $("#divCarruselTraslado").show();
            $("#bodyTrasladoCarrusel").html(items1);

        }

    });

});
