<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modulos de Atencion</h1>
    </div>
    <div>
        <h5>Bienvenido <?php echo $this->session->userdata('nombre'); ?> </h5>
        <div class="row">
            <div class="col-md-12">
                <br>
                <img style="width:10%" src="<?php echo base_route() ?>assets/images/logo3.png" />
                <img style="width:30%;margin: 40px" src="<?php echo base_route() ?>assets/images/logo.png" />
            </div>
        </div>
        <div class="card  text-success">
            <div class="m-4">
                <h2>SISTEMA ACTUALIZADO!</h2>
                <span>Cambios realizados:</span>
                <li>Se modifico modulo "gestino de recepcion" y se modifico la funcionalidad de extencion de arriendos.</li>
                <li><span class="text-danger">IMPORTANTE!!</span> Se agrego una condicion al generar el contrato de arriendo , desde ahora sera necesario subir el comprobante de pago correspondiente en el modulo "Facturacion pago cliente" antes de firmar el contrato (solo arriendos particulares y de empresa).</li>


            </div>
        </div>
        <br><br><br><br><br>
        <div id="card_alertas"></div>
    </div>
    </div>
    <br><br>
</main>
</div>
</div>





<script>
    (cargarArriendosActivos = async () => {
        const data = new FormData();
        data.append("filtro", "ACTIVO");
        const response = await ajax_function(data, "cargar_arriendos");
        if (response.success) {
            $.each(response.data, (i, arriendo) => {
                temporizador(arriendo);
            });
        }
    })();

    const temporizador = (arriendo) => {

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
            let fila = `
		<div id="alert${arriendo.id_arriendo}" class="alert  alert-dismissible fade show" role="alert">
		Arriendo: Nº${arriendo.id_arriendo}  Vehiculo: ${arriendo.patente_vehiculo}  Cliente: ${cliente} <div id=time${arriendo.id_arriendo}> </div>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		 <span aria-hidden="true">&times;</span>
		</button>
		</div> `;
            $("#card_alertas").append(fila);
            alertaTemporizador(countDownDate, time, arriendo.id_arriendo)
            time = setInterval(function() {
                alertaTemporizador(countDownDate, time, arriendo.id_arriendo)
            }, 1000);
        }


        if (arriendo.diasActuales_arriendo >= 2 && time <= 3600000 * 12) {
            let fila = `
		<div id="alert${arriendo.id_arriendo}" class="alert  alert-dismissible fade show" role="alert">
		Arriendo: Nº${arriendo.id_arriendo}  Vehiculo: ${arriendo.patente_vehiculo}  Cliente: ${cliente} <div id=time${arriendo.id_arriendo}> </div>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		 <span aria-hidden="true">&times;</span>
		</button>
		</div> `;
            $("#card_alertas").append(fila);
            alertaTemporizador(countDownDate, time, arriendo.id_arriendo)
            time = setInterval(function() {
                alertaTemporizador(countDownDate, time, arriendo.id_arriendo)
            }, 1000);
        }
    };


    const alertaTemporizador = (countDownDate, time, id_arriendo) => {
        let diff = countDownDate.diff(moment());
        if (diff <= 0) {
            clearInterval(time);
            // If the count down is finished, write some text
            $(`#time${id_arriendo}`).text("este arriendo a EXPIRADO");
            $(`#time${id_arriendo}`).addClass("text-danger");
            $(`#alert${id_arriendo}`).addClass("alert-danger");
        } else {
            $(`#alert${id_arriendo}`).addClass("alert-warning");
            $(`#time${id_arriendo}`).text(
                "queda menos de " + moment.utc(diff).format(" HH:mm:ss") + " horas para expirar"
            );
        }
    }
</script>