<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Modulos de Atencion</h2>
    </div>
    <div>
        <h3>Bienvenido <?php echo $this->session->userdata('nombre'); ?> </h3>
        <br>
        <div class="row">
            <div class="col-md-5">
                <br><br><br><br>
                <img style="width:100%;" src="<?php echo base_route() ?>assets/images/logo.png" />
            </div>
            <div class="col-md-7">
                <h5>Tabla vehiculos</h5>
                <?php if (validarPermiso(10)) { ?>
                    <input hidden type="text" id="id_sucursal" value="0" disabled>
                <?php } ?>

                <?php if (!validarPermiso(10)) { ?>
                    <input hidden type="text" id="id_sucursal" value="<?php echo $this->session->userdata('sucursal') ?>" disabled>
                <?php } ?>
                <div class="scroll">
                    <table id="tablaTotalArriendos" class="table table-striped table-bordered " style="width:100%">
                        <thead class="btn-dark">
                            <tr id="thead_sucursal">
                            </tr>
                        </thead>
                        <tbody>
                            <tr style='font-size: 0.6rem;' id="tbody1_sucursal">
                            </tr>
                            <tr style='font-size: 0.6rem;' id="tbody2_sucursal">
                            </tr>
                            <tr style='font-size: 0.6rem;' id="tbody3_sucursal">
                            </tr>
                            <tr style='font-size: 0.6rem;' id="tbody4_sucursal">
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="card  text-success">
            <div class="m-4">
                <h1>SISTEMA ACTUALIZADO! 09-03-2021</h1>
                <span>Cambios realizados:</span>
                <li>se agregaron 2 bloqueos , uno en el momento cuando de recepciona un vehiculo y otra cuando se registra un arriendo.</li>
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
    // a futuro hacer separar un contador por sucursal

    (cargarSucursales = async () => {
        let thead = '';
        let tbody1 = '';
        let tbody2 = '';
        let tbody3 = '';
        let tbody4 = '';

        if ($("#id_sucursal").val() === '0') {
            const response = await ajax_function(null, "cargar_Sucursales");
            response.data.forEach(async (sucursal) => {
                const data = new FormData();
                data.append("id_sucursal", sucursal.id_sucursal);
                const responseDisponible = await ajax_function(data, "cargar_vehiculosDisponibleSucursal");
                const responseArrendado = await ajax_function(data, "cargar_vehiculosArrendadoSucursal");
                let optionDisponibles = '<option value=null">-Disponibles-</option>';
                responseDisponible.data.forEach(({
                    patente_vehiculo
                }) => {
                    optionDisponibles += `<option value="${patente_vehiculo}">${patente_vehiculo}</option>`;
                })
                let optionArrendados = '<option value=null">-Arrendados-</option>';
                responseArrendado.data.forEach(({
                    patente_vehiculo
                }) => {
                    optionArrendados += `<option value="${patente_vehiculo}">${patente_vehiculo}</option>`;
                })
                thead += `<th class="text-center">${sucursal.nombre_sucursal}</th>`;
                tbody1 += `<th class="text-center" >DISPONIBLES :  ${responseDisponible.data.length}</th>`;
                tbody2 += `<th class="text-center" ><select class="form-control">${optionDisponibles}</select></th>`;
                tbody3 += `<th class="text-center" >ARRENDADOS :  ${responseArrendado.data.length}</th>`;
                tbody4 += `<th class="text-center" ><select class="form-control">${optionArrendados}</select></th>`;
                $("#thead_sucursal").html(thead);
                $("#tbody1_sucursal").html(tbody1);
                $("#tbody2_sucursal").html(tbody2);
                $("#tbody3_sucursal").html(tbody3);
                $("#tbody4_sucursal").html(tbody4);
            });

        } else {


            const data = new FormData();
            data.append("id_sucursal", $("#id_sucursal").val());
            const responseSucursal = await ajax_function(data, "buscar_sucursal");
            console.log(responseSucursal);
            const responseDisponible = await ajax_function(data, "cargar_vehiculosDisponibleSucursal");
            const responseArrendado = await ajax_function(data, "cargar_vehiculosArrendadoSucursal");
            console.log(responseArrendado)
            let optionDisponibles = '<option value=null">-Disponibles-</option>';
            responseDisponible.data.forEach(({
                patente_vehiculo
            }) => {
                optionDisponibles += `<option value="${patente_vehiculo}">${patente_vehiculo}</option>`;
            })
            let optionArrendados = '<option value=null">-Arrendados-</option>';
            responseArrendado.data.forEach(({
                patente_vehiculo
            }) => {
                optionArrendados += `<option value="${patente_vehiculo}">${patente_vehiculo}</option>`;
            })
            thead += `<th class="text-center">${responseSucursal.data.nombre_sucursal}</th>`;
            tbody1 += `<th class="text-center" >DISPONIBLES :  ${responseDisponible.data.length}</th>`;
            tbody2 += `<th class="text-center" ><select class="form-control">${optionDisponibles}</select></th>`;
            tbody3 += `<th class="text-center" >ARRENDADOS :  ${responseArrendado.data.length}</th>`;
            tbody4 += `<th class="text-center" ><select class="form-control">${optionArrendados}</select></th>`;
            $("#thead_sucursal").html(thead);
            $("#tbody1_sucursal").html(tbody1);
            $("#tbody2_sucursal").html(tbody2);
            $("#tbody3_sucursal").html(tbody3);
            $("#tbody4_sucursal").html(tbody4);

        }

    })();



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
		Arriendo: Nº${arriendo.id_arriendo}  Vehiculo: ${arriendo.patente_vehiculo}  Cliente: ${cliente} Sucursal: ${arriendo.sucursale.nombre_sucursal} <div id=time${arriendo.id_arriendo}> </div>

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
		Arriendo: Nº${arriendo.id_arriendo}  Vehiculo: ${arriendo.patente_vehiculo}  Cliente: ${cliente}  Sucursal: ${arriendo.sucursale.nombre_sucursal}  <div id=time${arriendo.id_arriendo}> </div>
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