@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}" />
<style>
  div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>

@endsection
@section('scripts')
@endsection
@section('content')


  <div class="row"  align="center">
     <div class="col-md-5 col-md-offset-3">
       <div class="panel panel-default">
              <div class="panel-heading">Komentiranje termina</div>
              <div class="panel-body">


                <form method="POST" action="/termin/komentiraj" enctype="multipart/form-data">
                    {{ csrf_field() }}
                 
               <input for="assignment_id" id="assignment_id"  name="assignment_id" type="hidden" value="{{$assingment_id}}">
             
              <div class="form-group">
              <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label for="komentar" class="label">Komentar</label>
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
        <textarea for="komentar" id="komentar" name="komentar" class="textarea" placeholder="Komentiraj rad"></textarea>
         @if ($errors->has('komentar'))
                                    <span class="help-block">
                                        {{ $errors->first('komentar') }}
                                    </span>
                                @endif
      </div>
    </div>
  </div>
</div>

          

              <div style="margin:50px;" class="form-group field is-horizontal">


                            
                      <div class="stars">
  <form action="">
    <input class="star star-5" id="star-5" type="radio" name="star"/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" type="radio" name="star"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3" type="radio" name="star"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" type="radio" name="star"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" type="radio" name="star"/>
    <label class="star star-1" for="star-1"></label>
  </form>
</div>
<input id="Star-input" type="hidden"  name="Star-input">


     
</div>

              <div class="form-group">
            <label for="hairstyles">Fotografija frizure (opcionalno):</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
             <span class="btn btn-file btn-default"><span class="fileupload-new">Izaberi sliku</span>
             <span class="fileupload-exists">Promijeni sliku</span>         <input type="file" name="hairstyle" /></span>
             <span class="fileupload-preview"></span>
             <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
            </div>
            </div>

              <div class="field is-grouped has-addons has-addons-centered">
                <p class="control">
                  <button class="button is-primary">Komentiraj</button>

                  <a href="{{ url()->previous() }}"><button class="button is-link" type="button">Odustani</button></a>
                </p>
              </div>
                </form>
              </div>
            </div>
            </div>
          </div>
        </div>

<script>
$('.star').on('click', function(){
  if ( $( "input:checked" ).attr('id') == 'star-5') {
   $('#Star-input').val(5);
  } else if ( $( "input:checked" ).attr('id') == 'star-4') {
    $('#Star-input').val(4);
  } else if ( $( "input:checked" ).attr('id') == 'star-3') {
    $('#Star-input').val(3);
  }
  else if ( $( "input:checked" ).attr('id') == 'star-2') {
    $('#Star-input').val(2);
  }
  else if ( $( "input:checked" ).attr('id') == 'star-1') {
    $('#Star-input').val(1);
  }

});
$('#jobs').change(function () {
    var selectedText = $(this).find("option:selected").data('description');
    $("#jobs-desc").html(selectedText);
});

!function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
</script>
@endsection
