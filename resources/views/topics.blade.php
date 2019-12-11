@extends('layouts.app')

@section('content')

<div id="main">
    <section >
        <div class="container">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" style="margin-top: 20px;">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(count($subscribed) > 0)<h2>Suscrito</h2> @endif
            <div class="content">
                @foreach($subscribed as $topicsub)
                <div class="row bottom-border">
                    <div class="col-md-6 col-sm-6">
                        <a href="" target="_blank">
                                @if($topicsub->topic->media_id == NULL)
                                <img src="/uploads/media/default.jpg" width="188px"/>
                            @else
                                <img src="/uploads/media/{{ $topicsub->topic->media->archive }}" width="188px"/>
                            @endif
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="row">
                            <h3>{{$topicsub->topic->name}}</h3>
                        </div>
                        <div class="row" style="padding-top: 20px">
                            <div class="col-md-4"><a href="" class="btn btn-dark" style="text-transform: capitalize;">Información</i></a></div>
                            <div class="col-md-4"><a href="{{ route('pruebasIndex.show', $topicsub->topic->id) }}" class="btn btn-dark" style="text-transform: capitalize;">Pruebas</i></a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if (!Auth::guest())
                @if(count($topics) > 0)<h2 class="pt-3">Sin suscribir</h2>@endif
            @else
                <h2>Nuestros temarios</h2>
            @endif
            <div class="content">
                @foreach($topics as $topic)
                <div class="row bottom-border">
                    <div class="col-md-6 col-sm-6">
                        <a href="" target="_blank">
                                @if($topic->media_id == NULL)
                                <img src="/uploads/media/default.jpg" width="188px"/>
                            @else
                                <img src="/uploads/media/{{ $topic->media->archive }}" width="188px"/>
                            @endif
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="row">
                            <h3>{{$topic->name}}</h3>
                        </div>
                        <div class="row" style="padding-top: 20px">
                            <form method="POST" action=" {{ route('subscription.store')}}">
                                @csrf
                                <input name="user_id" value="{{Auth::id()}}" hidden>
                                <input name="topic_id" value="{{$topic->id}}" hidden>
                                <input name="name" value="{{$topic->name}}" hidden>
                                <button type="submit"class="btn btn-dark m-3">Suscribete</button>
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