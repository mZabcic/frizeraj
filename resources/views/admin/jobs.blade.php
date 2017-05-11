@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th>Ime</th>
      <th>Opis</th>
      <th>Cijena</th>
      <th>Trajanje</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($jobs as $job)
   <tr>
       <td>
          {{$job->name}}
        </td>
        <td>
          {{$job->description}}
        </td>

          <td>
            {{$job->price}}HRK
          </td>
          <td>
          {{$job->duration_in_minutes}}

        <td>
          <form id="{{$job->id}}" action="/admin/posao/{{$job->id}}/obrisi" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
           <a class="button is-danger is-outlined" onclick="confirmDelete({{$job->id}})">
    <span>Delete</span>
    <span class="icon is-small">
      <i class="fa fa-times"></i>
    </span>
  </a>
           </form>
           </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $jobs->links() }}
<div style="margin-bottom: 20px;">
<span class="tag is-primary is-large">Ukupno: {{$jobs->count()}}</span>
</div>
@endsection
