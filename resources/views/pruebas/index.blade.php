@extends('layouts.app')

@section('content')

<div id="main">
    <section class="light mt-5" >
        <div class="container mt-5">
            <h2>Problems</h2>
            <div class="row">
                    <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Tipo test</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Listening</a>
                                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Rellenar Huecos</a>
                                    <a class="nav-link" id="v-pills-fallo-tab" data-toggle="pill" href="#v-pills-fallo" role="tab" aria-controls="v-pills-fallo" aria-selected="false">Encontrar Fallo</a>
                            </div>
                    </div>
                    <div class="col-9" style="background-color: #8080800f;">
                            <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" style="text-align: left">
                                        @if(!$tests->isEmpty())
                                            @foreach($tests as $test)
                                                <a href="{{ route('prueba.show', $test) }}" >
                                                    <h5 class="mt-3 ml-2">
                                                        - {{$test->title}}
                                                    </h5>
                                                </a>
                                            @endforeach
                                        @else
                                        Aun no se ha añadido ningun problema.
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" style="text-align: left">
                                        @if(!$listenings->isEmpty())
                                            @foreach($listenings as $listening)
                                                <a href="{{ route('prueba.show', $listening) }}" >
                                                    <h5 class="mt-3 ml-2">
                                                        - {{$listening->title}}
                                                    </h5>
                                                </a>
                                            @endforeach
                                        @else
                                        Aun no se ha añadido ningun problema.
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" style="text-align: left">
                                        @if(!$huecos->isEmpty())
                                        @foreach($huecos as $hueco)
                                            <a href="{{ route('prueba.show', $hueco) }}" >
                                                <h5 class="mt-3 ml-2">
                                                    - {{$hueco->title}}
                                                </h5>
                                            </a>
                                        @endforeach
                                    @else
                                    Aun no se ha añadido ningun problema.
                                    @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-fallo" role="tabpanel" aria-labelledby="v-pills-fallo-tab" style="text-align: left">
                                        @if(!$fallos->isEmpty())
                                        @foreach($fallos as $fallo)
                                            <a href="{{ route('prueba.show', $fallo) }}" >
                                                <h5 class="mt-3 ml-2">
                                                    - {{$fallo->title}}
                                                </h5>
                                            </a>
                                        @endforeach
                                    @else
                                    Aun no se ha añadido ningun problema.
                                    @endif
                                    </div>
                            </div>
                    </div>
            </div>
        </div>
    </section>
</div>

@endsection