@extends('layouts.app')

@section('content')

<div id="main">
        <section class="light" id="services">
            <div class="container">
                <div class="sub-title">Elige entre</div>
                <h2>Nuestros temarios</h2>

                <div class="content">
                    <div class="row">
                        @foreach($topics as $topic)

                       
                            <div class="col-md-6" style="text-align: center">
                                <a href="{{ route('pruebas.show', $topic->id) }}">
                                    <h4>{{$topic->name}}</h4>
                                    <img  src="/uploads/topic/{{$topic->img}}" width="336px" height="188px">
                                    
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
               
        </section>
</div>

@endsection