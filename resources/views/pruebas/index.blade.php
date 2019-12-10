@extends('layouts.app')

@section('content')

<div id="main">
        <section class="light" id="services">
            <div class="container">
<div class="content">

        <div class="row">
            <div class="col-sm-3 text-center">
                <a href="{{ route('test.show', $topic->id) }}" class="thumbnail">
                    <img src="/img/media/polygon-4.png" alt="Polygon 1">
                    <div class="caption">
                        <h4>Tipo Test</h4>
                        <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="/hueco" class="thumbnail">
                    <img src="/img/media/polygon-5.png" alt="Polygon 2">
                    <div class="caption">
                        <h4>Rellenar Huecos</h4>
                        <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="/fallo" class="thumbnail">
                    <img src="/img/media/polygon-6.png" alt="Polygon 3">
                    <div class="caption">
                        <h4>Encuentra el fallo</h4>
                        <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('listening.show', $topic->id) }}" class="thumbnail">
                    <img src="/img/media/polygon-4.png" alt="Polygon 1">
                    <div class="caption">
                        <h4>Listening</h4>
                        <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
        </section>
</div>

@endsection