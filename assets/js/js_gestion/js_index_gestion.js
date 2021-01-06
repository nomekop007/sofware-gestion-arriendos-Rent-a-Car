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
		time = setInterval(function () {
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
		time = setInterval(function () {
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
