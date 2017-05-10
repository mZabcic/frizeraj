@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}" />

@endsection
@section('scripts')
@endsection
@section('content')


  <div class="row"  align="center">
     <div class="col-md-5 col-md-offset-3">
       <div class="panel panel-default">
              <div class="panel-heading">Rezervacija termina</div>
              <div class="panel-body">

                <form method="POST" action="{{route('rezervacijaTermina')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <label for="frizer">Frizer:</label>
                    {{$hairdresser->first_name}} {{$hairdresser->last_name}}
                    <input type="hidden" name="hairdresser" value="{{$hairdresser->id}}" />
                  </div>
                  <div class="form-group">
                <label for="time">Vrijeme:</label>
                  <select class="form-control time-select" name="time">
                    @foreach($times as $time)
                      <option value="{{ $time->timestamp }}">{{ $time->format("H:i") }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
              <label for="jobs">Posao:</label>
                <select id="jobs" class="form-control jobs"  name="job" data-trigger="hover" data-toggle="tooltip" data-placement="top">
                  @foreach($jobs as $job)
                    <option value="{{ $job->id }}" class="option" data-description="{{$job->description}}">{{$job->name}} Cijena: {{$job->price}} HRK</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
              <label for="job">Opis Posla:</label>
              <div id="jobs-desc">
                {{$jobs[0]->description}}
              </div>
              </div>


              <div class="form-group">
            <label for="hairstyles">Željena frizura (opcionalno):</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
             <span class="btn btn-file btn-default"><span class="fileupload-new">Izaberi sliku</span>
             <span class="fileupload-exists">Promijeni sliku</span>         <input type="file" name="hairstyle" /></span>
             <span class="fileupload-preview"></span>
             <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
            </div>
            </div>

              <div class="field is-grouped has-addons has-addons-centered">
                <p class="control">
                  <button class="button is-primary">Rezerviraj</button>

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
$('#jobs').change(function () {
    var selectedText = $(this).find("option:selected").data('description');
    $("#jobs-desc").html(selectedText);
});

!function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
</script>
@endsection
