<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Modulos de Atencion</h2>
    </div>
    <div>
        <h3>Bienvenido <?php echo $this->session->userdata('nombre'); ?> </h3>
        <br>
        <div class="row">
            <div class="col-md-6">
                <img style="width:100%;" src="<?php echo base_route() ?>assets/images/logo.png" />
            </div>
            <div class="col-md-6">
                <h3>Vehiculos disponibles</h3>
                <div class="scroll">
                    <table id="tablaTotalArriendos" class="table table-striped table-bordered " style="width:100%">
                        <thead class="btn-dark">
                            <tr id="thead_sucursal">
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="tbody1_sucursal">
                            </tr>
                            <tr id="tbody2_sucursal">
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="card  text-success">
            <div class="m-4">
                <h1>SISTEMA ACTUALIZADO! 03-03-2021</h1>
                <span>Cambios realizados:</span>
                <li>MODULO ATENCION: Se agrego una tabla con el listado y cantidad de vehiculos de cada sucursal (beta).</li>
                <li>MODULO GESTION VEHICULO : se asociaron los vehiculos a las sucursales , en primera instancia se debe indicar a que sucursal pertenece a cada vehiculo.</li>
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
        const response = await ajax_function(null, "cargar_Sucursales");
        response.data.forEach(async (sucursal) => {
            const data = new FormData();
            data.append("id_sucursal", sucursal.id_sucursal);
            const response = await ajax_function(data, "cargar_vehiculosDisponibleSucursal")
            let option = '<option value=null">-vehiculos-</option>';
            response.data.forEach(({
                patente_vehiculo
            }) => {
                option += `<option value="${patente_vehiculo}">${patente_vehiculo}</option>`;
            })
            thead += `<th>${sucursal.nombre_sucursal}</th>`;
            tbody1 += `<th class="text-center" >${response.data.length}</th>`;
            tbody2 += `<th class="text-center" ><select class="form-control">${option}</select></th>`;
            $("#thead_sucursal").html(thead);
            $("#tbody1_sucursal").html(tbody1);
            $("#tbody2_sucursal").html(tbody2);
        })
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