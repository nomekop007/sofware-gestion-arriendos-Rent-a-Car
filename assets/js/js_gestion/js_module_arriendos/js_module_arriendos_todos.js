$(document).ready(() => {
    var tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);

    (() => {
        const url = base_route + "cargar_TotalArriendos";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    tablaTotalArriendos.row
                        .add([
                            o.id_arriendo,
                            formatearFecha(o.createdAt),
                            o.tipo_arriendo,
                            o.estado_arriendo,
                            o.usuario.nombre_usuario,
                            " <button  onclick='confirmacion(" +
                            o.id_arriendo +
                            ")' data-toggle='modal' data-target='#modal_confirmar_arriendo' class='btn btn-outline-info'><i class='fas fa-check-circle'></i></button>  " +
                            " <button data-toggle='modal' data-target='#modal_bajar_docs' class='btn btn-outline-dark'><i class='far fa-file-alt'></i></button>  " +
                            " <button data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn btn-outline-primary'><i class='far fa-edit'></i></button>  ",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar los arriendos");
            }
        });
    })();
});