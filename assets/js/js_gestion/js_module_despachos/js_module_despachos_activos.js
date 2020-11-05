const calcularDiasExtencion = () => {
    let fechaRecepcion = $("#inputFechaRecepcion_extenderPlazo").val();
    let fechaExtender = $("#inputFechaExtender_extenderPlazo").val();

    let fechaini = new Date(fechaRecepcion);
    let fechafin = new Date(fechaExtender);
    let diasdif = fechafin.getTime() - fechaini.getTime();
    let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
    $("#inputNumeroDias_extenderPlazo").val(dias);
};

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
                    cliente = `${arriendo.cliente.nombre_cliente} ${arriendo.cliente.rut_cliente}`;
                    break;
                case "REMPLAZO":
                    cliente = `${arriendo.remplazo.cliente.nombre_cliente} ${arriendo.remplazo.cliente.rut_cliente}`;
                    break;
                case "EMPRESA":
                    cliente = `${arriendo.empresa.nombre_empresa} ${arriendo.empresa.rut_empresa}`;
                    break;
            }
            temporizador(arriendo.fechaRecepcion_arriendo, arriendo.id_arriendo);

            // onclick='buscarArriendoExtender(this.value)'
            // onclick='buscarArriendoFinalizar(this.value)'
            tablaArriendosActivos.row
                .add([
                    arriendo.id_arriendo,
                    cliente,
                    arriendo.vehiculo.patente_vehiculo,
                    arriendo.tipo_arriendo,
                    formatearFechaHora(arriendo.fechaRecepcion_arriendo),
                    `<div id=time${arriendo.id_arriendo}> </div>`,
                    ` <button value='${arriendo.id_arriendo}'  data-toggle='modal'  data-target='#modal_ArriendoExtender' 
                         class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> 
                          <button value='${arriendo.id_arriendo}'  data-toggle='modal' data-target='#modal_ArriendoFinalizar'
                             class='btn btn btn-outline-success'><i class="fas fa-external-link-square-alt"></i></button>
                    `,
                ])
                .draw(false);
        } catch (error) {
            console.log(error);
        }
    };

    const temporizador = (fechaRecepcion_arriendo, id_arriendo) => {
        $(`#time${id_arriendo}`).text("");

        const countDownDate = moment(fechaRecepcion_arriendo);
        const fechaFinal = moment(fechaRecepcion_arriendo);
        let time = countDownDate.diff(moment());

        time = setInterval(function() {
            alertaTemporizador(countDownDate, fechaFinal, time, id_arriendo);
        }, 1000);
    };

    const alertaTemporizador = (countDownDate, fechaFinal, time, id_arriendo) => {
        let diff = countDownDate.diff(moment());

        const fechaActual = moment();
        const diasRestantes = fechaFinal.diff(fechaActual, "days"); // 1

        if (diff <= 0) {
            clearInterval(time);
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
    };

    const refrescarTablaActivos = () => {
        tablaArriendosActivos.row().clear().draw(false);
        cargarArriendosActivos();
    };
});