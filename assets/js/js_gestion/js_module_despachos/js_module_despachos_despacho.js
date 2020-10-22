$(document).ready(() => {
    //se inician los datatable
    const tablaControldespacho = $("#tablaControldespacho").DataTable(lenguaje);
    const arrayImages = [];




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


    $("#seleccionarFoto").click(async() => {
        if ($("#inputImagenVehiculo").val() != 0) {
            const canvas = document.getElementById("canvas-fotoVehiculo");
            const base64 = canvas.toDataURL("image/png");

            const url = await resizeBase64Img(base64, 500, 300);
            if (arrayImages.length < 5) {
                arrayImages.push(url);
                agregarFotoACarrucel(arrayImages);
                console.log(arrayImages);
                limpiarTodoCanvasVehiculo();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "el maximo son 5 imagenes",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "debe ingresar foto",
            });
        }
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

    $("#limpiarArrayFotos").click(() => {
        arrayImages.length = 0;
        $("#carrucel").empty();
    });






    const generarActaEntrega = async(data) => {
        $("#btn_crear_ActaEntrega").attr("disabled", true);
        $("#spinner_btn_generarActaEntrega").show();
        const response = await ajax_function(data, "generar_PDFactaEntrega");
        if (response) {
            arrayImages.length = 0;
            $("#carrucel").empty();
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
        $("#spinner_btn_generarActaEntrega").hide();
        $("#btn_crear_ActaEntrega").attr("disabled", false);
    }

    const mostrarPDF = (url) => {
        $("#body-documento").html(
            '<a href="' + url + '" >Descargar contrato</a><br>' +
            '<iframe width="100%" height="700px" src="' + url + '" target="_parent"></iframe>'
        );
    }

    const agregarFotoACarrucel = (array) => {
        let items = '';
        for (let i = 0; i < array.length; i++) {
            items += '<div class="item"><img src="' + array[i] + '" /></div>';
        }
        const html = ' <div class="owl-carousel owl-theme" id="carruselVehiculos">' + items + '</div></div>'
        $("#carrucel").html(html);

        $(".owl-carousel").owlCarousel({
            margin: 5,
        });
    }


    function resizeBase64Img(base64, newWidth, newHeight) {
        return new Promise((resolve, reject) => {
            var canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            let context = canvas.getContext("2d");
            let img = document.createElement("img");
            img.src = base64;
            img.onload = function() {
                context.scale(newWidth / img.width, newHeight / img.height);
                context.drawImage(img, 0, 0);
                resolve(canvas.toDataURL());
            }
        });
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