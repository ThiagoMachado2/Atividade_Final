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
    //initialDate: '2023-05-11',

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
    events: '_script/listar_evento.php'
  });

  calendar.render();
});