<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DevEnglish</title>

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{ asset('css/bootstrap.min5152.css?ver=1.0') }}" type="text/css" media="all" /> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/vendor/sweetalert/css/sweetalert.css" rel="stylesheet">
    
    <link rel="icon" href="{{asset('favicon.ico')}}">
</head>
<body>

        <header>
        
            
                <nav class="navbar navbar-expand-lg navbar-dark dark-nav fixed-top" >
                    <div class="container">
                        <div class="navbar-header">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                        </div>
                        <a class="navbar-brand" href="/"><img src="{{ asset('/img/media/Logo.png') }}" alt="" width="130px" class="logoMenu" /></a>
                    
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav ml-auto mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                            <a class="nav-link" href="/">Inicio</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('temario.index')}}">Temarios</a>
                            </li>
                            @if (!Auth::guest())
                                <li class="nav-item"><a  class="nav-link" href="{{ route('usuario.show', Auth::user())}}">Mi progreso</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('consulta.index')}}">Consultas</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('forum.index')}}">Foro</a>
                                </li>
                            @endif

                        </ul>

                        <ul class="nav navbar-nav navbar-special my-2 my-lg-0">
                            @if (Auth::guest())
                                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">Registrate</a></li>
                            @else
                                <li class="nav-item dropdown UserName">
                                    
                                    <a href="#" class="nav-link dropdown-toggle row" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navbarDropdownMenuLink">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu"  aria-labelledby="navbarDropdownMenuLink">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('usuario.edit', Auth::user())}}">
                                                Ajustes
                                            </a>
                                            @if(Auth::user()->user_type_id == 1)
                                            <a class="dropdown-item" href="/intranet">
                                                    Intranet
                                            </a>
                                            @elseif(Auth::user()->user_type_id == 2)
                                            <a class="dropdown-item" href="/teachertopics">
                                                Intranet
                                            </a>
                                            @endif
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
        <div class="back-top" id="gotop">
            <div class="arrow-box"><span class="fa fa-angle-up fa-3x"></span></div>
        </div>
        <div class="container">
            <div class="row">
                <div class=" col text-center">
                    &copy; 2020 DevEnglish. All rights reserved
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    {{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    @yield('js')
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="/vendor/sweetalert/js/sweetalert.js"></script>

</body>
</html>
