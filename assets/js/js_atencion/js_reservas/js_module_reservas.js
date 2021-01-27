$("#m_reserva").addClass("active");
$("#l_reserva").addClass("card");


const calcularDias = () => {
    let fechaEntrega = $("#fecha_inicio").val();
    let fechaRecepcion = $("#fecha_fin").val();
    let fechaini = new Date(moment(fechaEntrega));
    let fechafin = new Date(moment(fechaRecepcion));
    let diasdif = fechafin.getTime() - fechaini.getTime();
    let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
    $("#inputNumeroDias").val(dias);
};



$(document).ready(() => {
    $("#spinner_cliente").hide();

    cargarComunas("inputComunaCliente", "inputCiudadCliente");


    $('#fecha_inicio').datetimepicker({
        onChangeDateTime: function () {
            calcularDias()
        },
    });
    $('#fecha_fin').datetimepicker({
        onChangeDateTime: function () {
            calcularDias()
        },
    });


    (cargarRevervas = async () => {
        const response = await ajax_function(null, "cargar_reservas");
        if (response.success) {
            const array_calendario = response.data.map((reserva) => (
                {
                    title: `${reserva.titulo_reserva} `,
                    extendedProps: {
                        info: reserva
                    },
                    start: reserva.inicio_reserva,
                    allDay: false,
                    color: "#FF0F0",
                    textColor: '#FFFFFF'
                }))
            generarCalendario(array_calendario);
        }
    })();



    (cargarVehiculos = async () => {
        const data = new FormData();
        data.append("inputSucursal", $("#selectSucursal").val());
        const response = await ajax_function(data, "cargar_VehiculosPorSucursal");
        if (response.success) {
            if (response.data) {
                const select = document.getElementById("vehiculo");
                $.each(response.data.regione.vehiculos, (i, o) => {
                    let option = document.createElement("option");
                    option.innerHTML = `${o.patente_vehiculo} ${o.marca_vehiculo} ${o.modelo_vehiculo} ${o.año_vehiculo}`;
                    option.value = o.patente_vehiculo;
                    select.appendChild(option);
                });
                $("#vehiculo").attr("disabled", false);
            }
        }
    })();



    const generarCalendario = (array_calendario) => {
        const calendarEl = document.getElementById('calendario');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'today,prev,next btnModalRecerva',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            customButtons: {
                btnModalRecerva: {
                    text: "agregar una reservar ",
                    click: () => {
                        $("#modal_add_reserva").modal();
                        $("#form_reserva")[0].reset();
                    }
                }
            },
            eventSources: [{
                events: array_calendario,
                color: 'black',
                textColor: 'yellow'
            }],
            eventClick: (e) => {
                console.log(e.event.extendedProps)
                $('#tituloReserva').html(e.event.title);
                $("#modal_mostrar_reserva").modal();
            }
        });
        calendar.render();
    }




    $("#btn_buscarCliente").click(async () => {
        const data = new FormData();
        let rut_cliente = $("#inputRutCliente").val();
        if ($("#inputNacionalidadCliente").val() == "EXTRANJERO/A") {
            rut_cliente = `@${rut_cliente}`;
        }
        data.append("rut_cliente", rut_cliente);
        if (rut_cliente.length != 0) {
            $("#spinner_cliente").show();
            const response = await ajax_function(data, "buscar_cliente");
            if (response.success) {
                const c = response.data;
                //se agrega un option para el select ciudad
                const option = document.createElement('option');
                option.value = c.ciudad_cliente;
                option.text = c.ciudad_cliente;
                document.getElementById("inputCiudadCliente").appendChild(option);
                $("#inputComunaCliente").val(c.comuna_cliente);
                $("#inputCiudadCliente").val(c.ciudad_cliente);
                $("#inputNombreCliente").val(c.nombre_cliente);
                $("#inputDireccionCliente").val(c.direccion_cliente);
                $("#inputFechaNacimiento").val(moment(c.fechaNacimiento_cliente ? c.fechaNacimiento_cliente : null).format("YYYY/MM/DD"));
                $("#inputTelefonoCliente").val(c.telefono_cliente);
                $("#inputEstadoCivil").val(c.estadoCivil_cliente);
                $("#inputCorreoCliente").val(c.correo_cliente);
                $("#inputNacionalidadCliente").val(c.nacionalidad_cliente);
            } else {
                $("#inputNombreCliente").val("");
                $("#inputDireccionCliente").val("");
                $("#inputCiudadCliente").val("");
                $("#inputComunaCliente").val("");
                $("#inputTelefonoCliente").val("");
                $("#inputCorreoCliente").val("");
            }
            $("#spinner_cliente").hide();
        }
    });


    $("#btn_guardarReserva").click(async () => {

        if (
            $("#inputRutCliente").val().length == 0 ||
            $("#inputNombreCliente").val().length == 0 ||
            $("#inputTelefonoCliente").val().length == 0 ||
            $("#inputCorreoCliente").val().length == 0 ||
            $("#inputDireccionCliente").val().length == 0 ||
            $("#inputFechaNacimiento").val().length == 0
        ) {
            Swal.fire({ icon: "warning", title: "Faltan datos del cliente!", });
            return;
        }


        alertQuestion(async () => {
            const form = $("#form_reserva")[0];
            const data = new FormData(form);
            const responseClient = await ajax_function(data, "registrar_cliente");
            if (responseClient.success) {
                const responseReserva = await ajax_function(data, "registrar_reserva");
                if (responseReserva.success) {
                    Swal.fire("reserva guardada!", responseReserva.msg, "success");
                    $("#form_reserva")[0].reset();
                    $("#modal_add_reserva").modal("toggle");
                    cargarRevervas();
                }
            }

        })


    });

    /* 
    $route['cargar_reservas'] = 'Reserva_controller/cargarReservas';
    $route['buscar_reserva'] = 'Reserva_controller/buscarReserva';
    $route['registrar_reserva'] = 'Reserva_controller/registrarReserva';
    $route['editar_reserva'] = 'Reserva_controller/editarReserva';
    $route['eliminar_reserva'] = 'Reserva_controller/eliminarReserva';
    */

});