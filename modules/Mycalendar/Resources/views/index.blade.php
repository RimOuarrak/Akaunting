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
                    select: function(start, end, allDay) {
                    swal({
                        title: 'Choose event title:',
                        className: 'event-title-dialog',
                        buttons: {
                            option1: {
                                text: 'Invoice',
                                value: 'Invoice'
                            },
                            option2: {
                                text: 'Income',
                                value: 'Income'
                            },
                            option3: {
                                text: 'Bill',
                                value: 'Bill'
                            },
                            option4: {
                                text: 'Expense',
                                value: 'Expense'
                            },
                            cancel: true,
                        }
                        }).then(function(value) {
                            if (value) {
                                switch (value) {
                                    case 'Invoice':
                                        window.location.href = "{{ route('invoices.create') }}";
                                        break;
                                    case 'Income':
                                        window.location.href = "{{ route('transactions.create') }}?type=income";
                                        break;
                                    case 'Bill':
                                        window.location.href = "{{ route('bills.create') }}";
                                        break;
                                    case 'Expense':
                                        window.location.href = "{{ route('transactions.create') }}?type=expense";
                                        break;
                                    default:
                                        break;
                                }
                            }
                        });
                    },
                    editable: true,
                    firstDay: 1,
                    dayHeaderFormat: {
                        weekday: 'short',
                        day: 'numeric'
                    },
                    eventContent: function(info) {
                        return {
                            html: '<div class="fc-event-time">' + info.event.title + '</div>'
                        };
                    },
                    events: eventsData.map(function(event) {
                        return {
                            title: event.document_number,
                            start: event.issued_at,
                            end: event.due_at,
                            type: event.type,
                            id: event.id, // Include the event ID
                            additionalDetails: {
                                contactName: event.contact_name,
                                amount: event.amount,
                                status: event.status,
                                issued_at: event.issued_at,
                                due_at: event.due_at
                                // Include other additional fields you want to display
                            }
                        };
                    }),
                    eventDidMount: function(info) {
                        var eventType = info.event.extendedProps.type;
                        var eventEl = info.el;

                        switch (eventType) {
                            case 'invoice':
                                eventEl.style.backgroundColor = '#eeeef4';
                                break;
                            case 'income':
                                eventEl.style.backgroundColor = '#efad32';
                                break;
                            case 'bill':
                                eventEl.style.backgroundColor = '#ea9999';
                                break;
                            case 'expense':
                                eventEl.style.backgroundColor = '#e3e5e5';
                                break;
                            default:
                                eventEl.style.backgroundColor = '#6da252';
                                break;
                        }

                        var eventId = info.event.id;
                        var additionalDetails = info.event.extendedProps.additionalDetails;

                        // Event click handler
                        eventEl.addEventListener('click', function(e) {
                            e.preventDefault();
                            var eventId = info.event.id;
                            var additionalDetails = info.event.extendedProps.additionalDetails;

                            // Format the dates
                            var issuedAt = new Date(additionalDetails.issued_at).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            var dueAt = new Date(additionalDetails.due_at).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });

                            // Show event details using Swal
                            swal({
                                title: info.event.title,
                                content: {
                                    element: 'div',
                                    attributes: {
                                        innerHTML: 
                                            '<p>Contact Name: ' + additionalDetails.contactName + '</p>' +
                                            '<p>Amount: ' + additionalDetails.amount + '</p>' +
                                            '<p>Status: ' + additionalDetails.status + '</p>' +
                                            '<p>Issued At: ' + issuedAt + '</p>' +
                                            '<p>Due At: ' + dueAt + '</p>' 
                                    }
                                },
                                
                            });
                        });
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
