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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a type="button" href=""  onclick="window.history.go(-1); return false;"  style="text-transform: none;">Problems</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$problem->title}}</li>
                </ol>
            </nav>
            <div class="container mt-5"> 
                <div class="sub-title"></div>
                <h2> {{$problem->title}}</h2>
                <div class="card-body" style="padding: 30px 100px 0px 100px;">  
                    @php
                        $answers = array();
                    @endphp
                    @if($problem->display == 1) 
                        <div class="row" >  
                        @foreach($questions as $question)
                            @php 
                                $cont =  $loop->iteration;
                                array_push($answers, $question->options[0]->option);
                            @endphp
                            {{$question->title}}
                            <input type="text" id="option{{$cont}}" class="form-control inputHuecos">
                            @if($question->title_2 != NULL) {{$question->title_2}}@endif
                            
                        @endforeach
                        </div>
                        @else
                        @foreach($questions as $question)
                            @php 
                                $cont =  $loop->iteration;
                                array_push($answers, $question->options[0]->option);
                            @endphp
                            <div class="form-row mt-4">
                                <strong class="ml-3"> {{$cont}}.  {{$question->title}} </strong>
                                <input type="text" id="option{{$cont}}" class="form-control inputHuecos">
                                @if($question->title_2 != NULL)<strong> {{$question->title_2}} </strong>@endif
                            </div>
                        @endforeach
                        @endif
                    <button type="button" id="submitformHueco" class="btn btn-dark m-3 mr-auto">Realizar Ejercicio</button>
                </div>
            </div>
        </section>
        <input name="problem_id" value="{{$problem->id}}" hidden>
        <input name="topic_id" value="{{$problem->topic_id}}" hidden>
    </div>
    <script>
        var cont = "<?php echo $cont; ?>";
        var answer = [<?php echo '"'.implode('","', $answers).'"' ?>];
        console.log(answer);
    </script>
    @extends('layouts.modal')
@endsection

