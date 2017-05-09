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
				@foreach($termini as $key=>$termin)
				{
					title: 'Frizer {{$termin->user->first_name}} {{$termin->user->last_name}}',
					start: '{{$termin->start->toAtomString()}}',
					end: '{{$termin->end->toAtomString()}}',
					url: '/termin/{{$termin->start->timestamp}}/{{$termin->end->timestamp}}',
					color: colorfunc({{$termin->user->id}})
				}
				@if($key != count($termini)-1)
				,
				@endif
				@endforeach
			]
		});

	});


function colorfunc(id){
	var colors = [
		"#CA473D",
		"#1437EE",
		"#EE4714",
		"#143E21",
		"#EE14D1",
		"#B130EE",
		"#1D9F65",
		"#7E6D40",
		"#2A9166",
		"#DE4C7B"
	]
	return colors[id%10];
}
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
