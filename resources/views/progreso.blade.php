@extends('layouts.app')

@section('content')

<div id="main">
    <section class="light mt-5">
        <div class="container ">
            <div class="sub-title">Perfil</div>
            <h2>{{ $user->name }} </h2>

            <div class="row mb-5">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    @if($user->avatar == NULL)
                        <img src="/uploads/media/defaultUser.jpg" class="rounded-circle" width="200px"/>
                    @else
                        <img src="/uploads/media/{{ $user->avatar }}" class="rounded-circle" width="200px"/>
                    @endif
                </div>
                <div class="col-md-6 text-left">
                    <p>Nombre: {{ $user->name }}</p>
                    <p>Pruebas realizadas: {{ $userproblems->count() }}</p>
                    <p>Posts creados: {{ $posts }}</p>
                    <p>Comentarios: {{$comments }}</p>
                </div>
            </div>

            
            <h2>Progreso de {{ $user->name }}</h2>
            <table class="table mb-5">
                <thead>
                    <tr class="table-active">
                    <th scope="col" style="text-align:center ">Prueba</th>
                    <th scope="col"  style="text-align:center ">Aciertos</th>
                    <th scope="col"  style="text-align:center ">Preguntas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userproblems as $userproblem)
                    <tr>
                    <td>
                        <div style="display: none">{{$problem = \App\Problem::where('id', $userproblem->problem_id)->first()}}</div>
                        {{$problem->title}}
                    </td>
                    <td>{{$userproblem->success}}</td>
                    <td>{{$userproblem->options}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h2>Suscrito a:</h2>
            <div class="row">
                @foreach($subscriptions as $suscribed)
                    <div class="col-md-4">
                        <h5 class="mb-3">{{$suscribed->topic->name}}</h5>
                        @if($suscribed->topic->avatar == NULL)
                            <img src="/uploads/media/default.jpg" width="188px"/>
                        @else
                            <img src="/uploads/media/{{ $suscribed->topic->avatar }}" width="188px"/>
                        @endif
                    </div>
                @endforeach
                </div>
        </div>
    
    </section>
</div>

@endsection