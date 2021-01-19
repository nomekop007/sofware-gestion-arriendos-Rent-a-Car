$("#m_reserva").addClass("active");
$("#l_reserva").addClass("card");


$(document).ready(() => {


    const calendarEl = document.getElementById('calendario');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
    });
    calendar.render();

});