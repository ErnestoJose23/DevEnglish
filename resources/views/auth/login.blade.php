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
    <div class="backLeft"style="margin-top: 55px;"></div>
    <div class="right light"style="margin-top: 50px;">
    <div class="content">
    <h2><b>Login</b></h2><br>

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <label class="form-input" for="Usuario">
        <i class="material-icons">person</i>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required >
       
        <span class="label">E-mail</span>
        <div class="underline"></div>
        </label>
        
        <label class="form-input"  for="contraseña">
        <i class="material-icons">lock</i>
        <input type="password" name="password" required />
      
        <span class="label">Contraseña</span>
        <div class="underline"></div>
        </label>
        <a class=" btn1 off" style="color: #494949;" href="{{ route('register') }}">Registrate</a>
        <button type="submit" value="Entrar" class="btn1" name="submit">Login</button>
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
