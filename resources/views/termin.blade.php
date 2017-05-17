@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:50px; margin-bottom:50px;">
  <div class="columns">
        <div class="column is-4 is-offset-1 box" >

            <h2 class="title is-2" style="text-align:center"><strong>INFO O TERMINU:</strong></h2>
                    </br>
            <div class="box" style="background-color:#f2f2f2">
            <h2 class="subtitle is-6"><strong>Datum :</strong> {{$termin->start_at->format('d. m. Y.')}}</h2>
            <h2 class="subtitle is-6"><strong>Vrijeme početka :</strong> {{$termin->start_at->format('h : m')}}</h2>
            <h2 class="subtitle is-6"><strong>Trajanje :</strong> {{$termin->job->duration_in_minutes}} minuta</h2>
            <h2 class="subtitle is-6"><strong>Ime posla: </strong>{{$termin->job->name}}</h2>
             <h2 class="subtitle is-6"><strong>Ime korisnika: </strong>{{$termin->user->first_name}} {{$termin->user->last_name}}</h2>
              <h2 class="subtitle is-6"><strong>Ime frizera: </strong>{{$termin->working_day->user->first_name}} {{$termin->working_day->user->last_name}}</h2>
             @if (Auth::user()->hasRole('hairdresser'))
             @if ($termin->confirmed == 0)
               <form id="{{$termin->id}}" action="/termin/{{$termin->id}}/prihvati" method="post">
            {{ csrf_field() }}
                 <a class="button is-success" onclick="confirmAc({{$termin->id}})">
    <span class="icon is-small">
      <i class="fa fa-check"></i>
    </span>
    <span>Prihvati posao</span>
  </a>
  </form>
  <form id="{{$termin->job->duration_in_minutes}}" action="/termin/{{$termin->id}}/odbi" method="post">
   {{ csrf_field() }}
  <a class="button is-danger" onclick="confirmRe({{$termin->job->duration_in_minutes}})">
    <span class="icon is-small">
      <i class="fa fa-times"></i>
    </span>
    <span>Odbi posao</span>
  </a>
    </form>
    @else
      <div class="notification is-primary">
  
Termin je prihvaćen!
</div>
    @endif
    @endif

          </div>
        </div>
        <div class="column is-5 is-offset-1 box" style ="height:400px">
          <h2 class="title is-2" style="text-align:center"><strong>SLIKA FRIZURE:</strong></h2>
          @if ($termin->wanted_hairstyle_id != null)
           <img  src="http://localhost:8000/pic/{{ $termin->id }}" alt="slika" width="380" height="300">
           @else 
           <img  src="http://bulma.io/images/placeholders/1280x960.png" alt="slika" width="380" height="300">
           @endif
        </div>
    </div>
  

    <div class="columns">
      <div class="column is-10 is-offset-1 box">
        <h2 class="title is-4" style="text-align:center"><strong>KOMENTARI:</strong></h2>
        <div >
          <div class="box" style="background-color:#f2f2f2">
          @foreach($komentari as $komentar)
          <article class="media">
            <figure class="media-left">
              @if ($komentar->picture == null)
              <img id="" src="http://bulma.io/images/placeholders/1280x960.png" alt="slika" width="200" height="150">
              @else 
              <img id="" src="/userPic/{{$komentar->id}}" alt="slika" width="200" height="150">
              @endif
              <div id="" class="modal">
                <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                <img class="modal-content" id="img">
                <div id="caption"></div>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{$komentar->assignment->user->first_name}} {{$komentar->assignment->user->last_name}}</strong>
                  <br>
                  {{$komentar->comment}}
                </p>
              </div>
              <div class="level is-mobile">
                <div class="level-left">
                  <div class="level-item">
                    <div class="star-ratings-css">
                      <!-- Samo treba broj pretvorit u postotak pa ubaucit u width -->
                      <div class="star-ratings-css-top" style="width: {{$komentar->stars}}0%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>
         @endforeach
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection