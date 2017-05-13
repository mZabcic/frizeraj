@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th>Ime</th>
      <th>Prezime</th>
      <th>Email adresa</th>
      
      <th></th>
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
        <td  style="text-align: end;">
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
           <td>
            <a class="button is-info is-outlined" href="/admin/korisnici/{{$user->id}}/uredi">
    <span>Uredi</span>
    <span class="icon is-small">
      <i class="fa fa-pencil-square-o"></i>
    </span>
  </a>
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