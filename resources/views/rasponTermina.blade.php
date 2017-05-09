@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}" />

@endsection
@section('scripts')
@endsection
@section('content')


  <div class="row"  align="center">
     <div class="col-md-4 col-md-offset-4">
       <div class="panel panel-default">
              <div class="panel-heading">Rezervacija termina</div>
              <div class="panel-body">

                <form method="POST" action="">
                  <div class="form-group">
                    <label for="frizer">Frizer:</label>
                    {{$hairdresser->first_name}} {{$hairdresser->last_name}}
                    <input type="hidden" name="hairdresser" value="{{$hairdresser->id}}" />
                  </div>
                  <div class="form-group">
                <label for="time">Vrijeme:</label>
                  <select class="form-control time-select" name="time">
                    @foreach($times as $time)
                      <option value="{{ $time->timestamp }}">{{ $time->format("H:i") }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
              <label for="job">Posao:</label>
                <select id="jobs" class="form-control jobs"  name="job" data-trigger="hover" data-toggle="tooltip" data-placement="top">
                  @foreach($jobs as $job)
                    <option value="{{ $job->id }}" class="option" data-description="{{$job->description}}">{{$job->name}} Cijena: {{$job->price}} HRK</option>
                  @endforeach
                </select>
              <label for="job">Opis Posla:</label>
              <div id="jobs-desc">
                {{$jobs[0]->description}}
              </div>
              </div>

              
                </form>
              </div>
            </div>
          </div>
        </div>

<script>
$('#jobs').change(function () {
  console.log('test');
    var selectedText = $(this).find("option:selected").data('description');
    $("#jobs-desc").html(selectedText);
});
</script>
@endsection
