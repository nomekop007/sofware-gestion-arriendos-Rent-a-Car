$("#m_reserva").addClass("active");
$("#l_reserva").addClass("card");

let calendar_global = null;

const calcularDiasRegistrar = () => {
    let fechaEntrega = $("#fecha_inicio").val();
    let fechaRecepcion = $("#fecha_fin").val();
    if (fechaEntrega.length != 0 && fechaRecepcion.length != 0) {
        let fechaini = new Date(moment(fechaEntrega));
        let fechafin = new Date(moment(fechaRecepcion));
        let diasdif = fechafin.getTime() - fechaini.getTime();
        let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
        $("#inputNumeroDias").val(dias);
    }
};


const calcularDiasMostrar = () => {
    let fechaEntrega = $("#fecha_inicio_mostrar").val();
    let fechaRecepcion = $("#fecha_fin_mostrar").val();
    if (fechaEntrega.length != 0 && fechaRecepcion.length != 0) {
        let fechaini = new Date(moment(fechaEntrega));
        let fechafin = new Date(moment(fechaRecepcion));
        let diasdif = fechafin.getTime() - fechaini.getTime();
        let dias = Math.round(diasdif / (1000 * 60 * 60 * 24));
        $("#inputNumeroDias_mostrar").val(dias);
    }
};


const tipoCliente = (value) => {
    switch (value) {
        case "PARTICULAR":
            $("#option_empresa").hide();
            $("#option_natural").show();
            break;
        case "EMPRESA":
            $("#option_empresa").show();
            $("#option_natural").hide();
            break;
    }
};


$(document).ready(() => {
    $("#spinner_cliente").hide();
    $("#spinner_empresa").hide();
    cargarComunas("inputComunaCliente", "inputCiudadCliente");
    cargarComunas("inputComunaEmpresa", "inputCiudadEmpresa");
    cargarOlder("inputVigencia");


    $('#fecha_inicio').datetimepicker({
        onChangeDateTime: function () {
            calcularDiasRegistrar()
        },
    });
    $('#fecha_fin').datetimepicker({
        onChangeDateTime: function () {
            calcularDiasRegistrar()
        },
    });

    $('#fecha_inicio_mostrar').datetimepicker({
        onChangeDateTime: function () {
            calcularDiasMostrar()
        },
    });
    $('#fecha_fin_mostrar').datetimepicker({
        onChangeDateTime: function () {
            calcularDiasMostrar()
        },
    });


    (cargarReservas = async () => {
        const response = await ajax_function(null, "cargar_reservas");
        if (response.success) {
            const array_calendario = response.data.map((reserva) => (
                {
                    title: `${reserva.titulo_reserva} `,
                    extendedProps: {
                        info: reserva
                    },
                    start: reserva.inicio_reserva,
                    color: reserva.color_reserva,
                    textColor: 'yellow',
                    url: '#'
                }))
            generarCalendario(array_calendario);
        }
    })();



    (cargarVehiculos = async () => {
        const data = new FormData();
        data.append("inputSucursal", $("#selectSucursal").val());
        const response = await ajax_function(data, "cargar_VehiculosDisponibles");
        if (response.success) {
            const select = document.getElementById("vehiculo");
            const select_muestra = document.getElementById("vehiculo_mostrar");
            $.each(response.data, (i, o) => {
                let option = document.createElement("option");
                let option_muestra = document.createElement("option");
                option.innerHTML = `${o.patente_vehiculo} ${o.marca_vehiculo} ${o.modelo_vehiculo} ${o.año_vehiculo}`;
                option_muestra.innerHTML = `${o.patente_vehiculo} ${o.marca_vehiculo} ${o.modelo_vehiculo} ${o.año_vehiculo}`;
                option.value = o.patente_vehiculo;
                option_muestra.value = o.patente_vehiculo;
                select.appendChild(option);
                select_muestra.appendChild(option_muestra);
            });
            $("#vehiculo").attr("disabled", false);
        }
    })();



    const generarCalendario = (array_calendario) => {
        const calendarEl = document.getElementById('calendario');
        calendar_global = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'today,prev,next btnModalRecerva',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            customButtons: {
                btnModalRecerva: {
                    text: "Agregar nueva reservar ",
                    click: () => {
                        $("#modal_add_reserva").modal();
                        $("#form_reserva")[0].reset();
                        $("#option_empresa").hide();
                        $("#option_natural").show();
                    }
                }
            },
            eventSources: [{
                events: array_calendario,
            }],
            eventClick: mostrarReserva,
            eventDrop: editarConDrop,
            editable: true
        });
        calendar_global.render();
    }


    const editarConDrop = async (e) => {
        const reserva = e.event.extendedProps.info;
        const data = new FormData();
        data.append("id_reserva", reserva.id_reserva);
        data.append("fecha_inicio_mostrar", e.event.start);
        await ajax_function(data, "editar_reserva");
        cargarReservas()
        // calendar_global.refetchEvents();
    }


    const mostrarReserva = (e) => {
        $("#form_mostrar_reserva")[0].reset();
        const reserva = e.event.extendedProps.info;
        console.log(reserva);
        let cliente = null;
        if (reserva.reservasCliente) cliente = reserva.reservasCliente.cliente.nombre_cliente;
        if (reserva.reservasEmpresa) cliente = reserva.reservasEmpresa.empresa.nombre_empresa;
        $("#id_reserva").val(reserva.id_reserva);
        $('#tituloReserva').html(e.event.title);
        $("#vehiculo_mostrar").val(reserva.patente_vehiculo);
        $("#cliente_mostrar").val(cliente);
        $("#color_reserva_mostrar").val(reserva.color_reserva);
        $("#fecha_inicio_mostrar").val(moment(reserva.inicio_reserva).format('YYYY/MM/DD hh:mm'));
        $("#fecha_fin_mostrar").val(moment(reserva.fin_reserva).format('YYYY/MM/DD hh:mm'));
        $("#descripcion_mostrar").val(reserva.descripcion_reserva);
        calcularDiasMostrar();
        $("#modal_mostrar_reserva").modal();
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




    $("#btn_buscarEmpresa").click(async () => {
        const data = new FormData();
        const rut_empresa = $("#inputRutEmpresa").val();
        data.append("rut_empresa", rut_empresa);
        if (rut_empresa.length != 0) {
            $("#spinner_empresa").show();
            const response = await ajax_function(data, "buscar_empresa");
            if (response.success) {
                const c = response.data;
                //se agrega un option para el select ciudad
                const option = document.createElement('option');
                option.value = c.ciudad_empresa;
                option.text = c.ciudad_empresa;
                document.getElementById("inputCiudadEmpresa").appendChild(option);
                $("#inputComunaEmpresa").val(c.comuna_empresa);
                $("#inputCiudadEmpresa").val(c.ciudad_empresa);
                $("#inputNombreEmpresa").val(c.nombre_empresa);
                $("#inputDireccionEmpresa").val(c.direccion_empresa);
                $("#inputTelefonoEmpresa").val(c.telefono_empresa);
                $("#inputCorreoEmpresa").val(c.correo_empresa);
                $("#inputVigencia").val(c.vigencia_empresa);
                $("#inputRol").val(c.rol_empresa);
            } else {
                $("#inputComunaEmpresa").val("");
                $("#inputNombreEmpresa").val("");
                $("#inputDireccionEmpresa").val("");
                $("#inputCiudadEmpresa").val("");
                $("#inputTelefonoEmpresa").val("");
                $("#inputCorreoEmpresa").val("");
                $("#inputRol").val("");
            }
            $("#spinner_empresa").hide();
        }
    });


    $("#btn_eliminar_reserva").click(async () => {
        alertQuestion(async () => {
            const data = new FormData();
            data.append("id_reserva", $("#id_reserva").val());
            const response = await ajax_function(data, "eliminar_reserva");
            if (response.success) {
                Swal.fire("reserva eliminada!", response.msg, "success");
                $("#modal_mostrar_reserva").modal("toggle");
                cargarReservas()
                //calendar_global.refetchEvents();
            }
        });
    });




    $("#btn_editar_reserva").click(async () => {
        alertQuestion(async () => {
            const form = $("#form_mostrar_reserva")[0];
            const data = new FormData(form);
            const response = await ajax_function(data, "editar_reserva");
            if (response.success) {
                Swal.fire("reserva modificada!", response.msg, "success");
                $("#modal_mostrar_reserva").modal("toggle");
                cargarReservas()
                // calendar_global.refetchEvents();
            }
        });
    });


    $("#btn_guardarReserva").click(async () => {
        if ($('[name="customRadio0"]:checked').val() === "PARTICULAR") {
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
        }
        if ($('[name="customRadio0"]:checked').val() === "EMPRESA") {
            if (
                $("#inputRutEmpresa").val().length == 0 ||
                $("#inputNombreEmpresa").val().length == 0 ||
                $("#inputTelefonoEmpresa").val().length == 0 ||
                $("#inputCorreoEmpresa").val().length == 0 ||
                $("#inputDireccionEmpresa").val().length == 0 ||
                $("#inputVigencia").val().length == 0 ||
                $("#inputCiudadEmpresa").val().length == 0 ||
                $("#inputRol").val().length == 0
            ) {
                Swal.fire({ icon: "warning", title: "Faltan datos de la empresa!", });
                return;
            }
        }
        if (
            $("#inputNumeroDias").val() <= 0 ||
            $("#inputNumeroDias").val().length == 0 ||
            $("#fecha_inicio").val().length == 0 ||
            $("#fecha_fin").val().length == 0 ||
            $("#titulo_reserva").val().length == 0 ||
            $("#descripcion").val().length == 0) {
            Swal.fire({ icon: "warning", title: "Faltan datos de la reserva!", });
            return;
        }
        if ($("#vehiculo").val() == null ||
            $("#vehiculo").val() == "null") {
            Swal.fire({ icon: "warning", title: "debes seleccionar un vehiculo!", });
            return;
        }
        alertQuestion(async () => {
            let responseClient = null;
            const form = $("#form_reserva")[0];
            const data = new FormData(form);
            if ($('[name="customRadio0"]:checked').val() === "PARTICULAR") {
                responseClient = await ajax_function(data, "registrar_cliente");
                data.append('rut_cliente_reserva', responseClient.data.rut_cliente);
            }
            if ($('[name="customRadio0"]:checked').val() === "EMPRESA") {
                responseClient = await ajax_function(data, "registrar_empresa");
                data.append('rut_empresa_reserva', responseClient.data.rut_empresa);
            }
            if (responseClient.success) {
                const responseReserva = await ajax_function(data, "registrar_reserva");
                if (responseReserva.success) {
                    Swal.fire("reserva guardada!", responseReserva.msg, "success");
                    $("#form_reserva")[0].reset();
                    $("#modal_add_reserva").modal("toggle");
                    cargarReservas()
                    // calendar_global.refetchEvents();
                }
            }
        })
    });



});