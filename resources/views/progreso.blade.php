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
                        <img src="/uploads/media/defaultUser.jpg" class="rounded-circle avatar" />
                    @else
                        <div id="avatar"></div>
                        <style>
                            #avatar {
                                margin-left: auto;
                                margin-right: auto;
                                align-items: center;
                                background-image: url('/uploads/media/<?php echo $user->avatar; ?>');
                                width: 200px;
                                height: 200px;
                                background-size: cover;
                                background-position: top center;
                                border-radius: 50%;
                            }
                        </style>
                    @endif
                </div>
                <div class="col-md-6 text-left pt-2">
                    <p>Nombre: {{ $user->name }}</p>
                    <p>Pruebas realizadas: {{ $userproblems->count() }}</p>
                    <p>Posts creados: {{ $posts->count() }}</p>
                    <p>Comentarios: {{$comments }}</p>
                </div>
            </div>

            
            <h2>Actividad de {{ $user->name }}</h2>
            <div class="container">
                <ul id="tabs" class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Pruebas</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Foro</a>
                    </li>
                    
                </ul>
                <div id="content" class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        
                        <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                            <div class="table-responsive">
                                <table class="table mb-5" id="dataTable">
                                    <thead>
                                        <tr class="table-active">
                                        <th scope="col" style="text-align:center ">Fecha de realización</th>
                                        <th scope="col" style="text-align:center ">Temario</th>
                                        <th scope="col" style="text-align:center ">Prueba</th>
                                        <th scope="col"  style="text-align:center ">Aciertos</th>
                                        <th scope="col"  style="text-align:center ">Fallos</th>
                                        <th scope="col"  style="text-align:center ">Puntuación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($userproblems as $userproblem)
                                        <tr>
                                        <td>{{$userproblem->created_at->diffForHumans()}}</td>
                                        <td>{{$userproblem->topic->name}}</td>
                                        <td>{{$userproblem->problem->title}}</td>
                                        <td>{{$userproblem->right}}</td>
                                        <td>{{$userproblem->wrong}}</td>
                                        @if($userproblem->grade > 49.99)
                                            <td style="color:#8fec00">
                                        @else
                                            <td style="color:red">
                                        @endif
                                            {{$userproblem->grade}} %</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                        <div class="table-responsive">
                            <table class="table mb-5" id="dataTable">
                                <thead>
                                    <tr class="table-active">
                                    <th scope="col" style="text-align:center ">Fecha de cración</th>
                                    <th scope="col" style="text-align:center ">Titulo</th>
                                    <th scope="col"  style="text-align:center ">Post</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                    <tr  class='clickable-row' data-href='{{ route('forum.show', $post) }}'>
                                        <td>{{$post->created_at->diffForHumans()}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->content}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <h2>Suscrito a:</h2>
            <div class="row mb-5">
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