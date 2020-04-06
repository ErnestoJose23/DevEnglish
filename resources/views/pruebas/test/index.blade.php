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
                            </div>

                        @endforeach 

                    @endforeach
                    <button type="button" id="submitformTest" class="btn btn-dark m-3 mr-auto">Realizar Test</button>
                </div>
        </div>
        <script>
            var cont = "<?php echo $cont; ?>";
        </script>
        </section>
        <input name="problem_id" value="{{$problem->id}}" hidden>
        <input name="topic_id" value="{{$problem->topic_id}}" hidden>
    </div>
    @extends('layouts.modal')
@endsection