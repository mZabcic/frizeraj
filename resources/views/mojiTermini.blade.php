@extends('layouts.app')
@section('content')

<table class="table">
  <thead>
    <tr>
      <th>Datum termina</th>
      <th>Početak termina</th>
       <th>Trajanje termina</th>
       <th>Cijena</th>
       <th>Posao</th>
       <th>Frizer</th>
      <th>Odobren?</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <h2> Budući termini </h2>
    @foreach($termini as $termin)
    @if ($termin->start_at->gt($time))
   <tr>
       <td>
          {{$termin->start_at->format('d. m. Y.')}}
        </td>
          <td>
          {{$termin->start_at->format('h : m')}}
        </td>
          <td>
          {{$termin->job->duration_in_minutes}} minuta
        </td>
           <td>
          {{$termin->job->price}} HRK
        </td>
         <td>
          {{$termin->job->name}}
        </td>
        <td>
          {{$termin->working_day->user->first_name}} {{$termin->working_day->user->last_name}}
        </td>
        <td>
           @if ($termin->confirmed == 0)
           Nije odobren
           @else
           Odobren
           @endif
        </td>
        <td style="text-align: end;">
        @if ($termin->confirmed == 0)
          <form id="{{$termin->id}}" action="/termini/{{$termin->id}}/delete" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
           <a class="button is-danger is-outlined" onclick="confirmDeleteTermin({{$termin->id}})">
    <span>Delete</span>
    <span class="icon is-small">
      <i class="fa fa-times"></i>
    </span>
  </a>
  @endif
           </form>
           </td>
           <td>
            <a class="button is-info is-outlined" href="/termin/{{$termin->id}}">
    <span>Uredi</span>
    <span class="icon is-small">
      <i class="fa fa-pencil-square-o"></i>
    </span>
  </a>
        </td>
    </tr>
    @endif
    @endforeach

  </tbody>
</table>

  <h2> Odrađeni termini </h2>
<table class="table">
  <thead>
    <tr>
      <th>Datum termina</th>
      <th>Početak termina</th>
       <th>Trajanje termina</th>
       <th>Cijena</th>
       <th>Posao</th>
       <th>Frizer</th>
      <th>Odobren?</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  
    @foreach($termini as $termin)
    @if ($termin->start_at->lt($time) && $termin->confirmed == 1)
   <tr>
       <td>
          {{$termin->start_at->format('d. m. Y.')}}
        </td>
          <td>
          {{$termin->start_at->format('h : m')}}
        </td>
          <td>
          {{$termin->job->duration_in_minutes}} minuta
        </td>
           <td>
          {{$termin->job->price}} HRK
        </td>
         <td>
          {{$termin->job->name}}
        </td>
        <td>
          {{$termin->working_day->user->first_name}} {{$termin->working_day->user->last_name}}
        </td>
        <td>
           @if ($termin->confirmed == 0)
           Nije odobren
           @else
           Odobren
           @endif
        </td>
        <td style="text-align: end;">
        @if ($termin->confirmed == 1)
          <a href="/termin/{{$termin->id}}/komentiraj" class="button is-success is-outlined" >
    <span>Komentiraj</span>
    <span class="icon is-small">
      <i class="fa fa-comment"></i>
    </span>
  @endif
           </form>
           </td>
           <td>
            <a class="button is-info is-outlined" href="/termin/{{$termin->id}}">
    <span>Uredi</span>
    <span class="icon is-small">
      <i class="fa fa-pencil-square-o"></i>
    </span>
  </a>
        </td>
    </tr>
    @endif
    @endforeach

  </tbody>
</table>
@endsection