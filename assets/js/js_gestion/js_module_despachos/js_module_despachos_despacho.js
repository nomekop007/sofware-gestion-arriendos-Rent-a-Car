const buscarArriendo = async(id_arriendo) => {
    limpiarCampos();
    const data = new FormData();
    data.append("id_arriendo", id_arriendo);
    const response = await ajax_function(data, "buscar_arriendo");
    if (response.success) {
        const arriendo = response.data;
        $("#inputIdArriendo").val(arriendo.id_arriendo);
        $("#inputMarcaVehiculoDespacho").val(arriendo.vehiculo.marca_vehiculo);
        $("#inputModeloVehiculoDespacho").val(arriendo.vehiculo.modelo_vehiculo);
        $("#inputEdadVehiculoDespacho").val(arriendo.vehiculo.año_vehiculo);
        $("#inputColorVehiculoDespacho").val(arriendo.vehiculo.color_vehiculo);
        $("#inputPatenteVehiculoDespacho").val(arriendo.vehiculo.patente_vehiculo);
        $("#inputKilomentrajeVehiculoDespacho").val(
            arriendo.vehiculo.kilometraje_vehiculo
        );
        $("#formActaEntrega").show();
        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                $("#inputRecibidorDespacho").val(arriendo.cliente.nombre_cliente);
                break;
            case "REMPLAZO":
                $("#inputRecibidorDespacho").val(
                    arriendo.remplazo.cliente.nombre_cliente
                );
                break;
            case "EMPRESA":
                $("#inputRecibidorDespacho").val(arriendo.empresa.nombre_empresa);
                break;
        }
    }
    $("#formSpinner").hide();
};

const limpiarCampos = () => {

    mostrarCanvasImgVehiculo([
        "canvas-fotoVehiculo",
        "limpiar-fotoVehiculo",
        "dibujarCanvas",
        "inputImagenVehiculo"
    ]);


    $("#body-documento").hide();
    $("#body-firma").hide();
    $("#body-sinContrato").show();
    $("#nombre_documento").val("");
    $("#subtotal-copago").hide();
    $("#spinner_btn_generarActaEntrega").hide();
    $("#formActaEntrega")[0].reset();
    $("#formSpinner").show();
    $("#formActaEntrega").hide();

    $("#btn_firmar_actaEntrega").attr("disabled", false);
    $("#spinner_btn_firmarActaEntrega").hide();
    $("#spinner_btn_confirmarActaEntrega").hide();
    $("#btn_confirmar_actaEntrega").attr("disabled", true);

    //se limpia los canvas de firma
    dibujarFirma1 = false;
    dibujarFirma2 = false;
    ctxFirma1.clearRect(0, 0, cwFirma1, chFirma1);
    ctxFirma2.clearRect(0, 0, cwFirma2, chFirma2);
    Trazados1.length = 0;
    Trazados2.length = 0;
    puntos1.length = 0;
    puntos2.length = 0;
};



















//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
    //se inician los datatable
    const tablaControldespacho = $("#tablaControldespacho").DataTable(lenguaje);
    const arrayImages = [];

    const btndespacho = document.getElementById("nav-despachos-tab");
    btndespacho.addEventListener("click", () => {
        refrescarTabla();
    });

    (cargarArriendos = async() => {
        $("#spinner_tablaDespacho").show();
        const data = new FormData();
        data.append("filtro", "FIRMADO");
        const response = await ajax_function(data, "cargar_arriendos");
        if (response.success) {
            $.each(response.data, (i, arriendo) => {
                cargarArriendoEnTabla(arriendo);
            });
        }
        $("#spinner_tablaDespacho").hide();
    })();

    $("#seleccionarFoto").click(async() => {
        /*
        se redimenciona la imagen por que los archivos base64 tiene un peso de caracteres elevado y 
		el servidor solo puede recibir un maximo de 2mb en cada consulta.
        Actualizado: es posible que esto cambie debido al ambiente de desarrollo
        o capacidad de la maquina en la que se este ejecutando
        */
        const inputImg = $("#inputImagenVehiculo").val();
        if (inputImg != 0) {
            const canvas = document.getElementById("canvas-fotoVehiculo");
            const base64 = canvas.toDataURL("image/png");
            const url = await resizeBase64Img(base64, canvas.width, canvas.height, 3);
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
                $("#btn_firmar_actaEntrega").attr("disabled", true);
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
                );
                $("#modal_signature").modal("toggle");
                $("#modal_despachar_arriendo").modal("toggle");
            }
        });
    });

    $("#btn_firmar_actaEntrega").click(async() => {
        $("#btn_firmar_actaEntrega").attr("disabled", true);
        $("#spinner_btn_firmarActaEntrega").show();
        obtenerGeolocalizacion();
    });

    $("#limpiarArrayFotos").click(() => {
        arrayImages.length = 0;
        $("#carrucel").empty();
    });

    const obtenerGeolocalizacion = () => {
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
        };
        navigator.geolocation.getCurrentPosition(
            (success = (pos) => {
                console.log(pos);
                const geo =
                    "LAT: " +
                    pos.coords.latitude +
                    " - LOG: " +
                    pos.coords.longitude +
                    " - STAMP: " +
                    pos.timestamp;
                firmarActaEntrega(geo);
            }),
            (error = (err) => {
                console.log(err);
                alert("no se logro obtener la geolocalizacion , active manualmente");
                firmarActaEntrega("no location");
            }),
            options
        );
    };

    const firmarActaEntrega = (geo) => {
        const canvas1 = document.getElementById("canvas-firma1");
        const canvas2 = document.getElementById("canvas-firma2");
        const form = $("#formActaEntrega")[0];
        const data = new FormData(form);
        data.append("inputFirma1PNG", canvas1.toDataURL("image/png"));
        data.append("inputFirma2PNG", canvas2.toDataURL("image/png"));
        data.append("geolocalizacion", geo);
        generarActaEntrega(data);
    };

    const generarActaEntrega = async(data) => {
        if (arrayImages.length > 0) {
            const canvas = document.getElementById("canvas-combustible");
            const url = canvas.toDataURL("image/png");
            const matrizRecepcion = await capturarControlRecepcionArray();
            data.append("matrizRecepcion", JSON.stringify(matrizRecepcion));
            data.append("arrayImages", JSON.stringify(arrayImages));
            data.append("imageCombustible", url);
            $("#btn_crear_ActaEntrega").attr("disabled", true);
            $("#spinner_btn_generarActaEntrega").show();

            $("#recibido").text($("#inputRecibidorDespacho").val());
            $("#entregado").text($("#inputEntregadorDespacho").val());
            const response = await ajax_function(data, "generar_PDFactaEntrega");
            if (response.success) {
                $("#modal_signature").modal({
                    show: true,
                });
                $("#nombre_documento").val(response.data.nombre_documento);
                $("#body-documento").show();
                $("#body-firma").show();
                $("#body-sinContrato").hide();

                mostrarVisorPDF(response.data.url, [
                    "pdf_canvas_despacho",
                    "page_count_despacho",
                    "page_num_despacho",
                    "prev_despacho",
                    "next_despacho"
                ]);
                const a = document.getElementById("descargar_actaEntrega");
                a.href = `${storage}documentos/actaEntrega/${response.data.nombre_documento}.pdf`;


                if (response.data.firma1 && response.data.firma2) {
                    $("#btn_confirmar_actaEntrega").attr("disabled", false);
                }
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


    const agregarFotoACarrucel = (array) => {
        let items = "";
        for (let i = 0; i < array.length; i++) {
            items += `<div class="item"><img src="${array[i]}" /></div>`;
        }
        const html = `<div class="owl-carousel owl-theme" id="carruselVehiculos">${items}</div></div>`;
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

    const guardarDatosDespacho = async(data) => {
        return await ajax_function(data, "registrar_despacho");
    };

    const guardarActaEntrega = async(data, id_despacho) => {
        data.append("nombre_documento", $("#nombre_documento").val());
        data.append("inputIdDespacho", id_despacho);
        await ajax_function(data, "registrar_actaEntrega");
    };

    const cambiarEstadoArriendo = async(data) => {
        data.append("id_arriendo", $("#inputIdArriendo").val());
        data.append("estado", "ACTIVO");
        await ajax_function(data, "cambiarEstado_arriendo");
    };

    const cambiarEstadoVehiculo = async(data) => {
        data.append(
            "inputPatenteVehiculo",
            $("#inputPatenteVehiculoDespacho").val()
        );
        data.append("inputEstado", "ARRENDADO");
        data.append(
            "kilometraje_vehiculo",
            $("#inputKilomentrajeVehiculoDespacho").val()
        );
        await ajax_function(data, "cambiarEstado_vehiculo");
    };

    const enviarCorreoDespacho = async(data) => {
        await ajax_function(data, "enviar_correoActaEntrega");
    };

    const refrescarTabla = () => {
        //limpia la tabla
        tablaControldespacho.row().clear().draw(false);
        //carga nuevamente
        cargarArriendos();
    };

    //carga tablaTotalArriendos
    const cargarArriendoEnTabla = (arriendo) => {
        try {
            let cliente = "";
            switch (arriendo.tipo_arriendo) {
                case "PARTICULAR":
                    cliente = `${arriendo.cliente.nombre_cliente} ${arriendo.cliente.rut_cliente}`;
                    break;
                case "REMPLAZO":
                    cliente = `${arriendo.remplazo.cliente.nombre_cliente} ${arriendo.remplazo.cliente.rut_cliente}`;
                    break;
                case "EMPRESA":
                    cliente = `${arriendo.empresa.nombre_empresa} ${arriendo.empresa.rut_empresa}`;
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
                    arriendo.usuario.nombre_usuario,
                    ` <button value='${arriendo.id_arriendo}'  onclick='buscarArriendo(this.value)'   data-toggle='modal'
                    data-target='#modal_despachar_arriendo' class='btn btn btn-outline-success'><i class='fas fa-concierge-bell'></i></button>  `,
                ])
                .draw(false);
        } catch (error) {
            console.log(error);
        }
    };
});