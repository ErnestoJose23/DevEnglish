@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="{{ asset('css/login.css') }}" type="text/css" media="all" />
<style>
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    transition: background-color 5000s ease-in-out 0s;
}
</style>
<section>
        <div class="backRight"style="margin-top: 55px;"></div>
        <div class="left light"style="margin-top: 50px;">
            <div class="content" style="top:15%">
                <h2><b>Registrate</b></h2><br>
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="form-input" for="nombre">
                            <i class="material-icons">person</i>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <span class="label">Nombre</span>
                            <div class="underline"></div>
                        </label>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="form-input" for="Usuario">
                        <i class="material-icons">mail</i>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <span class="label">E-mail</span>
                        <div class="underline"></div>
                        </label>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="form-input"  for="contraseña">
                        <i class="material-icons">lock</i>
                        <input type="password" name="password" required />
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <span class="label">Contraseña</span>
                        <div class="underline"></div>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="form-input">
                            <i class="material-icons">lock</i>
                            <input id="password-confirm" type="password" name="password_confirmation" required>
                            <span class="label">Confirma Contraseña</span>
                            <div class="underline"></div>
                        </label>
                    </div>
                 
                    <button type="submit" class="btn1" name="submit">Registrate</button>
                </form>
            </div>
        </div>
</section>
<style>
footer{
    display: none;
}
</style>

@endsection
