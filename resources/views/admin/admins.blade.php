@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th>Ime</th>
      <th>Prezime</th>
      <th>Email adresa</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $user)
   <tr>
       <td>
          {{$user->first_name}}
        </td>
        <td>
          {{$user->last_name}}
        </td>
        <td>
          {{$user->email}}
        </td>
        <td>
          <form id="{{$user->id}}" action="/admin/korisnici/{{$user->id}}/delete" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
           <a class="button is-danger is-outlined" onclick="confirmDelete({{$user->id}})">
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
{{ $data->links() }}
<div style="margin-bottom: 20px;">
<span class="tag is-primary is-large">Ukupno: {{$count}}</span>
</div>
@endsection