@extends('layouts.app')

@section('styles')
<link href='{{ asset('fullcalendar/fullcalendar.min.css') }}' rel='stylesheet' />
<link href='{{ asset('fullcalendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print' />
@endsection

@section('scripts')
<script src='{{ asset('fullcalendar/lib/moment.min.js') }}'></script>
<script src='{{ asset('fullcalendar/fullcalendar.min.js') }}'></script>
<script src='{{ asset('fullcalendar/locale-all.js') }}'></script>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,agendaDay,listWeek',

			},
			defaultDate: '2017-05-12',
			defaultView: "agendaWeek",
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventStartEditable: false,
			eventDurationEditable:false,
			minTime: "08:00:00",
  		maxTime: "20:00:00",
			locale: 'hr',
			events: [
				{
					title: 'All Day Event',
					start: '2017-05-01'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-05-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-05-16T16:00:00'
				},
				{
					title: 'Meeting',
					start: '2017-05-12T10:30:00',
					end: '2017-05-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2017-05-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2017-05-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2017-05-12T17:30:00',
					end:'2017-05-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2017-05-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2017-05-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2017-05-28'
				}
			]
		});

	});

</script>
@endsection

@section('content')
<div class="container termini">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Termini</div>

                <div class="panel-body">
                  <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection
