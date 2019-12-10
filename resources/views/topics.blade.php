@extends('layouts.app')

@section('content')

<div id="main">
    <section >
        <div class="container">
            <div class="sub-title">Elige entre</div>
            <h2>Nuestros temarios</h2>
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
                            <div class="col-md-4"><a href="{{ route('videos.show', $topic->id) }}" class="btn btn-dark" style="text-transform: capitalize;">Videos</i></a></div>
                            <div class="col-md-4"><a href="{{ route('links.show', $topic->id) }}" class="btn btn-dark" style="text-transform: capitalize;">Links</i></a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection