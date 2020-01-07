@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    .card-body{
        border: 1px solid white;
        border-radius: 2mm;
        background-color: white;
    }
</style>
<div id="main" style="background-color: #80808008;">
        <section>
            <div class="container mt-5"> 
                <div class="sub-title"></div>
                <h2> {{$problem->title}}</h2>
                <div class="card-body">  
                    @if($problem->display == 1) 
                        <div class="your-class" style="display:table">  
                        @foreach($questions as $question)
                            @php 
                                $cont =  $loop->iteration
                            @endphp
                            <div class="ml-3" style="display:table-cell">{{$question->title}} </div>
                            <input type="text" id="option{{$cont}}" class="form-control inputHuecos" style="display:table-cell">
                            <input type="text" id="answer{{$cont}}" value="{{$question->options[0]->option}}" hidden>
                            @if($question->title_2 != NULL)<div style="display:table-cell"> {{$question->title_2}} </div>@endif
                        @endforeach
                        </div>
                        @else
                        @foreach($questions as $question)
                            @php 
                                $cont =  $loop->iteration
                            @endphp
                            <div class="form-row mt-4">
                                <strong class="ml-3"> {{$cont}}.  {{$question->title}} </strong>
                                <input type="text" id="option{{$cont}}" class="form-control inputHuecos">
                                <input type="text" id="answer{{$cont}}" value="{{$question->options[0]->option}}" hidden>
                                @if($question->title_2 != NULL)<strong> {{$question->title_2}} </strong>@endif
                            </div>
                        @endforeach
                        @endif
                    <button type="button" id="submitformHueco" class="btn btn-dark m-3 mr-auto">Realizar Ejercicio</button>
                </div>
            </div>
        </section>
    </div>
    <script>
        var cont = "<?php echo $cont; ?>";
    </script>
    @extends('layouts.modal')
@endsection

