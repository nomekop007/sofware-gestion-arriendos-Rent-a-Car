const dataTrasladoDestino = new FormData();
const $seleccionArchivosRecepcion = document.querySelector(
    "#seleccionArchivosRecepcion"
);
let imagenesTrasladoDestino = [];
let imagenesTrasladoDestinoSEND =[];
let cantidad_fotos_carruselRecepcion = "";
let useID=""; //guarda id de traslado



const GuardarImagenesDestino = async (imagenesTrasladoDestinoSEND,id) => {

    const data = new FormData();
 
    console.log(imagenesTrasladoDestinoSEND);

    data.append("id_traslado",id);
    for (let i = 0; i < imagenesTrasladoDestinoSEND.length; i++) {
        data.append(`file${i}`,imagenesTrasladoDestinoSEND[i]);
    }
    const ActualizarFotosTraslado = await ajax_function(data, "ActualizarFotosTrasladoDestino");
    imagenesTrasladoDestinoSEND=[];
}


const LimpiarFormulario = () => {
    $("#PatenteViewDestino").val('');
    $("#TipoViewDestino").val('');
    $("#MarcaViewDestino").val('');
    $("#ModeloViewDestino").val('');
    $("#NombreconductorViewDestino").val('');
    $("#RutconductorViewDestino").val('');
    $("#OrigenviewDestino").val('');
    $("#DestinoViewTraslado").val('');
    $("#KilometrajeViewTraslado").val('');
    cantidad_fotos_carruselRecepcion = "";

};

$("#Limpiar_carruselTD").click(async () => {
    $("#bodyTrasladoCarruselDestino").empty();
    
    imagenesTrasladoDestino = [];
    imagenesTrasladoDestinoSEND=[];


    $("#SpanTrasladoDestino").text(`Cantidad de fotografias: ${imagenesTrasladoDestino.length} (Max 5)`);
});

const RegistrarTrasladoDestino = async (id_traslado) => {

    let imagenesTrasladoDestino = [];
    imagenesTrasladoDestinoSEND=[];
    $("#SpanTrasladoDestino").text(`Cantidad de fotografias: ${imagenesTrasladoDestino.length} (Max 5)`);


    LimpiarFormulario();
    var id_ = parseInt(id_traslado);
    useID=id_traslado;
    const data = new FormData();


    data.append("id_traslado", parseInt(id_));

    let Responsetraslados = await ajax_function(data, "obtenerTraslado");

    if (Responsetraslados.success) {

        const traslado = Responsetraslados.data;
        const dataVehiculo = new FormData();
        

        dataVehiculo.append("patente", traslado.patente_vehiculo);

        let Vehiculo_ = await ajax_function(dataVehiculo, "buscar_vehiculo");
        let vehiculo = Vehiculo_.data;

        $("#PatenteViewDestino").prop({'value': vehiculo.patente_vehiculo});
        $("#TipoViewDestino").prop({'value': vehiculo.tipo_vehiculo});
        $("#MarcaViewDestino").prop({'value': vehiculo.marca_vehiculo});
        $("#ModeloViewDestino").prop({'value': vehiculo.modelo_vehiculo});
        $("#NombreconductorViewDestino").prop({'value': traslado.conductor});
        $("#RutconductorViewDestino").prop({'value': traslado.rutConductor});
        $("#OrigenviewDestino").prop({'value': traslado.nombreSucursalOrigen});
        $("#DestinoViewTraslado").prop({'value': traslado.nombreSucursalDestino});
    }
};



const LimpiarTablaDestino = async (TablaTrasladoRecepcion) => {
    //limpia la tabla
    TablaTrasladoRecepcion
        .row()
        .clear()
        .draw(false);
};



const IniciarTrasladoDestino = async () => {

        const TablaTrasladoRecepcion = $('#TablaRecepcionTraslado').DataTable(config);
        LimpiarTablaDestino(TablaTrasladoRecepcion);
        let Responsetraslados = await ajax_function(null, "obtenerTodosTraslados");
        let fechaOrigenFormat="";
        if (Responsetraslados.success) {

            const traslados = Responsetraslados.data;

            for (let i = 0; i < traslados.length; i++) {

                fechaOrigenFormat=moment(traslados[i].fechaTrasladoOrigen).format('DD/MM/YYYY HH:mm');

                if (traslados[i].estado == "EN TRASLADO") {

                    TablaTrasladoRecepcion
                        .row
                        .add([
                            traslados[i].patente_vehiculo,
                            traslados[i].nombreSucursalOrigen,
                            traslados[i].nombreSucursalDestino,
                            fechaOrigenFormat,
                            traslados[i].conductor,
                            traslados[i].rutConductor,
                            `<center><button type="button" onClick="RegistrarTrasladoDestino('${traslados[i].id_traslado}')"
                        data-toggle="modal" data-target="#ModalTrasladoRecepcion" 
                        class="btn btn-success"><i class="fas fa-exchange-alt"></i></button></center>`
                        ])
                        .draw(true);

                }
                fechaOrigenFormat="";
            }

            $("#TablaRecepcionTraslado").show();
        }


};


$(document).ready(function () {

    (Inializacion_Recepcion = async () => {
        IniciarTrasladoDestino();

    })();

    $("#ActualizarTablaRecepcion").click(async () => {
        IniciarTrasladoDestino();
    });





    $("#Registar_TD").click(async () => {


        let kilometraje_ = $("#KilometrajeViewTraslado");
        let kilometraje=$(kilometraje_).val();

        let FormTraslado = new FormData();
        let estado="FINALIZADO";

 
        if (kilometraje.length == 0 || imagenesTrasladoDestino.length == 0) {
			Swal.fire(
				"Ops... faltan algunos datos (Kilometraje, Imagenes)",
				"faltan datos en el formulario, por favor complete",
				"warning"
			);
			return;
		}

        
        FormTraslado.append("id_traslado",useID);
        FormTraslado.append("estado",estado);
        FormTraslado.append("kilometraje_vehiculo",kilometraje);
        FormTraslado.append("arrayimagenDestino",imagenesTrasladoDestino);

       
        let ActualizarTraslado = await ajax_function(FormTraslado, "actualizarTrasladoEstado");

        if (ActualizarTraslado.success) {
            GuardarImagenesDestino(imagenesTrasladoDestinoSEND,useID);
            IniciarTrasladoDestino();
            Swal.fire(
				"Se ha actualizado el traslado ",
				"El traslado se recepciono correctamente",
				"success"
			);
        }else{

            Swal.fire(
				"No se ha actualizado el traslado ",
				"El traslado no se recepciono correctamente",
				"warning"
			);

        }
       // const UpdateTrasladoRecepcion= await ajax_function(FormTraslado,"actualizarTrasladoEstado");
        useID="";
        imagenesTrasladoDestino=[];
    });

    $("#CargarImagenViewRecepcion").click(async () => {


        if (imagenesTrasladoDestino.length === 5) {

            Swal.fire(
				"Alcanzo el limite maximo de imagenes",
				"Continue con el proceso",
				"warning"
			)

            return;

        }

        // Los archivos seleccionados, pueden ser muchos o uno
        let items1 = "";
        let archivos = $seleccionArchivosRecepcion.files;

        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            console.log("No hay imagen");
            return;
        } else {

            const primerArchivo = archivos[0];
            imagenesTrasladoDestinoSEND.push(primerArchivo);

            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            imagenesTrasladoDestino.push(objectURL);

            seleccionArchivosRecepcion.value = "";
            archivos = "";

            if (imagenesTrasladoDestino.length == 1) {

                items1 += `<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="contenidoCarruselTrasladoOrigen">`;
                items1 += `<div class="carousel-item active">`;
                items1 += ` <img class="d-block w-100" src="${imagenesTrasladoDestino[0]}" alt="Slide"></div>`;
                items1 += ` </div> 
                            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;
            }
            if (imagenesTrasladoDestino.length > 1) {

                items1 += `<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" id="contenidoCarruselTrasladoDestino">`;
                items1 += `<div class="carousel-item active">`;
                items1 += ` <img class="d-block w-100" src="${imagenesTrasladoDestino[0]}" alt="Slide"></div>`;

                for (var i = 1; i < imagenesTrasladoDestino.length; i++) {

                    items1 += `<div class="carousel-item">`;
                    items1 += ` <img class="d-block w-100" src="${imagenesTrasladoDestino[i]}" alt="Slide"></div>`;
                }

                items1 += ` </div> 
                            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;
            }

            $("#SpanTrasladoDestino").text(`Cantidad de fotografias: ${imagenesTrasladoDestino.length} (Max 5)`);
            $("#divCarruselTrasladoDestino").show();
            $("#bodyTrasladoCarruselDestino").html(items1);

        }

    });
});