$("#m_reserva").addClass("active");
$("#l_reserva").addClass("card");


$(document).ready(() => {


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
                text: "reservar vehiculo",
                click: () => console.log("modal ")
            }
        },
        dateClick: (info) => {
            console.log(info)
            info.dayEl.style.backgroundColor = 'Gray';
            $("#reservaModal").modal();
        }
    });
    calendar.render();




});