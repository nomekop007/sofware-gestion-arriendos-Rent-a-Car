const calcularDiasExtencion = () => {
    let fechaRecepcion = $("#inputFechaRecepcion_extenderPlazo").val();
    let fechaExtender = $("#inputFechaExtender_extenderPlazo").val();

    let fechaini = new Date(fechaRecepcion);
    let fechafin = new Date(fechaExtender);
    let diasdif = fechafin.getTime() - fechaini.getTime();
    let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
    $("#inputNumeroDias_extenderPlazo").val(dias);
};

const calcularValores = () => {
    //variables
    let valorArriendo = Number($("#inputValorArriendo").val());
    let valorCopago = Number($("#inputValorCopago").val());
    let iva = Number($("#inputIVA").val());
    let descuento = Number($("#inputDescuento").val());
    let total = Number($("#inputTotal").val());
    let TotalNeto = 0;

    TotalNeto = TotalNeto + valorArriendo - descuento - valorCopago;
    iva = TotalNeto * 0.19;
    total = TotalNeto + iva;
    $("#inputNeto").val(TotalNeto);
    $("#inputIVA").val(Math.round(iva));
    $("#inputTotal").val(Math.round(total));
};

const buscarArriendoExtender = async(id_arriendo) => {
    limpiarFormulario();
    const data = new FormData();
    data.append("id_arriendo", id_arriendo);
    const response = await ajax_function(data, "buscar_arriendo");
    if (response.success) {
        const arriendo = response.data;
        $("#numeroArriendo").html("Nº " + arriendo.id_arriendo)
        $("#inputFechaRecepcion_extenderPlazo").val(arriendo.fechaRecepcion_arriendo.substring(0, 16));
        $("#inputFechaExtender_extenderPlazo").prop('min', arriendo.fechaRecepcion_arriendo.substring(0, 16));
        $("#id_arriendo").val(arriendo.id_arriendo);
        $("#dias_arriendo").val(arriendo.numerosDias_arriendo);
    }
}


const buscarArriendoFinalizar = async(id_arriendo) => {
    limpiarFormulario();
    const data = new FormData();
    data.append("id_despacho", id_arriendo);
    const response = await ajax_function(data, "buscar_actaEntrega");
    if (response.success) {
        const base64 = response.data.base64;
        mostrarVisorPDF(base64, [
            "pdf_canvas_recepcion",
            "page_count_recepcion",
            "page_num_recepcion",
            "prev_recepcion",
            "next_recepcion"
        ]);
    }
}

const limpiarFormulario = () => {
    $("#numeroArriendo").html("")
    $("#spinner_btn_extenderArriendo").hide();
    $("#formExtenderArriendo")[0].reset();
}




















//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//


$(document).ready(() => {

    const tablaArriendosActivos = $("#tablaArriendosActivos").DataTable(lenguaje);
    const btnActivos = document.getElementById("nav-activos-tab");
    btnActivos.addEventListener("click", () => {
        refrescarTablaActivos();
    });

    const cargarArriendosActivos = async() => {
        $("#spinner_tablaArriendoActivos").show();
        const data = new FormData();
        data.append("filtro", "ACTIVO");
        const response = await ajax_function(data, "cargar_arriendos");

        if (response) {
            $.each(response.data, (i, arriendo) => {
                cargarArriendoActivosEnTabla(arriendo);
            });
        }
        $("#spinner_tablaArriendoActivos").hide();
    };


    $("#btn_extenderArriendo").click(() => {
        const diasActuales = $("#dias_arriendo").val()
        const diasExtendidos = $("#inputNumeroDias_extenderPlazo").val();
        const subtotal = $("#inputValorArriendo").val();
        const copago = $("#inputValorCopago").val();
        const total = $("#inputTotal").val();

        if (diasExtendidos.length == 0 || subtotal.length == 0 || copago.length == 0 || total < 0) {
            Swal.fire(
                "faltan datos , o datos erroneos",
                "corriga el formulario!",
                "error"
            );
            return;
        }
        if (diasExtendidos <= 0) {
            Swal.fire(
                "Extencion fallida",
                "la extencion del contrato tiene que ser mayor a 1 dia",
                "error"
            );
            return;
        }
        Swal.fire({
            title: "Estas seguro?",
            text: "estas a punto de extender el plazo de un arriendo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async(result) => {
            if (result.isConfirmed) {
                $("#spinner_btn_extenderArriendo").show();
                $("#btn_extenderArriendo").attr("disabled", true)
                const form = $("#formExtenderArriendo")[0];
                const data = new FormData(form);
                data.append("nuevosDias", Number(diasActuales) + Number(diasExtendidos));
                const response = await extenderContrato(data);
                if (response.success) {
                    refrescarTablaActivos();
                    Swal.fire(
                        "Arriendo extendido",
                        "Arriendo extendido con exito!, proseguir a firmar el contrato",
                        "success"
                    );
                    $("#modal_ArriendoExtender").modal("toggle");
                }
                $("#spinner_btn_extenderArriendo").hide();
                $("#btn_extenderArriendo").attr("disabled", false)
            }
        });
    });

    const extenderContrato = async(data) => {
        const response = await ajax_function(data, "extenderArriendo_pago");
        if (response.success) {
            return await ajax_function(data, "extender_arriendo");
        }
    }

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



            tablaArriendosActivos.row
                .add([
                    arriendo.id_arriendo,
                    cliente,
                    arriendo.vehiculo.patente_vehiculo,
                    arriendo.tipo_arriendo,
                    formatearFechaHora(arriendo.fechaRecepcion_arriendo),
                    `<div id=time${arriendo.id_arriendo}> </div>`,
                    ` <button value='${arriendo.id_arriendo}' onclick='buscarArriendoExtender(this.value)'  data-toggle='modal'  data-target='#modal_ArriendoExtender' 
                         class='btn btn btn-outline-info'><i class="fab fa-algolia"></i></button> 
                          <button value='${arriendo.id_arriendo}' onclick='buscarArriendoFinalizar(this.value)'  data-toggle='modal' data-target='#modal_ArriendoFinalizar'
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