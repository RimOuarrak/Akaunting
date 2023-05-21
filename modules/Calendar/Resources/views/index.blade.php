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

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      initialView: 'dayGridMonth',
      events: '/calendar/events' // URL to retrieve events from the backend
    });

    calendar.render();
  });
</script>

    
  </div>
</body>
</html>

    </x-slot>
</x-layouts.admin>
