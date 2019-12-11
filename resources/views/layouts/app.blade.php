<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EnglishDev</title>

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{ asset('css/bootstrap.min5152.css?ver=1.0') }}" type="text/css" media="all" /> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{asset('favicon.ico')}}">
</head>
<body>

        <header>
        
            
                <nav class="navbar navbar-expand-lg navbar-dark dark-nav fixed-top" >
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        {{--<a class="navbar-brand" href="/"><img src="{{ asset('/img/logo.png') }}" alt="" /></a>--}}
                    
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav ml-auto mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                            <a class="nav-link" href="/">Inicio</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('temario.index')}}">Temarios</a>
                            </li>
                            @if (!Auth::guest())

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('forum.index')}}">Foro</a>
                            </li>
                            <li class="nav-item"><a  class="nav-link" href="{{ route('user.progreso', Auth::id())}}">Mi progreso</a></li>
                            @endif

                        </ul>

                        <ul class="nav navbar-nav navbar-special my-2 my-lg-0">
                            @if (Auth::guest())
                                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">Registrate</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navbarDropdownMenuLink">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu"  aria-labelledby="navbarDropdownMenuLink">
                                        <li>
                                                <a class="dropdown-item" href="/ajustes">
                                                Ajustes
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        
                        </ul>
                        
                        </div>
                    </div>
                    </nav>
            
        </header>
    @yield('content')

    <footer id="footer" class="dark footer-bg">
        <div class="back-top">
            <div class="arrow-box"><span class="fa fa-angle-up fa-3x"></span></div>
        </div>
        <div class="container">
            <div class="row">
                <div class=" col text-center">
                    &copy; 2019 DevEnglish. All rights reserved
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @yield('js')
</body>
</html>
