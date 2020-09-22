@extends('layouts.app')

@section('content')

<div id="main">
    <section >
        <div class="container mt-5 mb-5">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" style="margin-top: 20px;">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (!Auth::guest())
                @if(count($subscribed) > 0)<h2>Suscrito</h2>
                    <div class="content">
                        @foreach($subscribed as $topicsub)
                        <div class="row bottom-border">
                            <div class="col-md-6 col-sm-6">
                                    @if($topicsub->topic->avatar == NULL)
                                        <img src="/uploads/media/default.jpg" width="188px" />
                                    @else
                                        <img src="/uploads/media/{{ $topicsub->topic->avatar }}" width="188px" alt="{{$topicsub->topic->name}}"/>
                                    @endif
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <h3>{{$topicsub->topic->name}}</h3>
                                </div>
                                <div class="row">
                                    {{$topicsub->topic->description}}
                                </div>
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-md-4"><a href="{{ route('information.show', $topicsub->topic->id) }}" class="btn btn-dark" style="text-transform: capitalize;">Información</i></a></div>
                                    <div class="col-md-4"><a href="{{ route('pruebasIndex.show', $topicsub->topic->id) }}" class="btn btn-dark" style="text-transform: capitalize;">Pruebas</i></a></div>
                                    <div class="col-md-4">
                                        <form action="{{route('subscription.destroy', $topicsub)}}" method="POST" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-circle confirmar-cancelacion">Cancelar suscripción</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            
                @if(count($topics) > 0)<h2 class="pt-3">Sin suscribir</h2>@endif
            @else
                <h2 class="mt-5">Nuestros temarios</h2>
            @endif
            <div class="content mb-5">
                @foreach($topics as $topic)
                <div class="row bottom-border">
                    <div class="col-md-6 col-sm-6">
                            @if($topic->avatar == NULL)
                                <img src="/uploads/media/default.jpg" width="188px"/>
                            @else
                                <img src="/uploads/media/{{ $topic->avatar }}" width="188px" alt="{{$topic->name}}"/>
                            @endif
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="row">
                            <h3>{{$topic->name}}</h3>
                        </div>
                        <div class="row">
                            {{$topic->description}}
                        </div>
                        <div class="row" style="padding-top: 20px">
                            <form method="POST" action=" {{ route('subscription.store')}}">
                                @csrf
                                <input name="user_id" value="{{Auth::id()}}" hidden>
                                <input name="topic_id" value="{{$topic->id}}" hidden>
                                <input name="name" value="{{$topic->name}}" hidden>
                                @if (!Auth::guest())    <button type="submit"class="btn btn-dark m-3">Suscribete</button>
                                @else
                                <h5>Registrate para acceder a nuestros temarios</h5>
                                <a href="{{ route('register') }}" class="btn btn-dark mt-3">Registrate</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection