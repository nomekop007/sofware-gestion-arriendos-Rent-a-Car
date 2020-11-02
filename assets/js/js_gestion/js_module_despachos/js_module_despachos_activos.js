$(document).ready(() => {
    const tablaArriendosActivos = $("#tablaArriendosActivos").DataTable(lenguaje);
    const btnActivos = document.getElementById("nav-activos-tab");
    btnActivos.addEventListener("click", () => {
        refrescarTablaActivos();
    });

    const cargarArriendosActivos = async() => {
        $("#spinner_tablaArriendoActivos").show();
        const data = new FormData();
        data.append("filtro", "DESPACHADO");
        const response = await ajax_function(data, "cargar_arriendos");

        if (response) {
            $.each(response.data, (i, arriendo) => {
                cargarArriendoActivosEnTabla(arriendo);
            });
        }
        $("#spinner_tablaArriendoActivos").hide();
    };

    const cargarArriendoActivosEnTabla = (arriendo) => {
        try {
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

            tablaArriendosActivos.row
                .add([
                    arriendo.id_arriendo,
                    cliente,
                    arriendo.vehiculo.patente_vehiculo,
                    arriendo.tipo_arriendo,
                    formatearFechaHora(arriendo.fechaEntrega_arriendo),
                    formatearFechaHora(arriendo.fechaRecepcion_arriendo),
                    "algo",
                ])
                .draw(false);
        } catch (error) {
            console.log(error);
        }
    };

    const refrescarTablaActivos = () => {
        tablaArriendosActivos.row().clear().draw(false);
        cargarArriendosActivos();
    };
});