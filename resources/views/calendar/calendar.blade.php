@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Calendar') }}</div>
 
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
 
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      events: [
        @foreach($events as $event)
        {
            title: '{{ $event->title }}',
            start: '{{ $event->start_date }}',
            end: '{{ $event->end_date }}'
        },
        @endforeach
      ],
      backgroundEvents: [
        {
            title: 'Event 1',
            start: '2023-03-01T09:00:00',
            end: '2023-03-01T14:00:00',
            rendering: 'background',
            color: '#ff9f89'
        },
        {
            title: 'Event 2',
            start: '2023-03-03T09:00:00',
            end: '2023-03-03T14:00:00',
            rendering: 'background',
            color: '#ff9f89'
        },
        {
            title: 'Event 3',
            start: '2023-03-05T09:00:00',
            end: '2023-03-05T14:00:00',
            rendering: 'background',
            color: '#ff9f89'
        }
      ]

        // イベントをここに追加する
      ]
    });
 
    calendar.render();
  });
</script>