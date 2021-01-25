$("#m_reserva").addClass("active");
$("#l_reserva").addClass("card");
let array_calendario = [
    {
        title: 'item 1',
        description: 'aesta es la dscripcion',
        start: '2021-01-01',
        end: '2021-01-03',
        color: "#FF0F0",
        textColor: '#FFFFFF'
    },
    {
        title: 'item 2',
        description: 'aesta es la dscripcion',
        start: '2021-01-05',
        end: '2021-01-20',
    },
    {
        title: 'item 3',
        description: 'aesta es la dscripcion',
        start: '2021-01-01',
        end: '2021-01-09',
    }
];




$(document).ready(() => {


    (cargarRevervas = async () => {
        /*  const response = await ajax_function(null, "cargar_arriendos");
         if (response.success) {
             array_calendario = response.data.map((arriendo) => (
                 {
                     title: arriendo.patente_vehiculo,
                     description: arriendo,
                     start: arriendo.fechaEntrega_arriendo,
                     end: arriendo.fechaRecepcion_arriendo,
                     color: "#FF0F0",
                     textColor: '#FFFFFF'
                 }))
         */
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
    })();








});