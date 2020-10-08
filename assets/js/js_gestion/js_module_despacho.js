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

    //carga tablaTotalArriendos
    function cargarArriendoEnTabla(arriendo) {
        tablaControldespacho.row
            .add([
                arriendo.id_arriendo,
                arriendo.cliente ?
                arriendo.cliente.nombre_cliente :
                arriendo.empresa.nombre_empresa,
                arriendo.vehiculo.patente_vehiculo,
                formatearFechaHora(arriendo.fechaEntrega_arriendo),
                formatearFechaHora(arriendo.fechaRecepcion_arriendo),
                arriendo.tipo_arriendo,
                arriendo.estado_arriendo,
                arriendo.usuario.nombre_usuario,

                " <button  data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn btn-outline-success'><i class='fas fa-concierge-bell'></i></button>  ",
            ])
            .draw(false);

        if (arriendo.estado_arriendo != "PENDIENTE") {
            $(`#${arriendo.id_arriendo}`).attr("disabled", true);
        }
    }
});