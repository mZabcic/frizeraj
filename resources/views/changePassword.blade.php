@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="columns">
                <div class="column is-11">
                    Promjena lozinke
                </div>
                <div class="column is-1">
                </div>
                </div>
                </div>
              </br>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="/korisnik/postCredentials">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="current-password" class="col-md-4 control-label">Trenutna lozinka</label>

                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id="current-password" type="password" class="form-control" name="current-password" placeholder="Password">
                          </div>
                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    {{ $errors->first('current-password') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Nova lozinka</label>

                        <div class="col-md-6">
                          <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                          </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-md-4 control-label">Ponovite novu lozinku</label>

                        <div class="col-md-6">
                          <div class="form-group">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter Password">
                          </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    {{ $errors->first('password_confirmation') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-5 col-sm-6">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
