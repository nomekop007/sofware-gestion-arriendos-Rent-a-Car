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
            temporizador(arriendo.fechaRecepcion_arriendo, arriendo.id_arriendo);

            tablaArriendosActivos.row
                .add([
                    arriendo.id_arriendo,
                    cliente,
                    arriendo.vehiculo.patente_vehiculo,
                    arriendo.tipo_arriendo,
                    formatearFechaHora(arriendo.fechaRecepcion_arriendo),
                    `<div id=time${arriendo.id_arriendo}> </div>`,
                    ` <button value='${arriendo.id_arriendo}'  onclick='buscarArriendoExtender(this.value)'   data-toggle='modal'
                    data-target='#modal_ArriendoExtender' class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> 
                    <button value='${arriendo.id_arriendo}'  onclick='buscarArriendoFinalizar(this.value)'   data-toggle='modal'
                    data-target='#modal_ArriendoFinalizar' class='btn btn btn-outline-success'><i class="fas fa-external-link-square-alt"></i></button>
                    `,
                ])
                .draw(false);
        } catch (error) {
            console.log(error);
        }
    };

    const temporizador = (fechaRecepcion_arriendo, id_arriendo) => {
        $(`#time${id_arriendo}`).text("");
        var countDownDate = moment(fechaRecepcion_arriendo);

        var x = countDownDate.diff(moment());

        var x = setInterval(function() {
            diff = countDownDate.diff(moment());
            var fechaFinal = moment(fechaRecepcion_arriendo);
            var fechaActual = moment();
            var diasRestantes = fechaFinal.diff(fechaActual, "days"); // 1

            if (diff <= 0) {
                clearInterval(x);
                // If the count down is finished, write some text
                $(`#time${id_arriendo}`).text("EXPIRADO");
                $(`#time${id_arriendo}`).addClass("text-danger");
            } else {
                if (diasRestantes > 0) {
                    $(`#time${id_arriendo}`).text(`
                        ${diasRestantes}  ${
						diasRestantes == 1 ? " dia" : " dias"
					}  y ${moment.utc(diff).format(" HH:mm:ss")} horas `);
                } else {
                    $(`#time${id_arriendo}`).text(
                        moment.utc(diff).format(" HH:mm:ss") + " horas"
                    );
                }
            }
        }, 1000);
    };

    const refrescarTablaActivos = () => {
        tablaArriendosActivos.row().clear().draw(false);
        cargarArriendosActivos();
    };
});