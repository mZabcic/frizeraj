@extends('layouts.app')
@section('scripts')
<script src="/js/script.js" type="text/javascript"></script>
@endsection
@section('content')
<div class="container" style="margin-top:50px; margin-bottom:50px;">
  <div class="columns">
        <div class="column is-4 is-offset-1 box" style ="height:400px;">

            <h2 class="title is-2" style="text-align:center"><strong>INFO:</strong></h2>
                    </br>
            <div class="box" style="background-color:#f2f2f2">
            <h2 class="subtitle is-6"><strong>Ime :</strong> {{$hairdresser->first_name}}</h2>
            <h2 class="subtitle is-6"><strong>Prezime :</strong> {{$hairdresser->last_name}}</h2>
            <h2 class="subtitle is-6"><strong>Email :</strong> {{$hairdresser->email}}</h2>
            <h2 class="subtitle is-6"><strong>Broj korisnika kojima je najdraži frizer: </strong>{{$favorites}} </h2>
          </div>
        </div>
        <div class="column is-5 is-offset-1 box" style ="height:400px">
          <h2 class="title is-2" style="text-align:center"><strong>RADNO VRIJEME:</strong></h2>
          <table class="table box" style="height:275px;">
            <thead>
              <tr>
                <th style="width:40%;">Dan</th>
                <th style="width:30%;">Od</th>
                <th style="width:30%;">Do</th>

                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($working_days as $day)
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
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
    <div class="columns">
      <div class="column is-10 is-offset-1 box">
        <h2 class="title is-4" style="text-align:center"><strong>KOMENTARI:</strong></h2>
        <div >
          <div class="box" style="background-color:#f2f2f2">
          @foreach ($comments_and_stars as $comment)
          @if ($comment->assignment->working_day->user->id == $hairdresser->id)
          <article class="media">
            <figure class="media-left">
                @if ($comment->picture == null)
              <img id="" src="http://bulma.io/images/placeholders/1280x960.png" alt="slika" width="200" height="150">
              @else 
              <img id="" src="/userPic/{{$comment->id}}" alt="slika" width="200" height="150">
              @endif
              <div id="" class="modal">
                <span class="close" onclick="document.getElementById('').style.display='none'">&times;</span>
                <img class="modal-content" id="">
                <div id="caption"></div>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{$comment->assignment->user->first_name}} {{$comment->assignment->user->last_name}}</strong>
                  <br>
                  <a href="/termin/{{$comment->assignment->id}}">{{$comment->assignment->job->name}} -> kliknite za više informacija</a>
                  <br>
                  {{$comment->comment}}
                </p>
              </div>
              <div class="level is-mobile">
                <div class="level-left">
                  <div class="level-item">
                    <div class="star-ratings-css">
                      <!-- Samo treba broj pretvorit u postotak pa ubaucit u width -->
                      <div class="star-ratings-css-top" style="width: {{$comment->stars / 6 * 100}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                      <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>
          @endif
          @endforeach
        </div>
        </div>
      </div>
    </div>
  </div>
</div>


<style>

.column {
  background-color: #FFFFFF;
  height:100%;
}
.table {
  background-color: #f2f2f2;
}
.h2{
  text-color:red;
}

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


/*ZA MODALNU SLIKU!   */
.myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
.caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)}
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: inherit;
    top: 75px;
    right: 375px;
    color: #d0ff00;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}


</style>
<script>

for(var i = 0; i < 10 ; i++){
  var modal = document.getElementById('myModal' + i);
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById('myImg' + i);
  var modalImg = document.getElementById("img" + i);
  var captionText = document.getElementById("caption");
  img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
}

</script>

@endsection
