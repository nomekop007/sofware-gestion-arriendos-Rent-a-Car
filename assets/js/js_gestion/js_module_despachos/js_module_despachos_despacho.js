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

    const refrescarTabla = () => {
        //limpia la tabla
        tablaControldespacho.row().clear().draw(false);
        //carga nuevamente
        cargarArriendos();
    };

    $("#seleccionarFoto").click(async() => {
        /*
        se redimenciona la imagen por que los archivos base64 tiene un peso de caracteres elevado y 
		el servidor solo puede recibir un maximo de 2mb en cada consulta.
        Actualizado: es posible que esto cambie debido al ambiente de desarrollo
        o capacidad de la maquina en la que se este ejecutando
        */
        if ($("#inputImagenVehiculo").val() != 0) {
            const canvas = document.getElementById("canvas-fotoVehiculo");
            const base64 = canvas.toDataURL("image/png");
            const url = await resizeBase64Img(base64, 500, 300);
            if (arrayImages.length < 5) {
                arrayImages.push(url);
                agregarFotoACarrucel(arrayImages);
                limpiarTodoCanvasVehiculo();
                console.log(arrayImages);
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


    $("#btn_crear_ActaEntrega").click(async() => {
        const form = $("#formActaEntrega")[0];
        const data = new FormData(form);

        console.log($("#inputPatenteVehiculoDespacho").val());
        console.log($("#inputKilomentrajeVehiculoDespacho").val());



        generarActaEntrega(data);

    });

    $("#btn_confirmar_actaEntrega").click(() => {
        Swal.fire({
            title: "Estas seguro?",
            text: "estas a punto de guardar los cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async(result) => {
            if (result.isConfirmed) {
                $("#spinner_btn_confirmarActaEntrega").show();
                $("#btn_confirmar_actaEntrega").attr("disabled", true);
                const form = $("#formActaEntrega")[0];
                const data = new FormData(form);

                //metodos
                const response = await guardarDatosDespacho(data);
                await guardarActaEntrega(data, response.id_despacho);
                await cambiarEstadoArriendo(data);
                await cambiarEstadoVehiculo(data);
                await enviarCorreoDespacho(data);

                refrescarTabla();
                Swal.fire(
                    "Acta de entrega Firmado!",
                    "acta de entrega firmado y registrado con exito!",
                    "success"
                )
                $("#modal_signature").modal("toggle");
                $("#modal_despachar_arriendo").modal("toggle");
            }
        });
    });



    $("#btn_firmar_actaEntrega").click(async() => {
        const canvas1 = document.getElementById("canvas-firma1");
        const canvas2 = document.getElementById("canvas-firma2");
        const form = $("#formActaEntrega")[0];
        const data = new FormData(form);
        data.append("inputFirma1PNG", canvas1.toDataURL("image/png"));
        data.append("inputFirma2PNG", canvas2.toDataURL("image/png"));
        generarActaEntrega(data);
    });



    $("#limpiarArrayFotos").click(() => {
        arrayImages.length = 0;
        $("#carrucel").empty();
    });

    const generarActaEntrega = async(data) => {
        if (arrayImages.length > 0) {
            const canvas = document.getElementById("canvas-combustible");
            const url = canvas.toDataURL("image/png");
            const matrizRecepcion = await capturarControlRecepcionArray();

            data.append("matrizRecepcion", JSON.stringify(matrizRecepcion));
            data.append("arrayImages", JSON.stringify(arrayImages));
            data.append("imageCombustible", url);

            $("#btn_crear_ActaEntrega").attr("disabled", true);
            $("#btn_firmar_actaEntrega").attr("disabled", true);
            $("#spinner_btn_generarActaEntrega").show();
            $("#spinner_btn_firmarActaEntrega").show();
            $("#recibido").text($("#inputRecibidorDespacho").val());
            $("#entregado").text($("#inputEntregadorDespacho").val());

            const response = await ajax_function(data, "generar_PDFactaEntrega");
            if (response) {
                $("#modal_signature").modal({
                    show: true,
                });
                $("#nombre_documento").val(response.data.nombre_documento);
                $("#body-documento").show();
                $("#body-firma").show();
                $("#body-sinContrato").hide();
                const url =
                    storage +
                    "documentos/actaEntrega/" +
                    response.data.nombre_documento +
                    ".pdf";


                if (response.data.firma1 && response.data.firma2) {
                    $("#btn_confirmar_actaEntrega").attr("disabled", false);
                }
                mostrarPDF(url);
            }

            $("#spinner_btn_generarActaEntrega").hide();
            $("#spinner_btn_firmarActaEntrega").hide();
            $("#btn_firmar_actaEntrega").attr("disabled", false);
            $("#btn_crear_ActaEntrega").attr("disabled", false);
        } else {
            Swal.fire({
                icon: "error",
                title: "falta tomar fotos al vehiculo!",
            });
        }
    };

    const mostrarPDF = (url) => {
        $("#body-documento").html(
            '<a href="' +
            url +
            '" >Descargar Acta de entrega</a><br>' +
            '<iframe width="100%" height="700px" src="' +
            url +
            '" target="_parent"></iframe>'
        );
    };

    const agregarFotoACarrucel = (array) => {
        let items = "";
        for (let i = 0; i < array.length; i++) {
            items += '<div class="item"><img src="' + array[i] + '" /></div>';
        }
        const html =
            ' <div class="owl-carousel owl-theme" id="carruselVehiculos">' +
            items +
            "</div></div>";
        $("#carrucel").html(html);

        $(".owl-carousel").owlCarousel({
            margin: 5,
        });
    };

    const capturarControlRecepcionArray = async() => {
        //cacturando los accesorios
        const matrizRecepcion = [];

        matrizRecepcion.push(
            $('[name="listA[]"]:checked')
            .map(function() {
                return this.value;
            })
            .get()
        );

        matrizRecepcion.push(
            $('[name="listB[]"]:checked')
            .map(function() {
                return this.value;
            })
            .get()
        );

        matrizRecepcion.push(
            $('[name="listC[]"]:checked')
            .map(function() {
                return this.value;
            })
            .get()
        );

        return matrizRecepcion;
    };

    const resizeBase64Img = (base64, newWidth, newHeight) => {
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
            };
        });
    };


    const guardarDatosDespacho = async(data) => {
        return await ajax_function(data, "registrar_despacho");
    };

    const guardarActaEntrega = async(data, id_despacho) => {
        data.append("nombre_documento", $("#nombre_documento").val());
        data.append("inputIdDespacho", id_despacho);
        await ajax_function(data, "registrar_actaEntrega");
    };

    const cambiarEstadoArriendo = async(data) => {
        data.append("estado", "DESPACHADO");
        await ajax_function(data, "cambiarEstado_arriendo");
    };

    const cambiarEstadoVehiculo = async(data) => {
        data.append("inputPatenteVehiculo", $("#inputPatenteVehiculoDespacho").val());
        data.append("inputEstado", "ARRENDADO");
        data.append("kilometraje_vehiculo", $("#inputKilomentrajeVehiculoDespacho").val());
        await ajax_function(data, "cambiarEstado_vehiculo");
    };

    const enviarCorreoDespacho = async(data) => {
        await ajax_function(data, "enviar_correoDespacho");
    };



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