@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th><abbr title="Ime">Ime</abbr></th>
      <th><abbr title="Prezime">Prezime</abbr></th>
      <th><abbr title="Email">Email adresa</abbr></th>
      <th><abbr title="Uloga">Uloga</abbr></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
       <th><abbr title="Ime">Ime</abbr></th>
      <th><abbr title="Prezime">Prezime</abbr></th>
      <th><abbr title="Email">Email adresa</abbr></th>
      <th><abbr title="Uloga">Uloga</abbr></th>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($data as $user)
   <tr>
       <td>
       
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection