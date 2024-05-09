document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            {
                title: 'Cadastro de Peça',
                start: '2023-03-01',
                backgroundColor: '#4caf50',
                borderColor: '#4caf50'
            },
            {
                title: 'Venda de Peça',
                start: '2023-03-05',
                backgroundColor: '#f44336',
                borderColor: '#f44336'
            }
        ]
    });

    calendar.render();
});