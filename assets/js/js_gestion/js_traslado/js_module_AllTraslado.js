
const LimpiarTablaAllTraslados = (TablaAllTraslados) => {
    //limpia la tabla
    TablaAllTraslados
        .row()
        .clear()
        .draw(false);
};




const EliminarTraslado = async (id_traslado) => {

    const data = new FormData();
    data.append("id_traslado", id_traslado);

    let EliminarTraslado = await ajax_function(data, "eliminarTraslado");


    if (EliminarTraslado.success) {

        Iniciar();
        Swal.fire(
            "Se ha eliminado el traslado",
            "el traslado se elimino exitosamente",
            "success"
        )


    } else {

        Swal.fire(
            "No se ha eliminado el traslado",
            "El traslado no se elimino!",
            "warning"
        )

    }
}


const ImagenesDestino = async (arrayimagenes) => {

    let imagenes = arrayimagenes.split("/")

    var Links = [];
    var items1 = "";
    for (let i = 0; i < imagenes.length; i++) {

        const data = new FormData();
        data.append("nombreDocumento", imagenes[i]);
        data.append("tipo", "fotoTrasladoDestino");
        let ImagenOrigen = await ajax_function(data, "buscar_documento");
        var link = ImagenOrigen.data.link;
        let separador = base_path

        var link = link.split(separador);
        link = base_path + link[1];
        Links.push(link);

    }


    if (Links.length == 1) {

        items1 += `<div id="ModalImagenesOrigenAll" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">`;
        items1 += `<div class="carousel-item active">`;
        items1 += ` <img class="d-block w-100" src="${Links[0]}" alt="Slide"></div>`;
        items1 += ` </div> 
                            <a class="carousel-control-prev" href="#ModalImagenesOrigenAll" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#ModalImagenesOrigenAll" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;


    }
    if (Links.length > 1) {

        items1 += `<div id="carouselExampleIndicators4" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" id="contenidoCarruselTrasladoDestinoALL">`;

        items1 += `<div class="carousel-item active">`;
        items1 += ` <img class="d-block w-100" src="${Links[0]}" alt="Slide"></div>`;

        for (var i = 1; i < Links.length; i++) {

            items1 += `<div class="carousel-item">`;
            items1 += ` <img class="d-block w-100" src="${Links[i]}" alt="Slide"></div>`;
        }

        items1 += ` </div> 
                            <a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;

    }

    $("#bodyTrasladoCarruselAllDestino").html(items1);




}


const ImagenesOrigen = async (arrayimagenes) => {


    let imagenes = arrayimagenes.split("/")

    var Links = [];
    var items1 = "";
    console.log(imagenes);

    for (let i = 0; i < imagenes.length; i++) {

        const data = new FormData();
        data.append("nombreDocumento", imagenes[i]);
        data.append("tipo", "fotoTrasladoOrigen");
        let ImagenOrigen = await ajax_function(data, "buscar_documento");
        var link = ImagenOrigen.data.link;
        let separador = base_path

        var link = link.split(separador);
        link = base_path + link[1];
        Links.push(link);

    }

    if (Links.length == 1) {

        items1 += `<div id="ModalImagenesOrigenAll" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">`;
        items1 += `<div class="carousel-item active">`;
        items1 += ` <img class="d-block w-100" src="${Links[0]}" alt="Slide"></div>`;
        items1 += ` </div> 
                            <a class="carousel-control-prev" href="#ModalImagenesOrigenAll" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#ModalImagenesOrigenAll" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;


    }
    if (Links.length > 1) {

        items1 += `<div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" id="contenidoCarruselTrasladoOrigenALL">`;

        items1 += `<div class="carousel-item active">`;
        items1 += ` <img class="d-block w-100" src="${Links[0]}" alt="Slide"></div>`;

        for (var i = 1; i < Links.length; i++) {

            items1 += `<div class="carousel-item">`;
            items1 += ` <img class="d-block w-100" src="${Links[i]}" alt="Slide"></div>`;
        }

        items1 += ` </div> 
                            <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>`;

    }

    $("#bodyTrasladoCarruselAllOrigen").html(items1);


}

const ActaTrasladoDestino = async (actaTrasladoDestino) => {

    const data = new FormData();

    data.append("nombreDocumento", actaTrasladoDestino);
    data.append("tipo", "actaTrasladoDestino");

    let Origen = await ajax_function(data, "buscar_documento");
    /*  console.log(Origen);
     var link = Origen.data.link;
     let separador = "http://www.localhost:3000/"
 
     link = link.split(separador);
     link = "http://www.localhost:3000/" + link[1];
  */
    window.open(Origen.data.link)


}


const ActaTrasladoOrigen = async (actaTrasladoDestino) => {

    const data = new FormData();


    data.append("nombreDocumento", actaTrasladoDestino);
    data.append("tipo", "actaTrasladoOrigen");

    let Destino = await ajax_function(data, "buscar_documento");
    /*    var link = Destino.data.link;
   
       let separador = "http://www.localhost:3000//"
   
       link = link.split(separador);
       link = "http://www.localhost:3000/" + link[1]; */
    window.open(Destino.data.link)
}








const Iniciar = async () => {

    const TablaAllTraslados = $('#TablaAllTraslados').DataTable(config);
    LimpiarTablaOrigen(TablaAllTraslados);


    let fechaOrigenFormat = "";
    let fechaDestinoFormat = "";

    let Responsetraslados = await ajax_function(null, "obtenerTodosTraslados");
    if (Responsetraslados.success) {

        const traslados = Responsetraslados.data;

        for (let i = 0; i < traslados.length; i++) {

            fechaDestinoFormat = moment(traslados[i].fechaTrasladoDestino).format('DD/MM/YYYY HH:mm');
            fechaOrigenFormat = moment(traslados[i].fechaTrasladoOrigen).format('DD/MM/YYYY HH:mm');

            if (traslados[i].estado == "EN TRASLADO") {
                TablaAllTraslados
                    .row
                    .add([
                        traslados[i].patente_vehiculo,
                        traslados[i].nombreSucursalOrigen,
                        traslados[i].nombreSucursalDestino,
                        fechaOrigenFormat,
                        fechaDestinoFormat,
                        traslados[i].estado,
                        `<button type="button" onClick="ActaTrasladoOrigen('${traslados[i].actaTrasladoOrigen}')"
                            class="btn btn-secondary btn-sm btn-block">Origen </button>`,
                        `<center><button type="button" data-toggle="modal" data-target="#ModalImagenesOrigenAll" onClick="ImagenesOrigen('${traslados[i].arrayimagenesOrigen}')"
                            class="btn btn-secondary btn-sm btn-block">Origen </button></center>`
                        ,
                        `<center><button type="button" onClick="EliminarTraslado('${traslados[i].id_traslado}')"
                        class="btn btn-danger"><i class="far fa-trash-alt"></i></button></center>`
                    ])
                    .draw(true);


            }
            if (traslados[i].estado == "FINALIZADO") {

                TablaAllTraslados
                    .row
                    .add([
                        traslados[i].patente_vehiculo,
                        traslados[i].nombreSucursalOrigen,
                        traslados[i].nombreSucursalDestino,
                        fechaOrigenFormat,
                        fechaDestinoFormat,
                        traslados[i].estado,
                        `<button type="button" onClick="ActaTrasladoOrigen('${traslados[i].actaTrasladoOrigen}')"
                            class="btn btn-secondary btn-sm btn-block"> Origen </button><br><button type="button" onClick="ActaTrasladoDestino('${traslados[i].actaTrasladoDestino}')"
                            class="btn btn-secondary btn-sm btn-block">Destino</button>`,
                        `<center><button type="button"   data-toggle="modal" data-target="#ModalImagenesOrigenAll"  onClick="ImagenesOrigen('${traslados[i].arrayimagenesOrigen}')"
                            class="btn btn-secondary btn-sm btn-block">Origen </button></center> <br><center><button type="button"   data-toggle="modal" data-target="#ModalImagenesDestinoAll"  onClick="ImagenesDestino('${traslados[i].arrayimagenDestino}')"
                            class="btn btn-secondary btn-sm btn-block">Destino</button></center>`
                        ,
                        `<br><center><button type="button" onClick="EliminarTraslado('${traslados[i].id_traslado}')"
                        class="btn btn-danger"><i class="far fa-trash-alt"></i></button></center>`
                    ])
                    .draw(true);

            }




        }

        $("#TablaAllTraslados").show();
    }
}






$(document).ready(function () {

    (Inializacion_Recepcion = async () => {

        Iniciar();
    })();


    $("#ActualizarTablaAllTraslados").click(async () => {
        Iniciar();
    });


});