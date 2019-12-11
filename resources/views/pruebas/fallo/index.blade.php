@extends('layouts.app')

@section('content')
    <style>
    .inputGroup {
        background-color: #fff;
        display: block;
        margin: 10px 0;
        position: relative;
    }
    .inputGroup .option {
        border: 1px solid #8080805c;
        border-radius: 2mm;
        padding:8px;
        width: 100%;
        display: block;
        text-align: left;
        color: #3c454c;
        cursor: pointer;
        position: relative;
        z-index: 2;
        transition: color 200ms ease-in;
        overflow: hidden;
    }
    .inputGroup .option:before {
        width: 100%;
        height: 10px;
        border-radius: 50%;
        content: '';
        background-color: #5562eb;
        position: absolute;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
    }
    .inputGroup .option:after {
        width: 32px;
        height: 32px;
        content: '';
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
    }
    .inputGroup input:checked ~ label {
        color: #fff;
    }
    .inputGroup input:checked ~ label:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
    }

    .inputGroup input {
        width: 32px;
        height: 32px;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }
    .card-body{
        border: 1px solid white;
        border-radius: 2mm;
        background-color: white;
    }
    
    .btn-circle {
    width: 40px;
    height: 40px;
    padding: 6px 0px;
    border-radius: 20px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}


</style>
<div id="main" style="background-color: #80808008;">
        <section>
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
                    <form method="POST" action="{{ route('test.realizar') }}" enctype="multipart/form-data">
                        @csrf
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
                        <input hidden name="questions" value={{$cont}}>
                        <input hidden name="problem_id" value={{$problem->id}}>
                        <input hidden name="user_id" value={{ Auth::user()->id}}>
                        <button type="submit"class="btn btn-dark m-3 mr-auto">Realizar Test</button>
                    </form>
                </div>
             
            
        </div>
        </section>
    
    </div>

@endsection