@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Novi korisnik</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/korisnici/create">
                        {{ csrf_field() }}


                           
                        <div class="form-group{{ $errors->has('Ime') ? ' has-error' : '' }}">
                            <label for="Ime" class="col-md-4 control-label">Ime</label>

                            <div class="col-md-6">
                                <input id="Ime" type="text" class="form-control" name="Ime" value="{{ old('Ime') }}"  autofocus>

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
                                <input id="Prezime" type="text" class="form-control" name="Prezime" value="{{ old('Prezime') }}" >

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
                                <input id="Email" type="text" class="form-control" name="Email" value="{{ old('Email') }}" >

                                @if ($errors->has('Email'))
                                    <span class="help-block">
                                        {{ $errors->first('Email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Lozinka') ? ' has-error' : '' }}">
                            <label for="Lozinka" class="col-md-4 control-label">Lozinka</label>

                            <div class="col-md-6">
                                <input id="Lozinka" type="password" class="form-control" name="Lozinka" >

                                @if ($errors->has('Lozinka'))
                                    <span class="help-block">
                                        {{ $errors->first('Lozinka') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Lozinka-confirm" class="col-md-4 control-label">Potvrdi Lozinku</label>

                            <div class="col-md-6">
                                <input id="Lozinka-confirm" type="password" class="form-control" name="Lozinka_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">


                            
                            <label for="Rola" class="col-md-4 control-label">Uloga</label>

                            <div class="col-md-6">
                                <span class="select">
                                <select id="uloga">
                                    <option value="1">Korisnik</option>
                                    <option value="2">Frizer</option>
                                    <option value="3">Administrator</option>
                                </select>
                                <input id="Rola" type="hidden" class="form-control" name="Rola" value="{{ old('Rola') }}">
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kreiraj novog korisnika
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
