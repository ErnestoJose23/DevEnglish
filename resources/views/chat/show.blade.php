@extends('layouts.app')

@section('content')

<div id="main">
    <section>
        <div class="container"> 
            <div class="sub-title"></div>
            <h2>{{$chat->title}}</h2>
        </div>
    </section>

    <img src="/uploads/media/{{ $avatar }}" class="rounded-circle" width="200px"/>

</div>

@endsection