$(document).ready(() => {
    //se inician los datatable
    const tablaControldespacho = $("#tablaControldespacho").DataTable(lenguaje);

    const carousel = $(".owl-carousel").owlCarousel({
        margin: 5,
    });
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




    $("#btn_guardar_fotoDespacho").click(() => {


    });


    $("#seleccionarFoto").click(() => {
        const canvas = document.getElementById("canvas-fotoVehiculo");
        const url = canvas.toDataURL("image/png")

        arrayImages.push(url);


        //AGREGAR IMAGEN A CARRUSEL
        const img = document.createElement("img");
        img.src = "https://www.ecured.cu/images/d/d8/Iconos%28informatica%29.png";



        console.log(arrayImages);
    });













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