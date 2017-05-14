@extends('layouts.app')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/jquery.rateyo.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/jquery.rateyo.css') }}" />

<div class="columns is-multiline">
    @foreach($data as $user)
      <div class="column is-one-third">
        <div class="card">
          <header class="card-header">
            <div class="card-header-title box">
                <p style="text-font:14px"><strong>{{$user->last_name}} {{$user->first_name}}</strong></p>
            </div>
          </header>
          <div class="card-content">
            <div class="content">
              <h2 class="title is-4" style="text-align:center"><strong>RADNO VRIJEME:</strong></h2>
              <table class="table box" style="height:275px;">
                <col width="150">
                <col width="100">
                <col width="100">
                <thead>
                  <tr>
                    <th>Dan</th>
                    <th>Od</th>
                    <th>Do</th>

                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->working_days as $key => $day)
                 <tr>
                     <td>
                        {{$day->from->toDateString()}}
                      </td>
                      <td>
                        {{$day->from->format('H:i')}}
                      </td>
                      <td>
                        {{$day->until->format('H:i')}}
                      </td>
                  </tr>
                  @if($key>=3)
                    @break
                  @endif
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
          <footer class="card-footer">
            <div class="card-footer-item">
              <div class="like-content">
                <button class="btn-secondary like-review">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            <a class="card-footer-item">
              <div id="rate{{$user->id}}"></div>
            </a>
            <div class="card-footer-item">
              <a class="button is-primary is-medium" href="/frizer/{{$user->id}}">Detalji</a>
            </div>
          </footer>
        </div>
    </div>
  @endforeach
</div>
<style>
.table {
  background-color: #f2f2f2;
}
.card {
  height: 100%;
  display:flex;
  flex-direction: column;
  background-color: white;
}
.card-footer {
    margin-top: auto;
    background-color: white;
}
/* LIKE BUTTON */
.like-content .btn-secondary {
	  display: block;
    text-align: center;
    background: #ed2553;
    border-radius: 6px;
    /* box-shadow: 0 10px 20px -8px rgb(240, 75, 113); */
    padding: 10px 17px;
    font-size: 18px;
    cursor: pointer;
    border: none;
    outline: none;
    color: #ffffff;
    text-decoration: none;
    -webkit-transition: 0.3s ease;
    transition: 0.3s ease;
}
.like-content .btn-secondary:hover {
	  transform: translateY(-3px);
}
.like-content .btn-secondary .fa {

}.like-review button{
}
.animate-like {
	animation-name: likeAnimation;
	animation-iteration-count: 1;
	animation-fill-mode: forwards;
	animation-duration: 0.65s;
}
@keyframes likeAnimation {
  0%   { transform: scale(30); }
  100% { transform: scale(1); }
}

</style>

<script>
/*LIKE BUTTON */
$(function(){
	$(document).one('click', '.like-review', function(e) {
		$(this).html('<i class="fa fa-heart" aria-hidden="true"></i>');
		$(this).children('.fa-heart').addClass('animate-like');
	});
});

/*STAR RATING */
  var ids = {!! $data->pluck('id') !!};
  $(function () {
    for(i in ids){
      $("#rate" + ids[i]).rateYo({
        rating: 3.6,
        fullStar: true
      });
  }

  });
</script>

{{ $data->links() }}
<div style="margin-bottom: 20px;">
<span class="tag is-primary is-large">Ukupno: {{$count}}</span>
</div>
@endsection
