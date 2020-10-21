$(document).ready(() => {
    //se inician los datatable
    const tablaControldespacho = $("#tablaControldespacho").DataTable(lenguaje);
    const arrayImages = [];

    $(".owl-carousel").owlCarousel({
        margin: 5,
    });


    (cargarArriendos = () => {
        $("#spinner_tablaDespacho").show();
        const url = base_url + "cargar_arriendosListos";
        $.getJSON(url, (result) => {
            $("#spinner_tablaDespacho").hide();
            if (result.success) {
                $.each(result.data, (i, arriendo) => {
                    cargarArriendoEnTabla(arriendo);
                });
            } else {
                console.log("ah ocurrido un error al cargar los arriendos");
            }
        });
    })();


    $("#seleccionarFoto").click(() => {
        const canvas = document.getElementById("canvas-fotoVehiculo");
        const url = canvas.toDataURL("image/png")

        arrayImages.push(url);

        console.log(url);
        //AGREGAR IMAGEN A CARRUSEL pendiente
        const img = document.createElement("img");
        img.src = "https://www.ecured.cu/images/d/d8/Iconos%28informatica%29.png";
        limpiarTodoCanvasVehiculo();
    });


    $("#btn_crear_ActaEntrega").click(() => {
        const canvas = document.getElementById("canvas-combustible");
        const url = canvas.toDataURL("image/png")
        const form = $("#formActaEntrega")[0];
        const data = new FormData(form);
        data.append("arrayImages", JSON.stringify(arrayImages));
        data.append("imageCombustible", url);

        generarActaEntrega(data);
    });





    const generarActaEntrega = async(data) => {
        const response = await ajax_function(data, "generar_PDFactaEntrega");
        if (response) {
            $("#modal_signature").modal({
                show: true,
            });
            $("#nombre_documento").val(response.data.nombre_documento);
            $("#body-documento").show();
            $("#body-firma").show();
            $("#body-sinContrato").hide();

            const url = storage + "documentos/actaEntrega/" + response.data.nombre_documento + ".pdf";
            mostrarPDF(url);
        }
    }

    const mostrarPDF = (url) => {
        $("#body-documento").html(
            '<a href="' + url + '" class="btn btn-secondary " >Descargar contrato</a><br>' +
            '<iframe width="100%" height="700px" src="' + url + '" target="_parent"></iframe>'
        );
    }



    //carga tablaTotalArriendos
    const cargarArriendoEnTabla = (arriendo) => {
        let cliente = "";
        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                cliente = arriendo.cliente.nombre_cliente;
                break;
            case "REMPLAZO":
                cliente = arriendo.remplazo.cliente.nombre_cliente;
                break;
            case "EMPRESA":
                cliente = arriendo.empresa.nombre_empresa;
                break;
        }

        tablaControldespacho.row
            .add([
                arriendo.id_arriendo,
                cliente,
                arriendo.vehiculo.patente_vehiculo,
                formatearFechaHora(arriendo.fechaEntrega_arriendo),
                formatearFechaHora(arriendo.fechaRecepcion_arriendo),
                arriendo.tipo_arriendo,
                arriendo.estado_arriendo,
                arriendo.usuario.nombre_usuario,
                " <button value='" +
                arriendo.id_arriendo +
                "' " +
                " onclick='buscarArriendo(this.value)'" +
                " data-toggle='modal' data-target='#modal_despachar_arriendo' class='btn btn btn-outline-success'><i class='fas fa-concierge-bell'></i></button>  ",
            ])
            .draw(false);
    };
});