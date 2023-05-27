<x-layouts.admin>
<x-slot name="title">Calendar</x-slot>

    <x-slot name="content">
    
<br>
<sript>
  <html>
<head>
<meta charset='utf-8' />
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.7/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.7/index.global.min.js'></script>
</head>
<body>
  
  <div id="calendar">

  <script>

  document.addEventListener('DOMContentLoaded', function() {
    
    var calendarEl = document.getElementById('calendar');
    const eventsUrl = "{{ route('calendar.events') }}";

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      themeSystem: 'standard',
      initialView: 'dayGridMonth',
      hiddenDays: [],
      nowIndicator: true,
      selectable: true,
      editable: true,
      firstDay: 1,
      allDaySlot: false,
      dayHeaderFormat: {
            weekday: 'short',
            day: 'numeric'
      },
      select: function(info) {
    var title = prompt('Enter event title:');
    if (title) {
      var eventData = {
        title: title,
        start: info.startStr,
        end: info.endStr,
        color: '#6da252',     // an option!
      textColor: 'white'
      };
      calendar.addEvent(eventData);
    }
      // eventSources: [

// your event source
// {
//       events: [
//     { // this object will be "parsed" into an Event Object
//       title: 'The Title', 
//       start: '2023-05-18', 
//       end: '2023-05-20' 
//     },
//     { 
//       title: 'The Title', 
//       start: '2023-05-27', 
//       end: '2023-05-28' 
//     },
//     { 
//       title: 'The Title', 
//       start: '2023-05-12', 
//       end: '2023-05-13' 
//     }
//   ],
//   color: '#6da252',     // an option!
//       textColor: 'white'
// }]
}
    });

    calendar.render();
  });
</script>

    
  </div>
</body>
</html>

    </x-slot>
</x-layouts.admin>
