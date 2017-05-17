@extends('layouts.app')
@section('scripts')
<script src="/js/script.js"></script>
@endsection
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
              <h2 class="title is-5" style="text-align:center"><strong>RADNO VRIJEME:</strong></h2>
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
                @if(Auth::user()->hasRole('customer'))
                @if ($customer->favorite_hairdresser == $user->id)
                <button class="btn-secondary like-review" onclick="omiljeni({{$user->id}})">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                </button>
                @else
                <button style="    background: blue;" class="btn-secondary like-review" onclick="omiljeni({{$user->id}})">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                </button>
                @endif
                @endif
              </div>
            </div>
             <div class="card-footer-item" style="background-color: lightgray;">
            <div class="star-ratings-css">
                      <!-- Samo treba broj pretvorit u postotak pa ubaucit u width -->
                      <div class="star-ratings-css-top" style="width: {{$prosjek[$user->id] / 6 * 100}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                      <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
            </div>
            </div>
            <div class="card-footer-item">
              <a class="button is-primary is-medium" href="/frizer/{{$user->id}}">Detalji</a>
            </div>
          </footer>
        </div>
    </div>
  @endforeach
</div>
<style>





/* Zvjezdice */
.star-ratings-css {
  unicode-bidi: bidi-override;
  color: #ffffff;
  font-size: 25px;
  height: 25px;
  width: 125px;
  margin: 0 auto;
  position: relative;
  padding: 0;
  text-shadow: 0px 1px 0 #a2a2a2;
}th, td{
  text-align: center !important;
}
  .star-ratings-css-top {
    color: #e7711b;
    padding: 0;
    position: absolute;
    z-index: 1;
    display: block;
    top: 0;
    left: 0;
    overflow: hidden;
  }
  .star-ratings-css-bottom {
    padding: 0;
    display: block;
    z-index: 0;
  }


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
.like-content {
    width: 100%;
    margin: 0px 0 0;
    padding: 0px 0 0;
}
.like-content .btn-secondary {
	  display: flex;
	  margin: 0px auto 0px;
    text-align: center;
    background: #ed2553;
    border-radius: 3px;
    /*box-shadow: 0 10px 20px -8px rgb(240, 75, 113);*/
    padding: 14px 20px;
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
	  margin-right: 0px;
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
