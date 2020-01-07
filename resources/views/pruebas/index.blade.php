@extends('layouts.app')

@section('content')

<div id="main">
    <section class="light mt-5" >
        <div class="container mt-5">
            <div class="content">
                <div class="row">
                    <div class="col-sm-3 text-center">
                        <a href="{{ route('getpruebas.show', [$topic->id, 1]) }}" class="thumbnail">
                            <img src="/img/media/polygon-4.png" alt="Polygon 1">
                            <div class="caption">
                                <h4>Tipo Test</h4>
                                <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 text-center">
                            <a href="{{ route('getpruebas.show', [$topic->id, 2]) }}" class="thumbnail">
                                <img src="/img/media/polygon-4.png" alt="Polygon 1">
                                <div class="caption">
                                    <h4>Listening</h4>
                                    <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                                </div>
                            </a>
                        </div>
                    <div class="col-sm-3 text-center">
                        <a href="{{ route('getpruebas.show', [$topic->id, 3]) }}" class="thumbnail">
                            <img src="/img/media/polygon-5.png" alt="Polygon 2">
                            <div class="caption">
                                <h4>Rellenar Huecos</h4>
                                <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 text-center">
                        <a href="{{ route('getpruebas.show', [$topic->id, 4]) }}" class="thumbnail">
                            <img src="/img/media/polygon-6.png" alt="Polygon 3">
                            <div class="caption">
                                <h4>Encuentra el fallo</h4>
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