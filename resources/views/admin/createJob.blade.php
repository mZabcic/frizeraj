@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Novi posao</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/posao/dodaj">
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

                        <div class="form-group{{ $errors->has('Opis') ? ' has-error' : '' }}">
                            <label for="Opis" class="col-md-4 control-label">Opis</label>

                            <div class="col-md-6">
                                <input id="Opis" type="text" class="form-control" name="Opis" value="{{ old('Opis') }}" >

                                @if ($errors->has('Opis'))
                                    <span class="help-block">
                                        {{ $errors->first('Opis') }}
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('Cijena') ? ' has-error' : '' }}">
                            <label for="Cijena" class="col-md-4 control-label">Cijena</label>

                            <div class="col-md-6">
                                <input id="Cijena" type="text" class="form-control" name="Cijena" value="{{ old('Cijena') }}" >

                                @if ($errors->has('Cijena'))
                                    <span class="help-block">
                                        {{ $errors->first('Cijena') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Trajanje') ? ' has-error' : '' }}">
                            <label for="Trajanje" class="col-md-4 control-label">Trajanje: </label>

                            <div class="col-md-6">
                                <select class="form-control" id="Trajanje" name="Trajanje">
                                 <option value="15">15 minuta</option>
                                 <option value="30">30 minuta</option>
                                 <option value="45">45 minuta</option>
                                </select>
                                @if ($errors->has('Trajanje'))
                                    <span class="help-block">
                                        {{ $errors->first('Trajanje') }}
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upiši posao
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
