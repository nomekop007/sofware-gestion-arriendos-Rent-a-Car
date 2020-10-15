$(document).ready(() => {
    cargarArriendos();

    //se inician los datatable
    var tablaControldespacho = $("#tablaControldespacho").DataTable(lenguaje);

    function cargarArriendos() {
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
    }

    $("#btn_guardar_fotoDespacho").click(() => {
        var data = new FormData();

        for (let i = 0; i < $("#inputFotos").val().length; i++) {
            data.append("fotos", $("#inputFotos")[0].files[i]);
        }
        console.log(data);
    });

    //carga tablaTotalArriendos
    function cargarArriendoEnTabla(arriendo) {
        var cliente = "";
        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                var cliente = arriendo.cliente.nombre_cliente;
                break;
            case "REMPLAZO":
                var cliente = arriendo.remplazo.cliente.nombre_cliente;
                break;
            case "EMPRESA":
                var cliente = arriendo.empresa.nombre_empresa;
                break;
            default:
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
                " onclick='cargarArriendo(this.value)'" +
                " data-toggle='modal' data-target='#modal_despachar_arriendo' class='btn btn btn-outline-success'><i class='fas fa-concierge-bell'></i></button>  " +
                " <button  data-toggle='modal' data-target='#modal_fotos_despacho' class='btn btn btn-outline-dark'><i class='fas fa-camera-retro'></i></button>  ",
            ])
            .draw(false);
    }
});