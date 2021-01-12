<div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arriendo Nº <span id="alert_id_arriendo"></span></h5>
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(() => {

    (cargarArriendosActivos = async () => {
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
        if (arriendo.diasActuales_arriendo < 2 && time <= 3600000 * 5) {
            notificacionTemporizador(countDownDate, time, arriendo)
        }
        if (arriendo.diasActuales_arriendo >= 2 && time <= 3600000 * 12) {
            notificacionTemporizador(countDownDate, time, arriendo)
        }
    };


    const notificacionTemporizador = (countDownDate, time, arriendo) => {
        toastr.options = {
            "onclick": function() {
                mostrarModal(arriendo)
            },
            "progressBar": true,
            timeOut: 15000
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

    const mostrarModal = (arriendo) => {
        console.log(arriendo)

        let nombreCliente = null;
        let rutCliente = null;
        let telefonoCliente = null;
        let correoCliente = null;

        switch (arriendo.tipo_arriendo) {
            case "PARTICULAR":
                nombreCliente = arriendo.cliente.nombre_cliente;
                rutCliente = arriendo.cliente.rut_cliente;
                telefonoCliente = arriendo.cliente.telefono_cliente;
                correCliente = arriendo.cliente.corre_cliente;
                break;
            case "REEMPLAZO":
                nombreCliente = arriendo.remplazo.cliente.nombre_cliente;
                rutCliente = arriendo.remplazo.cliente.rut_cliente;
                telefonoCliente = arriendo.remplazo.cliente.telefono_cliente;
                correCliente = arriendo.remplazo.cliente.corre_cliente;
                break;
            case "EMPRESA":
                nombreCliente = arriendo.empresa.nombre_empresa;
                rutCliente = arriendo.empresa.rut_empresa;
                telefonoCliente = arriendo.empresa.telefono_empresa;
                correoCliente = arriendo.empresa.correo_empresa;
                break;
        }


        $("#alert_id_arriendo").html(arriendo.id_arriendo);
        $("#alert_fecha_inicio").html("fecha inicio : " + moment(arriendo.fechaEntrega_arriendo).format(
            "YYYY/MM/DD h:m"));
        $("#alert_fecha_fin").html("fecha fin : " + moment(arriendo.fechaRecepcion_arriendo).format(
            "YYYY/MM/DD h:m"));
        $("#alert_vehiculo").html(
            `Vehiculo Patente: ${arriendo.patente_vehiculo} modelo : ${arriendo.vehiculo.marca_vehiculo} ${arriendo.vehiculo.modelo_vehiculo} ${arriendo.vehiculo.año_vehiculo}`
        );
        $("#alert_nombre_cliente").html(nombreCliente);
        $("#alert_rut_cliente").html(rutCliente);




        $("#modalAlert").modal("show");
    }


});
</script>