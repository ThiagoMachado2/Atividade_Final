//Executar quando o documento HTML for completamente carregado
document.addEventListener('DOMContentLoaded', function() {
  //Receber o seletor calender do atributo id
  var calendarEl = document.getElementById('calendar');

  //Instaciando FullCalendar.Calendar e atribuir a variavel calendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    
    //Criação do Cabeçalho
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },

    //Definir o idioma
    locale: 'pt-br',

    //Definir a data inicial
    initialDate: '2023-01-12',

    //Permitir clicar nos nomes dos dias da semana
    navLinks: true, // can click day/week names to navigate views

    //Permitir seleção de datas arrastar o mouse por varias datas
    selectable: true,
    //Indicação visualmente a area que sera selecionada
    selectMirror: true,

    //Permitir arrastar e redimensionar os eventos diariamente no calendario.
    editable: true,

    //Definir o limite de eventos por dia
    dayMaxEvents: true, // allow "more" link when too many events
    events: [
      {
        title: 'All Day Event',
        start: '2023-01-01'
      },
      {
        title: 'Long Event',
        start: '2023-01-07',
        end: '2023-01-10'
      },
      {
        groupId: 999,
        title: 'Repeating Event',
        start: '2023-01-09T16:00:00'
      },
      {
        groupId: 999,
        title: 'Repeating Event',
        start: '2023-01-16T16:00:00'
      },
      {
        title: 'Conference',
        start: '2023-01-11',
        end: '2023-01-13'
      },
      {
        title: 'Meeting',
        start: '2023-01-12T10:30:00',
        end: '2023-01-12T12:30:00'
      },
      {
        title: 'Lunch',
        start: '2023-01-12T12:00:00'
      },
      {
        title: 'Meeting',
        start: '2023-01-12T14:30:00'
      },
      {
        title: 'Happy Hour',
        start: '2023-01-12T17:30:00'
      },
      {
        title: 'Dinner',
        start: '2023-01-12T20:00:00'
      },
      {
        title: 'Birthday Party',
        start: '2023-01-13T07:00:00'
      },
      {
        title: 'Click for Google',
        url: 'http://google.com/',
        start: '2023-01-28'
      }
    ]
  });

  calendar.render();
});