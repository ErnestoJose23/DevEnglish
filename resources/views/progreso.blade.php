@extends('layouts.app')

@section('content')

<div id="main">
    <section class="light">
        <div class="container">
            <div class="sub-title">Perfil</div>
            <h2>{{ $user->name }} </h2>

            <div class="row" style="padding-bottom: 50px">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    @if($user->media_id == NULL)
                        <img src="/uploads/media/defaultUser.jpg" class="rounded-circle" width="200px"/>
                    @else
                        <img src="/uploads/media/{{ $user->media->archive }}" class="rounded-circle" width="200px"/>
                    @endif
                </div>
                <div class="col-md-6 text-left">
                    <p>Nombre: {{ $user->name }}</p>
                    <p>Pruebas realizadas: {{ $pruebas }}</p>
                    <p>Posts creados: {{ $posts }}</p>
                    <p>Comentarios: {{$comments }}</p>
                    <p>Suscrito a: {{$comments }} temarios</p>
                </div>
            </div>

            
            <h2>Progreso de {{ $user->name }}</h2>
            <table class="table  ">
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
        </div>
    
    </section>
</div>

@endsection