<div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arriendo Nº <span id="alert_id_arriendo"></span> <span
                        id="alert_estado_atraso"></span></h5>
            </div>
            <div class="modal-body">
                <br>
                <h4>Datos arriendo</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span id="alert_fecha_inicio" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <span id="alert_fecha_fin" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <span id="alert_vehiculo" class="input-group-text form-control"></span>
                    </div>
                </div>
                <br>
                <h4>Contacto Cliente</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span id="alert_nombre_cliente" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <span id="alert_rut_cliente" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <span id="alert_telefono_cliente" class="input-group-text form-control"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <span id="alert_correo_cliente" class="input-group-text form-control"></span>
                    </div>
                </div>
                <br>
                <div class="card ">
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-center">
                            <a class="btn btn-outline-info" id="alert_telefono_input_cliente">Llamar cliente </a>
                        </div>
                        <div class="form-group col-md-6 text-center">
                            <button type="button" class="btn btn-outline-dark" id="alert_btn_enviar_correo">enviar
                                correo autogenerado sobre vencimiento </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(() => {

    (cargarArriendosParaNotificacion = async () => {
        const data = new FormData();
        data.append("filtro", "ACTIVO");
        const response = await ajax_function(data, "cargar_arriendos");
        if (response.success) {
            $.each(response.data, (i, arriendo) => {
                notificacion(arriendo);
            });
        }
    })();

    const notificacion = (arriendo) => {
        let cliente = "";
        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                cliente = `${arriendo.cliente.nombre_cliente}`;
                break;
            case "REEMPLAZO":
                cliente = `${arriendo.remplazo.cliente.nombre_cliente}`;
                break;
            case "EMPRESA":
                cliente = `${arriendo.empresa.nombre_empresa}`;
                break;
        }
        const countDownDate = moment(arriendo.fechaRecepcion_arriendo);
        let time = countDownDate.diff(moment());
        // 1 segundo = 1.000
        // 1 minuto = 60.000
        // 1 hora = 3.600.000
        let estadoAtraso = '';
        if (arriendo.diasActuales_arriendo < 2 && time <= 3600000 * 5) {
            notificacionTemporizador(countDownDate, time, arriendo)
        }
        if (arriendo.diasActuales_arriendo >= 2 && time <= 3600000 * 12) {
            notificacionTemporizador(countDownDate, time, arriendo, )
        }
    };


    const notificacionTemporizador = (countDownDate, time, arriendo) => {
        toastr.options = {
            "onclick": function() {
                mostrarModalNotificacion(arriendo)
            },
            "progressBar": true,
            timeOut: 0
        }
        let diff = countDownDate.diff(moment());
        if (diff <= 0) {
            clearInterval(time);
            toastr.error('este arriendo a EXPIRADO', 'Arriendo Nº ' + arriendo.id_arriendo)
        } else {
            toastr.warning("queda menos de " + moment.utc(diff).format(" HH:mm:ss") + " horas para expirar",
                'Arriendo Nº ' + arriendo.id_arriendo)
        }
    }

    const mostrarModalNotificacion = (arriendo) => {
        let nombreCliente = null;
        let rutCliente = null;
        let telefonoCliente = null;
        let correoCliente = null;
        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                nombreCliente = arriendo.cliente.nombre_cliente;
                rutCliente = arriendo.cliente.rut_cliente;
                telefonoCliente = arriendo.cliente.telefono_cliente;
                correoCliente = arriendo.cliente.correo_cliente;
                break;
            case "REEMPLAZO":
                nombreCliente = arriendo.remplazo.cliente.nombre_cliente;
                rutCliente = arriendo.remplazo.cliente.rut_cliente;
                telefonoCliente = arriendo.remplazo.cliente.telefono_cliente;
                correoCliente = arriendo.remplazo.cliente.correo_cliente;
                break;
            case "EMPRESA":
                nombreCliente = arriendo.empresa.nombre_empresa;
                rutCliente = arriendo.empresa.rut_empresa;
                telefonoCliente = arriendo.empresa.telefono_empresa;
                correoCliente = arriendo.empresa.correo_empresa;
                break;
        }
        let estadoAtraso = '';
        let dias = '';
        const countDownDate = moment(arriendo.fechaRecepcion_arriendo);
        let diff = countDownDate.diff(moment());
        if (diff <= 0) {
            const diasRestantes = countDownDate.diff(moment(), "days");
            if (diasRestantes < 0) {
                dias = diasRestantes + " dias";
            }
            estadoAtraso =
                `(Este arriendo a EXPIRADO con ${dias}  ${moment.utc(diff).format(" HH:mm:ss")} horas de atraso )`;
        } else {
            estadoAtraso = `(Queda menos de ${moment.utc(diff).format(" HH:mm:ss")} horas para expirar)`
        }
        $("#alert_id_arriendo").html(arriendo.id_arriendo);
        $("#alert_estado_atraso").html(estadoAtraso);
        $("#alert_fecha_inicio").html("fecha inicio : " + moment(arriendo.fechaEntrega_arriendo).format(
            "YYYY/MM/DD hh:mm"));
        $("#alert_fecha_fin").html("fecha fin : " + moment(arriendo.fechaRecepcion_arriendo).format(
            "YYYY/MM/DD hh:mm"));
        $("#alert_vehiculo").html(
            `Vehiculo Patente: ${arriendo.patente_vehiculo} modelo : ${arriendo.vehiculo.marca_vehiculo} ${arriendo.vehiculo.modelo_vehiculo} ${arriendo.vehiculo.año_vehiculo}`
        );
        $("#alert_rut_cliente").html("Rut : " + rutCliente);
        $("#alert_telefono_cliente").html("Telefono : +569 " + telefonoCliente);

        $("#alert_nombre_cliente").html("Nombre : " + nombreCliente);
        $("#alert_correo_cliente").html("Correo : " + correoCliente);
        $("#alert_nombre_cliente").val(nombreCliente);
        $("#alert_correo_cliente").val(correoCliente);

        const inputTelefono = document.getElementById("alert_telefono_input_cliente");
        inputTelefono.href = "tel:+569" + telefonoCliente;
        inputTelefono.text = "Llamar cliente +569 " + telefonoCliente
        $("#modalAlert").modal("show");
    }

    $("#alert_btn_enviar_correo").click(() => {
        Swal.fire({
            title: "Estas seguro de enviar el correo?",
            text: "se enviara un correo autogenerado avisando al cliente sobre el estado de su arriendo !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, seguro",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true,
        }).then(async (result) => {
            if (result.isConfirmed) {
                const data = new FormData();
                data.append("id_arriendo", $("#alert_id_arriendo").text());
                data.append("correo_cliente", $("#alert_correo_cliente").val())
                data.append("nombre_cliente", $("#alert_nombre_cliente").val())
                const response = await ajax_function(data, "enviarCorreo_alertaArriendo");
                if (response.success) {
                    Swal.fire(
                        "correo enviado con exito!",
                        "se envio un correo al usuario avisando sobre el estado de su arriendo",
                        "success"
                    )
                    $("#modalAlert").modal("toggle");
                }
            }
        });
    })


});
</script>