@extends('layouts.app')

@section('styles')
<link href="http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.css" rel="stylesheet" />
<link href='{{ asset('fullcalendar/fullcalendar.min.css') }}' rel='stylesheet' />
<link href='{{ asset('fullcalendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print' />
@endsection

@section('scripts')
<script src="http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>
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
			defaultDate: '{{$today->toDateString()}}',
			defaultView: "agendaWeek",
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventStartEditable: false,
			eventDurationEditable:false,
			minTime: "08:00:00",
  		maxTime: "20:00:00",
			slotEventOverlap:false,
			locale: 'hr',
			events: [
				@foreach($termini as $key=>$termin)
				{
					title: '{{Auth::user()->hasRole("customer")?"Frizer":"Klijent"}} {{$termin->user->first_name}} {{$termin->user->last_name}}',
					start: '{{$termin->start->toAtomString()}}',
					end: '{{$termin->end->toAtomString()}}',
					@if(Auth::user()->hasRole("customer"))
					url: '/termin/{{$termin->user->id}}/{{$termin->start->timestamp}}/{{$termin->end->timestamp}}',
					@endif
					@if(Auth::user()->hasRole("hairdresser"))
					url: '/termin/{{ $termin->id }}',
					@endif
					description: '{{Auth::user()->hasRole("customer")?"Frizer":"Klijent"}} {{$termin->user->first_name}} {{$termin->user->last_name}}',
					color: colorfunc({{$termin->user->id}})
				}
				@if($key != count($termini)-1)
				,
				@endif
				@endforeach
			],
			eventRender: function(event, element) {
        element.qtip({
            content: event.description
        });
			}
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
				@if (Auth::user()->hasRole('customer'))
				 <a style="margin: 10px" href="/termini/moji" class="button is-large">
    <span class="icon is-medium">
      <i class="fa fa-address-card"></i>
    </span>
    <span>Moji rezervirani termini</span>
  </a>
  @endif

                <div class="panel-body">
                  <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection
