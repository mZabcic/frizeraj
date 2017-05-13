@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="columns">
                <div class="column is-11">
                    Uredi korisnika  
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
                    <form class="form-horizontal" role="form" method="POST" action="/admin/korisnici/update">
                        {{ csrf_field() }}


                           
                        <div class="form-group{{ $errors->has('Ime') ? ' has-error' : '' }}">
                            <label for="Ime" class="col-md-4 control-label">Ime</label>

                            <div class="col-md-6">
                                <input id="Ime" type="text" class="form-control" name="Ime" value="{{$user->first_name}}"  autofocus>

                                @if ($errors->has('Ime'))
                                    <span class="help-block">
                                        {{ $errors->first('Ime') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Prezime') ? ' has-error' : '' }}">
                            <label for="Prezime" class="col-md-4 control-label">Prezime</label>

                            <div class="col-md-6">
                                <input id="Prezime" type="text" class="form-control" name="Prezime" value="{{$user->last_name}}" >

                                @if ($errors->has('Prezime'))
                                    <span class="help-block">
                                        {{ $errors->first('Prezime') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                            <label for="Email" class="col-md-4 control-label">E-Mail adresa</label>

                            <div class="col-md-6">
                                <input id="Email" type="text" class="form-control" name="Email" value="{{$user->email}}" >

                                @if ($errors->has('Email'))
                                    <span class="help-block">
                                        {{ $errors->first('Email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    


                            
                            <label for="Rola" class="col-md-4 control-label">Uloga</label>

                            <div class="col-md-6">
                                <span class="select">
                                <select id="uloga">
                                    <option value="1">Korisnik</option>
                                    <option value="2">Frizer</option>
                                    <option value="3">Administrator</option>
                                </select>
                                <input id="Rola" type="hidden" class="form-control" name="Rola" value="{{$user->role}}">
                                </span>
                            </div>
                      
                              <input id="Id" type="hidden" class="form-control" name="Id" value="{{$user->id}}">
                        <div class="form-group">
                            <div style="margin-top:10px;"  class="col-md-6 col-md-offset-4">
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
@endsection
