@extends('layouts.app')

@section('content')
<link href="{{ asset('css/test.css') }}" rel="stylesheet">
<div id="main" style="background-color: #80808008;">
        <section>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a type="button" href=""  onclick="window.history.go(-1); return false;"  style="text-transform: none;">Problems</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$problem->title}}</li>
                </ol>
            </nav>
            <div class="container"> 
                <div class="sub-title"></div>
                <h2> {{$problem->title}}</h2>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 pull-right" style="text-align: right">
                            <audio controls>
                                <source src="/uploads/problem/{{$problem->file}}" type="audio/ogg">
                                <source src="/uploads/problem/{{$problem->file}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <div class="col-md-4 col-sm-4" style="text-align: left;
                        transform: translateY(15%);">
                            
                            <button type="button" class="btn btn-lg btn-dark btn-circle" data-toggle="popover" title="Información" data-content="Escucha el audio y responde a las preguntas"><i class="fa fa-info fa-2x"></i></button>
                            <script>
                                $(function () {
                                $('[data-toggle="popover"]').popover()
                                })
                            </script>
                        </div>  
                    </div>      
                    <p>
                        <button class="btn btn-dark mt-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Audio Transcription
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body ml-5" style="text-align: initial;">
                            {!! $problem->content !!}
                        </div>
                    </div>
                    @foreach($questions as $question)
                        @php ($cont =  $loop->iteration)
                        <div class="form-row  mt-4">
                                <div class="form-group col-md-1">  
                                </div><strong> {{$cont}}.  {{$question->title}}</strong>  
                        </div>
                        @foreach($question->options as $option)
                            <div class="form-row mb-2">
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-9 inputGroup">
                                    <input class="form-check-input " type="radio" name="{{$cont}}" id="Option{{$option->id}}"value="{{$option->correct}}">
                                    <label class="option" for="Option{{$option->id}}">{{$option->option}}</label>
                                </div>
                                {{--<div class="form-group col-md-9">
                                    <input type="text" name="option" placeholder="" class="form-control" value="{{$option->option}}" style="background-color: white;" disabled >
                                    
                                </div>   --}}
                            </div>

                        @endforeach 

                    @endforeach
                    <button type="button" id="submitformTest" class="btn btn-dark m-3 mr-auto">Realizar Test</button>
                </div>
                <script>
                    var cont = "<?php echo $cont; ?>";
                </script>
            </div>
            <input name="problem_id" value="{{$problem->id}}" hidden>
            <input name="topic_id" value="{{$problem->topic_id}}" hidden>
        </section>
        @extends('layouts.modal')
    </div>

@endsection