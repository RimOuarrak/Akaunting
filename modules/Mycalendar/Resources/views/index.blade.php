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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div id="calendar"> 
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.7/main.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            var eventsData = {!! json_encode($data) !!};

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
                    eventContent: function(info) {
                        var timeFormat = new Intl.DateTimeFormat('en-US', { hour: 'numeric', minute: '2-digit' });
                        var timeStr = timeFormat.format(info.event.start);

                        return {
                            html: '<div class="fc-event-time">' + info.event.title + '</div>',
                        };
                    },
                    eventClassNames: function(info) {
                        if (info.event.end - info.event.start <= 86400000) { // Check if the event is a single-day event
                            return ['single-day-event']; // Apply a custom CSS class for single-day events
                        }
                        return []; // No additional CSS classes for multi-day events
                    },
                    select: function(info) {
    swal({
        title: 'Choose event title:',
        className: 'event-title-dialog',
        buttons: {
            option1: {
                text: 'Invoice',
                value: 'Invoice',
            },
            option2: {
                text: 'Income',
                value: 'Income',
                color: '#ffd700',
            },
            option3: {
                text: 'Bill',
                value: 'Bill',
                color: '#ffcccc',
            },
            option4: {
                text: 'Expense',
                value: 'Expense',
                color: '#808080',
            },
            cancel: true,
        },
    }).then((value) => {
        if (value) {
            var title = value;
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
            swal("Event not created!", "Please select a valid event title.", "error");
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
                    },
                    eventDrop: function(info) {
                        var event = info.event;
                        var updatedEvent = {
                            id: event.id,
                            start: event.startStr,
                            end: event.endStr
                            // Update other event properties if needed
                        };

                        fetch("{{ route('mycalendar.update', '') }}/" + event.id, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify(updatedEvent)
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data.message);
                            })
                            .catch(error => console.error(error));
                    }
                });

                calendar.addEventSource(eventsData);
                calendar.render();
            });
        </script>
<!-- 
<style>
    .fc-event-time {
        font-weight: bold;
    }
 
    .single-day-event.option1 {
        background-color: #6da252; /* Default green color */
        color: white;
    }

    .single-day-event.option2 {
        background-color: #ffd700; /* Yellow color */
        color: white;
    }
    
    .single-day-event.option3 {
        background-color: #ffcccc; /* Pinkish-red color */
        color: white;
    }

    .single-day-event.option4 {
        background-color: #808080; /* Gray color */
        color: white;
    }
</style> -->

        <style>
            .fc-event-time {
                font-weight: bold;
            }

            .single-day-event {
                background-color: #6da252;
                color: white;
            }
        </style>

  </div>
</body>
</html>

    </x-slot>
</x-layouts.admin>
