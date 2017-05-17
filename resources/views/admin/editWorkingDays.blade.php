@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" />
<link rel="stylesheet" href="/css/style.css" />
@endsection
@section('scripts')
<script src='{{ asset('fullcalendar/lib/moment.min.js') }}'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="columns">
                <div class="column is-11">
                    Promijeni radno vrijeme frizera {{$user->first_name}} {{$user->last_name}}
                </div>
                <div class="column is-1">
                 <a style="margin-top:7px;" class="button is-outlined" onclick="history.go(-1);">

    <span class="icon is-small">
      <i class="fa fa-times"></i>
    </span>
  </a>
  </div>
                </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('promijeniRadnoVrijeme',$user->id)}}">
                        {{ csrf_field() }}

                        <div align="center">
                          <table class="wd-table" id="wd-table">
                          <th style="text-align:center;"> Od </th>
                          <th style="text-align:center;"> Do </th>
                        
                        @foreach($working_days as $key=>$working_day)
                        <tr id="tr{{$key}}">


                                <td>
                                  <div align="center">
                                <div align="center" style="width:200px;">

                                        <div class='input-group date  datetimepicker'>
                                            <input type='text' class="form-control" name="from[]" value="{{$working_day->from->format('m/d/Y h:i A')}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>

                                </div>
                              </div>
                              </td>
                          <td style="height:60px;">
                            <div align="center">
                                <div class="" style="width:200px;">

                                        <div class='input-group date  datetimepicker'>
                                            <input type='text' class="form-control" name="until[]" value="{{$working_day->until->format('m/d/Y h:i A')}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
</div>
                                </div>

                        </td>
                        <td>
                          <button class="btn btn-default" type="button" onclick="document.getElementById('tr{{$key}}').parentNode.removeChild(document.getElementById('tr{{$key}}'));"><i class="fa fa-trash-o" style="font-size:20px;"></i></button>
                        </td>
                          </div>
                        </div>
                        <input name="id[]" type="hidden" value="{{$working_day->id}}" />
                        <script type="text/javascript">
                            $(function () {
                                $('.datetimepicker').each(function(index){

                                  $(this).datetimepicker();
                                });
                            });
                        </script>
                      </tr>
                        @endforeach
                        </table>
                        <div class="form-group">
                        <button type="button" class="btn" onclick="dodaj()">
                           Dodaj radno vrijeme
                        </button>
                      </div>
                              <input id="id" type="hidden" class="form-control" name="user_id" value="{{$working_days[0]->user_id}}">
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                   Spremi promjene
                                </button>
                            </div>



</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var rm_id={{$key}};
function dodaj(){
  rm_id++;
  var table = document.getElementById("wd-table");
  var tr = document.createElement("tr");
  tr.id = "tr"+rm_id;
  tr.innerHTML = '<td><div align="center"><div align="center" style="width:200px;"><div class=\'input-group date  datetimepicker\'><input type=\'text\' class="form-control" name="from[]" value="" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div></td><td style="height:60px;"><div align="center"><div class="" style="width:200px;"><div class=\'input-group date  datetimepicker\'><input type=\'text\' class="form-control" name="until[]" value="" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div></td><td><button class="btn btn-default" type="button" onclick="document.getElementById(\'tr'+rm_id+'\').parentNode.removeChild(document.getElementById(\'tr'+rm_id+'\'));"><i class="fa fa-trash-o" style="font-size:20px;"></i></button></td></div></div><input name="id[]" type="hidden" value="0" />';
  table.appendChild(tr);
  $(function () {$('.datetimepicker').each(function(index){$(this).datetimepicker();});})
}
</script>
@endsection
