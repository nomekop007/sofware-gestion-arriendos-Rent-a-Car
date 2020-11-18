$("#m_facturacion").addClass("active");
$("#l_facturacion").addClass("card");


$(document).ready(() => {

    const tabla_facturacion = $("#tabla_facturaciones").DataTable(lenguaje);

    $("#nav-facturaciones-tab").click(() => refrescarTabla());

    const refrescarTabla = () => {
        //limpia la tabla
        tabla_facturacion.row().clear().draw(false);
        //carga nuevamente
        cargarFacturaciones();
    };


    const cargarFacturaciones = async () => {
        $("#spinner_tabla_facturaciones").show();
        const response = await ajax_function(null, "cargar_facturaciones");
        if (response.success) {
            $.each(response.data, (i, facturacion) => {
                cargarFacturacionEnTabla(facturacion);
            });
        }
        $("#spinner_tabla_facturaciones").hide();
    };


    const cargarFacturacionEnTabla = (facturacion) => {
        try {
            tabla_facturacion.row
                .add([
                    facturacion.id_facturacion,
                    facturacion.tipo_facturacion,
                    facturacion.numero_facturacion,
                    facturacion.cantidadPagos,
                    formatearFechaHora(facturacion.createdAt),
                    facturacion.userAt,
                    "",
                    ` <button value='${facturacion.id_facturacion}' onclick='buscarFacturacion(this.value)'
                       data-toggle='modal' data-target='#modal_editar' class='btn btn-outline-info'><i class='far fa-eye'></i></button> `,
                ])
                .draw(false);
        } catch (error) {
            console.log("error al cargar la facturacion: " + error);
        }
    };

})