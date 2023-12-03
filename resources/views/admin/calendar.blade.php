@extends('admin.master')
@section('title', 'Calendar')

@section('style')
<link href="/admins/plugins/fullcalendar/main.min.css" rel="stylesheet">
@endsection
    
@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div id='calendar'></div>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script src="/admins/plugins/fullcalendar/main.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

events: 'https://fullcalendar.io/demo-events.json?overload-day'
      });
      calendar.render();
    });

  </script>
@endsection