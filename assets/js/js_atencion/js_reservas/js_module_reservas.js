$("#m_reserva").addClass("active");
$("#l_reserva").addClass("card");


$(document).ready(() => {


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
                    click: () => $("#modal_add_reserva").modal()
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








});