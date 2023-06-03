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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  
  <div id="calendar"> 
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.7/main.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var csrfToken = '{{ csrf_token() }}';

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
                        swal({
                            title: 'Enter event title:',
                            content: 'input',
                            buttons: {
                                cancel: true,
                                confirm: {
                                    text: 'Save',
                                    closeModal: false,
                                }
                            },
                        }).then((title) => {
                            if (title) {
                                var eventData = {
                                    title: title,
                                    start: info.startStr,
                                    end: info.endStr,
                                    color: '#6da252',
                                    textColor: 'white'
                                };

                                calendar.addEvent(eventData);
                                fetch("{{ route('mycalendar.store') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrfToken
                                        },
                                        body: JSON.stringify({
                                            title: title,
                                            start: info.startStr,
                                            end: info.endStr
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        // Update the event object with the server-generated ID
                                        eventData.id = data.id;
                                        calendar.updateEvent(eventData);
                                    })
                                    .catch(error => console.error(error));

                                swal("Event created!", "Your event has been added.", "success");
                            } else {
                                swal("Event not created!", "Please enter a valid event title.", "error");
                            }
                        }).catch((error) => {
                            console.log(error);
                        });
                    },
                    eventClick: function(info) {
                        swal({
                            title: 'Are you sure?',
                            text: 'Once deleted, you will not be able to recover this event!',
                            icon: 'warning',
                            buttons: {
                                cancel: true,
                                confirm: {
                                    text: 'Delete',
                                    closeModal: false,
                                }
                            },
                            dangerMode: true,
                        })
                            .then((confirmDelete) => {
                                if (confirmDelete) {
                                    info.event.remove();

                                    // Send the event ID to the server and delete it from the database
                                    fetch("{{ route('mycalendar.destroy', '') }}/" + info.event.id, {
                                            method: 'DELETE',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log(data.message);
                                        })
                                        .catch(error => console.error(error));

                                    swal('Deleted!', 'The event has been deleted.', 'success');
                                } else {
                                    swal('Cancelled', 'The event was not deleted.', 'info');
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }
                });

                // Fetch events from the server and populate the calendar
                fetch("{{ route('mycalendar.events') }}", {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        calendar.addEventSource(data);
                    })
                    .catch(error => console.error(error));

                calendar.render();
            });
        </script>

  </div>
</body>
</html>

    </x-slot>
</x-layouts.admin>
