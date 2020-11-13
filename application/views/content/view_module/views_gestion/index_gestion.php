<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modulos de Gestion</h1>
    </div>
    <div>
        <h5>Bienvenido <?php echo $this->session->userdata('nombre'); ?> </h5>
        <div class="row">
            <div class="col-md-12">
                <br>
                <img style="width:15%" src="<?php echo base_route() ?>assets/images/logo3.png" />
                <img style="width:40%;margin: 40px" src="<?php echo base_route() ?>assets/images/logo.png" />
            </div>
        </div>
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
            temporizador(arriendo.fechaRecepcion_arriendo, arriendo.id_arriendo);
        });
    }
})();

const temporizador = (fechaRecepcion_arriendo, id_arriendo) => {
    const countDownDate = moment(fechaRecepcion_arriendo);

    let time = countDownDate.diff(moment());
    // 1 segundo = 1.000
    // 1 minuto = 60.000
    // 1 hora = 3.600.000
    if (time <= 3600000 * 2) {

        let fila = `
            <div id="alert${id_arriendo}" class="alert  alert-dismissible fade show" role="alert">
               ARRIENDO Nº${id_arriendo} <div id=time${id_arriendo}> </div>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
            </button>
            </div> `;
        $("#card_alertas").append(fila);
        alertaTemporizador(countDownDate, time, id_arriendo)
        time = setInterval(function() {
            alertaTemporizador(countDownDate, time, id_arriendo)
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
            "queda menos de dos horas para expirar ( " + moment.utc(diff).format(" HH:mm:ss") + " horas )"
        );
    }
}
</script>